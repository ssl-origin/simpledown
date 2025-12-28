<?php
/**
 * Language File - Common (English)
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
    // Title and general messages
    'SIMPLEDOWN_TITLE' => 'Downloads',
    'SIMPLEDOWN_NO_CATEGORY' => 'No Category',
    'SIMPLEDOWN_SHOW_ALL_CATEGORIES' => 'Show all categories',
    'SIMPLEDOWN_NO_DOWNLOADS_AVAILABLE' => 'No downloads available.',
    'SIMPLEDOWN_NO_CATEGORIES_YET' => 'No categories yet.',
    'SIMPLEDOWN_FILE_NOT_FOUND' => 'File not found.',
    // Visibility - Public / Private (frontend)
    'SIMPLEDOWN_PUBLIC_FILE' => 'Public',
    'SIMPLEDOWN_PRIVATE_FILE' => 'Private',
    'SIMPLEDOWN_LOGIN_REQUIRED' => 'You must be logged in to download this file.',
    // File information
    'SIMPLEDOWN_DOWNLOADS' => 'Downloads',
    'SIMPLEDOWN_DOWNLOADS_LOWER' => 'downloads',
    'SIMPLEDOWN_SIZE' => 'Size',
    'SIMPLEDOWN_NO_DESCRIPTION' => 'No description available.',
    'SIMPLEDOWN_NO_SHORT_DESCRIPTION' => 'No short description available.',
    'SIMPLEDOWN_VERSION' => 'Version',
    'SIMPLEDOWN_NO_VERSION' => 'No version',
    // Thumbnails
    'SIMPLEDOWN_THUMBNAIL' => 'Thumbnail',
    'SIMPLEDOWN_NO_THUMBNAIL' => 'No thumbnail',
    'SIMPLEDOWN_SELECT_THUMB' => 'Select existing thumbnail',
    'SIMPLEDOWN_UPLOAD_THUMB' => 'Upload new thumbnail',
    'SIMPLEDOWN_THUMB_PREVIEW' => 'Thumbnail preview',
    // Buttons and navigation
    'DOWNLOAD_BUTTON' => 'Download',
    'SIMPLEDOWN_DETAILS_BUTTON' => 'Details',
    'SIMPLEDOWN_BACK_TO_DOWNLOADS' => 'Back to Downloads',
    // Category
    'SIMPLEDOWN_CATEGORY' => 'Category',
    // Image preview
    'SIMPLEDOWN_PREVIEW_IMAGE' => 'Preview image',
    'SIMPLEDOWN_IMAGE_PREVIEW_ALT' => 'Image preview',
    // Search
    'SIMPLEDOWN_SEARCH_PLACEHOLDER' => 'Search by name or description...',
    'SIMPLEDOWN_CLEAR_SEARCH' => 'Clear search',
    'SIMPLEDOWN_SEARCH_EMPTY' => 'No results found for your search...',
    'SIMPLEDOWN_SEARCH_EMPTY_HINT' => 'Try using different terms or removing some filters.',
    // Sorting
    'SIMPLEDOWN_SORT_DEFAULT' => 'Sort by',
    'SORT_NAME_ASC' => 'Name (A → Z)',
    'SORT_NAME_DESC' => 'Name (Z → A)',
    'SORT_DOWNLOADS_DESC' => 'Most downloaded',
    'SORT_DOWNLOADS_ASC' => 'Least downloaded',
    'SORT_SIZE_DESC' => 'Largest size',
    'SORT_SIZE_ASC' => 'Smallest size',
    // Count
    'SIMPLEDOWN_FILES' => 'files',
    // Logs
    'LOG_SIMPLEDOWN_FILE_DOWNLOADED' => 'SimpleDown file downloaded: %s',
    // ACP - Administration (some keys also used in frontend)
    'ACP_SIMPLEDOWN_TITLE' => 'SimpleDown - Manage Downloads',
    'ACP_SIMPLEDOWN_SETTINGS' => 'Settings',
    'ACP_SIMPLEDOWN_EXISTING_FILES' => 'Existing files',
    'ACP_SIMPLEDOWN_ADD_FILE' => 'Add file',
    'ACP_SIMPLEDOWN_UPLOAD_FILE' => 'Upload file',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB' => 'Upload thumbnail',
    'ACP_SIMPLEDOWN_REPLACE_FILE' => 'Replace file',
    'ACP_SIMPLEDOWN_SELECT_THUMB' => 'Select existing thumbnail',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW' => 'Preview',
    'ACP_SIMPLEDOWN_NO_THUMBS' => 'No thumbnails available.',
    'ACP_SIMPLEDOWN_SAVE_CHANGES' => 'Save changes',
    'ACP_SIMPLEDOWN_CANCEL' => 'Cancel',
    'ACP_SIMPLEDOWN_FILE_EDITED' => 'File edited successfully.',
    'ACP_SIMPLEDOWN_FILE_DELETED' => 'File deleted successfully.',
    // Private file login modal
    'SIMPLEDOWN_PRIVATE_MODAL_TEXT' => 'This file is exclusive to registered members.<br>Log in or register to download.',
    'SIMPLEDOWN_LOGIN_BUTTON' => 'Log In',
    'SIMPLEDOWN_REGISTER_BUTTON' => 'Create Account',
    // Frontend - Details and list
    'L_OR' => 'or',
    'L_DOWNLOAD_BUTTON' => 'Download',
    'L_SIMPLEDOWN_BACK_TO_DOWNLOADS' => '← Back to Downloads',
    'L_SIMPLEDOWN_DETAILS_BUTTON' => 'View Details',
    // Sorting
    'L_SIMPLEDOWN_SORT_DEFAULT' => 'Sort by',
    'L_SORT_NAME_ASC' => 'Name (A → Z)',
    'L_SORT_NAME_DESC' => 'Name (Z → A)',
    'L_SORT_DOWNLOADS_DESC' => 'Most downloaded',
    'L_SORT_DOWNLOADS_ASC' => 'Least downloaded',
    'L_SORT_SIZE_DESC' => 'Largest size',
    'L_SORT_SIZE_ASC' => 'Smallest size',
    // Search
    'L_SIMPLEDOWN_SEARCH_EMPTY' => 'No files found for your search.',
    'L_SIMPLEDOWN_SEARCH_EMPTY_HINT' => 'Try different words or remove filters.',
    // Private modal
    'L_SIMPLEDOWN_PRIVATE_MODAL_TEXT' => 'This file is exclusive to registered members.<br>Log in or create an account to download.',
    'L_SIMPLEDOWN_LOGIN_BUTTON' => 'Log In',
    'L_SIMPLEDOWN_REGISTER_BUTTON' => 'Register',
]);