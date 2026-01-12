<?php
/**
 * ACP Language File (English)
 *
 * @package mundophpbb/simpledown
 * @copyright (c) 2026 Mundo phpBB
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
    // ===================================================================
    // Titles and General Navigation
    // ===================================================================
    'ACP_SIMPLEDOWN_TITLE'              => 'Simple Downloads',
    'ACP_SIMPLEDOWN_SETTINGS'           => 'Settings',
    'ACP_SIMPLEDOWN_FILES'              => 'Files',
    'ACP_SIMPLEDOWN_TOOLS'              => 'Tools',
    'ACP_SIMPLEDOWN_LOGS'               => 'Download Logs',
    'ACP_SIMPLEDOWN_ADD_FILE'           => 'Add File',
    'ACP_SIMPLEDOWN_EXISTING_FILES'     => 'Existing Files',

    // ===================================================================
    // General Settings Tab
    // ===================================================================
    'ACP_SIMPLEDOWN_GENERAL_SETTINGS'   => 'General Settings',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE'    => 'Maximum upload size',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE_EXPLAIN' => 'Limit in MB for uploaded files (default: 100 MB). Minimum allowed: 1 MB.',
    'ACP_SIMPLEDOWN_UPLOAD_SIZE'        => 'MB',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT'   => 'Short description character limit',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT_EXPLAIN' => 'Maximum characters for the short description displayed in cards (default: 150, recommended range: 100–200).',
    'ACP_SIMPLEDOWN_SITE_THEME'         => 'Site theme',
    'ACP_SIMPLEDOWN_SITE_THEME_EXPLAIN' => 'Default visual theme displayed on the Simple Downloads public page for all visitors.',
    'ACP_SIMPLEDOWN_LIGHT_THEME'        => 'Light theme',
    'ACP_SIMPLEDOWN_DARK_THEME'         => 'Dark theme',
    'ACP_SIMPLEDOWN_CARDS_PER_ROW'      => 'Number of cards per row',
    'ACP_SIMPLEDOWN_CARDS_PER_ROW_EXPLAIN' => 'How many download cards are displayed side by side on the main page.<br>• <strong>3 cards</strong>: default layout (recommended for desktops)<br>• <strong>2 cards</strong>: more comfortable on medium screens',
    'ACP_SIMPLEDOWN_CARDS'              => 'cards per row',
    'ACP_SIMPLEDOWN_ALLOW_USER_LAYOUT_CHOICE' => 'Allow visitors to choose layout',
    'ACP_SIMPLEDOWN_ALLOW_USER_LAYOUT_CHOICE_EXPLAIN' => 'If enabled, visitors can toggle between grid view (cards) and list view. The choice is saved in a cookie.',
    'ACP_SIMPLEDOWN_VIEW_GRID'          => 'Grid view',
    'ACP_SIMPLEDOWN_VIEW_LIST'          => 'List view',
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY' => 'Default visibility for new files',
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY_EXPLAIN' => 'Sets the pre-selected value when adding a new file.<br><strong style="color:#c62828">Individual file settings always take priority.</strong>',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES' => 'Private categories',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_EXPLAIN' => 'Files in these categories will require login to download. Leave empty to disable category-based rules.',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_HOLD_CTRL' => 'Hold Ctrl (or Cmd on Mac) to select multiple categories.',
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE'    => 'Message for private files/categories',
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE_EXPLAIN' => 'Text displayed when a non-logged visitor tries to access private content.',
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE_DEFAULT' => 'This file is exclusive to registered members. Please login or register to download.',
    'ACP_SIMPLEDOWN_SAVE_CONFIG'        => 'Save Settings',
    'ACP_SIMPLEDOWN_CONFIG_SAVED'       => 'Settings saved successfully!',

    // ===================================================================
    // Categories
    // ===================================================================
    'ACP_SIMPLEDOWN_CATEGORY'           => 'Category',
    'ACP_SIMPLEDOWN_CATEGORIES'         => 'Add Category',
    'ACP_SIMPLEDOWN_ADD_CATEGORY'       => 'Add Category',
    'ACP_SIMPLEDOWN_CATEGORY_NAME'      => 'Category Name',
    'ACP_SIMPLEDOWN_DELETE_CATEGORY'    => 'Delete Category',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_TO_DELETE' => 'Select a category to delete',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_YET'  => 'No categories created yet.',
    'ACP_SIMPLEDOWN_NO_CATEGORY'        => 'No Category',
    'ACP_SIMPLEDOWN_NO_CATEGORY_NAME'   => 'Category name is required.',
    'ACP_SIMPLEDOWN_CATEGORY_NOT_FOUND' => 'Category not found.',
    'ACP_SIMPLEDOWN_CATEGORY_DUPLICATE' => 'This category already exists.',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_REQUIRED' => 'Select a valid category.',
    'ACP_SIMPLEDOWN_CAT_ADDED'          => 'Category added successfully!',
    'ACP_SIMPLEDOWN_CAT_DELETED'        => 'Category deleted successfully!',
    'ACP_SIMPLEDOWN_CATEGORY_REQUIRED'  => 'You must select a valid category for the file.',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_EXIST' => 'No categories have been created yet. Create at least one before adding files.',

    // ===================================================================
    // File Management (Add/Edit)
    // ===================================================================
    'ACP_SIMPLEDOWN_FILE_NAME'          => 'File name (internal)',
    'ACP_SIMPLEDOWN_FILE_NAME_EXPLAIN'  => 'Name displayed in the administration and on the public downloads page.',
    'ACP_SIMPLEDOWN_DISPLAY_NAME'       => 'Public title (displayed to users)',
    'ACP_SIMPLEDOWN_DISPLAY_NAME_EXPLAIN' => 'Name that appears in the public downloads list. Does not affect the actual name on the server.',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION'  => 'Short description',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION_EXPLAIN' => 'Brief summary displayed in cards (recommended: 100–150 characters).',
    'ACP_SIMPLEDOWN_DESCRIPTION'        => 'Full description',
    'ACP_SIMPLEDOWN_DESCRIPTION_EXPLAIN' => 'Detailed text on the file page. Supports BBCode.',
    'ACP_SIMPLEDOWN_EDIT_DESCRIPTION'   => 'Edit Description',
    'ACP_SIMPLEDOWN_VERSION'            => 'Version',
    'ACP_SIMPLEDOWN_VERSION_EXPLAIN'    => 'Optional. Examples: 1.0, 2.1-beta, Final 2025',
    'ACP_SIMPLEDOWN_VISIBILITY'         => 'File visibility',
    'ACP_SIMPLEDOWN_VISIBILITY_EXPLAIN' => 'Public = any visitor can download<br>Private = only logged-in users can download.',
    'ACP_SIMPLEDOWN_PUBLIC'             => 'Public',
    'ACP_SIMPLEDOWN_PRIVATE'            => 'Private',
    'ACP_SIMPLEDOWN_UPLOAD_FILE'        => 'Upload File',
    'ACP_SIMPLEDOWN_UPLOAD_FILE_SUBMIT' => 'Upload file',
    'ACP_SIMPLEDOWN_REPLACE_FILE'       => 'Replace file',
    'ACP_SIMPLEDOWN_REPLACE_FILE_EXPLAIN' => 'Check to upload a new version. The old file will be permanently deleted.',
    'ACP_SIMPLEDOWN_REPLACE_FILE_WARNING' => 'The old file will be permanently deleted upon saving.',
    'ACP_SIMPLEDOWN_REPLACE_FILE_HELP'  => 'The old file will be permanently deleted. The new file will be saved with a sanitized name (it may be renamed automatically in case of conflict).',
    'ACP_SIMPLEDOWN_CURRENT_FILE'       => 'Current file',
    'ACP_SIMPLEDOWN_CURRENT_SERVER_FILE'=> 'Current name on server',
    'ACP_SIMPLEDOWN_SIZE'               => 'Size',
    'ACP_SIMPLEDOWN_DOWNLOADS'          => 'Downloads',
    'ACP_SIMPLEDOWN_FILE_ADDED'         => 'File added successfully!',
    'ACP_SIMPLEDOWN_FILE_EDITED'        => 'File updated successfully!',
    'ACP_SIMPLEDOWN_FILE_DELETED'       => 'File deleted successfully!',
    'ACP_SIMPLEDOWN_NO_FILES_YET'       => 'No files registered yet.',
    'ACP_SIMPLEDOWN_NO_DESCRIPTION'     => 'No description available.',
    'ACP_SIMPLEDOWN_TOTAL_FILES'        => 'Total files',
    'ACP_SIMPLEDOWN_ITEMS_PER_PAGE'     => 'Items per page',
    'ACP_SIMPLEDOWN_ALL_ITEMS'          => 'All',

    // ===================================================================
    // Thumbnails
    // ===================================================================
    'ACP_SIMPLEDOWN_UPLOAD_THUMB'       => 'Upload Thumbnail',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB_SUBMIT'=> 'Upload thumbnail',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB_EXPLAIN' => 'Upload an image to be used as a thumbnail on the details page. Recommended: 300×300 px or larger (JPEG, PNG, WebP, GIF).',
    'ACP_SIMPLEDOWN_THUMB_ALREADY_EXISTS_WARNING' => 'Warning: A thumbnail with this name already existed and has been overwritten.',
    'ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS' => 'Thumbnail uploaded successfully!',
    'ACP_SIMPLEDOWN_SELECT_THUMB'       => 'Select existing thumbnail',
    'ACP_SIMPLEDOWN_NO_THUMB'           => 'No thumbnail',
    'ACP_SIMPLEDOWN_NO_THUMBS'          => 'No thumbnails found in the thumbs folder.',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW'      => 'Thumbnail preview',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW_ALT'  => 'Thumbnail preview',
    'CONFIRM_DELETE_THUMB'              => 'WARNING: Do you want to PERMANENTLY delete this thumbnail? It cannot be recovered later!',

    // ===================================================================
    // Automatic Forum Announcements
    // ===================================================================
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE'     => 'Automatic Forum Announcements',
    'ACP_SIMPLEDOWN_ANNOUNCE_EXPLAIN'   => 'When enabled, adding a new file will automatically create a topic in the configured forum.',
    'ACP_SIMPLEDOWN_AUTO_ANNOUNCE'      => 'Enable automatic topic creation',
    'ACP_SIMPLEDOWN_ANNOUNCE_FORUM'     => 'Announcement Forum',
    'ACP_SIMPLEDOWN_NO_FORUM'           => '-- No forum selected --',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE'      => 'Topic type created',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_EXPLAIN' => 'Choose the type of topic that will be created automatically when adding a file.',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_NORMAL'   => 'Normal',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_STICKY'   => 'Sticky',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_ANNOUNCE' => 'Announcement',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_GLOBAL'   => 'Global announcement',
    'ACP_SIMPLEDOWN_ANNOUNCE_LOCKED'    => 'Create locked topic',
    'ACP_SIMPLEDOWN_ANNOUNCE_LOCKED_EXPLAIN' => 'If enabled, the announcement topic will be created already locked (no replies allowed).',
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_TEMPLATE' => 'Topic title template',
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_EXPLAIN' => 'Available placeholders:<br><strong>{NAME}</strong> – File name<br><strong>{VERSION}</strong> – Version<br><br><em>Recommended example: [New Download] {NAME} v{VERSION}</em>',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_TEMPLATE' => 'Topic message template',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_EXPLAIN' => 'Available placeholders:<br><strong>{NAME}</strong> – File name<br><strong>{VERSION}</strong> – Version<br><strong>{DESC_SHORT}</strong> – Short description<br><strong>{DESC_FORMATTED}</strong> – Full description with BBCode<br><strong>{URL_DETAILS}</strong> – Link to details page<br><strong>{URL_DOWNLOAD}</strong> – Direct download link<br><br><em>Full example already pre-filled by default.</em>',
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_TEMPLATE_DEFAULT' => '[New Download] {NAME} v{VERSION}',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_TEMPLATE_DEFAULT' => "{DESC_FORMATTED}\n\n[center][url={URL_DETAILS}]Download now[/url][/center]",

    // ===================================================================
    // Administrative Action Logs (ACP logs)
    // ===================================================================
    'LOG_SIMPLEDOWN_FILE_DELETED'       => 'Deleted the file “%s”',
    'LOG_SIMPLEDOWN_FILE_EDITED'        => 'Edited the file “%s”',
    'LOG_SIMPLEDOWN_FILE_ADDED'         => 'Added the file “%s”',
    'LOG_SIMPLEDOWN_ANNOUNCE_CREATED'   => 'Created announcement topic for the file “%s”',
    'LOG_SIMPLEDOWN_ANNOUNCE_LOCK_TOGGLED' => 'Changed the lock status of the announcement for file “%1$s” to %2$s',
    'LOG_SIMPLEDOWN_ANNOUNCE_DELETED'   => 'Deleted the announcement topic for file “%s”',
    'LOG_SIMPLEDOWN_CAT_ADDED'          => 'Added the category “%s”',
    'LOG_SIMPLEDOWN_CAT_DELETED'        => 'Deleted the category “%s”',
    'LOG_SIMPLEDOWN_THUMB_ADDED'        => 'Added thumbnail “%s”',
    'LOG_SIMPLEDOWN_THUMB_DELETED'      => 'Deleted thumbnail “%s”',
    'LOG_SIMPLEDOWN_ORPHAN_DELETED'     => 'Deleted orphan file “%s”',
    'LOG_SIMPLEDOWN_LOGS_DELETED'       => 'Deleted %s log entries',
    'LOG_SIMPLEDOWN_LOGS_CLEARED_OLD'   => 'Cleared old logs (over 6 months)',
    'LOG_SIMPLEDOWN_LOGS_CLEARED_ALL'   => 'Cleared all download logs',
    'LOG_SIMPLEDOWN_FILE_DOWNLOADED'    => '<strong>%1$s</strong> downloaded the file “%2$s”',

    // ===================================================================
    // Download Logs Tab
    // ===================================================================
    'ACP_SIMPLEDOWN_LOGS_EXPLAIN'       => 'Detailed record of all download-related actions: views, blocked attempts, and actual downloads.',
    'ACP_SIMPLEDOWN_TOTAL_LOGS'         => 'Total records',
    'ACP_SIMPLEDOWN_STATS_TOTAL_DOWNLOADS' => 'Total registered downloads',
    'ACP_SIMPLEDOWN_STATS_TOP_FILE'     => 'Most downloaded file',
    'ACP_SIMPLEDOWN_LOG_TIME'           => 'Date/Time',
    'ACP_SIMPLEDOWN_LOG_USERNAME'       => 'User',
    'ACP_SIMPLEDOWN_LOG_FILE'           => 'File',
    'ACP_SIMPLEDOWN_LOG_ACTION'         => 'Action',
    'ACP_SIMPLEDOWN_LOG_IP'             => 'IP Address',
    'ACP_SIMPLEDOWN_LOG_USER_AGENT'     => 'Browser/Device',
    'ACP_SIMPLEDOWN_LOG_ACTION_DOWNLOAD'=> 'Download',
    'ACP_SIMPLEDOWN_LOG_ACTION_PREVIEW' => 'View',
    'ACP_SIMPLEDOWN_LOG_ACTION_DENIED'  => 'Access denied',
    'ACP_SIMPLEDOWN_UNKNOWN_FILE'       => 'Unknown file',
    'ACP_SIMPLEDOWN_NONE'               => 'None',
    'NO_LOGS_FOUND'                     => 'No records found.',
    'NO_LOGS_SELECTED'                  => 'No logs selected for deletion.',
    'ACP_SIMPLEDOWN_DELETE_SELECTED'    => 'Delete selected',
    'ACP_SIMPLEDOWN_CLEAR_OLD_LOGS'     => 'Clear old logs (over 6 months)',
    'ACP_SIMPLEDOWN_CLEAR_ALL_LOGS'     => 'Clear all logs',
    'CONFIRM_DELETE_SELECTED_LOGS'      => 'Are you sure you want to delete the selected logs?',
    'CONFIRM_CLEAR_OLD_LOGS'            => 'Are you sure you want to delete all logs older than 6 months? This action is irreversible.',
    'CONFIRM_CLEAR_ALL_LOGS'            => 'Are you sure you want to delete ALL logs? This action cannot be undone!',
    'LOGS_DELETED_SUCCESS'              => '%d logs deleted successfully.',
    'LOGS_CLEARED_OLD_SUCCESS'          => 'Old logs were successfully deleted.',
    'LOGS_CLEARED_ALL_SUCCESS'          => 'All logs were successfully deleted.',

    // ===================================================================
    // Tools Tab
    // ===================================================================
    'ACP_SIMPLEDOWN_THUMBNAILS_MANAGEMENT'      => 'Thumbnail Management',
    'ACP_SIMPLEDOWN_THUMBNAILS_EXPLAIN_SIMPLE'  => 'Lists all thumbnails present in the <code>/files/thumbs/</code> folder.',
    'ACP_SIMPLEDOWN_AVAILABLE_THUMBS'           => 'Available thumbnails',
    'ACP_SIMPLEDOWN_SELECT_ONE_THUMB'           => '-- Select a thumbnail --',
    'ACP_SIMPLEDOWN_PREVIEW_TITLE'              => 'Preview',
    'ACP_SIMPLEDOWN_DELETE_THIS_THUMB'          => 'Delete this thumbnail',
    'ACP_SIMPLEDOWN_NO_THUMBS_FOUND'            => 'No thumbnails found in the <code>/files/thumbs/</code> folder.',
    'ACP_SIMPLEDOWN_TOTAL_THUMBS'               => 'Total thumbnails',
    'ACP_SIMPLEDOWN_THUMB_DELETED'              => 'Thumbnail deleted successfully.',
    'ACP_SIMPLEDOWN_ASSOCIATED_FILES'           => 'Associated Files',
    'ACP_SIMPLEDOWN_ASSOCIATED_FILES_EXPLAIN'   => 'Files present in the <code>/files/</code> folder that are linked to an active database record (in use).',
    'ACP_SIMPLEDOWN_TOTAL_ASSOCIATED'           => 'Total associated files',
    'ACP_SIMPLEDOWN_NO_ASSOCIATED_FILES'        => 'No associated files found.',
    'ACP_SIMPLEDOWN_ORPHAN_FILES_MANAGEMENT'    => 'Orphan Files',
    'ACP_SIMPLEDOWN_ORPHAN_FILES_EXPLAIN'       => 'Physical files in the <code>/files/</code> folder that are not associated with any database record. These can be safely deleted.',
    'ACP_SIMPLEDOWN_AVAILABLE_ORPHAN_FILES'     => 'Available orphan files',
    'ACP_SIMPLEDOWN_SELECT_ONE_FILE'            => '-- Select a file --',
    'ACP_SIMPLEDOWN_DELETE_THIS_FILE'           => 'Delete this file',
    'ACP_SIMPLEDOWN_NO_ORPHAN_FILES_FOUND'      => 'No orphan files found.',
    'ACP_SIMPLEDOWN_TOTAL_ORPHAN_FILES'         => 'Total orphan files',
    'ACP_SIMPLEDOWN_ORPHAN_WARNING'             => 'Warning: these files are not being used by any active download.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETED'             => 'Orphan file deleted successfully.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETE_FAILED'       => 'Failed to delete the orphan file.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETE_WARNING'      => 'You are about to permanently delete the selected file from the server. This action cannot be undone.',
    'ACP_SIMPLEDOWN_TOOLS_LEGEND'               => 'Custom content for Tools tab',
    'ACP_SIMPLEDOWN_TOOLS_LABEL'                => 'Custom Text/HTML:',
    'ACP_SIMPLEDOWN_TOOLS_EXPLAIN'              => 'Write here any content you wish to display on the Tools tab.<br>Supports basic HTML (links, images, lists, bold, etc.).',
    'ACP_SIMPLEDOWN_SAVE_TOOLS_CONTENT'         => 'Save content',

    // ===================================================================
    // JavaScript Confirmations (Tools)
    // ===================================================================
    'ACP_SIMPLEDOWN_DELETE_THUMB_CONFIRM'       => 'Are you sure you want to permanently delete this thumbnail?',
    'ACP_SIMPLEDOWN_DELETE_ORPHAN_CONFIRM'      => 'Are you sure you want to permanently delete this orphan file? This action cannot be undone!',
    'CONFIRM_DELETE_ORPHAN'                     => 'WARNING: Do you want to PERMANENTLY delete this orphan file? It cannot be recovered later!',

    // ===================================================================
    // General Messages and Actions
    // ===================================================================
    'ACP_SIMPLEDOWN_ACTIONS'            => 'Actions',
    'ACP_SIMPLEDOWN_EDIT'               => 'Edit',
    'ACP_SIMPLEDOWN_DELETE'             => 'Delete',
    'ACP_SIMPLEDOWN_SAVE_CHANGES'       => 'Save Changes',
    'ACP_SIMPLEDOWN_CANCEL'             => 'Cancel',
    'ACP_SIMPLEDOWN_SEARCH_FILES'       => 'Search files',
    'ACP_SIMPLEDOWN_SEARCH_PLACEHOLDER' => 'Type file name...',
    'ACP_SIMPLEDOWN_VIEW_FULL_DESC'     => 'View full description',
    'ACP_SIMPLEDOWN_CHOOSE_FILE'        => 'Choose file',
    'ACP_SIMPLEDOWN_NO_FILE_SELECTED'   => 'No file selected',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE'     => 'Are you sure you want to delete this file? This action cannot be undone.',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE_FILE'=> 'Are you sure you want to delete this file? This action cannot be undone.',

    // ===================================================================
    // Security and Validations
    // ===================================================================
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TITLE'   => 'Warning!',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_1'  => 'Executable files (.exe, .bat, .js, .vbs, etc.) are <strong>automatically blocked</strong>.',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_2'  => 'Avoid uploading potentially malicious files.',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TITLE'      => 'Allowed Files',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_1'     => 'Allowed formats:',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_2'     => 'PDF, ZIP, RAR, 7Z, DOC/DOCX, XLS/XLSX, PPT/PPTX, images, TXT, MP3/WAV/OGG, MP4/AVI/MKV/MOV.',
    'ACP_SIMPLEDOWN_NO_FILE_UPLOADED'         => 'No file uploaded.',
    'ACP_SIMPLEDOWN_FILE_TOO_LARGE'           => 'File too large. Maximum limit: %d MB.',
    'ACP_SIMPLEDOWN_INVALID_MIME_TYPE'        => 'Invalid file type.',
    'ACP_SIMPLEDOWN_DANGEROUS_FILE'           => 'Upload blocked: executable or malicious files are not allowed.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE'           => 'This file has already been uploaded.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE_DETECTED'  => 'This file was already uploaded as "<strong>%1$s</strong>" (server name: <code>%2$s</code>).<br>Use the <strong>Files</strong> tab to edit it or upload a different version.',
    'ACP_SIMPLEDOWN_UPLOAD_FAILED'            => 'Failed to upload the file.',
    'ACP_SIMPLEDOWN_UPLOAD_DIR_ERROR'         => 'Error creating the upload directory.',
    'ACP_SIMPLEDOWN_FILE_NOT_FOUND'           => 'File not found.',
    'ACP_SIMPLEDOWN_FILE_NAME_REQUIRED'       => 'File name is required.',
    'ACP_SIMPLEDOWN_THUMB_NOT_FOUND'          => 'Thumbnail not found.',

    // ===================================================================
    // Generic Messages and BBCode
    // ===================================================================
    'ACP_SIMPLEDOWN_ERROR'              => 'Error',
    'ACP_SIMPLEDOWN_SUCCESS'            => 'Success',
    'ACP_SIMPLEDOWN_CLOSE'              => 'Close',
    'ACP_SIMPLEDOWN_WARNING'            => 'Warning',
    'CHARACTERS'                        => 'characters',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_TITLE'  => 'Font size',
    'ACP_SIMPLEDOWN_BBCODE_SIZE'        => 'Size',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_VERY_SMALL'  => '50% (very small)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_SMALL'       => '85% (small)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_NORMAL'      => '100% (default)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_LARGE'       => '150% (large)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_VERY_LARGE'  => '200% (very large)',

    // ===================================================================
    // BBCode Toolbar
    // ===================================================================
    'ACP_SIMPLEDOWN_BBCODE_BOLD'        => 'Bold',
    'ACP_SIMPLEDOWN_BBCODE_ITALIC'      => 'Italic',
    'ACP_SIMPLEDOWN_BBCODE_UNDERLINE'   => 'Underline',
    'ACP_SIMPLEDOWN_BBCODE_QUOTE'       => 'Quote',
    'ACP_SIMPLEDOWN_BBCODE_CODE'        => 'Code',
    'ACP_SIMPLEDOWN_BBCODE_URL'         => 'URL',
    'ACP_SIMPLEDOWN_BBCODE_IMG'         => 'Image',
    'ACP_SIMPLEDOWN_BBCODE_LIST'        => 'List',
    'ACP_SIMPLEDOWN_BBCODE_COLOR'       => 'Color',

    // ===================================================================
    // phpBB compatibility keys (used in tables / headers)
    // ===================================================================
    'SIZE'                              => 'Size',
    'IP'                                => 'IP',

    // ===================================================================
    // File deletion confirmation with associated announcement
    // ===================================================================
    'CONFIRM_DELETE_FILE'               => 'Are you sure you want to delete this file?<br /><br /><strong>Warning:</strong> This action is irreversible and will also permanently delete the associated announcement topic and all its replies in the forum.',
]);