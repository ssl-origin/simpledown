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

        $user->add_lang_ext('mundophpbb/simpledown', 'common');
        $user->add_lang_ext('mundophpbb/simpledown', 'acp/info_acp_simpledown', 'en');
        if ($user->lang['CODE'] !== 'en') {
            $user->add_lang_ext('mundophpbb/simpledown', 'acp/info_acp_simpledown');
        }

        add_form_key('mundophpbb_simpledown');

        switch ($mode) {
            case 'settings':
                $this->tpl_name = 'acp_simpledown_settings';
                $this->page_title = $user->lang('ACP_SIMPLEDOWN_SETTINGS');

                /** @var \mundophpbb\simpledown\controller\acp_settings_controller $controller */
                $controller = $phpbb_container->get('mundophpbb.simpledown.acp_settings_controller');
                $controller->set_u_action($this->u_action);
                $controller->handle();
                break;

            case 'files':
                $this->tpl_name = 'acp_simpledown_files';
                $this->page_title = $user->lang('ACP_SIMPLEDOWN_FILES');

                /** @var \mundophpbb\simpledown\controller\acp_files_controller $controller */
                $controller = $phpbb_container->get('mundophpbb.simpledown.acp_files_controller');
                $controller->set_u_action($this->u_action);
                $controller->handle();
                break;

            case 'tools':
                $this->tpl_name = 'acp_simpledown_tools';
                $this->page_title = $user->lang('ACP_SIMPLEDOWN_TOOLS');

                /** @var \mundophpbb\simpledown\controller\acp_tools_controller $controller */
                $controller = $phpbb_container->get('mundophpbb.simpledown.acp_tools_controller');
                $controller->set_u_action($this->u_action);
                $controller->handle();
                break;

            default:
                redirect(append_sid("{$phpbb_admin_path}index.$php_ext", "i=simpledown&mode=settings"));
                break;
        }
    }
}