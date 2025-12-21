<?php
/**
 * Language File - Common (English)
 *
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
 */

if (!defined('IN_PHPBB')) {
    exit;
}

if (empty($lang) || !is_array($lang)) {
    $lang = array();
}

$lang = array_merge($lang, array(
    // General titles and messages
    'SIMPLEDOWN_TITLE'                  => 'Downloads',
    'SIMPLEDOWN_NO_CATEGORY'            => 'No Category',
    'SIMPLEDOWN_SHOW_ALL_CATEGORIES'    => 'Show all categories',
    'SIMPLEDOWN_NO_DOWNLOADS_AVAILABLE' => 'No downloads available.',
    'SIMPLEDOWN_NO_CATEGORIES_YET'      => 'No categories yet.',
    'SIMPLEDOWN_FILE_NOT_FOUND'         => 'File not found.',

    // File information
    'SIMPLEDOWN_DOWNLOADS'              => 'Downloads',
    'SIMPLEDOWN_DOWNLOADS_LOWER'        => 'downloads',
    'SIMPLEDOWN_SIZE'                   => 'Size',
    'SIMPLEDOWN_NO_DESCRIPTION'         => 'No description available.',

    // Buttons and navigation
    'DOWNLOAD_BUTTON'                   => 'Download',
    'SIMPLEDOWN_DETAILS_BUTTON'         => 'Details',
    'SIMPLEDOWN_BACK_TO_DOWNLOADS'      => 'Back to Downloads',

    // Category
    'SIMPLEDOWN_CATEGORY'               => 'Category',

    // Image preview
    'SIMPLEDOWN_PREVIEW_IMAGE'          => 'Preview image',
    'SIMPLEDOWN_IMAGE_PREVIEW_ALT'      => 'Image preview',

    // Search
    'SIMPLEDOWN_SEARCH_PLACEHOLDER'     => 'Search by name or description...',

    // Sorting
    'SIMPLEDOWN_SORT_DEFAULT'           => 'Sort by',
    'SORT_NAME_ASC'                     => 'Name (A → Z)',
    'SORT_NAME_DESC'                    => 'Name (Z → A)',
    'SORT_DOWNLOADS_DESC'               => 'Most downloaded',
    'SORT_DOWNLOADS_ASC'                => 'Least downloaded',
    'SORT_SIZE_DESC'                    => 'Largest size',
    'SORT_SIZE_ASC'                     => 'Smallest size',

    // Count
    'SIMPLEDOWN_FILES'                  => 'files',

    // Logs
    'LOG_SIMPLEDOWN_FILE_DOWNLOADED'    => 'SimpleDown file downloaded: %s',
));