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

class acp_settings_controller
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

    /**
 * Define a URL da página atual (usada para redirecionamentos e links)
 */
public function set_page_url($u_action)
{
    $this->u_action = $u_action;
}

    public function handle()
    {
        // Salvar configurações gerais
        if ($this->request->is_set_post('config_submit')) {
            if (!check_form_key('mundophpbb_simpledown')) {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }

            $max_upload_mb = max(1, $this->request->variable('max_upload_size', 100));
            $short_desc_limit = max(50, $this->request->variable('short_desc_limit', 150));
            $private_categories = $this->request->variable('private_categories', [0]);
            $default_is_private = $this->request->variable('default_is_private', 0);
            $site_theme = $this->request->variable('site_theme', 'light');

            // Número de cards por linha
            $cards_per_row = $this->request->variable('cards_per_row', 3);
            $cards_per_row = ($cards_per_row == 2) ? 2 : 3;

            // NOVA OPÇÃO: Permitir que usuários escolham entre grid e lista
            $allow_user_layout_choice = $this->request->variable('allow_user_layout_choice', 0);

            $this->config->set('simpledown_max_upload_size', $max_upload_mb);
            $this->config->set('simpledown_short_desc_limit', $short_desc_limit);
            $this->config->set('simpledown_private_categories', serialize($private_categories));
            $this->config->set('simpledown_default_is_private', $default_is_private);
            $this->config->set('simpledown_theme', $site_theme);
            $this->config->set('simpledown_cards_per_row', $cards_per_row);
            $this->config->set('simpledown_allow_user_layout_choice', $allow_user_layout_choice);

            trigger_error($this->language->lang('ACP_SIMPLEDOWN_CONFIG_SAVED') . adm_back_link($this->u_action . '&mode=settings'));
        }

        // Upload de novo arquivo
        if ($this->request->is_set_post('submit')) {
            if (!check_form_key('mundophpbb_simpledown')) {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }
            $this->upload_file();
        }

        // Upload avulso de thumbnail
        if ($this->request->is_set_post('thumb_submit')) {
            if (!check_form_key('mundophpbb_simpledown')) {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }
            $this->upload_thumb();
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

        // Preparar dados para o template
        $this->prepare_template();
    }

    protected function prepare_template()
    {
        // Thumbnails existentes
        $thumbs_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/';
        $thumbs_list = [];
        if (is_dir($thumbs_dir)) {
            $files = scandir($thumbs_dir);
            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
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

        // Configurações atuais
        $private_categories = unserialize($this->config['simpledown_private_categories'] ?? serialize([]));
        $default_is_private = (int)($this->config['simpledown_default_is_private'] ?? 0);
        $site_theme = $this->config['simpledown_theme'] ?? 'light';
        $cards_per_row = (int)($this->config['simpledown_cards_per_row'] ?? 3);
        $cards_per_row = ($cards_per_row == 2) ? 2 : 3;
        $allow_user_layout_choice = (int)($this->config['simpledown_allow_user_layout_choice'] ?? 0);

        $this->template->assign_vars([
            'MAX_UPLOAD_SIZE'           => $this->config['simpledown_max_upload_size'] ?? 100,
            'SHORT_DESC_LIMIT'          => $this->config['simpledown_short_desc_limit'] ?? 150,
            'PRIVATE_CATEGORIES'        => $private_categories,
            'DEFAULT_IS_PRIVATE'        => $default_is_private,
            'SITE_THEME'                => $site_theme,
            'CARDS_PER_ROW'             => $cards_per_row,
            'ALLOW_USER_LAYOUT_CHOICE'  => $allow_user_layout_choice,
            'U_ACTION'                  => $this->u_action . '&mode=settings',
            'THUMBS_DIR'                => $this->path_helper->get_web_root_path() . 'ext/mundophpbb/simpledown/files/thumbs/',
            'S_THUMBS_EXIST'            => !empty($thumbs_list),
        ]);
    }

    protected function upload_file()
    {
        $file = $this->request->file('file_upload');
        if (empty($file['name'])) {
            $this->template->assign_vars([
                'ERROR_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_NO_FILE_UPLOADED'),
            ]);
            return;
        }

        $upload_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/';
        if (!is_dir($upload_dir)) {
            @mkdir($upload_dir, 0755, true);
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

        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            $this->template->assign_vars([
                'ERROR_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_UPLOAD_FAILED'),
            ]);
            return;
        }

        // Calcular hash para verificação de duplicidade
        $hash = md5_file($dest);

        // Verificar se já existe um arquivo com o mesmo conteúdo
        $sql = 'SELECT file_name, file_realname FROM ' . $this->files_table . ' WHERE file_hash = \'' . $this->db->sql_escape($hash) . '\' LIMIT 1';
        $result = $this->db->sql_query($sql);
        $existing = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if ($existing) {
            // Arquivo duplicado: apaga o que acabou de ser enviado
            @unlink($dest);
            $this->template->assign_vars([
                'ERROR_MESSAGE' => $this->language->lang(
                    'ACP_SIMPLEDOWN_FILE_DUPLICATE_DETECTED',
                    $existing['file_name'],
                    $existing['file_realname']
                ),
            ]);
            return;
        }

        // Dados do formulário
        $name = $this->request->variable('file_name', $original_filename, true);
        $desc_short = $this->request->variable('file_desc_short', '', true);
        $desc_full = $this->request->variable('file_desc', '', true);
        $version = $this->request->variable('file_version', '', true);
        $cat = $this->request->variable('category', 0);
        $selected_thumb = $this->request->variable('existing_thumb', '', true);
        $is_private = $this->request->variable('is_private', 0);

        // Validação obrigatória de categoria
        if ($cat <= 0) {
            $sql = 'SELECT COUNT(*) AS total FROM ' . $this->categories_table;
            $result = $this->db->sql_query($sql);
            $row = $this->db->sql_fetchrow($result);
            $this->db->sql_freeresult($result);

            $error_msg = ($row['total'] == 0)
                ? $this->language->lang('ACP_SIMPLEDOWN_NO_CATEGORIES_EXIST')
                : $this->language->lang('ACP_SIMPLEDOWN_CATEGORY_REQUIRED');

            @unlink($dest);
            $this->template->assign_vars([
                'ERROR_MESSAGE' => $error_msg,
            ]);
            return;
        }

        // Inserir no banco
        $sql_data = [
            'file_name'       => $name,
            'file_realname'   => $filename,
            'file_desc_short' => $desc_short,
            'file_desc'       => $desc_full,
            'version'         => $version ?: null,
            'category_id'     => (int)$cat,
            'downloads'       => 0,
            'file_size'       => (int)$file['size'],
            'file_hash'       => $hash,
            'thumbnail'       => $selected_thumb !== '' ? $selected_thumb : null,
            'is_private'      => (int)$is_private,
        ];

        $sql = 'INSERT INTO ' . $this->files_table . ' ' . $this->db->sql_build_array('INSERT', $sql_data);
        $this->db->sql_query($sql);

        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_FILE_ADDED', false, [$name]);

        $this->template->assign_vars([
            'SUCCESS_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_FILE_ADDED'),
        ]);
    }

    protected function upload_thumb()
    {
        $file = $this->request->file('thumb_upload');
        if (empty($file['name'])) {
            $this->template->assign_vars([
                'ERROR_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_NO_FILE_UPLOADED'),
            ]);
            return;
        }

        $thumbs_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/';
        if (!is_dir($thumbs_dir)) {
            @mkdir($thumbs_dir, 0755, true);
        }

        $original_name = $file['name'];
        $safe_name = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $original_name);
        $destination = $thumbs_dir . $safe_name;

        if (file_exists($destination)) {
            $this->template->assign_vars([
                'WARNING_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_THUMB_ALREADY_EXISTS_WARNING'),
            ]);
        }

        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mime, $allowed)) {
            $this->template->assign_vars([
                'ERROR_MESSAGE' => 'Apenas imagens JPG, PNG, GIF ou WEBP são permitidas.',
            ]);
            return;
        }

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_THUMB_ADDED', false, [$safe_name]);
            $this->template->assign_vars([
                'SUCCESS_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS'),
            ]);
        } else {
            $this->template->assign_vars([
                'ERROR_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_UPLOAD_FAILED'),
            ]);
        }
    }

    protected function add_category()
    {
        $cat_name = trim($this->request->variable('cat_name', '', true));
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
}