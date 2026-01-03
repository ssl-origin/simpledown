<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
 */

namespace mundophpbb\simpledown\acp;

class main_module
{
    public $u_action;
    public $tpl_name;
    public $page_title;

    public function main($id, $mode)
    {
        global $phpbb_container, $user;

        // Carrega idiomas da extensão
        $user->add_lang_ext('mundophpbb/simpledown', 'common');
        $user->add_lang_ext('mundophpbb/simpledown', 'acp/info_acp_simpledown');

        // Proteção CSRF global (opcional se cada controller já tem a sua)
        add_form_key('mundophpbb_simpledown');

        switch ($mode)
        {
            case 'settings':
                $this->tpl_name = 'acp_simpledown_settings';
                $this->page_title = $user->lang('ACP_SIMPLEDOWN_SETTINGS');

                $controller = $phpbb_container->get('mundophpbb.simpledown.acp_settings_controller');
                $controller->set_page_url($this->u_action);
                $controller->handle();
                return; // ← Adicionado

            case 'files':
                $this->tpl_name = 'acp_simpledown_files';
                $this->page_title = $user->lang('ACP_SIMPLEDOWN_FILES');

                $controller = $phpbb_container->get('mundophpbb.simpledown.acp_files_controller');
                $controller->set_page_url($this->u_action);
                $controller->handle();
                return; // ← Adicionado

            case 'tools':
                $this->tpl_name = 'acp_simpledown_tools';
                $this->page_title = $user->lang('ACP_SIMPLEDOWN_TOOLS');

                $controller = $phpbb_container->get('mundophpbb.simpledown.acp_tools_controller');
                $controller->set_page_url($this->u_action);
                $controller->handle();
                return; // ← Adicionado

            case 'logs':
                $this->tpl_name = 'acp_simpledown_logs';
                $this->page_title = $user->lang('ACP_SIMPLEDOWN_LOGS');

                $controller = $phpbb_container->get('mundophpbb.simpledown.acp_logs_controller');
                $controller->set_page_url($this->u_action);
                $controller->handle();

                return; // ← ESSA LINHA É A QUE VAI RESOLVER TUDO
                break;

            default:
                trigger_error('NO_MODE', E_USER_ERROR);
                break;
        }
    }
}