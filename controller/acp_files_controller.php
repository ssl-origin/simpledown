<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
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

class acp_files_controller
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
    protected $categories_table;
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
        $this->config            = $config;
        $this->db                = $db;
        $this->language          = $language;
        $this->log               = $log;
        $this->request           = $request;
        $this->template          = $template;
        $this->user              = $user;
        $this->path_helper       = $path_helper;
        $this->root_path         = $root_path;
        $this->php_ext           = $php_ext;
        $this->categories_table  = $table_prefix . 'simpledown_categories';
        $this->files_table       = $table_prefix . 'simpledown_files';
    }

    public function set_u_action($u_action)
    {
        $this->u_action = $u_action;
    }

    public function handle()
    {
        $action = $this->request->variable('action', '');
        $id     = $this->request->variable('id', 0);

        if ($action === 'delete' && $id) {
            $this->delete_file($id);
        }
        if ($action === 'edit' && $id) {
            $this->edit_file($id);
        }
        if ($this->request->is_set_post('submit_edit')) {
            if (!check_form_key('mundophpbb_simpledown')) {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }
            $this->save_edit_file($id);
        }

        $this->list_files();
    }

    protected function list_files()
    {
        $global_default_private = (int)($this->config['simpledown_default_is_private'] ?? 0);

        $sql = 'SELECT f.*, c.name AS cat_name
                FROM ' . $this->files_table . ' f
                LEFT JOIN ' . $this->categories_table . ' c ON f.category_id = c.id
                ORDER BY f.file_name';
        $result = $this->db->sql_query($sql);
        $total_files = 0;

        while ($row = $this->db->sql_fetchrow($result)) {
            $total_files++;
            $effective_private = ($row['is_private'] !== null) ? (int)$row['is_private'] : $global_default_private;
            $desc_short = $row['file_desc_short'] ?: $row['file_desc'] ?: $this->language->lang('ACP_SIMPLEDOWN_NO_DESCRIPTION');

            $this->template->assign_block_vars('files', [
                'ID'            => $row['id'],
                'NAME'          => $row['file_name'],
                'DESC_SHORT'    => $desc_short,
                'DESC_FORMATTED'=> nl2br(htmlspecialchars($row['file_desc'] ?? '', ENT_QUOTES)),
                'VERSION'       => $row['version'] ?? '-',
                'CAT'           => $row['cat_name'] ?? $this->language->lang('ACP_SIMPLEDOWN_NO_CATEGORY'),
                'DOWNLOADS'     => $row['downloads'] ?? 0,
                'SIZE'          => $this->get_formatted_filesize($row['file_size'] ?? 0),
                'REAL_NAME'     => $row['file_realname'],
                'FILE_ICON'     => $this->get_file_icon_class($row['file_realname']),
                'IS_PRIVATE'    => $effective_private,
                'U_EDIT'        => $this->u_action . '&action=edit&id=' . $row['id'],
                'U_DELETE'      => $this->u_action . '&action=delete&id=' . $row['id'],
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars([
            'U_ACTION'     => $this->u_action,
            'TOTAL_FILES'  => $total_files,
        ]);
    }

    protected function edit_file($id)
    {
        $sql = 'SELECT * FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$row) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_NOT_FOUND') . adm_back_link($this->u_action . '&mode=files'), E_USER_WARNING);
        }

        // Thumbnails existentes
        $thumbs_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/';
        $thumbs_list = [];
        if (is_dir($thumbs_dir)) {
            $files = scandir($thumbs_dir);
            foreach ($files as $file) {
                if ($file === '.' || $file === '..') continue;
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
                    $thumbs_list[] = $file;
                }
            }
            sort($thumbs_list);
        }
        foreach ($thumbs_list as $thumb) {
            $this->template->assign_block_vars('thumbs', ['FILENAME' => $thumb]);
        }

        // Categorias
        $sql = 'SELECT * FROM ' . $this->categories_table . ' ORDER BY name';
        $result = $this->db->sql_query($sql);
        while ($cat_row = $this->db->sql_fetchrow($result)) {
            $this->template->assign_block_vars('categories', [
                'ID'   => $cat_row['id'],
                'NAME' => $cat_row['name'],
            ]);
        }
        $this->db->sql_freeresult($result);

        $edit_is_private = ($row['is_private'] !== null) ? (int)$row['is_private'] : (int)($this->config['simpledown_default_is_private'] ?? 0);

        $this->template->assign_vars([
            'S_EDIT_MODE'          => true,
            'EDIT_FILE_ID'         => $row['id'],
            'EDIT_FILE_NAME'       => $row['file_name'],
            'EDIT_FILE_DESC_SHORT' => $row['file_desc_short'],
            'EDIT_FILE_DESC'       => $row['file_desc'],
            'EDIT_FILE_VERSION'    => $row['version'],
            'EDIT_FILE_CAT_ID'     => $row['category_id'],
            'EDIT_FILE_THUMBNAIL'  => $row['thumbnail'],
            'EDIT_FILE_IS_PRIVATE' => $edit_is_private,
            'EDIT_FILE_REALNAME'   => $row['file_realname'],
            'THUMBS_DIR'           => $this->path_helper->get_web_root_path() . 'ext/mundophpbb/simpledown/files/thumbs/',
            'S_THUMBS_EXIST'       => !empty($thumbs_list),
        ]);
    }

    protected function save_edit_file($id)
    {
        $name           = $this->request->variable('edit_file_name', '', true);
        $desc_short     = $this->request->variable('edit_file_desc_short', '', true);
        $desc_full      = $this->request->variable('edit_file_desc', '', true);
        $version        = $this->request->variable('edit_file_version', '', true);
        $category       = $this->request->variable('edit_category', 0);
        $existing_thumb = $this->request->variable('existing_thumb', '', true);
        $is_private     = $this->request->variable('is_private', 0);

        $sql_data = [
            'file_name'       => $name,
            'file_desc_short' => $desc_short,
            'file_desc'       => $desc_full,
            'version'         => $version ?: null,
            'category_id'     => (int)$category,
            'is_private'      => (int)$is_private,
        ];

        // === SUBSTITUIÇÃO DO ARQUIVO PRINCIPAL ===
        $replace_file = $this->request->file('replace_upload');
        if (!empty($replace_file['name']) && empty($replace_file['error'])) {
            $files_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/';

            // Apagar arquivo antigo
            $sql = 'SELECT file_realname FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
            $result = $this->db->sql_query($sql);
            $current = $this->db->sql_fetchrow($result);
            $this->db->sql_freeresult($result);

            if ($current && !empty($current['file_realname'])) {
                $old_path = $files_dir . $current['file_realname'];
                if (file_exists($old_path)) {
                    @unlink($old_path);
                }
            }

            // Usar o nome original limpo
            $original_name = $replace_file['name'];
            $ext           = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
            $basename      = pathinfo($original_name, PATHINFO_FILENAME);

            // Limpar caracteres perigosos ou inválidos no nome base
            $basename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $basename);

            $new_filename = $basename . '.' . $ext;
            $destination  = $files_dir . $new_filename;

            // Evitar sobrescrita: adicionar _1, _2, etc. se já existir
            $counter = 1;
            $temp_name = $new_filename;
            while (file_exists($destination)) {
                $temp_name    = $basename . '_' . $counter . '.' . $ext;
                $destination  = $files_dir . $temp_name;
                $counter++;
            }
            $new_filename = $temp_name;

            if (move_uploaded_file($replace_file['tmp_name'], $destination)) {
                $sql_data['file_realname'] = $new_filename;
                $sql_data['file_size']     = filesize($destination);
            } else {
                trigger_error($this->language->lang('ACP_SIMPLEDOWN_UPLOAD_FAILED') . adm_back_link($this->u_action . '&action=edit&id=' . $id), E_USER_WARNING);
            }
        }

        // === THUMBNAIL ===
        $thumb_file = $this->request->file('thumb_upload');
        $new_thumb = null;
        if (!empty($thumb_file['name'])) {
            $thumbs_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/';
            if (!is_dir($thumbs_dir)) {
                @mkdir($thumbs_dir, 0755, true);
            }
            $safe_name   = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $thumb_file['name']);
            $destination = $thumbs_dir . $safe_name;
            if (move_uploaded_file($thumb_file['tmp_name'], $destination)) {
                $new_thumb = $safe_name;
            }
        }

        if ($new_thumb !== null) {
            $sql_data['thumbnail'] = $new_thumb;
        } else if ($existing_thumb !== '') {
            $sql_data['thumbnail'] = $existing_thumb;
        } else {
            $sql_data['thumbnail'] = null;
        }

        // Atualizar no banco
        $sql = 'UPDATE ' . $this->files_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE id = ' . (int)$id;
        $this->db->sql_query($sql);

        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_FILE_EDITED', false, [$name]);
        trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_EDITED') . adm_back_link($this->u_action . '&mode=files'));
    }

    protected function delete_file($id)
    {
        $sql = 'SELECT file_realname, file_name, thumbnail FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if ($row) {
            $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/' . $row['file_realname'];
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
            if ($row['thumbnail']) {
                $thumb_path = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/' . $row['thumbnail'];
                if (file_exists($thumb_path)) {
                    @unlink($thumb_path);
                }
            }

            $sql = 'DELETE FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
            $this->db->sql_query($sql);

            $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_FILE_DELETED', false, [$row['file_name']]);
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_DELETED') . adm_back_link($this->u_action . '&mode=files'));
        } else {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_NOT_FOUND') . adm_back_link($this->u_action . '&mode=files'), E_USER_WARNING);
        }
    }

    protected function get_file_icon_class($filename)
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        switch ($extension) {
            case 'zip': case 'rar': case '7z': return 'fa-file-archive';
            case 'pdf': return 'fa-file-pdf';
            case 'doc': case 'docx': return 'fa-file-word';
            case 'xls': case 'xlsx': return 'fa-file-excel';
            case 'ppt': case 'pptx': return 'fa-file-powerpoint';
            case 'jpg': case 'jpeg': case 'png': case 'gif': case 'webp': case 'svg': return 'fa-file-image';
            case 'txt': case 'md': return 'fa-file-lines';
            case 'mp3': case 'wav': case 'ogg': return 'fa-file-audio';
            case 'mp4': case 'avi': case 'mkv': case 'mov': return 'fa-file-video';
            default: return 'fa-file';
        }
    }

    protected function get_formatted_filesize($bytes)
    {
        $bytes = max((int)$bytes, 0);
        if ($bytes < 1024) return $bytes . ' bytes';
        if ($bytes < 1048576) return round($bytes / 1024, 2) . ' KB';
        if ($bytes < 1073741824) return round($bytes / 1048576, 2) . ' MB';
        return round($bytes / 1073741824, 2) . ' GB';
    }
}