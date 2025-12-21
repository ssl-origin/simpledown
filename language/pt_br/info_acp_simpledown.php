<?php
/**
 * Arquivo de idioma ACP (Português Brasileiro)
 *
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
 */
if (!defined('IN_PHPBB'))
{
    exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = [];
}

$lang = array_merge($lang, [
    // Títulos e Navegação Geral
    'ACP_SIMPLEDOWN_TITLE'                  => 'Downloads Simples',
    'ACP_SIMPLEDOWN_SETTINGS'               => 'Configurações',
    'ACP_SIMPLEDOWN_FILES'                  => 'Arquivos',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE'        => 'Tamanho máximo de upload',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE_EXPLAIN'=> 'Limite máximo em MB (padrão: 100 MB).',
    'ACP_SIMPLEDOWN_SAVE_CONFIG'            => 'Salvar configurações',
    'ACP_SIMPLEDOWN_EXISTING_FILES'         => 'Arquivos Existentes',
    'ACP_SIMPLEDOWN_FILE_NAME'              => 'Nome do Arquivo',
    'ACP_SIMPLEDOWN_CATEGORY'               => 'Categoria',
    'ACP_SIMPLEDOWN_DOWNLOADS'              => 'Downloads',
    'ACP_SIMPLEDOWN_SIZE'                   => 'Tamanho',
    'ACP_SIMPLEDOWN_ACTIONS'                => 'Ações',
    'ACP_SIMPLEDOWN_EDIT'                   => 'Editar',
    'ACP_SIMPLEDOWN_DELETE'                 => 'Excluir',
    'ACP_SIMPLEDOWN_NO_FILES_YET'           => 'Nenhum arquivo ainda.',
    'ACP_SIMPLEDOWN_CONFIG_SAVED'           => 'Configurações salvas com sucesso!',
]);