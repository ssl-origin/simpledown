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

class admin_controller
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
        $this->categories_table = $table_prefix . 'simpledown_categories';
        $this->files_table = $table_prefix . 'simpledown_files';
    }

    public function set_u_action($u_action)
    {
        $this->u_action = $u_action;
    }

    /**
     * Modo "Configurações": Configurações gerais + Gerenciamento de categorias + Upload de arquivos
     */
    public function display_settings()
    {
        $action = $this->request->variable('action', '');

        // Salvar configuração geral
        if ($this->request->is_set_post('config_submit')) {
            if (!check_form_key('mundophpbb_simpledown')) {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }
            $max_upload_mb = max(1, $this->request->variable('max_upload_size', 100));
            $this->config->set('simpledown_max_upload_size', $max_upload_mb);
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_CONFIG_SAVED') . adm_back_link($this->u_action . '&mode=settings'));
        }

        // Processar upload de arquivo
        if ($this->request->is_set_post('submit')) {
            if (!check_form_key('mundophpbb_simpledown')) {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }
            $this->upload_file();
        }

        // Adicionar categoria
        if ($this->request->is_set_post('add_cat')) {
            if (!check_form_key('mundophpbb_simpledown')) {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }
            $this->add_category();
        }

        // Excluir categoria
        if ($this->request->is_set_post('delete_cat_submit')) {
            if (!check_form_key('mundophpbb_simpledown')) {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }
            $cat_id = $this->request->variable('delete_category', 0);
            if ($cat_id > 0) {
                $this->delete_category($cat_id);
            }
        }

        // Carregar categorias para os selects (upload e exclusão)
        $sql = 'SELECT * FROM ' . $this->categories_table . ' ORDER BY name';
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result)) {
            $this->template->assign_block_vars('categories', [
                'ID'   => $row['id'],
                'NAME' => $row['name'],
            ]);
            $this->template->assign_block_vars('delete_categories', [
                'ID'   => $row['id'],
                'NAME' => $row['name'],
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars([
            'MAX_UPLOAD_SIZE' => $this->config['simpledown_max_upload_size'] ?? 100,
            'U_ACTION'        => $this->u_action . '&mode=settings',
        ]);
    }

    /**
     * Modo "Arquivos": Listagem de arquivos com paginação + Edição inline
     */
    public function display_files()
    {
        $action = $this->request->variable('action', '');
        $id     = $this->request->variable('id', 0);
        $page   = max(1, $this->request->variable('page', 1));

        // Processar ações
        if ($action == 'delete' && $id) {
            $this->delete_file($id);
        }

        if ($action == 'edit' && $id) {
            $this->edit_file($id);
        }

        // Salvar edição
        if ($this->request->is_set_post('submit_edit')) {
            if (!check_form_key('mundophpbb_simpledown')) {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }
            $this->save_edit_file($id);
        }

        // Carregar categorias para o select de edição
        $sql = 'SELECT * FROM ' . $this->categories_table . ' ORDER BY name';
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result)) {
            $this->template->assign_block_vars('categories', [
                'ID'   => $row['id'],
                'NAME' => $row['name'],
            ]);
        }
        $this->db->sql_freeresult($result);

        // Paginação
        $items_per_page = 20;
        $start = ($page - 1) * $items_per_page;

        $sql = 'SELECT COUNT(*) AS total FROM ' . $this->files_table;
        $result = $this->db->sql_query($sql);
        $total_files = (int) $this->db->sql_fetchfield('total');
        $this->db->sql_freeresult($result);

        $total_pages = max(1, ceil($total_files / $items_per_page));

        // Listar arquivos
        $sql = 'SELECT f.*, c.name AS cat_name
                FROM ' . $this->files_table . ' f
                LEFT JOIN ' . $this->categories_table . ' c ON f.category_id = c.id
                ORDER BY c.name, f.file_name
                LIMIT ' . $items_per_page . ' OFFSET ' . $start;
        $result = $this->db->sql_query($sql);

        while ($row = $this->db->sql_fetchrow($result)) {
            $this->template->assign_block_vars('files', [
                'NAME'       => $row['file_name'],
                'DESC'       => $row['file_desc'],
                'REAL_NAME'  => $row['file_realname'],
                'CAT'        => $row['cat_name'] ?: $this->language->lang('ACP_SIMPLEDOWN_NO_CATEGORY'),
                'DOWNLOADS'  => $row['downloads'],
                'SIZE'       => $this->get_formatted_filesize($row['file_size']),
                'U_EDIT'     => $this->u_action . '&mode=files&action=edit&id=' . $row['id'],
                'U_DELETE'   => $this->u_action . '&mode=files&action=delete&id=' . $row['id'],
                'FILE_ICON'  => $this->get_file_icon_class($row['file_realname']),
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars([
            'U_ACTION'         => $this->u_action . '&mode=files',
            'ACP_CURRENT_PAGE' => $page,
            'ACP_TOTAL_PAGES'  => $total_pages,
            'ACP_PREV_PAGE'    => ($page > 1) ? $this->u_action . '&mode=files&page=' . ($page - 1) : '',
            'ACP_NEXT_PAGE'    => ($page < $total_pages) ? $this->u_action . '&mode=files&page=' . ($page + 1) : '',
        ]);
    }

    // =======================================
    // Métodos auxiliares (mantidos e ajustados)
    // =======================================

    protected function add_category()
    {
        $cat_name = $this->request->variable('cat_name', '', true);
        if (empty($cat_name)) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_NO_CATEGORY_NAME') . adm_back_link($this->u_action . '&mode=settings'), E_USER_WARNING);
        }

        $sql = 'SELECT id FROM ' . $this->categories_table . ' WHERE name = \'' . $this->db->sql_escape($cat_name) . '\'';
        $result = $this->db->sql_query($sql);
        if ($this->db->sql_fetchrow($result)) {
            $this->db->sql_freeresult($result);
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_CATEGORY_DUPLICATE') . adm_back_link($this->u_action . '&mode=settings'), E_USER_WARNING);
        }
        $this->db->sql_freeresult($result);

        $sql = 'INSERT INTO ' . $this->categories_table . ' ' . $this->db->sql_build_array('INSERT', ['name' => $cat_name]);
        $this->db->sql_query($sql);

        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_CAT_ADDED', false, [$cat_name]);
        trigger_error($this->language->lang('ACP_SIMPLEDOWN_CAT_ADDED') . adm_back_link($this->u_action . '&mode=settings'));
    }

    protected function delete_category($id)
    {
        $sql = 'SELECT name FROM ' . $this->categories_table . ' WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$row) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_CATEGORY_NOT_FOUND') . adm_back_link($this->u_action . '&mode=settings'), E_USER_WARNING);
        }

        $cat_name = $row['name'];

        $sql = 'UPDATE ' . $this->files_table . ' SET category_id = 0 WHERE category_id = ' . (int)$id;
        $this->db->sql_query($sql);

        $sql = 'DELETE FROM ' . $this->categories_table . ' WHERE id = ' . (int)$id;
        $this->db->sql_query($sql);

        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_CAT_DELETED', false, [$cat_name]);
        trigger_error($this->language->lang('ACP_SIMPLEDOWN_CAT_DELETED') . adm_back_link($this->u_action . '&mode=settings'));
    }

    protected function upload_file()
    {
        $file = $this->request->file('file_upload');
        if (empty($file['name'])) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_NO_FILE_UPLOADED') . adm_back_link($this->u_action . '&mode=settings'), E_USER_WARNING);
        }

        $cat = $this->request->variable('category', 0);
        if ($cat == 0) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_CATEGORY_REQUIRED') . adm_back_link($this->u_action . '&mode=settings'), E_USER_WARNING);
        }

        // Validação de tamanho
        $max_upload_mb = (int)($this->config['simpledown_max_upload_size'] ?? 100);
        $max_upload_bytes = $max_upload_mb * 1024 * 1024;
        if ($file['size'] > $max_upload_bytes) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_TOO_LARGE', $max_upload_mb) . adm_back_link($this->u_action . '&mode=settings'), E_USER_WARNING);
        }

        // Validação de MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $allowed_mimes = [
            'application/pdf', 'application/zip', 'application/x-rar-compressed', 'application/x-7z-compressed',
            'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml',
            'text/plain',
            'audio/mpeg', 'audio/wav', 'audio/ogg',
            'video/mp4', 'video/x-matroska', 'video/quicktime', 'video/avi',
        ];

        if (!in_array($mime, $allowed_mimes)) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_INVALID_MIME_TYPE') . adm_back_link($this->u_action . '&mode=settings'), E_USER_WARNING);
        }

        // Bloqueio de extensões perigosas
        $dangerous_extensions = ['exe', 'bat', 'cmd', 'com', 'scr', 'pif', 'vbs', 'js', 'ps1', 'sh', 'jar', 'msi', 'apk', 'app'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($extension, $dangerous_extensions)) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_DANGEROUS_FILE') . adm_back_link($this->u_action . '&mode=settings'), E_USER_WARNING);
        }

        $upload_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/';
        if (!is_dir($upload_dir)) {
            if (!@mkdir($upload_dir, 0755, true) && !is_dir($upload_dir)) {
                trigger_error($this->language->lang('ACP_SIMPLEDOWN_UPLOAD_FAILED') . ': ' . $this->language->lang('ACP_SIMPLEDOWN_UPLOAD_DIR_ERROR') . adm_back_link($this->u_action . '&mode=settings'), E_USER_WARNING);
            }
        }

        $original_filename = $file['name'];
        $filename = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $original_filename);
        $dest = $upload_dir . $filename;
        $counter = 1;
        $base_name = pathinfo($filename, PATHINFO_FILENAME);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        while (file_exists($dest)) {
            $filename = $base_name . ' (' . $counter . ').' . $extension;
            $dest = $upload_dir . $filename;
            $counter++;
        }

        if (move_uploaded_file($file['tmp_name'], $dest)) {
            $hash = md5_file($dest);
            $sql = 'SELECT id FROM ' . $this->files_table . " WHERE file_hash = '" . $this->db->sql_escape($hash) . "'";
            $result = $this->db->sql_query($sql);
            if ($this->db->sql_fetchrow($result)) {
                @unlink($dest);
                $this->db->sql_freeresult($result);
                trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_DUPLICATE') . adm_back_link($this->u_action . '&mode=settings'), E_USER_WARNING);
            }
            $this->db->sql_freeresult($result);

            $name = $this->request->variable('file_name', $original_filename, true);
            $name = utf8_clean_string($name);
            $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
            $desc = $this->request->variable('file_desc', '', true);
            $size = $file['size'];

            $sql = 'INSERT INTO ' . $this->files_table . ' ' . $this->db->sql_build_array('INSERT', [
                'file_name'     => $name,
                'file_realname' => $filename,
                'file_desc'     => $desc,
                'category_id'   => (int)$cat,
                'downloads'     => 0,
                'file_size'     => (int)$size,
                'file_hash'     => $hash,
            ]);
            $this->db->sql_query($sql);

            $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_FILE_ADDED', false, [$name]);
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_ADDED') . adm_back_link($this->u_action . '&mode=settings'));
        } else {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_UPLOAD_FAILED') . adm_back_link($this->u_action . '&mode=settings'), E_USER_WARNING);
        }
    }

    protected function edit_file($id)
    {
        $sql = 'SELECT file_name, file_desc, category_id FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$row) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_NOT_FOUND') . adm_back_link($this->u_action . '&mode=files'), E_USER_WARNING);
        }

        $this->template->assign_vars([
            'S_EDIT_MODE'     => true,
            'EDIT_FILE_ID'    => $id,
            'EDIT_FILE_NAME'  => htmlspecialchars($row['file_name'], ENT_QUOTES, 'UTF-8'),
            'EDIT_FILE_DESC'  => $row['file_desc'],
            'EDIT_FILE_CAT_ID'=> $row['category_id'],
        ]);
    }

    protected function save_edit_file($id)
    {
        $new_name = $this->request->variable('edit_file_name', '', true);
        $new_name = utf8_clean_string($new_name);
        $new_name = htmlspecialchars($new_name, ENT_QUOTES, 'UTF-8');
        $desc = $this->request->variable('edit_file_desc', '', true);
        $cat = $this->request->variable('edit_category', 0);

        if (empty($new_name)) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_NAME_REQUIRED') . adm_back_link($this->u_action . '&mode=files'), E_USER_WARNING);
        }

        $sql = 'UPDATE ' . $this->files_table . ' SET
                file_name     = \'' . $this->db->sql_escape($new_name) . '\',
                file_desc     = \'' . $this->db->sql_escape($desc) . '\',
                category_id   = ' . (int)$cat . '
                WHERE id = ' . (int)$id;
        $this->db->sql_query($sql);

        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_FILE_EDITED', false, [$new_name]);
        trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_EDITED') . adm_back_link($this->u_action . '&mode=files'));
    }

    protected function delete_file($id)
    {
        $sql = 'SELECT file_realname, file_name FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if ($row) {
            $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/' . $row['file_realname'];
            if (file_exists($file_path)) {
                @unlink($file_path);
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