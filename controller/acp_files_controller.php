<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2026 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
    protected $topics_table;
    protected $posts_table;

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
        $this->topics_table      = $table_prefix . 'topics';
        $this->posts_table       = $table_prefix . 'posts';
    }

    public function set_page_url($u_action)
    {
        $this->u_action = $u_action;
    }

    public function handle()
    {
        include($this->root_path . 'includes/functions_posting.' . $this->php_ext);

        $action = $this->request->variable('action', '');
        $id     = $this->request->variable('id', 0);

        // Deleção com confirmação
        if ($action === 'delete' && $id && confirm_box(true)) {
            $this->delete_file($id);
        } else if ($action === 'delete' && $id) {
            confirm_box(false, $this->language->lang('CONFIRM_DELETE_FILE'), build_hidden_fields(['id' => $id, 'action' => 'delete']));
        }

        // Salvamento da edição
        if ($this->request->is_set_post('submit_edit')) {
            if (!check_form_key('mundophpbb_simpledown')) {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }
            $this->save_edit_file($id); // redirect no final
        }

        // Modo edição: prepara o form e limpa a tabela da listagem
        if ($action === 'edit' && $id) {
            $this->edit_file($id);
            $this->list_files();
            // Remove o block da tabela para não exibir a listagem no modo edição
            $this->template->destroy_block_vars('files');
        } else {
            // Modo padrão: apenas a listagem
            $this->list_files();
        }
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

            $desc_short = $row['file_desc_short'] ?? '';

            if (!$desc_short && $row['file_desc']) {
                $plain_text = generate_text_for_display(
                    $row['file_desc'],
                    $row['file_desc_bbcode_uid'] ?? '',
                    $row['file_desc_bbcode_bitfield'] ?? '',
                    $row['file_desc_bbcode_flags'] ?? 7
                );
                $plain_text = strip_tags($plain_text);
                $desc_short = truncate_string($plain_text, 150);
            }

            if (!$desc_short) {
                $desc_short = $this->language->lang('ACP_SIMPLEDOWN_NO_DESCRIPTION');
            }

            $desc_formatted = generate_text_for_display(
                $row['file_desc'] ?: '',
                $row['file_desc_bbcode_uid'] ?? '',
                $row['file_desc_bbcode_bitfield'] ?? '',
                $row['file_desc_bbcode_flags'] ?? 7
            );
            $desc_formatted_escaped = htmlspecialchars($desc_formatted, ENT_QUOTES, 'UTF-8');

            $this->template->assign_block_vars('files', [
                'ID'                     => $row['id'],
                'NAME'                   => $row['file_name'],
                'DESC_SHORT'             => $desc_short,
                'DESC_FORMATTED'         => $desc_formatted,
                'DESC_FORMATTED_ESCAPED' => $desc_formatted_escaped,
                'VERSION'                => $row['version'] ?? '-',
                'CAT'                    => $row['cat_name'] ?? $this->language->lang('ACP_SIMPLEDOWN_NO_CATEGORY'),
                'DOWNLOADS'              => $row['downloads'] ?? 0,
                'SIZE'                   => $this->get_formatted_filesize($row['file_size'] ?? 0),
                'REAL_NAME'              => $row['file_realname'],
                'FILE_ICON'              => $this->get_file_icon_class($row['file_realname']),
                'IS_PRIVATE'             => $effective_private,
                'U_EDIT'                 => $this->u_action . '&action=edit&id=' . $row['id'],
                'U_DELETE'               => $this->u_action . '&action=delete&id=' . $row['id'],
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars([
            'U_ACTION'    => $this->u_action,
            'TOTAL_FILES' => $total_files,
        ]);
    }

    protected function edit_file($id)
    {
        $sql = 'SELECT * FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$row) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_NOT_FOUND') . adm_back_link($this->u_action), E_USER_WARNING);
        }

        $edit_result = generate_text_for_edit(
            $row['file_desc'],
            $row['file_desc_bbcode_uid'] ?? '',
            $row['file_desc_bbcode_flags'] ?? 7
        );

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

        $sql = 'SELECT * FROM ' . $this->categories_table . ' ORDER BY name';
        $result = $this->db->sql_query($sql);
        while ($cat_row = $this->db->sql_fetchrow($result)) {
            $this->template->assign_block_vars('categories', [
                'ID'         => $cat_row['id'],
                'NAME'       => $cat_row['name'],
                'S_SELECTED' => ($cat_row['id'] == $row['category_id']) ? 'selected' : '',
            ]);
        }
        $this->db->sql_freeresult($result);

        $edit_is_private = ($row['is_private'] !== null)
            ? (int)$row['is_private']
            : (int)($this->config['simpledown_default_is_private'] ?? 0);

        $web_root = $this->path_helper->get_web_root_path();

        $this->template->assign_vars([
            'S_EDIT_MODE'          => true,
            'EDIT_FILE_ID'         => $row['id'],
            'EDIT_FILE_NAME'       => $row['file_name'],
            'EDIT_FILE_DESC_SHORT' => $row['file_desc_short'],
            'EDIT_FILE_DESC'       => $edit_result['text'],
            'EDIT_FILE_VERSION'    => $row['version'],
            'EDIT_FILE_CAT_ID'     => $row['category_id'],
            'EDIT_FILE_THUMBNAIL'  => $row['thumbnail'],
            'EDIT_FILE_IS_PRIVATE' => $edit_is_private,
            'EDIT_FILE_REALNAME'   => $row['file_realname'],
            'THUMBS_DIR'           => $web_root . 'ext/mundophpbb/simpledown/files/thumbs/',
            'S_THUMBS_EXIST'       => !empty($thumbs_list),
        ]);
    }

    /**
     * Remove BBCode UID from text (standard hack used in many phpBB extensions)
     */
    protected function remove_bbcode_uid($text)
    {
        if (empty($text)) {
            return $text;
        }
        return preg_replace('/\:[a-z0-9]+/i', '', $text);
    }

    protected function save_edit_file($id)
    {
        $name           = trim($this->request->variable('edit_file_name', '', true));
        $desc_short     = trim($this->request->variable('edit_file_desc_short', '', true));
        $desc_full      = $this->request->variable('edit_file_desc', '', true);
        $version        = trim($this->request->variable('edit_file_version', '', true));
        $category       = $this->request->variable('edit_category', 0);
        $existing_thumb = $this->request->variable('existing_thumb', '', true);
        $is_private     = $this->request->variable('is_private', 0);

        // Processar BBCode para a base de dados da extensão
        $uid = $bitfield = $flags = '';
        generate_text_for_storage($desc_full, $uid, $bitfield, $flags, true, true, true);

        $upload_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/';
        $thumbs_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/';

        $sql_data = [
            'file_name'                 => $name,
            'file_desc_short'           => $desc_short,
            'file_desc'                 => $desc_full,
            'file_desc_bbcode_uid'      => $uid,
            'file_desc_bbcode_bitfield' => $bitfield,
            'file_desc_bbcode_flags'    => $flags,
            'version'                   => $version ?: null,
            'category_id'               => (int)$category,
            'is_private'                => (int)$is_private,
        ];

        // === SUBSTITUIÇÃO DO ARQUIVO PRINCIPAL ===
        $replace_file = $this->request->file('replace_upload');
        if (!empty($replace_file['name']) && empty($replace_file['error'])) {
            $sql = 'SELECT file_realname FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
            $result = $this->db->sql_query_limit($sql, 1);
            $current_file = $this->db->sql_fetchrow($result);
            $this->db->sql_freeresult($result);

            if ($current_file && !empty($current_file['file_realname'])) {
                $old_path = $upload_dir . $current_file['file_realname'];
                if (file_exists($old_path)) {
                    @unlink($old_path);
                }
            }

            $original_name = $replace_file['name'];
            $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
            $basename = preg_replace('/[^a-zA-Z0-9._-]/', '_', pathinfo($original_name, PATHINFO_FILENAME));
            $new_filename = $basename . '.' . $ext;
            $destination = $upload_dir . $new_filename;

            $counter = 1;
            while (file_exists($destination)) {
                $new_filename = $basename . '_' . $counter . '.' . $ext;
                $destination = $upload_dir . $new_filename;
                $counter++;
            }

            if (move_uploaded_file($replace_file['tmp_name'], $destination)) {
                $sql_data['file_realname'] = $new_filename;
                $sql_data['file_size']     = filesize($destination);
                $sql_data['file_hash']     = md5_file($destination);
            }
        }

        // === THUMBNAIL ===
        $thumb_file = $this->request->file('thumb_upload');
        if (!empty($thumb_file['name']) && empty($thumb_file['error'])) {
            $safe_thumb = preg_replace('/[^a-zA-Z0-9_\.\-]/', '_', $thumb_file['name']);
            if (move_uploaded_file($thumb_file['tmp_name'], $thumbs_dir . $safe_thumb)) {
                $sql_data['thumbnail'] = $safe_thumb;
            }
        } elseif ($existing_thumb !== '') {
            $sql_data['thumbnail'] = $existing_thumb;
        } else {
            $sql_data['thumbnail'] = null;
        }

        // Atualiza a tabela da extensão
        $sql = 'UPDATE ' . $this->files_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE id = ' . (int)$id;
        $this->db->sql_query($sql);

        // === ATUALIZAÇÃO DO TÓPICO DE ANÚNCIO NO FÓRUM ===
        $sql = 'SELECT topic_id FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        $topic_id = (int)($row['topic_id'] ?? 0);

        if ($topic_id > 0 && !empty($this->config['simpledown_auto_announce'])) {
            $forum_id = (int)($this->config['simpledown_announce_forum'] ?? 0);

            if ($forum_id > 0) {
                $sql = 'SELECT t.*, p.icon_id AS post_icon_id
                        FROM ' . $this->topics_table . ' t
                        LEFT JOIN ' . $this->posts_table . ' p ON p.post_id = t.topic_first_post_id
                        WHERE t.topic_id = ' . (int)$topic_id;
                $result = $this->db->sql_query($sql);
                $current_topic = $this->db->sql_fetchrow($result);
                $this->db->sql_freeresult($result);

                if ($current_topic) {
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

                    $details_url = generate_board_url() . '/downloads/details/' . $id;

                    $download_link_bbcode = '[url=' . $details_url . '] ' . htmlspecialchars($name, ENT_QUOTES) . ($version ? ' v' . htmlspecialchars($version, ENT_QUOTES) : '') . '[/url]';

                    $title_tpl = $this->config['simpledown_announce_title_template'] ?? '';
                    $msg_tpl   = $this->config['simpledown_announce_message_template'] ?? '';

                    $subject = str_replace(['{NAME}', '{VERSION}'], [$name, $version ?: ''], $title_tpl) ?: $name;

                    // Limpeza da descrição
                    $desc_full_clean = $this->remove_bbcode_uid($desc_full);
                    $desc_full_clean = preg_replace('#<[./]?[a-zA-Z0-9]+.*?>#i', '', $desc_full_clean);

                    $message_raw = str_replace(
                        [
                            '{NAME}',
                            '{VERSION}',
                            '{URL_DETAILS}',
                            '{DESC_SHORT}',
                            '{DESC_FULL_RAW}',
                            '{DESC_FORMATTED}',
                            '{URL_DOWNLOAD}'
                        ],
                        [
                            $name,
                            $version ?: '',
                            $details_url,
                            $desc_short,
                            $desc_full_clean,
                            $desc_full_clean,
                            $download_link_bbcode
                        ],
                        $msg_tpl
                    ) ?: $desc_full_clean;

                    $m_uid = $m_bitfield = $m_flags = '';
                    generate_text_for_storage($message_raw, $m_uid, $m_bitfield, $m_flags, true, true, true);

                    $poll = [];
                    $data = [
                        'topic_id'               => (int)$topic_id,
                        'post_id'                => (int)$current_topic['topic_first_post_id'],
                        'forum_id'               => (int)$forum_id,
                        'topic_title'            => $subject,
                        'post_subject'           => $subject,
                        'message'                => $message_raw,
                        'message_md5'            => md5($message_raw),
                        'bbcode_bitfield'        => $m_bitfield,
                        'bbcode_uid'             => $m_uid,
                        'bbcode_flags'           => $m_flags,
                        'enable_bbcode'          => true,
                        'enable_smilies'         => true,
                        'enable_urls'            => true,
                        'enable_sig'             => false,
                        'poster_id'              => (int)$this->user->data['user_id'],
                        'topic_type'             => $topic_type,
                        'post_edit_locked'       => $announce_locked ? 1 : 0,
                        'topic_status'           => $announce_locked ? ITEM_LOCKED : ITEM_UNLOCKED,
                        'icon_id'                => (int)($current_topic['post_icon_id'] ?? 0),
                        'post_edit_reason'       => '',
                        'topic_posts_approved'   => (int)$current_topic['topic_posts_approved'],
                        'topic_posts_unapproved' => (int)$current_topic['topic_posts_unapproved'],
                        'topic_posts_softdeleted'=> (int)$current_topic['topic_posts_softdeleted'],
                        'topic_first_post_id'    => (int)$current_topic['topic_first_post_id'],
                        'topic_last_post_id'     => (int)$current_topic['topic_last_post_id'],
                        'force_approved_state'   => true,
                    ];

                    submit_post('edit', $subject, $this->user->data['username'], $topic_type, $poll, $data);

                    // Forçar atualização do lock
                    $desired_topic_status = $announce_locked ? ITEM_LOCKED : ITEM_UNLOCKED;
                    $desired_post_locked  = $announce_locked ? 1 : 0;

                    $sql = 'UPDATE ' . $this->topics_table . '
                            SET topic_status = ' . (int)$desired_topic_status . '
                            WHERE topic_id = ' . (int)$topic_id;
                    $this->db->sql_query($sql);

                    $first_post_id = (int)$current_topic['topic_first_post_id'];
                    $sql = 'UPDATE ' . $this->posts_table . '
                            SET post_edit_locked = ' . (int)$desired_post_locked . '
                            WHERE post_id = ' . $first_post_id;
                    $this->db->sql_query($sql);

                    $old_locked = ($current_topic['topic_status'] ?? ITEM_UNLOCKED) == ITEM_LOCKED;
                    if ($old_locked != $announce_locked) {
                        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip,
                            'LOG_SIMPLEDOWN_ANNOUNCE_LOCK_TOGGLED',
                            false,
                            [$name, $announce_locked ? 'locked' : 'unlocked']
                        );
                    }
                }
            }
        }

        redirect($this->u_action);
    }

    protected function delete_file($id)
    {
        // Busca dados incluindo topic_id
        $sql = 'SELECT file_realname, file_name, thumbnail, topic_id FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$row) {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_NOT_FOUND') . adm_back_link($this->u_action), E_USER_WARNING);
        }

        $upload_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/';
        $thumbs_dir = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/';

        // Remove arquivo físico
        if ($row['file_realname']) {
            $file_path = $upload_dir . $row['file_realname'];
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        // Remove thumbnail
        if ($row['thumbnail']) {
            $thumb_path = $thumbs_dir . $row['thumbnail'];
            if (file_exists($thumb_path)) {
                @unlink($thumb_path);
            }
        }

        // === EXCLUSÃO DIRETA DO TÓPICO E POSTS (evita problemas com delete_posts em versões incompatíveis) ===
        if (!empty($row['topic_id'])) {
            $topic_id = (int)$row['topic_id'];

            // Deleta todos os posts do tópico
            $sql = 'DELETE FROM ' . $this->posts_table . ' WHERE topic_id = ' . $topic_id;
            $this->db->sql_query($sql);

            // Deleta o tópico
            $sql = 'DELETE FROM ' . $this->topics_table . ' WHERE topic_id = ' . $topic_id;
            $this->db->sql_query($sql);

            // Log da exclusão do anúncio
            $this->log->add('admin', $this->user->data['user_id'], $this->user->ip,
                'LOG_SIMPLEDOWN_ANNOUNCE_DELETED', false, [$row['file_name']]);
        }

        // Remove o registro do arquivo
        $sql = 'DELETE FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
        $this->db->sql_query($sql);

        // Log da exclusão do arquivo
        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip,
            'LOG_SIMPLEDOWN_FILE_DELETED', false, [$row['file_name']]);

        trigger_error($this->language->lang('ACP_SIMPLEDOWN_FILE_DELETED') . adm_back_link($this->u_action));
    }

    protected function get_file_icon_class($filename)
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        switch ($extension) {
            case 'zip': case 'rar': case '7z':           return 'fa-file-archive';
            case 'pdf':                                  return 'fa-file-pdf';
            case 'doc': case 'docx':                     return 'fa-file-word';
            case 'xls': case 'xlsx':                     return 'fa-file-excel';
            case 'ppt': case 'pptx':                     return 'fa-file-powerpoint';
            case 'jpg': case 'jpeg': case 'png':
            case 'gif': case 'webp': case 'svg':         return 'fa-file-image';
            case 'txt': case 'md':                       return 'fa-file-lines';
            case 'mp3': case 'wav': case 'ogg':          return 'fa-file-audio';
            case 'mp4': case 'avi': case 'mkv': case 'mov': return 'fa-file-video';
            default:                                     return 'fa-file';
        }
    }

    protected function get_formatted_filesize($bytes)
    {
        $bytes = max((int)$bytes, 0);
        if ($bytes < 1024)         return $bytes . ' bytes';
        if ($bytes < 1048576)     return round($bytes / 1024, 2) . ' KB';
        if ($bytes < 1073741824)  return round($bytes / 1048576, 2) . ' MB';
        return round($bytes / 1073741824, 2) . ' GB';
    }
}