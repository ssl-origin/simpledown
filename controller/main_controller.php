<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
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
        $root_path,
        $php_ext,
        $table_prefix
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
    }

    /**
     * Formata tamanho de arquivo de forma legível
     */
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

    /**
     * Retorna a classe Font Awesome adequada ao tipo de arquivo
     */
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

    /**
     * Página principal /downloads - Lista todos os arquivos agrupados por categoria
     */
    public function handle(): Response
    {
        $this->language->add_lang('common', 'mundophpbb/simpledown');

        $private_categories = unserialize($this->config['simpledown_private_categories'] ?? serialize([]));
        $is_logged_in = $this->user->data['is_registered'];

        // Busca todos os arquivos com nome da categoria
        $sql = 'SELECT f.*, c.name AS cat_name, f.category_id AS cat_id
                FROM ' . $this->files_table . ' f
                LEFT JOIN ' . $this->categories_table . ' c ON f.category_id = c.id
                ORDER BY COALESCE(c.name, ""), f.file_name';
        $result = $this->db->sql_query($sql);
        $cat_files = [];
        while ($row = $this->db->sql_fetchrow($result)) {
            $cat_id = (int)$row['cat_id'];
            $cat_name = $row['cat_name'] ?: $this->language->lang('SIMPLEDOWN_NO_CATEGORY');
            if (!isset($cat_files[$cat_id])) {
                $cat_files[$cat_id] = [
                    'name' => $cat_name,
                    'files' => [],
                ];
            }
            $cat_files[$cat_id]['files'][] = $row;
        }
        $this->db->sql_freeresult($result);

        // Atribui blocos ao template
        foreach ($cat_files as $cat_id => $cat_data) {
            $this->template->assign_block_vars('categories', [
                'NAME'       => $cat_data['name'],
                'ID'         => $cat_id,
                'FILE_COUNT' => count($cat_data['files']),
            ]);
            foreach ($cat_data['files'] as $file) {
                $short_desc = $file['file_desc_short'] ?: $file['file_desc'] ?: $this->language->lang('SIMPLEDOWN_NO_DESCRIPTION');
                $has_thumbnail = !empty($file['thumbnail']);
                $thumb_url = $has_thumbnail
                    ? generate_board_url() . '/ext/mundophpbb/simpledown/files/thumbs/' . rawurlencode($file['thumbnail'])
                    : '';
                $is_private = in_array($file['category_id'], $private_categories) || (!empty($file['is_private']) && $file['is_private'] == 1);

                $this->template->assign_block_vars('categories.files', [
                    'NAME'           => $file['file_name'],
                    'DESC_SHORT'     => $short_desc,
                    'DESC'           => $file['file_desc'],
                    'DOWNLOADS'      => $file['downloads'],
                    'SIZE'           => $this->get_formatted_filesize($file['file_size']),
                    'REAL_NAME'      => $file['file_realname'],
                    'U_DOWNLOAD'     => $this->helper->route('mundophpbb_simpledown_download', ['id' => $file['id']]),
                    'U_PREVIEW'      => $this->helper->route('mundophpbb_simpledown_preview', ['id' => $file['id']]),
                    'U_DETAILS'      => $this->helper->route('mundophpbb_simpledown_details', ['id' => $file['id']]),
                    'FILE_ICON'      => $this->get_file_icon_class($file['file_realname']),
                    'VERSION'        => $file['version'] ?? '',
                    'HAS_THUMBNAIL'  => $has_thumbnail,
                    'U_THUMBNAIL'    => $thumb_url,
                    'IS_PRIVATE'     => $is_private,
                    'PRIVATE_LABEL'  => $is_private ? $this->language->lang('SIMPLEDOWN_PRIVATE_FILE') : $this->language->lang('SIMPLEDOWN_PUBLIC_FILE'),
                    'SHOW_LOGIN_MODAL'=> $is_private && !$is_logged_in,
                ]);
            }
        }

        // Dropdown de categorias no filtro
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

        // Tema do site
        $site_theme = $this->config['simpledown_theme'] ?? 'light';

        // Número de cards por linha
        $cards_per_row = (int)($this->config['simpledown_cards_per_row'] ?? 3);
        $cards_per_row = ($cards_per_row == 2) ? 2 : 3;

        // Permitir que usuários escolham entre grid e lista
        $allow_user_layout_choice = (bool)($this->config['simpledown_allow_user_layout_choice'] ?? false);

        $this->template->assign_vars([
            'S_IS_LOGGED_IN'           => $is_logged_in,
            'U_LOGIN'                  => append_sid("{$this->root_path}ucp.{$this->php_ext}", 'mode=login'),
            'U_REGISTER'               => append_sid("{$this->root_path}ucp.{$this->php_ext}", 'mode=register'),
            'S_SIMPLEDOWN_THEME'       => $site_theme,
            'CARDS_PER_ROW'            => $cards_per_row,
            'ALLOW_USER_LAYOUT_CHOICE' => $allow_user_layout_choice,
        ]);

        return $this->helper->render('downloads_body.html', $this->language->lang('SIMPLEDOWN_TITLE'));
    }

    public function details(int $id): Response
    {
        $this->language->add_lang('common', 'mundophpbb/simpledown');
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
        $show_login_modal = $is_private && !$is_logged_in;
        $extension = strtolower(pathinfo($file['file_realname'], PATHINFO_EXTENSION));
        $is_image = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
        $has_thumbnail = !empty($file['thumbnail']);
        $thumb_url = $has_thumbnail
            ? generate_board_url() . '/ext/mundophpbb/simpledown/files/thumbs/' . rawurlencode($file['thumbnail']) . '?v=' . time()
            : '';
        $preview_url = $has_thumbnail ? $thumb_url : ($is_image ? $this->helper->route('mundophpbb_simpledown_preview', ['id' => $file['id']]) : '');
        $site_theme = $this->config['simpledown_theme'] ?? 'light';
        $this->template->assign_vars([
            'FILE_NAME'        => $file['file_name'],
            'FILE_DESC'        => $file['file_desc'] ?: $this->language->lang('SIMPLEDOWN_NO_DESCRIPTION'),
            'FILE_REALNAME'    => $file['file_realname'],
            'FILE_SIZE'        => $this->get_formatted_filesize($file['file_size']),
            'FILE_DOWNLOADS'   => $file['downloads'],
            'FILE_ICON'        => $this->get_file_icon_class($file['file_realname']),
            'U_DOWNLOAD'       => $this->helper->route('mundophpbb_simpledown_download', ['id' => $file['id']]),
            'U_PREVIEW'        => $preview_url,
            'HAS_THUMBNAIL'    => $has_thumbnail,
            'U_THUMBNAIL'      => $thumb_url,
            'CAT_NAME'         => $file['cat_name'] ?: $this->language->lang('SIMPLEDOWN_NO_CATEGORY'),
            'U_SIMPLEDOWN'     => $this->helper->route('mundophpbb_simpledown_index'),
            'VERSION_DISPLAY'  => $file['version'] ?? $this->language->lang('SIMPLEDOWN_NO_VERSION'),
            'IS_IMAGE'         => $is_image,
            'IS_PRIVATE'       => $is_private,
            'PRIVATE_LABEL'    => $is_private ? $this->language->lang('SIMPLEDOWN_PRIVATE_FILE') : $this->language->lang('SIMPLEDOWN_PUBLIC_FILE'),
            'SHOW_LOGIN_MODAL' => $show_login_modal,
            'S_IS_LOGGED_IN'   => $is_logged_in,
            'U_LOGIN'          => append_sid("{$this->root_path}ucp.{$this->php_ext}", 'mode=login'),
            'U_REGISTER'       => append_sid("{$this->root_path}ucp.{$this->php_ext}", 'mode=register'),
            'S_SIMPLEDOWN_THEME'=> $site_theme,
        ]);
        return $this->helper->render('download_details.html', $file['file_name'] . ' - ' . $this->language->lang('SIMPLEDOWN_TITLE'));
    }

    public function preview(int $id): Response
    {
        $private_categories = unserialize($this->config['simpledown_private_categories'] ?? serialize([]));
        $sql = 'SELECT is_private, file_realname, category_id FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);
        if (!$row) {
            throw new http_exception(404, $this->language->lang('SIMPLEDOWN_FILE_NOT_FOUND'));
        }
        $is_private = in_array($row['category_id'], $private_categories) || (!empty($row['is_private']) && $row['is_private'] == 1);
        if ($is_private && !$this->user->data['is_registered']) {
            throw new http_exception(403, $this->language->lang('SIMPLEDOWN_LOGIN_REQUIRED'));
        }
        $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/' . $row['file_realname'];
        if (!file_exists($file_path)) {
            throw new http_exception(404, $this->language->lang('SIMPLEDOWN_FILE_NOT_FOUND'));
        }
        $response = new BinaryFileResponse($file_path);
        $response->headers->set('Content-Type', mime_content_type($file_path) ?: 'application/octet-stream');
        $response->headers->set('Cache-Control', 'public, max-age=31536000');
        $response->setAutoEtag();
        return $response;
    }

    public function download(int $id): Response
    {
        $private_categories = unserialize($this->config['simpledown_private_categories'] ?? serialize([]));
        $sql = 'SELECT * FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);
        if (!$row) {
            throw new http_exception(404, $this->language->lang('SIMPLEDOWN_FILE_NOT_FOUND'));
        }
        $is_private = in_array($row['category_id'], $private_categories) || (!empty($row['is_private']) && $row['is_private'] == 1);
        if ($is_private && !$this->user->data['is_registered']) {
            throw new http_exception(403, $this->language->lang('SIMPLEDOWN_LOGIN_REQUIRED'));
        }
        $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/' . $row['file_realname'];
        if (!file_exists($file_path)) {
            throw new http_exception(404, $this->language->lang('SIMPLEDOWN_FILE_NOT_FOUND'));
        }
        // Incrementa contador de downloads
        $sql = 'UPDATE ' . $this->files_table . ' SET downloads = downloads + 1 WHERE id = ' . (int)$id;
        $this->db->sql_query($sql);
        $this->log->add('user', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_FILE_DOWNLOADED', false, [$row['file_name']]);
        $response = new BinaryFileResponse($file_path);
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Length', (string)filesize($file_path));
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $row['file_name']);
        return $response;
    }
}