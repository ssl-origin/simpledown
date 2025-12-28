<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2
 */
namespace mundophpbb\simpledown\controller;

use phpbb\config\config;
use phpbb\language\language;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;

class acp_tools_controller
{
    protected $config;
    protected $language;
    protected $request;
    protected $template;
    protected $user;
    protected $u_action;
    protected $root_path;

    public function __construct(
        config $config,
        language $language,
        request $request,
        template $template,
        user $user
    ) {
        $this->config   = $config;
        $this->language = $language;
        $this->request  = $request;
        $this->template = $template;
        $this->user     = $user;
        global $phpbb_root_path;
        $this->root_path = $phpbb_root_path;
    }

    /**
 * Define a URL da página atual (usada para redirecionamentos e links)
 */
public function set_page_url($u_action)
{
    $this->u_action = $u_action;
}

    public function handle()
    {
        // ==================================================
        // Exclusão de Miniatura
        // ==================================================
        if ($this->request->variable('delete_thumb', 0))
        {
            $filename = $this->request->variable('filename', '', true);
            if (!empty($filename))
            {
                $filename  = basename($filename);
                $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/' . $filename;

                if (file_exists($file_path) && is_file($file_path))
                {
                    if (@unlink($file_path))
                    {
                        trigger_error($this->language->lang('ACP_SIMPLEDOWN_THUMB_DELETED') . adm_back_link($this->u_action));
                    }
                    else
                    {
                        trigger_error($this->language->lang('ACP_SIMPLEDOWN_THUMB_DELETE_FAILED', $filename) . adm_back_link($this->u_action), E_USER_WARNING);
                    }
                }
            }
        }

        // ==================================================
        // Exclusão de Arquivo Órfão (/files/)
        // ==================================================
        if ($this->request->variable('delete_file', 0))
        {
            $filename = $this->request->variable('filename', '', true);
            if (!empty($filename))
            {
                $filename  = basename($filename);
                $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/' . $filename;

                if (file_exists($file_path) && is_file($file_path))
                {
                    if (@unlink($file_path))
                    {
                        trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_DELETED') . adm_back_link($this->u_action));
                    }
                    else
                    {
                        trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_DELETE_FAILED', $filename) . adm_back_link($this->u_action), E_USER_WARNING);
                    }
                }
            }
        }

        // Lista miniaturas e arquivos órfãos
        $this->list_thumbnails();
        $this->list_orphan_files();

        $this->template->set_filenames([
            'body' => '@mundophpbb_simpledown/acp_simpledown_tools.html',
        ]);
    }

    /**
     * Lista todas as miniaturas na pasta /thumbs/
     */
    protected function list_thumbnails()
    {
        $thumbs_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/';
        $thumbs_url = generate_board_url() . '/ext/mundophpbb/simpledown/files/thumbs/';

        $thumbnails = [];
        clearstatcache();

        if (is_dir($thumbs_dir))
        {
            $files = glob($thumbs_dir . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
            if ($files !== false)
            {
                foreach ($files as $file)
                {
                    if (is_file($file))
                    {
                        $filename = basename($file);
                        $size     = filesize($file);
                        $formatted_size = $size >= 1024 ? round($size / 1024, 2) . ' KB' : $size . ' B';

                        $thumbnails[] = [
                            'FILENAME'    => $filename,
                            'SIZE'        => $formatted_size,
                            'PREVIEW_URL' => $thumbs_url . $filename,
                            'U_DELETE'    => $this->u_action . '&delete_thumb=1&filename=' . rawurlencode($filename),
                        ];
                    }
                }
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

    /**
     * Lista arquivos órfãos na pasta principal /files/ (excluindo a subpasta thumbs)
     */
    protected function list_orphan_files()
    {
        $files_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/';

        $orphan_files = [];
        clearstatcache();

        if (is_dir($files_dir))
        {
            $entries = scandir($files_dir);
            if ($entries !== false)
            {
                foreach ($entries as $entry)
                {
                    // Ignora ., .., pasta thumbs e arquivos ocultos que começam com .
                    if ($entry === '.' || $entry === '..' || $entry === 'thumbs' || $entry[0] === '.' || !is_file($files_dir . $entry))
                    {
                        continue;
                    }

                    $file_path = $files_dir . $entry;
                    $size      = filesize($file_path);
                    $formatted_size = $size >= 1024 ? round($size / 1024, 2) . ' KB' : $size . ' B';

                    $orphan_files[] = [
                        'FILENAME' => $entry,
                        'SIZE'     => $formatted_size,
                        'U_DELETE' => $this->u_action . '&delete_file=1&filename=' . rawurlencode($entry),
                    ];
                }
            }
        }

        foreach ($orphan_files as $file)
        {
            $this->template->assign_block_vars('orphan_files', $file);
        }

        $this->template->assign_vars([
            'S_HAS_ORPHAN_FILES' => !empty($orphan_files),
            'TOTAL_ORPHAN_FILES' => count($orphan_files),
        ]);
    }
}