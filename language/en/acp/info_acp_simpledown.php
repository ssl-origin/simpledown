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
    // General Titles and Navigation
    'ACP_SIMPLEDOWN_TITLE'                  => 'Simple Downloads',
    'ACP_SIMPLEDOWN_SETTINGS'               => 'Settings',
    'ACP_SIMPLEDOWN_FILES'                  => 'Files',
    'ACP_SIMPLEDOWN_TOOLS'                  => 'Tools',
    'ACP_SIMPLEDOWN_ADD_FILE'               => 'Add File',
    'ACP_SIMPLEDOWN_EXISTING_FILES'         => 'Existing Files',

    // General Settings
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE'        => 'Maximum upload size',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE_EXPLAIN'=> 'Limit in MB for uploaded files (default: 100 MB).',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT'       => 'Short description character limit',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT_EXPLAIN'=> 'Maximum characters for the short description displayed on cards (default: 150).',

    // Privacy control by categories
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES'     => 'Private categories',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_EXPLAIN' => 'Select the categories whose files will require login to download. Leave empty so that no file is private by category (individual control still works).',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_HOLD_CTRL' => 'Hold Ctrl (or Cmd on Mac) to select multiple categories.',

    // Default visibility for new files
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY'     => 'Default visibility for new files',
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY_EXPLAIN' => 'This option sets the pre-selected value (public or private) when adding a new file.<br /><strong style="color: #c62828;">Individual file settings always take highest priority:</strong> if you mark a specific file as Public, it will be accessible to everyone (even if the default is Private), and vice versa.',
    'ACP_SIMPLEDOWN_SAVE_CONFIG'            => 'Save Settings',

    // Category Management
    'ACP_SIMPLEDOWN_CATEGORY'               => 'Category',
    'ACP_SIMPLEDOWN_ADD_CATEGORY'           => 'Add Category',
    'ACP_SIMPLEDOWN_CATEGORY_NAME'          => 'Category Name',
    'ACP_SIMPLEDOWN_DELETE_CATEGORY'        => 'Delete Category',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_TO_DELETE' => 'Select a category to delete',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_YET'      => 'No categories yet.',
    'ACP_SIMPLEDOWN_NO_CATEGORY'            => 'No Category',

    // File Management
    'ACP_SIMPLEDOWN_FILE_NAME'              => 'File Name',
    'ACP_SIMPLEDOWN_FILE_NAME_EXPLAIN'      => 'This is the name displayed on the downloads page.',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION'      => 'Short Description',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION_EXPLAIN' => 'Brief summary displayed on cards (recommended 100-150 characters).',
    'ACP_SIMPLEDOWN_DESCRIPTION'            => 'Full Description',
    'ACP_SIMPLEDOWN_DESCRIPTION_EXPLAIN'    => 'Full description displayed on the details page.',
    'ACP_SIMPLEDOWN_EDIT_DESCRIPTION'       => 'Edit Description',
    'ACP_SIMPLEDOWN_UPLOAD_FILE'            => 'Upload File',
    'ACP_SIMPLEDOWN_SIZE'                   => 'Size',
    'ACP_SIMPLEDOWN_NO_FILES_YET'           => 'No files yet.',
    'ACP_SIMPLEDOWN_NO_DESCRIPTION'         => 'No description available.',
    'ACP_SIMPLEDOWN_VERSION'                => 'Version',
    'ACP_SIMPLEDOWN_VERSION_EXPLAIN'        => 'Optional: e.g., 1.0, 2.1-beta, Final 2025',
    'ACP_SIMPLEDOWN_REPLACE_FILE'           => 'Replace file',
    'ACP_SIMPLEDOWN_REPLACE_FILE_EXPLAIN'   => 'Check to upload a new file. The old one will be deleted.',

    // Public/Private visibility (individual)
    'ACP_SIMPLEDOWN_VISIBILITY'             => 'File visibility',
    'ACP_SIMPLEDOWN_VISIBILITY_EXPLAIN'     => 'Define whether the file is public (any visitor) or private (only logged-in users can download).',
    'ACP_SIMPLEDOWN_PUBLIC'                 => 'Public',
    'ACP_SIMPLEDOWN_PRIVATE'                => 'Private',

    // Thumbnails
    'ACP_SIMPLEDOWN_UPLOAD_THUMB'           => 'Upload Thumbnail',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB_EXPLAIN'   => 'Upload an image to be used as thumbnail on the details page. Recommended: 300x300px or larger.',
    'ACP_SIMPLEDOWN_THUMB_ALREADY_EXISTS_WARNING' => 'Warning: A thumbnail with this name already existed and was overwritten.',
    'ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS'   => 'Thumbnail uploaded successfully!',
    'ACP_SIMPLEDOWN_SELECT_THUMB'           => 'Select existing thumbnail',
    'ACP_SIMPLEDOWN_NO_THUMB'               => 'No thumbnail',
    'ACP_SIMPLEDOWN_NO_THUMBS'              => 'No thumbnails found in the thumbs folder.',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW'          => 'Preview of selected thumbnail',

    // Table
    'ACP_SIMPLEDOWN_DOWNLOADS'              => 'Downloads',
    'ACP_SIMPLEDOWN_ACTIONS'                => 'Actions',
    'ACP_SIMPLEDOWN_EDIT'                   => 'Edit',
    'ACP_SIMPLEDOWN_DELETE'                 => 'Delete',
    'ACP_SIMPLEDOWN_SAVE_CHANGES'           => 'Save Changes',
    'ACP_SIMPLEDOWN_CANCEL'                 => 'Cancel',

    // Pagination and counting
    'ACP_SIMPLEDOWN_TOTAL_FILES'            => 'Total files',
    'ACP_SIMPLEDOWN_ITEMS_PER_PAGE'         => 'Items per page',
    'ACP_SIMPLEDOWN_ALL_ITEMS'              => 'All',

    // Warnings and Security
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TITLE' => 'Warning!',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_1'=> 'Executable files (.exe, .bat, .js, .vbs, etc.) are <strong>automatically blocked</strong>.',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_2'=> 'Avoid uploading potentially malicious files.',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TITLE'    => 'Allowed Files',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_1'   => 'Allowed formats:',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_2'   => 'PDF, ZIP, RAR, 7Z, DOC/DOCX, XLS/XLSX, PPT/PPTX, images, TXT, MP3/WAV/OGG, MP4/AVI/MKV/MOV.',

    // Success Messages
    'ACP_SIMPLEDOWN_CONFIG_SAVED'           => 'Settings saved successfully!',
    'ACP_SIMPLEDOWN_CAT_ADDED'              => 'Category added successfully!',
    'ACP_SIMPLEDOWN_CAT_DELETED'            => 'Category deleted successfully!',
    'ACP_SIMPLEDOWN_FILE_ADDED'             => 'File added successfully!',
    'ACP_SIMPLEDOWN_FILE_EDITED'            => 'File updated successfully!',
    'ACP_SIMPLEDOWN_FILE_DELETED'           => 'File deleted successfully!',
    'ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS'   => 'Thumbnail uploaded successfully!',

    // Errors and Validation
    'ACP_SIMPLEDOWN_NO_FILE_UPLOADED'       => 'No file uploaded.',
    'ACP_SIMPLEDOWN_CATEGORY_REQUIRED'      => 'You must select a category before uploading the file.',
    'ACP_SIMPLEDOWN_FILE_TOO_LARGE'         => 'File too large. Maximum limit: %d MB.',
    'ACP_SIMPLEDOWN_INVALID_MIME_TYPE'      => 'Invalid file type.',
    'ACP_SIMPLEDOWN_DANGEROUS_FILE'         => 'Upload blocked: executable or malicious files are not allowed.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE'         => 'This file has already been uploaded.',
    'ACP_SIMPLEDOWN_UPLOAD_FAILED'          => 'Failed to upload file.',
    'ACP_SIMPLEDOWN_UPLOAD_DIR_ERROR'       => 'Error creating upload directory.',
    'ACP_SIMPLEDOWN_FILE_NOT_FOUND'         => 'File not found.',
    'ACP_SIMPLEDOWN_NO_CATEGORY_NAME'       => 'Category name is required.',
    'ACP_SIMPLEDOWN_CATEGORY_NOT_FOUND'     => 'Category not found.',
    'ACP_SIMPLEDOWN_CATEGORY_DUPLICATE'     => 'This category already exists.',
    'ACP_SIMPLEDOWN_FILE_NAME_REQUIRED'     => 'File name is required.',

    // Custom upload keys
    'ACP_SIMPLEDOWN_CHOOSE_FILE'            => 'Choose file',
    'ACP_SIMPLEDOWN_NO_FILE_SELECTED'       => 'No file selected',
    'ACP_SIMPLEDOWN_SEARCH_FILES'           => 'Search files',
    'ACP_SIMPLEDOWN_SEARCH_PLACEHOLDER'     => 'Enter file name...',

    // Tooltip for full description icon
    'ACP_SIMPLEDOWN_VIEW_FULL_DESC'         => 'View full description',

    // Modal and messages
    'ACP_SIMPLEDOWN_ERROR'                  => 'Error',
    'ACP_SIMPLEDOWN_SUCCESS'                => 'Success',
    'ACP_SIMPLEDOWN_CLOSE'                  => 'Close',
    'ACP_SIMPLEDOWN_WARNING'                => 'Warning',

    // Fixed fatal error key
    'CHARACTERS'                            => 'characters',

    // Tools Tab
    'ACP_SIMPLEDOWN_TOOLS_LEGEND'           => 'Custom content for the Tools tab',
    'ACP_SIMPLEDOWN_TOOLS_LABEL'            => 'Custom text/HTML:',
    'ACP_SIMPLEDOWN_TOOLS_EXPLAIN'          => 'Write here any content you want to display in the Tools tab.<br />Supports basic HTML (links, images, lists, bold, etc.).',
    'ACP_SIMPLEDOWN_SAVE_TOOLS_CONTENT'     => 'Save content',
    'ACP_SIMPLEDOWN_TOOLS'                  => 'Tools',

    // Thumbnails Management
    'ACP_SIMPLEDOWN_THUMBNAILS_MANAGEMENT'  => 'Thumbnails Management',
    'ACP_SIMPLEDOWN_THUMBNAILS_EXPLAIN'     => 'Lists all existing thumbnails. Orphaned thumbnails (not used by any file) are shown in red.',
    'ACP_SIMPLEDOWN_TOTAL_THUMBS'           => 'Total thumbnails',
    'ACP_SIMPLEDOWN_ORPHAN_THUMBS'          => 'Orphaned thumbnails',
    'ACP_SIMPLEDOWN_CLEAN_ORPHAN_THUMBS'    => 'Delete all orphaned thumbnails',
    'ACP_SIMPLEDOWN_CONFIRM_CLEAN_THUMBS'   => 'Are you sure you want to delete all orphaned thumbnails?',
    'ACP_SIMPLEDOWN_ORPHANS_DELETED'        => '%d orphaned thumbnails were deleted.',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE_THUMB'   => 'Are you sure you want to delete the thumbnail "%s"?',
    'ACP_SIMPLEDOWN_THUMB_DELETED'          => 'Thumbnail deleted successfully.',
    'ACP_SIMPLEDOWN_THUMB_NOT_FOUND'        => 'Thumbnail not found.',
    'ACP_SIMPLEDOWN_ORPHAN_THUMB'           => 'Orphan (not used)',
    'ACP_SIMPLEDOWN_THUMBNAILS_EXPLAIN_SIMPLE' => 'Select a thumbnail to view and delete.',
    'ACP_SIMPLEDOWN_SELECT_THUMB_TO_DELETE' => 'Thumbnail to delete',
    'ACP_SIMPLEDOWN_SELECT_ONE'             => '-- Select a thumbnail --',
    'ACP_SIMPLEDOWN_DELETE_SELECTED_THUMB'  => 'Delete selected thumbnail',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW'          => 'Thumbnail preview',
    'ACP_SIMPLEDOWN_NO_THUMBS'              => 'No thumbnails found.',

    // Thumbnails Management (continuation and new keys)
    'ACP_SIMPLEDOWN_THUMBNAILS_MANAGEMENT'  => 'Thumbnails Management',
    'ACP_SIMPLEDOWN_THUMBNAILS_EXPLAIN_SIMPLE' => 'Select a thumbnail below to view details and deletion option.',
    'ACP_SIMPLEDOWN_AVAILABLE_THUMBS'       => 'Available thumbnails:',
    'ACP_SIMPLEDOWN_SELECT_ONE_THUMB'       => '-- Select an image --',
    'ACP_SIMPLEDOWN_PREVIEW_TITLE'          => 'Preview:',
    'ACP_SIMPLEDOWN_DELETE_THIS_THUMB'      => 'Delete this thumbnail',
    'ACP_SIMPLEDOWN_NO_THUMBS_FOUND'        => 'No thumbnails found in the <code>/files/thumbs/</code> folder.',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE_THUMB'   => 'Are you sure you want to delete the thumbnail "%s"?',
    'ACP_SIMPLEDOWN_THUMB_DELETED'          => 'Thumbnail deleted successfully.',
    'ACP_SIMPLEDOWN_THUMB_NOT_FOUND'        => 'Thumbnail not found.',

    // Theme selection (for frontend)
    'ACP_SIMPLEDOWN_SITE_THEME'                  => 'Interface theme',
    'ACP_SIMPLEDOWN_SITE_THEME_EXPLAIN'          => 'Choose between light or dark theme for the SimpleDown administration panel.',
    'ACP_SIMPLEDOWN_TOGGLE_THEME'           => 'Toggle light/dark theme',
    'ACP_SIMPLEDOWN_LIGHT_THEME'            => 'Light theme',
    'ACP_SIMPLEDOWN_DARK_THEME'             => 'Dark theme',
]);