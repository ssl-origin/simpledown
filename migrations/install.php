<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
 */

namespace mundophpbb\simpledown\migrations;

class install extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return $this->db_tools->sql_table_exists($this->table_prefix . 'simpledown_files');
    }

    public static function depends_on()
    {
        return ['\phpbb\db\migration\data\v330\v330'];
    }

    public function update_data()
    {
        return [
            // Categoria principal no ACP
            ['module.add', [
                'acp',
                'ACP_CAT_DOT_MODS',
                'ACP_SIMPLEDOWN_TITLE'
            ]],

            // Módulo com os 4 modos (incluindo logs)
            ['module.add', [
                'acp',
                'ACP_SIMPLEDOWN_TITLE',
                [
                    'module_basename' => '\mundophpbb\simpledown\acp\main_module',
                    'modes'           => ['settings', 'files', 'tools', 'logs'],
                ],
            ]],

            // Configurações gerais
            ['config.add', ['simpledown_max_upload_size', 100]],
            ['config.add', ['simpledown_short_desc_limit', 150]],
            ['config.add', ['simpledown_default_is_private', 0]],
            ['config.add', ['simpledown_theme', 'light']],
            ['config.add', ['simpledown_cards_per_row', 3]],
            ['config.add', ['simpledown_allow_user_layout_choice', 0]],
            ['config.add', ['simpledown_private_message', 'Este arquivo é exclusivo para membros cadastrados. Faça login ou registre-se para baixar.']],
            ['config.add', ['simpledown_thumbs_dir', 'ext/mundophpbb/simpledown/files/thumbs/']],

            // Configurações de logs
            ['config.add', ['simpledown_enable_logging', 1]],
            ['config.add', ['simpledown_logs_per_page', 50]],
            ['config.add', ['simpledown_logs_retention_days', 0]],

            // Criação das pastas de upload
            ['custom', [[$this, 'create_upload_dirs']]],
        ];
    }

    public function update_schema()
    {
        return [
            'add_tables' => [
                $this->table_prefix . 'simpledown_categories' => [
                    'COLUMNS' => [
                        'id'   => ['UINT', null, 'auto_increment'],
                        'name' => ['VCHAR:255', ''],
                    ],
                    'PRIMARY_KEY' => 'id',
                ],

                $this->table_prefix . 'simpledown_files' => [
                    'COLUMNS' => [
                        'id'              => ['UINT', null, 'auto_increment'],
                        'file_name'       => ['VCHAR:255', ''],
                        'file_realname'   => ['VCHAR:255', ''],
                        'file_desc_short' => ['TEXT_UNI', ''],
                        'file_desc'       => ['TEXT_UNI', ''],
                        'version'         => ['VCHAR:50', null],
                        'category_id'     => ['UINT', 0],
                        'downloads'       => ['UINT', 0],
                        'file_size'       => ['UINT', 0],
                        'file_hash'       => ['VCHAR:32', ''],
                        'thumbnail'       => ['VCHAR:255', null],
                        'is_private'      => ['BOOL', 0],
                    ],
                    'PRIMARY_KEY' => 'id',
                ],

                $this->table_prefix . 'simpledown_logs' => [
                    'COLUMNS' => [
                        'log_id'      => ['UINT', null, 'auto_increment'],
                        'file_id'     => ['UINT', 0],
                        'user_id'     => ['UINT', 0],
                        'username'    => ['VCHAR:255', ''],
                        'ip_address'  => ['VCHAR:40', ''],
                        'user_agent'  => ['VCHAR_UNI:255', ''],
                        'action'      => ['VCHAR:50', ''],
                        'log_time'    => ['TIMESTAMP', 0],
                        'extra_data'  => ['TEXT_UNI', '', 'NOT NULL', 'default' => ''],
                    ],
                    'PRIMARY_KEY' => 'log_id',
                    'KEYS' => [
                        'log_time'     => ['INDEX', 'log_time'],
                        'file_id'      => ['INDEX', 'file_id'],
                        'user_id'      => ['INDEX', 'user_id'],
                        'action'       => ['INDEX', 'action'],
                        'time_file'    => ['INDEX', ['log_time', 'file_id']],
                        'time_user'    => ['INDEX', ['log_time', 'user_id']],
                        'time_action'  => ['INDEX', ['log_time', 'action']],
                    ],
                ],
            ],
        ];
    }

    public function revert_schema()
    {
        return [
            'drop_tables' => [
                $this->table_prefix . 'simpledown_categories',
                $this->table_prefix . 'simpledown_files',
                $this->table_prefix . 'simpledown_logs',
            ],
        ];
    }

    public function revert_data()
    {
        return [
            ['custom', [[$this, 'delete_all_files']]],

            ['config.remove', ['simpledown_max_upload_size']],
            ['config.remove', ['simpledown_short_desc_limit']],
            ['config.remove', ['simpledown_default_is_private']],
            ['config.remove', ['simpledown_theme']],
            ['config.remove', ['simpledown_cards_per_row']],
            ['config.remove', ['simpledown_allow_user_layout_choice']],
            ['config.remove', ['simpledown_private_message']],
            ['config.remove', ['simpledown_thumbs_dir']],
            ['config.remove', ['simpledown_enable_logging']],
            ['config.remove', ['simpledown_logs_per_page']],
            ['config.remove', ['simpledown_logs_retention_days']],

            ['module.remove', ['acp', 'ACP_SIMPLEDOWN_TITLE', '']],
            ['module.remove', ['acp', 'ACP_CAT_DOT_MODS', 'ACP_SIMPLEDOWN_TITLE']],
        ];
    }

    /**
     * Cria as pastas necessárias para uploads e miniaturas
     */
    public function create_upload_dirs()
    {
        $root_path = $this->phpbb_root_path;
        $base_dir  = $root_path . 'ext/mundophpbb/simpledown/';
        $dirs      = ['files/', 'files/thumbs/'];

        foreach ($dirs as $dir)
        {
            $path = $base_dir . $dir;
            if (!is_dir($path))
            {
                @mkdir($path, 0755, true);
                @chmod($path, 0755);
            }
        }
    }

    /**
     * Remove todos os arquivos físicos ao desinstalar
     */
    public function delete_all_files()
    {
        $root_path = $this->phpbb_root_path;
        $files_dir = $root_path . 'ext/mundophpbb/simpledown/files/';

        if (is_dir($files_dir))
        {
            $this->rrmdir($files_dir);
        }
    }

    /**
     * Remove diretório recursivamente
     */
    protected function rrmdir($dir)
    {
        if (!is_dir($dir))
        {
            return;
        }

        $objects = scandir($dir);
        foreach ($objects as $object)
        {
            if ($object === '.' || $object === '..')
            {
                continue;
            }

            $path = $dir . DIRECTORY_SEPARATOR . $object;
            is_dir($path) ? $this->rrmdir($path) : @unlink($path);
        }
        @rmdir($dir);
    }
}