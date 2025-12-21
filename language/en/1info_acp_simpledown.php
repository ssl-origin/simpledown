<?php
/**
 * ACP Language File (English)
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
    'ACP_SIMPLEDOWN_TITLE'                  => 'Simple Downloads',
    'ACP_SIMPLEDOWN_SETTINGS'               => 'Settings',
    'ACP_SIMPLEDOWN_FILES'                  => 'Files',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE'        => 'Maximum upload size',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE_EXPLAIN'=> 'Maximum file size in MB (default: 100 MB).',
    'ACP_SIMPLEDOWN_SAVE_CONFIG'            => 'Save settings',
    'ACP_SIMPLEDOWN_EXISTING_FILES'         => 'Existing Files',
    'ACP_SIMPLEDOWN_FILE_NAME'              => 'File Name',
    'ACP_SIMPLEDOWN_CATEGORY'               => 'Category',
    'ACP_SIMPLEDOWN_DOWNLOADS'              => 'Downloads',
    'ACP_SIMPLEDOWN_SIZE'                   => 'Size',
    'ACP_SIMPLEDOWN_ACTIONS'                => 'Actions',
    'ACP_SIMPLEDOWN_EDIT'                   => 'Edit',
    'ACP_SIMPLEDOWN_DELETE'                 => 'Delete',
    'ACP_SIMPLEDOWN_NO_FILES_YET'           => 'No files yet.',
    'ACP_SIMPLEDOWN_CONFIG_SAVED'           => 'Settings saved successfully!',
]);