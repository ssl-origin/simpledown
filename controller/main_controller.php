<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
 */
namespace mundophpbb\simpledown\controller;

use phpbb\exception\http_exception;
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
    protected $files_table;
    protected $categories_table;

    public function __construct(
        \phpbb\config\config $config,
        \phpbb\controller\helper $helper,
        \phpbb\db\driver\driver_interface $db,
        \phpbb\language\language $language,
        \phpbb\log\log $log,
        \phpbb\request\request $request,
        \phpbb\template\template $template,
        \phpbb\user $user,
        \phpbb\path_helper $path_helper,
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
     * Formata o tamanho do arquivo de forma legível
     */
    protected function get_formatted_filesize($bytes)
    {
        $bytes = max((int)$bytes, 0);
        if ($bytes < 1024) {
            return $bytes . ' bytes';
        } elseif ($bytes < 1048576) {
            return round($bytes / 1024, 2) . ' KB';
        } elseif ($bytes < 1073741824) {
            return round($bytes / 1048576, 2) . ' MB';
        } else {
            return round($bytes / 1073741824, 2) . ' GB';
        }
    }

    /**
     * Retorna a classe Font Awesome correta com base na extensão do arquivo
     */
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

    public function handle()
    {
        $this->language->add_lang('common', 'mundophpbb/simpledown');

        $items_per_page = (int)($this->config['simpledown_items_per_page'] ?? 12);

        $sql = 'SELECT f.*, c.name AS cat_name, f.category_id AS cat_id
                FROM ' . $this->files_table . ' f
                LEFT JOIN ' . $this->categories_table . ' c ON f.category_id = c.id
                ORDER BY COALESCE(c.name, ""), f.file_name';

        $result = $this->db->sql_query($sql);
        $cat_files = [];

        while ($row = $this->db->sql_fetchrow($result))
        {
            $cat_id = $row['cat_id'];
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

        foreach ($cat_files as $cat_id => $cat_data) {
            $file_count = count($cat_data['files']);
            $this->template->assign_block_vars('categories', [
                'NAME' => $cat_data['name'],
                'ID' => $cat_id,
                'FILE_COUNT' => $file_count,
            ]);

            foreach ($cat_data['files'] as $file) {
                $this->template->assign_block_vars('categories.files', [
                    'NAME'       => $file['file_name'],
                    // Fallback seguro: usa file_desc_short se existir, senão usa file_desc antigo
                    'DESC'       => $file['file_desc_short'] ?? ($file['file_desc'] ?? $this->language->lang('SIMPLEDOWN_NO_DESCRIPTION')),
                    'DOWNLOADS'  => $file['downloads'],
                    'SIZE'       => $this->get_formatted_filesize($file['file_size']),
                    'REAL_NAME'  => $file['file_realname'],
                    'U_DOWNLOAD' => $this->helper->route('mundophpbb_simpledown_download', ['id' => $file['id']]),
                    'U_PREVIEW'  => $this->helper->route('mundophpbb_simpledown_preview', ['id' => $file['id']]),
                    'U_DETAILS'  => $this->helper->route('mundophpbb_simpledown_details', ['id' => $file['id']]),
                    'FILE_ICON'  => $this->get_file_icon_class($file['file_realname']),
                ]);
            }
        }

        // Dropdown de categorias
        if (isset($cat_files[0])) {
            $this->template->assign_block_vars('dropdown_categories', [
                'ID' => 0,
                'NAME' => $this->language->lang('SIMPLEDOWN_NO_CATEGORY'),
            ]);
        }

        $sql_dropdown = 'SELECT id, name FROM ' . $this->categories_table . ' ORDER BY name';
        $result_dropdown = $this->db->sql_query($sql_dropdown);
        while ($row_dropdown = $this->db->sql_fetchrow($result_dropdown))
        {
            if (isset($cat_files[$row_dropdown['id']])) {
                $this->template->assign_block_vars('dropdown_categories', [
                    'ID' => $row_dropdown['id'],
                    'NAME' => $row_dropdown['name'],
                ]);
            }
        }
        $this->db->sql_freeresult($result_dropdown);

        $this->template->assign_vars([
            'ITEMS_PER_PAGE' => $items_per_page,
        ]);

        return $this->helper->render('downloads_body.html', $this->language->lang('SIMPLEDOWN_TITLE'));
    }

    public function details($id)
    {
        $this->language->add_lang('common', 'mundophpbb/simpledown');

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

        $is_image = in_array(strtolower(pathinfo($file['file_realname'], PATHINFO_EXTENSION)),
            ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);

        // Descrição completa: usa file_desc_full se existir, senão fallback para file_desc antigo
        $desc_text = $file['file_desc_full'] ?? $file['file_desc'] ?? '';
        $full_desc = generate_text_for_display(
            $desc_text,
            $file['file_uid'] ?? '',
            $file['file_bitfield'] ?? '',
            $file['file_options'] ?? 7
        );

        $this->template->assign_vars([
            'FILE_NAME'      => $file['file_name'],
            'FILE_DESC'      => $full_desc ?: $this->language->lang('SIMPLEDOWN_NO_DESCRIPTION'),
            'FILE_REALNAME'  => $file['file_realname'],
            'FILE_SIZE'      => $this->get_formatted_filesize($file['file_size']),
            'FILE_DOWNLOADS' => $file['downloads'],
            'FILE_ICON'      => $this->get_file_icon_class($file['file_realname']),
            'U_DOWNLOAD'     => $this->helper->route('mundophpbb_simpledown_download', ['id' => $file['id']]),
            'U_PREVIEW'      => $is_image ? $this->helper->route('mundophpbb_simpledown_preview', ['id' => $file['id']]) : '',
            'HAS_THUMBNAIL'  => $is_image,
            'CAT_NAME'       => $file['cat_name'] ?: $this->language->lang('SIMPLEDOWN_NO_CATEGORY'),
            'U_SIMPLEDOWN'   => $this->helper->route('mundophpbb_simpledown_index'),
        ]);

        return $this->helper->render('download_details.html', $file['file_name'] . ' - ' . $this->language->lang('SIMPLEDOWN_TITLE'));
    }

    public function preview($id)
    {
        $sql = 'SELECT * FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$row || in_array(strtolower(pathinfo($row['file_realname'], PATHINFO_EXTENSION)), ['exe'])) {
            throw new http_exception(404, 'Arquivo não encontrado');
        }

        $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/' . $row['file_realname'];
        if (!file_exists($file_path)) {
            throw new http_exception(404, 'Arquivo não encontrado');
        }

        $response = new BinaryFileResponse($file_path);
        $response->headers->set('Content-Type', mime_content_type($file_path) ?: 'application/octet-stream');
        $response->headers->set('Cache-Control', 'public, max-age=31536000');
        return $response;
    }

    public function download($id)
    {
        $sql = 'SELECT * FROM ' . $this->files_table . ' WHERE id = ' . (int)$id;
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

        $sql = 'UPDATE ' . $this->files_table . ' SET downloads = downloads + 1 WHERE id = ' . (int)$id;
        $this->db->sql_query($sql);

        $this->log->add('user', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_FILE_DOWNLOADED', false, [$row['file_name']]);

        $response = new BinaryFileResponse($file_path);
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Length', filesize($file_path));
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $row['file_name']);

        return $response;
    }
}