<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2026 Mundo phpBB
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
    protected $forums_table;
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
        $this->forums_table = $table_prefix . 'forums';
    }

    public function set_page_url($u_action)
    {
        $this->u_action = $u_action;
    }

    public function handle()
    {
        add_form_key('mundophpbb_simpledown');

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
            $cards_per_row = $this->request->variable('cards_per_row', 3);
            $cards_per_row = ($cards_per_row == 2) ? 2 : 3;
            $allow_user_layout_choice = $this->request->variable('allow_user_layout_choice', 0);

            // Anúncios automáticos
            $auto_announce = $this->request->variable('auto_announce', 0);
            $announce_forum = $this->request->variable('announce_forum', 0);
            $announce_title_template = $this->request->variable('announce_title_template', '', true);
            $announce_message_template = $this->request->variable('announce_message_template', '', true);
            $announce_type = $this->request->variable('announce_type', 'normal');
            $announce_locked = $this->request->variable('announce_locked', 0);

            // Nova: mensagem para arquivos privados
            $private_message = $this->request->variable('private_message', '', true);

            $this->config->set('simpledown_max_upload_size', $max_upload_mb);
            $this->config->set('simpledown_short_desc_limit', $short_desc_limit);
            $this->config->set('simpledown_private_categories', serialize($private_categories));
            $this->config->set('simpledown_default_is_private', $default_is_private);
            $this->config->set('simpledown_theme', $site_theme);
            $this->config->set('simpledown_cards_per_row', $cards_per_row);
            $this->config->set('simpledown_allow_user_layout_choice', $allow_user_layout_choice);
            $this->config->set('simpledown_auto_announce', $auto_announce);
            $this->config->set('simpledown_announce_forum', $announce_forum);
            $this->config->set('simpledown_announce_title_template', $announce_title_template);
            $this->config->set('simpledown_announce_message_template', $announce_message_template);
            $this->config->set('simpledown_announce_type', $announce_type);
            $this->config->set('simpledown_announce_locked', (int)$announce_locked);
            $this->config->set('simpledown_private_message', $private_message);

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
                if ($file === '.' || $file === '..') continue;
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

        // Select de fóruns para anúncio automático
        $sql = 'SELECT forum_id, forum_name FROM ' . $this->forums_table . ' WHERE forum_type = ' . FORUM_POST . ' ORDER BY left_id';
        $result = $this->db->sql_query($sql);
        $announce_forum_select = '<select name="announce_forum" id="announce_forum">';
        $announce_forum_select .= '<option value="0">' . $this->language->lang('ACP_SIMPLEDOWN_NO_FORUM') . '</option>';
        while ($row = $this->db->sql_fetchrow($result)) {
            $selected = ($row['forum_id'] == ($this->config['simpledown_announce_forum'] ?? 0)) ? ' selected' : '';
            $announce_forum_select .= '<option value="' . $row['forum_id'] . '"' . $selected . '>' . $row['forum_name'] . '</option>';
        }
        $announce_forum_select .= '</select>';
        $this->db->sql_freeresult($result);

        // Configurações atuais
        $private_categories = unserialize($this->config['simpledown_private_categories'] ?? serialize([]));
        $default_is_private = (int)($this->config['simpledown_default_is_private'] ?? 0);
        $site_theme = $this->config['simpledown_theme'] ?? 'light';
        $cards_per_row = (int)($this->config['simpledown_cards_per_row'] ?? 3);
        $cards_per_row = ($cards_per_row == 2) ? 2 : 3;
        $allow_user_layout_choice = (int)($this->config['simpledown_allow_user_layout_choice'] ?? 0);

        $this->template->assign_vars([
            'MAX_UPLOAD_SIZE'               => $this->config['simpledown_max_upload_size'] ?? 100,
            'SHORT_DESC_LIMIT'              => $this->config['simpledown_short_desc_limit'] ?? 150,
            'PRIVATE_CATEGORIES'            => $private_categories,
            'DEFAULT_IS_PRIVATE'            => $default_is_private,
            'SITE_THEME'                    => $site_theme,
            'CARDS_PER_ROW'                 => $cards_per_row,
            'ALLOW_USER_LAYOUT_CHOICE'      => $allow_user_layout_choice,
            'AUTO_ANNOUNCE'                 => (int)($this->config['simpledown_auto_announce'] ?? 0),
            'ANNOUNCE_FORUM_SELECT'         => $announce_forum_select,
            'ANNOUNCE_TITLE_TEMPLATE'       => $this->config['simpledown_announce_title_template']
                ?? $this->language->lang('ACP_SIMPLEDOWN_ANNOUNCE_TITLE_TEMPLATE_DEFAULT'),
            'ANNOUNCE_MESSAGE_TEMPLATE'     => $this->config['simpledown_announce_message_template']
                ?? $this->language->lang('ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_TEMPLATE_DEFAULT'),
            'ANNOUNCE_TYPE'                 => $this->config['simpledown_announce_type'] ?? 'normal',
            'ANNOUNCE_LOCKED'               => (int)($this->config['simpledown_announce_locked'] ?? 0),
            'PRIVATE_MESSAGE'               => $this->config['simpledown_private_message']
                ?? $this->language->lang('ACP_SIMPLEDOWN_PRIVATE_MESSAGE_DEFAULT'),
            'U_ACTION'                      => $this->u_action . '&mode=settings',
            'THUMBS_DIR'                    => $this->path_helper->get_web_root_path() . 'ext/mundophpbb/simpledown/files/thumbs/',
            'S_THUMBS_EXIST'                => !empty($thumbs_list),
        ]);
    }

    protected function upload_file()
    {
        if (!function_exists('submit_post')) {
            include($this->root_path . 'includes/functions_posting.' . $this->php_ext);
        }

        $file = $this->request->file('file_upload');
        if (empty($file['name'])) {
            $this->template->assign_vars(['ERROR_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_NO_FILE_UPLOADED')]);
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
            $this->template->assign_vars(['ERROR_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_UPLOAD_FAILED')]);
            return;
        }

        // Verificar duplicidade por hash
        $hash = md5_file($dest);
        $sql = 'SELECT file_name, file_realname FROM ' . $this->files_table . ' WHERE file_hash = \'' . $this->db->sql_escape($hash) . '\' LIMIT 1';
        $result = $this->db->sql_query($sql);
        $existing = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if ($existing) {
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

        if ($cat <= 0) {
            $sql = 'SELECT COUNT(*) AS total FROM ' . $this->categories_table;
            $result = $this->db->sql_query($sql);
            $row = $this->db->sql_fetchrow($result);
            $this->db->sql_freeresult($result);
            $error_msg = ($row['total'] == 0)
                ? $this->language->lang('ACP_SIMPLEDOWN_NO_CATEGORIES_EXIST')
                : $this->language->lang('ACP_SIMPLEDOWN_CATEGORY_REQUIRED');
            @unlink($dest);
            $this->template->assign_vars(['ERROR_MESSAGE' => $error_msg]);
            return;
        }

        // Processar BBCode na descrição completa (do arquivo, não do anúncio)
        $uid = $bitfield = $flags = '';
        generate_text_for_storage($desc_full, $uid, $bitfield, $flags, true, true, true);

        $sql_data = [
            'file_name'                  => $name,
            'file_realname'              => $filename,
            'file_desc_short'            => $desc_short,
            'file_desc'                  => $desc_full,
            'file_desc_bbcode_uid'       => $uid,
            'file_desc_bbcode_bitfield'  => $bitfield,
            'file_desc_bbcode_flags'     => $flags,
            'version'                    => $version ?: null,
            'category_id'                => (int)$cat,
            'downloads'                  => 0,
            'file_size'                  => (int)$file['size'],
            'file_hash'                  => $hash,
            'thumbnail'                  => $selected_thumb !== '' ? $selected_thumb : null,
            'is_private'                 => (int)$is_private,
            'topic_id'                   => 0,
        ];

        $sql = 'INSERT INTO ' . $this->files_table . ' ' . $this->db->sql_build_array('INSERT', $sql_data);
        $this->db->sql_query($sql);
        $file_id = $this->db->sql_nextid();

        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_FILE_ADDED', false, [$name]);

        // CRIAÇÃO AUTOMÁTICA DO TÓPICO DE ANÚNCIO
        if (!empty($this->config['simpledown_auto_announce'])) {
            $forum_id = (int)($this->config['simpledown_announce_forum'] ?? 0);
            if ($forum_id > 0) {
                $details_url = generate_board_url() . '/downloads/details/' . $file_id;

                $desc_full_raw = $this->request->variable('file_desc', '', true);

                $title_template = trim($this->config['simpledown_announce_title_template']
                    ?? $this->language->lang('ACP_SIMPLEDOWN_ANNOUNCE_TITLE_TEMPLATE_DEFAULT'));

                $message_template = trim($this->config['simpledown_announce_message_template']
                    ?? $this->language->lang('ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_TEMPLATE_DEFAULT'));

                $subject = str_replace(
                    ['{NAME}', '{VERSION}'],
                    [$name, $version ?: ''],
                    $title_template
                );

                $message = str_replace(
                    [
                        '{NAME}',
                        '{VERSION}',
                        '{URL_DETAILS}',
                        '{URL_DOWNLOAD}',
                        '{DESC_SHORT}',
                        '{DESC_FORMATTED}',
                        '{DESC_FULL_RAW}'
                    ],
                    [
                        $name,
                        $version ?: '',
                        $details_url,
                        $details_url,
                        $desc_short ?: '',
                        $desc_full_raw,
                        $desc_full_raw
                    ],
                    $message_template
                );

                // Processamento do BBCode
                // REMOVIDO O PROCESSAMENTO DO TÍTULO: títulos de tópicos no phpBB são texto plano (não suportam BBCode).
                // Isso evita <t></t> ou UID nas tags.
                // Apenas a mensagem do post recebe BBCode completo.
                $message_uid = $message_bitfield = $message_flags = '';
                generate_text_for_storage($message, $message_uid, $message_bitfield, $message_flags, true, true, true);

                // Tipo de tópico e trancamento
                $announce_type = $this->config['simpledown_announce_type'] ?? 'normal';
                $announce_locked = !empty($this->config['simpledown_announce_locked']);

                $topic_type = POST_NORMAL;
                switch ($announce_type) {
                    case 'sticky':
                        $topic_type = POST_STICKY;
                        break;
                    case 'announce':
                        $topic_type = POST_ANNOUNCE;
                        break;
                    case 'global':
                        $topic_type = POST_GLOBAL;
                        break;
                }

                $poll = [];

                $data = [
                    'forum_id'          => $forum_id,
                    'topic_title'       => $subject,
                    'message'           => $message,
                    'message_md5'       => md5($message),
                    'bbcode_bitfield'   => $message_bitfield,
                    'bbcode_uid'        => $message_uid,
                    'enable_bbcode'     => true,
                    'enable_smilies'    => true,
                    'enable_urls'       => true,
                    'enable_sig'        => false,
                    'poster_id'         => $this->user->data['user_id'],
                    'post_time'         => time(),
                    'post_edit_locked'  => $announce_locked ? 1 : 0,
                    'topic_status'      => $announce_locked ? ITEM_LOCKED : ITEM_UNLOCKED,
                    'topic_time_limit'  => 0,
                    'icon_id'           => 0,
                    'enable_indexing'   => true,
                    'notify'            => false,
                    'notify_poster'     => false,
                    'notify_set'        => false,
                    'topic_type'        => $topic_type,
                ];

                submit_post('post', $subject, $this->user->data['username'], $topic_type, $poll, $data);

                if (!empty($data['topic_id'])) {
                    $sql = 'UPDATE ' . $this->files_table . '
                            SET topic_id = ' . (int)$data['topic_id'] . '
                            WHERE id = ' . (int)$file_id;
                    $this->db->sql_query($sql);

                    $this->log->add('admin', $this->user->data['user_id'], $this->user->ip,
                        'LOG_SIMPLEDOWN_ANNOUNCE_CREATED', false, [$subject, $forum_id]);
                }
            }
        }

        $this->template->assign_vars(['SUCCESS_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_FILE_ADDED')]);
    }

    protected function upload_thumb()
    {
        $file = $this->request->file('thumb_upload');
        if (empty($file['name'])) {
            $this->template->assign_vars(['ERROR_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_NO_FILE_UPLOADED')]);
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
            $this->template->assign_vars(['WARNING_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_THUMB_ALREADY_EXISTS_WARNING')]);
        }

        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mime, $allowed)) {
            $this->template->assign_vars(['ERROR_MESSAGE' => 'Apenas imagens JPG, PNG, GIF ou WEBP são permitidas.']);
            return;
        }

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_THUMB_ADDED', false, [$safe_name]);
            $this->template->assign_vars(['SUCCESS_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS')]);
        } else {
            $this->template->assign_vars(['ERROR_MESSAGE' => $this->language->lang('ACP_SIMPLEDOWN_UPLOAD_FAILED')]);
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