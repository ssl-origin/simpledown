<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2026 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2
 */
namespace mundophpbb\simpledown\controller;

use phpbb\config\config;
use phpbb\db\driver\driver_interface;
use phpbb\language\language;
use phpbb\log\log;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;
use phpbb\path_helper;

class acp_tools_controller
{
    protected $config;
    protected $db;
    protected $language;
    protected $log;
    protected $request;
    protected $template;
    protected $user;
    protected $path_helper;
    protected $root_path;
    protected $php_ext;
    protected $table_prefix;
    protected $files_table;
    protected $u_action;

    public function __construct(
        config $config,
        driver_interface $db,
        language $language,
        log $log,
        request $request,
        template $template,
        user $user,
        path_helper $path_helper,
        $root_path,
        $php_ext,
        $table_prefix
    ) {
        $this->config = $config;
        $this->db = $db;
        $this->language = $language;
        $this->log = $log;
        $this->request = $request;
        $this->template = $template;
        $this->user = $user;
        $this->path_helper = $path_helper;
        $this->root_path = $root_path;
        $this->php_ext = $php_ext;
        $this->table_prefix = $table_prefix;
        $this->files_table = $table_prefix . 'simpledown_files';
    }

    public function set_page_url($u_action)
    {
        $this->u_action = $u_action;
    }

    public function handle()
    {
        // Confirmações de deleção (confirm_box nativo do phpBB)
        if ($this->request->variable('delete_thumb', 0))
        {
            $filename = $this->request->variable('filename', '', true);
            if (!empty($filename) && confirm_box(true))
            {
                $this->delete_thumbnail($filename);
            }
            else if (!empty($filename))
            {
                confirm_box(false, $this->language->lang('CONFIRM_DELETE_THUMB', $filename), build_hidden_fields([
                    'delete_thumb' => 1,
                    'filename' => $filename,
                ]));
            }
        }

        if ($this->request->variable('delete_orphan', 0))
        {
            $filename = $this->request->variable('filename', '', true);
            if (!empty($filename) && confirm_box(true))
            {
                $this->delete_orphan_file($filename);
            }
            else if (!empty($filename))
            {
                confirm_box(false, $this->language->lang('CONFIRM_DELETE_ORPHAN', $filename), build_hidden_fields([
                    'delete_orphan' => 1,
                    'filename' => $filename,
                ]));
            }
        }

        // Listagens
        $this->list_thumbnails();
        $this->list_associated_files();
        $this->list_orphan_files();

        $this->template->set_filenames([
            'body' => '@mundophpbb_simpledown/acp_simpledown_tools.html',
        ]);
    }

    protected function list_thumbnails()
    {
        $thumbs_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/';
        $thumbs_url = generate_board_url() . '/ext/mundophpbb/simpledown/files/thumbs/';
        $thumbnails = [];
        clearstatcache();

        if (is_dir($thumbs_dir))
        {
            $files = glob($thumbs_dir . '*.{jpg,jpeg,png,gif,webp,JPG,JPEG,PNG,GIF,WEBP}', GLOB_BRACE);
            if ($files !== false)
            {
                foreach ($files as $file)
                {
                    if (is_file($file))
                    {
                        $filename = basename($file);
                        $size = filesize($file);
                        $formatted_size = $this->format_filesize($size);
                        $thumbnails[] = [
                            'FILENAME' => $filename,
                            'SIZE' => $formatted_size,
                            'PREVIEW_URL' => $thumbs_url . $filename,
                            'U_DELETE' => $this->u_action . '&delete_thumb=1&filename=' . rawurlencode($filename),
                        ];
                    }
                }
                usort($thumbnails, function($a, $b) {
                    return strcasecmp($a['FILENAME'], $b['FILENAME']);
                });
            }
        }

        foreach ($thumbnails as $thumb)
        {
            $this->template->assign_block_vars('thumbs', $thumb);
        }

        $this->template->assign_vars([
            'S_HAS_THUMBS' => !empty($thumbnails),
            'TOTAL_THUMBS' => count($thumbnails),
        ]);
    }

    protected function list_associated_files()
    {
        $files_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/';
        $web_root = generate_board_url() . '/ext/mundophpbb/simpledown/files/';

        $sql = 'SELECT file_realname, file_name, file_size
                FROM ' . $this->files_table . '
                WHERE file_realname IS NOT NULL AND file_realname != ""
                ORDER BY file_name';
        $result = $this->db->sql_query($sql);

        $associated = [];
        while ($row = $this->db->sql_fetchrow($result))
        {
            $filename = $row['file_realname'];
            $full_path = $files_dir . $filename;
            if (file_exists($full_path))
            {
                $size = $row['file_size'] ?: filesize($full_path);
                $formatted_size = $this->format_filesize($size);
                $associated[] = [
                    'FILENAME' => $filename,
                    'DISPLAY_NAME' => $row['file_name'],
                    'SIZE' => $formatted_size,
                    'FILE_URL' => $web_root . $filename,
                ];
            }
        }
        $this->db->sql_freeresult($result);

        foreach ($associated as $file)
        {
            $this->template->assign_block_vars('associated_files', $file);
        }

        $this->template->assign_vars([
            'S_HAS_ASSOCIATED' => !empty($associated),
            'TOTAL_ASSOCIATED' => count($associated),
        ]);
    }

    protected function list_orphan_files()
    {
        $files_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/';

        // Arquivos usados no banco
        $used_files = [];
        $sql = 'SELECT file_realname FROM ' . $this->files_table . ' WHERE file_realname IS NOT NULL AND file_realname != ""';
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $used_files[$row['file_realname']] = true;
        }
        $this->db->sql_freeresult($result);

        $orphan_files = [];
        clearstatcache();

        if (is_dir($files_dir))
        {
            $entries = scandir($files_dir);
            if ($entries !== false)
            {
                foreach ($entries as $entry)
                {
                    if ($entry === '.' || $entry === '..' || $entry === 'thumbs' || $entry[0] === '.' || !is_file($files_dir . $entry))
                    {
                        continue;
                    }
                    if (!isset($used_files[$entry]))
                    {
                        $size = filesize($files_dir . $entry);
                        $formatted_size = $this->format_filesize($size);
                        $orphan_files[] = [
                            'FILENAME' => $entry,
                            'SIZE' => $formatted_size,
                            'U_DELETE' => $this->u_action . '&delete_orphan=1&filename=' . rawurlencode($entry),
                        ];
                    }
                }
                usort($orphan_files, function($a, $b) {
                    return strcasecmp($a['FILENAME'], $b['FILENAME']);
                });
            }
        }

        foreach ($orphan_files as $file)
        {
            $this->template->assign_block_vars('orphan_files', $file);
        }

        $this->template->assign_vars([
            'S_HAS_ORPHANS' => !empty($orphan_files),
            'TOTAL_ORPHANS' => count($orphan_files),
        ]);
    }

    protected function delete_thumbnail($filename)
    {
        $filename = basename($filename);
        $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/' . $filename;

        if (file_exists($file_path) && is_file($file_path) && @unlink($file_path))
        {
            $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_THUMB_DELETED', false, [$filename]);
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_THUMB_DELETED', $filename) . adm_back_link($this->u_action));
        }

        trigger_error($this->language->lang('ACP_SIMPLEDOWN_THUMB_DELETE_FAILED', $filename) . adm_back_link($this->u_action), E_USER_WARNING);
    }

    protected function delete_orphan_file($filename)
    {
        $filename = basename($filename);
        $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/' . $filename;

        if (file_exists($file_path) && is_file($file_path) && @unlink($file_path))
        {
            $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_ORPHAN_DELETED', false, [$filename]);
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_ORPHAN_DELETED', $filename) . adm_back_link($this->u_action));
        }

        trigger_error($this->language->lang('ACP_SIMPLEDOWN_ORPHAN_DELETE_FAILED', $filename) . adm_back_link($this->u_action), E_USER_WARNING);
    }

    protected function format_filesize($bytes)
    {
        $bytes = max((int)$bytes, 0);
        if ($bytes < 1024) return $bytes . ' B';
        if ($bytes < 1048576) return round($bytes / 1024, 2) . ' KB';
        if ($bytes < 1073741824) return round($bytes / 1048576, 2) . ' MB';
        return round($bytes / 1073741824, 2) . ' GB';
    }
}