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
            'title'    => 'ACP_SIMPLEDOWN_TITLE', // Título principal da categoria no menu ACP
            'modes'    => [
                'settings' => [
                    'title' => 'ACP_SIMPLEDOWN_SETTINGS', // "Configurações" ou "Settings"
                    'auth'  => 'ext_mundophpbb/simpledown && acl_a_board',
                    'cat'   => ['ACP_SIMPLEDOWN_TITLE'],
                ],
                'files' => [
                    'title' => 'ACP_SIMPLEDOWN_FILES', // "Arquivos" ou "Files"
                    'auth'  => 'ext_mundophpbb/simpledown && acl_a_board',
                    'cat'   => ['ACP_SIMPLEDOWN_TITLE'],
                ],
            ],
        ];
    }
}