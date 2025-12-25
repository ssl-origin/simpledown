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
            // Adiciona o módulo ACP principal na categoria "Extensões"
            ['module.add', [
                'acp',
                'ACP_CAT_DOT_MODS',
                'ACP_SIMPLEDOWN_TITLE'
            ]],
            // Adiciona os três modos ao módulo
            ['module.add', [
                'acp',
                'ACP_SIMPLEDOWN_TITLE',
                [
                    'module_basename' => '\mundophpbb\simpledown\acp\main_module',
                    'modes' => ['settings', 'files', 'tools'],
                ],
            ]],
            // Configurações padrão
            ['config.add', ['simpledown_max_upload_size', 100]],
            ['config.add', ['simpledown_short_desc_limit', 150]],
            ['config.add', ['simpledown_default_is_private', 0]], // visibilidade padrão (0 = público)
            // Mensagem padrão exibida no modal de login para arquivos privados
            ['config.add', ['simpledown_private_message', 'Este arquivo é exclusivo para membros cadastrados. Faça login ou registre-se para baixar.']],
            // Caminho da pasta de thumbnails (ESSENCIAL PARA A ABA TOOLS FUNCIONAR)
            ['config.add', ['simpledown_thumbs_dir', 'ext/mundophpbb/simpledown/files/thumbs/']],
            // Cria as pastas de upload e thumbnails
            ['custom', [[$this, 'create_upload_dirs']]],
        ];
    }

    public function update_schema()
    {
        return [
            'add_tables' => [
                $this->table_prefix . 'simpledown_categories' => [
                    'COLUMNS' => [
                        'id' => ['UINT', null, 'auto_increment'],
                        'name' => ['VCHAR:255', ''],
                    ],
                    'PRIMARY_KEY' => 'id',
                ],
                $this->table_prefix . 'simpledown_files' => [
                    'COLUMNS' => [
                        'id' => ['UINT', null, 'auto_increment'],
                        'file_name' => ['VCHAR:255', ''],
                        'file_realname' => ['VCHAR:255', ''],
                        'file_desc_short' => ['TEXT_UNI', ''],
                        'file_desc' => ['TEXT_UNI', ''],
                        'version' => ['VCHAR:50', null],
                        'category_id' => ['UINT', 0],
                        'downloads' => ['UINT', 0],
                        'file_size' => ['UINT', 0],
                        'file_hash' => ['VCHAR:32', ''],
                        'thumbnail' => ['VCHAR:255', null],
                        'is_private' => ['BOOL', 0], // 0 = público, 1 = privado
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
            // Apaga todos os arquivos físicos da extensão
            ['custom', [[$this, 'delete_all_files']]],
            // Remove configurações
            ['config.remove', ['simpledown_max_upload_size']],
            ['config.remove', ['simpledown_short_desc_limit']],
            ['config.remove', ['simpledown_default_is_private']],
            ['config.remove', ['simpledown_private_message']],
            ['config.remove', ['simpledown_thumbs_dir']], // ← REMOÇÃO DA NOVA CONFIG
            // Remove módulos ACP
            ['module.remove', ['acp', 'ACP_SIMPLEDOWN_TITLE', '']],
            ['module.remove', ['acp', 'ACP_CAT_DOT_MODS', 'ACP_SIMPLEDOWN_TITLE']],
        ];
    }

    /**
     * Cria as pastas necessárias para uploads e thumbnails
     */
    public function create_upload_dirs()
    {
        $root_path = $this->phpbb_root_path;
        $base_dir = $root_path . 'ext/mundophpbb/simpledown/';
        $dirs_to_create = [
            $base_dir . 'files/',
            $base_dir . 'files/thumbs/',
        ];
        foreach ($dirs_to_create as $dir) {
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
                @chmod($dir, 0755);
            }
        }
    }

    /**
     * Apaga todos os arquivos físicos da extensão durante a desinstalação
     */
    public function delete_all_files()
    {
        $root_path = $this->phpbb_root_path;
        $files_dir = $root_path . 'ext/mundophpbb/simpledown/files/';
        if (is_dir($files_dir)) {
            $this->rrmdir($files_dir);
        }
    }

    /**
     * Remove recursivamente uma pasta e todo o seu conteúdo
     *
     * @param string $dir Caminho da pasta
     */
    protected function rrmdir($dir)
    {
        if (!is_dir($dir)) {
            return;
        }
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object === '.' || $object === '..') {
                continue;
            }
            $path = $dir . DIRECTORY_SEPARATOR . $object;
            if (is_dir($path)) {
                $this->rrmdir($path);
            } else {
                @unlink($path);
            }
        }
        @rmdir($dir);
    }
}