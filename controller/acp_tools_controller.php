<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
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
        // Simplificado: remove qualquer barra duplicada e garante a estrutura correta
        $this->root_path = $phpbb_root_path;
    }

    public function set_u_action($u_action)
    {
        $this->u_action = $u_action;
    }

    public function handle()
    {
        $action = $this->request->variable('action', '');

        if ($action === 'delete_thumb') {
            $filename = $this->request->variable('filename', '', true);
            if ($filename) {
                $filename = basename($filename);

                if (confirm_box(true)) {
                    $this->delete_single_thumbnail($filename);
                } else {
                    $s_hidden_fields = build_hidden_fields([
                        'action'   => 'delete_thumb',
                        'filename' => $filename,
                    ]);
                    confirm_box(false, $this->language->lang('ACP_SIMPLEDOWN_CONFIRM_DELETE_THUMB', $filename), $s_hidden_fields);
                }
            }
        }

        $this->list_thumbnails();

        return $this->template->set_filenames([
            'body' => 'acp_simpledown_tools.html',
        ]);
    }

    protected function list_thumbnails()
    {
        // Caminho relativo da extensão
        $relative_path = 'ext/mundophpbb/simpledown/files/thumbs/';
        $thumbs_dir = $this->root_path . $relative_path;
        $has_thumbs = false;

        // Limpa o cache do sistema de arquivos para garantir que ele veja novos arquivos
        clearstatcache();

        if (is_dir($thumbs_dir)) {
            // GLOB_BRACE busca as extensões. 
            // IMPORTANTE: No Windows/XAMPP, o caminho usa \ mas o glob aceita /
            $files = glob($thumbs_dir . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
            
            if ($files !== false && !empty($files)) {
                $has_thumbs = true;
                foreach ($files as $file) {
                    if (is_file($file)) {
                        $filename = basename($file);
                        
                        // Tamanho formatado
                        $size_bytes = filesize($file);
                        $formatted_size = ($size_bytes > 1024) ? round($size_bytes / 1024, 2) . ' KB' : $size_bytes . ' B';

                        // URL para o Navegador (Substitui barras invertidas do Windows por barras normais para a URL)
                        $board_url = rtrim(generate_board_url(), '/');
                        $preview_url = $board_url . '/' . $relative_path . $filename;

                        $this->template->assign_block_vars('thumbs', [
                            'FILENAME'    => $filename,
                            'SIZE'        => $formatted_size,
                            'PREVIEW_URL' => $preview_url,
                        ]);
                    }
                }
            }
        }

        $this->template->assign_vars([
            'U_ACTION'     => $this->u_action,
            'S_HAS_THUMBS' => $has_thumbs,
        ]);
    }

    protected function delete_single_thumbnail($filename)
    {
        $file_path = $this->root_path . 'ext/mundophpbb/simpledown/files/thumbs/' . basename($filename);

        if (file_exists($file_path) && is_file($file_path)) {
            @unlink($file_path);
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_THUMB_DELETED') . adm_back_link($this->u_action));
        } else {
            trigger_error($this->language->lang('ACP_SIMPLEDOWN_THUMB_NOT_FOUND') . adm_back_link($this->u_action), E_USER_WARNING);
        }
    }
}