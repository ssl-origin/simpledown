<?php
namespace mundophpbb\simpledown\acp;

use phpbb\config\config;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;

class main_module
{
    public $u_action;
    public $tpl_name;
    public $page_title;

    public function main($id, $mode)
    {
        global $phpbb_container, $user;

        $user->add_lang_ext('mundophpbb/simpledown', 'common');
        $user->add_lang_ext('mundophpbb/simpledown', 'info_acp_simpledown');

        /** @var \mundophpbb\simpledown\controller\admin_controller $admin_controller */
        $admin_controller = $phpbb_container->get('mundophpbb.simpledown.admin_controller');
        $admin_controller->set_u_action($this->u_action);

        add_form_key('mundophpbb_simpledown');

        switch ($mode) {
            case 'settings':
                $this->tpl_name = 'acp_simpledown_settings';
                $this->page_title = $user->lang('ACP_SIMPLEDOWN_TITLE');
                $admin_controller->display_settings();
                break;

            case 'files':
            default:
                $this->tpl_name = 'acp_simpledown_files';
                $this->page_title = $user->lang('ACP_SIMPLEDOWN_TITLE');
                $admin_controller->display_files();
                break;
        }
    }
}