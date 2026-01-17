<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
 */

namespace mundophpbb\simpledown\acp;

class main_info
{
    public function module()
    {
        return [
            'filename' => '\mundophpbb\simpledown\acp\main_module',
            'title'    => 'ACP_SIMPLEDOWN_TITLE',
            'modes'    => [
                'settings' => [
                    'title' => 'ACP_SIMPLEDOWN_SETTINGS',
                    'auth'  => 'ext_mundophpbb/simpledown && acl_a_board',
                    'cat'   => ['ACP_SIMPLEDOWN_TITLE'],
                ],
                'files' => [
                    'title' => 'ACP_SIMPLEDOWN_FILES',
                    'auth'  => 'ext_mundophpbb/simpledown && acl_a_board',
                    'cat'   => ['ACP_SIMPLEDOWN_TITLE'],
                ],
                'tools' => [
                    'title' => 'ACP_SIMPLEDOWN_TOOLS',
                    'auth'  => 'ext_mundophpbb/simpledown && acl_a_board',
                    'cat'   => ['ACP_SIMPLEDOWN_TITLE'],
                ],
                'logs' => [
                    'title' => 'ACP_SIMPLEDOWN_LOGS',
                    'auth'  => 'ext_mundophpbb/simpledown && acl_a_board',
                    'cat'   => ['ACP_SIMPLEDOWN_TITLE'],
                ],
            ],
        ];
    }
}