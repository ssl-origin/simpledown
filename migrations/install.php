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

    static public function depends_on()
    {
        return ['\phpbb\db\migration\data\v330\v330'];
    }

    public function update_data()
    {
        return [
            ['module.add', [
                'acp',
                'ACP_CAT_DOT_MODS',
                'ACP_SIMPLEDOWN_TITLE'
            ]],
            ['module.add', [
                'acp',
                'ACP_SIMPLEDOWN_TITLE',
                [
                    'module_basename' => '\mundophpbb\simpledown\acp\main_module',
                    'modes' => ['settings', 'files'], // Adiciona os dois modos
                ],
            ]],
            ['config.add', ['simpledown_max_upload_size', 100]],
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
                        'id'            => ['UINT', null, 'auto_increment'],
                        'file_name'     => ['VCHAR:255', ''],
                        'file_realname' => ['VCHAR:255', ''],
                        'file_desc'     => ['TEXT', ''],
                        'category_id'   => ['UINT', 0],
                        'downloads'     => ['UINT', 0],
                        'file_size'     => ['UINT', 0],
                        'file_hash'     => ['VCHAR:32', ''],
                    ],
                    'PRIMARY_KEY' => 'id',
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
            ],
        ];
    }

    public function revert_data()
    {
        return [
            ['custom', [[$this, 'delete_all_files']]],
            ['config.remove', ['simpledown_max_upload_size']],
        ];
    }

    public function delete_all_files()
    {
        $root_path = $this->phpbb_root_path;
        $base_dir = $root_path . 'ext/mundophpbb/simpledown/';
        $dirs_to_clean = [
            $base_dir . 'files/',
            $base_dir . 'cache/',
            $base_dir . 'thumbs/',
        ];

        foreach ($dirs_to_clean as $dir) {
            if (is_dir($dir)) {
                $files = glob($dir . '*');
                if ($files !== false) {
                    foreach ($files as $file) {
                        if (is_file($file)) {
                            @unlink($file);
                        }
                    }
                }
            }
        }
    }
}