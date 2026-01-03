<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2026 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */
namespace mundophpbb\simpledown\controller;

use phpbb\config\config;
use phpbb\controller\helper;
use phpbb\db\driver\driver_interface;
use phpbb\exception\http_exception;
use phpbb\language\language;
use phpbb\log\log;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;
use phpbb\path_helper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class main_controller
{
    protected $config;
    protected $helper;
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
    protected $logs_table;

    public function __construct(
        config $config,
        helper $helper,
        driver_interface $db,
        language $language,
        log $log,
        request $request,
        template $template,
        user $user,
        path_helper $path_helper,
        string $root_path,
        string $php_ext,
        string $table_prefix
    ) {
        $this->config = $config;
        $this->helper = $helper;
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
        $this->logs_table = $table_prefix . 'simpledown_logs';
    }

    protected function get_formatted_filesize(int $bytes): string
    {
        $bytes = max($bytes, 0);
        if ($bytes < 1024) {
            return $bytes . ' bytes';
        }
        if ($bytes < 1048576) {
            return round($bytes / 1024, 2) . ' KB';
        }
        if ($bytes < 1073741824) {
            return round($bytes / 1048576, 2) . ' MB';
        }
        return round($bytes / 1073741824, 2) . ' GB';
    }

    protected function get_file_icon_class(string $filename): string
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        return match ($extension) {
            'zip', 'rar', '7z' => 'fa-file-archive',
            'pdf' => 'fa-file-pdf',
            'doc', 'docx' => 'fa-file-word',
            'xls', 'xlsx' => 'fa-file-excel',
            'ppt', 'pptx' => 'fa-file-powerpoint',
            'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' => 'fa-file-image',
            'txt', 'md' => 'fa-file-lines',
            'mp3', 'wav', 'ogg' => 'fa-file-audio',
            'mp4', 'avi', 'mkv', 'mov' => 'fa-file-video',
            default => 'fa-file',
        };
    }

    protected function log_action(int $file_id, string $action): void
    {
        if (empty($this->config['simpledown_enable_logging'])) {
            return;
        }

        // Convidados: user_id = 0 e username = IP (mais útil no ACP)
        $user_id = $this->user->data['is_registered'] ? (int) $this->user->data['user_id'] : 0;
        $username = $this->user->data['is_registered'] ? $this->user->data['username'] : ($this->user->ip ?: $this->language->lang('GUEST'));

        $sql_arr = [
            'file_id'     => $file_id,
            'user_id'     => $user_id,
            'username'    => $username,
            'ip_address'  => $this->user->ip,
            'user_agent'  => $this->request->header('USER_AGENT', 'unknown'),
            'action'      => $action,
            'log_time'    => time(),
        ];

        $sql = 'INSERT INTO ' . $this->logs_table . ' ' . $this->db->sql_build_array('INSERT', $sql_arr);
        $this->db->sql_query($sql);
    }

    public function handle(): Response
    {
        $this->language->add_lang('common', 'mundophpbb/simpledown');
        include($this->root_path . 'includes/functions_posting.' . $this->php_ext);

        $private_categories = unserialize($this->config['simpledown_private_categories'] ?? serialize([]));
        $is_logged_in = $this->user->data['is_registered'];

        $sql = 'SELECT f.*, c.name AS cat_name, f.category_id AS cat_id
                FROM ' . $this->files_table . ' f
                LEFT JOIN ' . $this->categories_table . ' c ON f.category_id = c.id
                ORDER BY COALESCE(c.name, ""), f.file_name';
        $result = $this->db->sql_query($sql);

        $cat_files = [];
        while ($row = $this->db->sql_fetchrow($result)) {
            $cat_id = (int) $row['cat_id'];
            $cat_name = $row['cat_name'] ?: $this->language->lang('SIMPLEDOWN_NO_CATEGORY');

            if (!isset($cat_files[$cat_id])) {
                $cat_files[$cat_id] = [
                    'name' => $cat_name,
                    'files' => [],
                ];
            }

            $desc_full = $row['file_desc'] ?: '';
            $desc_formatted = generate_text_for_display(
                $desc_full,
                $row['file_desc_bbcode_uid'] ?? '',
                $row['file_desc_bbcode_bitfield'] ?? '',
                $row['file_desc_bbcode_flags'] ?? 7
            );
            $short_desc = $row['file_desc_short'] ?: strip_tags($desc_formatted) ?: $this->language->lang('SIMPLEDOWN_NO_DESCRIPTION');

            $extension = strtolower(pathinfo($row['file_realname'], PATHINFO_EXTENSION));
            $is_image = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);

            $is_private = in_array($row['category_id'], $private_categories) || (!empty($row['is_private']) && $row['is_private'] == 1);

            $cat_files[$cat_id]['files'][] = [
                'row' => $row,
                'short_desc' => $short_desc,
                'desc_formatted' => $desc_formatted,
                'is_image' => $is_image,
                'is_private' => $is_private,
            ];
        }
        $this->db->sql_freeresult($result);

        foreach ($cat_files as $cat_id => $cat_data) {
            $this->template->assign_block_vars('categories', [
                'NAME' => $cat_data['name'],
                'ID' => $cat_id,
                'FILE_COUNT' => count($cat_data['files']),
            ]);

            foreach ($cat_data['files'] as $file_data) {
                $file = $file_data['row'];

                $this->template->assign_block_vars('categories.files', [
                    'NAME'           => $file['file_name'],
                    'DESC_SHORT'     => $file_data['short_desc'],
                    'DESC_FORMATTED' => $file_data['desc_formatted'],
                    'DOWNLOADS'      => $file['downloads'],
                    'SIZE'           => $this->get_formatted_filesize($file['file_size']),
                    'REAL_NAME'      => $file['file_realname'],
                    'U_DOWNLOAD'     => $this->helper->route('mundophpbb_simpledown_download', ['id' => $file['id']]),
                    'U_PREVIEW_ROUTE'=> $this->helper->route('mundophpbb_simpledown_preview', ['id' => $file['id']]),
                    'U_DETAILS'      => $this->helper->route('mundophpbb_simpledown_details', ['id' => $file['id']]),
                    'FILE_ICON'      => $this->get_file_icon_class($file['file_realname']),
                    'VERSION'        => $file['version'] ?? '',
                    'IS_IMAGE'       => $file_data['is_image'],
                    'IS_PRIVATE'     => $file_data['is_private'],
                    'PRIVATE_LABEL'  => $file_data['is_private'] ? $this->language->lang('SIMPLEDOWN_PRIVATE_FILE') : $this->language->lang('SIMPLEDOWN_PUBLIC_FILE'),
                    'SHOW_LOGIN_MODAL' => $file_data['is_private'] && !$is_logged_in,
                    'FILE_ID'        => $file['id'],
                    'U_DOWNLOAD_URL' => $this->helper->route('mundophpbb_simpledown_download', ['id' => $file['id']]),
                    'U_LOG_DENIED'   => $this->helper->route('mundophpbb_simpledown_log_denied', ['id' => $file['id']]),
                ]);
            }
        }

        // Dropdown de categorias
        $sql_dropdown = 'SELECT id, name FROM ' . $this->categories_table . ' ORDER BY name';
        $result_dropdown = $this->db->sql_query($sql_dropdown);

        if (isset($cat_files[0])) {
            $this->template->assign_block_vars('dropdown_categories', [
                'ID'   => 0,
                'NAME' => $this->language->lang('SIMPLEDOWN_NO_CATEGORY'),
            ]);
        }

        while ($row = $this->db->sql_fetchrow($result_dropdown)) {
            $this->template->assign_block_vars('dropdown_categories', [
                'ID'   => $row['id'],
                'NAME' => $row['name'],
            ]);
        }
        $this->db->sql_freeresult($result_dropdown);

        $site_theme = $this->config['simpledown_theme'] ?? 'light';
        $cards_per_row = ($this->config['simpledown_cards_per_row'] ?? 3) == 2 ? 2 : 3;
        $allow_user_layout_choice = !empty($this->config['simpledown_allow_user_layout_choice']);

        $this->template->assign_vars([
            'S_IS_LOGGED_IN'         => $is_logged_in,
            'U_LOGIN'                => append_sid("{$this->root_path}ucp.{$this->php_ext}", 'mode=login'),
            'U_REGISTER'             => append_sid("{$this->root_path}ucp.{$this->php_ext}", 'mode=register'),
            'S_SIMPLEDOWN_THEME'     => $site_theme,
            'CARDS_PER_ROW'          => $cards_per_row,
            'ALLOW_USER_LAYOUT_CHOICE' => $allow_user_layout_choice,
        ]);

        return $this->helper->render('downloads_body.html', $this->language->lang('SIMPLEDOWN_TITLE'));
    }

    public function details(int $id): Response
    {
        $this->language->add_lang('common', 'mundophpbb/simpledown');
        include($this->root_path . 'includes/functions_posting.' . $this->php_ext);

        $private_categories = unserialize($this->config['simpledown_private_categories'] ?? serialize([]));

        $sql = 'SELECT f.*, c.name AS cat_name
                FROM ' . $this->files_table . ' f
                LEFT JOIN ' . $this->categories_table . ' c ON f.category_id = c.id
                WHERE f.id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $file = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$file) {
            throw new http_exception(404, $this->language->lang('SIMPLEDOWN_FILE_NOT_FOUND'));
        }

        $is_private = in_array($file['category_id'], $private_categories) || (!empty($file['is_private']) && $file['is_private'] == 1);
        $is_logged_in = $this->user->data['is_registered'];

        $extension = strtolower(pathinfo($file['file_realname'], PATHINFO_EXTENSION));
        $is_image = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);

        $has_thumbnail = !empty($file['thumbnail']);
        $thumb_url = $has_thumbnail
            ? generate_board_url() . '/ext/mundophpbb/simpledown/files/thumbs/' . rawurlencode($file['thumbnail']) . '?v=' . time()
            : '';

        $preview_route = $this->helper->route('mundophpbb_simpledown_preview', ['id' => $file['id']]);

        $desc_full = $file['file_desc'] ?: $this->language->lang('SIMPLEDOWN_NO_DESCRIPTION');
        $desc_formatted = generate_text_for_display(
            $desc_full,
            $file['file_desc_bbcode_uid'] ?? '',
            $file['file_desc_bbcode_bitfield'] ?? '',
            $file['file_desc_bbcode_flags'] ?? 7
        );

        $site_theme = $this->config['simpledown_theme'] ?? 'light';

        $this->template->assign_vars([
            'FILE_NAME'         => $file['file_name'],
            'FILE_DESC'         => $desc_formatted,
            'FILE_REALNAME'     => $file['file_realname'],
            'FILE_SIZE'         => $this->get_formatted_filesize($file['file_size']),
            'FILE_DOWNLOADS'    => $file['downloads'],
            'FILE_ICON'         => $this->get_file_icon_class($file['file_realname']),
            'U_DOWNLOAD'        => $this->helper->route('mundophpbb_simpledown_download', ['id' => $file['id']]),
            'U_PREVIEW_ROUTE'   => $preview_route,
            'HAS_THUMBNAIL'     => $has_thumbnail,
            'U_THUMBNAIL'       => $thumb_url,
            'CAT_NAME'          => $file['cat_name'] ?: $this->language->lang('SIMPLEDOWN_NO_CATEGORY'),
            'U_SIMPLEDOWN'      => $this->helper->route('mundophpbb_simpledown_index'),
            'VERSION_DISPLAY'   => $file['version'] ?? $this->language->lang('SIMPLEDOWN_NO_VERSION'),
            'IS_IMAGE'          => $is_image,
            'IS_PRIVATE'        => $is_private,
            'PRIVATE_LABEL'     => $is_private ? $this->language->lang('SIMPLEDOWN_PRIVATE_FILE') : $this->language->lang('SIMPLEDOWN_PUBLIC_FILE'),
            'SHOW_LOGIN_MODAL'  => $is_private && !$is_logged_in,
            'S_IS_LOGGED_IN'    => $is_logged_in,
            'U_LOGIN'           => append_sid("{$this->root_path}ucp.{$this->php_ext}", 'mode=login'),
            'U_REGISTER'        => append_sid("{$this->root_path}ucp.{$this->php_ext}", 'mode=register'),
            'S_SIMPLEDOWN_THEME'=> $site_theme,
            'FILE_ID'           => $file['id'],
            'U_DOWNLOAD_URL'    => $this->helper->route('mundophpbb_simpledown_download', ['id' => $file['id']]),
            'U_LOG_DENIED'      => $this->helper->route('mundophpbb_simpledown_log_denied', ['id' => $file['id']]),
        ]);

        return $this->helper->render('download_details.html', $file['file_name'] . ' - ' . $this->language->lang('SIMPLEDOWN_TITLE'));
    }

    public function preview(int $id): Response
    {
        $sql = 'SELECT file_realname
                FROM ' . $this->files_table . '
                WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$row) {
            throw new http_exception(404, $this->language->lang('SIMPLEDOWN_FILE_NOT_FOUND'));
        }

        $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/' . $row['file_realname'];
        if (!file_exists($file_path)) {
            throw new http_exception(404, $this->language->lang('SIMPLEDOWN_FILE_NOT_FOUND'));
        }

        $this->log_action($id, 'view');

        $response = new BinaryFileResponse($file_path);
        $response->headers->set('Content-Type', mime_content_type($file_path) ?: 'application/octet-stream');
        $response->headers->set('Cache-Control', 'public, max-age=31536000');
        $response->setAutoEtag();

        return $response;
    }

    public function download(int $id): Response
    {
        $private_categories = unserialize($this->config['simpledown_private_categories'] ?? serialize([]));

        $sql = 'SELECT *
                FROM ' . $this->files_table . '
                WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$row) {
            throw new http_exception(404, $this->language->lang('SIMPLEDOWN_FILE_NOT_FOUND'));
        }

        $is_private = in_array($row['category_id'], $private_categories) || (!empty($row['is_private']) && $row['is_private'] == 1);

        if ($is_private && !$this->user->data['is_registered']) {
            $this->log_action($id, 'denied');
            throw new http_exception(403, $this->language->lang('SIMPLEDOWN_LOGIN_REQUIRED'));
        }

        $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/' . $row['file_realname'];
        if (!file_exists($file_path)) {
            throw new http_exception(404, $this->language->lang('SIMPLEDOWN_FILE_NOT_FOUND'));
        }

        // Incrementa contador de downloads
        $sql = 'UPDATE ' . $this->files_table . '
                SET downloads = downloads + 1
                WHERE id = ' . (int)$id;
        $this->db->sql_query($sql);

        // Registra log
        $this->log_action($id, 'download');
        $this->log->add('user', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_FILE_DOWNLOADED', false, [$row['file_name']]);

        $response = new BinaryFileResponse($file_path);
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Length', (string) filesize($file_path));
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $row['file_name']);

        return $response;
    }

    /**
     * Rota AJAX para registrar acesso negado (denied) de forma silenciosa
     */
    public function log_denied(int $id): Response
    {
        $sql = 'SELECT id, category_id, is_private
                FROM ' . $this->files_table . '
                WHERE id = ' . (int)$id;
        $result = $this->db->sql_query_limit($sql, 1);
        $file = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$file) {
            return new Response('', 404);
        }

        $private_categories = unserialize($this->config['simpledown_private_categories'] ?? serialize([]));
        $is_private = in_array($file['category_id'], $private_categories) || (!empty($file['is_private']) && $file['is_private'] == 1);

        if ($is_private && !$this->user->data['is_registered']) {
            $this->log_action((int)$id, 'denied');
        }

        return new Response('', 204);
    }
}