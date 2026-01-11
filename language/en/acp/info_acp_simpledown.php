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
    // General Titles and Navigation
    // ===================================================================
    'ACP_SIMPLEDOWN_TITLE' => 'Simple Downloads',
    'ACP_SIMPLEDOWN_SETTINGS' => 'Settings',
    'ACP_SIMPLEDOWN_FILES' => 'Files',
    'ACP_SIMPLEDOWN_TOOLS' => 'Tools',
    'ACP_SIMPLEDOWN_LOGS' => 'Download Logs',
    'ACP_SIMPLEDOWN_ADD_FILE' => 'Add File',
    'ACP_SIMPLEDOWN_EXISTING_FILES' => 'Existing Files',
    // ===================================================================
    // General Settings Tab
    // ===================================================================
    'ACP_SIMPLEDOWN_GENERAL_SETTINGS' => 'General Settings',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE' => 'Maximum upload size',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE_EXPLAIN' => 'Limit in MB for uploaded files (default: 100 MB).',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT' => 'Short description character limit',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT_EXPLAIN' => 'Maximum characters for the short description shown in cards (default: 150).',
    'ACP_SIMPLEDOWN_SITE_THEME' => 'Site theme',
    'ACP_SIMPLEDOWN_SITE_THEME_EXPLAIN' => 'Choose the default visual theme (light or dark) displayed on the public SimpleDown page for all visitors.',
    'ACP_SIMPLEDOWN_LIGHT_THEME' => 'Light theme',
    'ACP_SIMPLEDOWN_DARK_THEME' => 'Dark theme',
    'ACP_SIMPLEDOWN_CARDS_PER_ROW' => 'Cards per row',
    'ACP_SIMPLEDOWN_CARDS_PER_ROW_EXPLAIN' => 'Defines how many download cards are displayed side by side on the main downloads page.<br />• <strong>3 cards</strong>: standard layout (recommended for desktops).<br />• <strong>2 cards</strong>: wider and more comfortable layout on medium screens.',
    'ACP_SIMPLEDOWN_CARDS' => 'cards per row',
    'ACP_SIMPLEDOWN_ALLOW_USER_LAYOUT_CHOICE' => 'Allow users to choose layout',
    'ACP_SIMPLEDOWN_ALLOW_USER_LAYOUT_CHOICE_EXPLAIN' => 'When enabled, visitors can switch between grid (cards) and list view on the public downloads page. Choice is saved in a cookie.',
    'ACP_SIMPLEDOWN_VIEW_GRID' => 'Grid view',
    'ACP_SIMPLEDOWN_VIEW_LIST' => 'List view',
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY' => 'Default visibility for new files',
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY_EXPLAIN' => 'This option sets the pre-selected value (public or private) when adding a new file.<br /><strong style="color: #c62828;">Individual file settings always take highest priority:</strong> if you mark a specific file as Public, it will be accessible to everyone (even if default is Private), and vice-versa.',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES' => 'Private categories',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_EXPLAIN' => 'Select categories whose files will require login to download. Leave empty for no category-based private files (individual control still works).',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_HOLD_CTRL' => 'Hold Ctrl (or Cmd on Mac) to select multiple categories.',
    // Custom message for private files
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE' => 'Message for private files',
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE_EXPLAIN' => 'This message is displayed when a non-logged-in visitor tries to access a private file or a file in a private category.',
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE_DEFAULT' => 'This file is exclusive to registered members. Please log in or register to download.',
    'ACP_SIMPLEDOWN_SAVE_CONFIG' => 'Save Settings',
    'ACP_SIMPLEDOWN_CONFIG_SAVED' => 'Settings saved successfully!',
    // ===================================================================
    // Categories
    // ===================================================================
    'ACP_SIMPLEDOWN_CATEGORY' => 'Category',
    'ACP_SIMPLEDOWN_CATEGORIES' => 'Add Category',
    'ACP_SIMPLEDOWN_ADD_CATEGORY' => 'Add Category',
    'ACP_SIMPLEDOWN_CATEGORY_NAME' => 'Category Name',
    'ACP_SIMPLEDOWN_DELETE_CATEGORY' => 'Delete Category',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_TO_DELETE' => 'Select a category to delete',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_YET' => 'No categories yet.',
    'ACP_SIMPLEDOWN_NO_CATEGORY' => 'No Category',
    'ACP_SIMPLEDOWN_NO_CATEGORY_NAME' => 'The category name is required.',
    'ACP_SIMPLEDOWN_CATEGORY_NOT_FOUND' => 'Category not found.',
    'ACP_SIMPLEDOWN_CATEGORY_DUPLICATE' => 'This category already exists.',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_REQUIRED' => 'Select a category',
    'ACP_SIMPLEDOWN_CAT_ADDED' => 'Category added successfully!',
    'ACP_SIMPLEDOWN_CAT_DELETED' => 'Category deleted successfully!',
    'ACP_SIMPLEDOWN_CATEGORY_REQUIRED' => 'You must select a valid category for the file.',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_EXIST' => 'No categories have been created yet. Create at least one category before adding files.',
    // ===================================================================
    // File Management (Add/Edit)
    // ===================================================================
    'ACP_SIMPLEDOWN_FILE_NAME' => 'File Name',
    'ACP_SIMPLEDOWN_FILE_NAME_EXPLAIN' => 'This is the name displayed on the downloads page.',
    'ACP_SIMPLEDOWN_DISPLAY_NAME' => 'Display Name (download title)',
    'ACP_SIMPLEDOWN_DISPLAY_NAME_EXPLAIN' => 'This is the name users will see in the downloads list. It does not affect the actual server filename.',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION' => 'Short Description',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION_EXPLAIN' => 'Brief summary shown in cards (recommended 100-150 characters).',
    'ACP_SIMPLEDOWN_DESCRIPTION' => 'Full Description',
    'ACP_SIMPLEDOWN_DESCRIPTION_EXPLAIN' => 'Complete description shown on the details page. Supports BBCode.',
    'ACP_SIMPLEDOWN_EDIT_DESCRIPTION' => 'Edit Description',
    'ACP_SIMPLEDOWN_VERSION' => 'Version',
    'ACP_SIMPLEDOWN_VERSION_EXPLAIN' => 'Optional: e.g., 1.0, 2.1-beta, Final 2025',
    'ACP_SIMPLEDOWN_VISIBILITY' => 'File Visibility',
    'ACP_SIMPLEDOWN_VISIBILITY_EXPLAIN' => 'Set whether the file is public (any visitor) or private (only logged-in users can download).',
    'ACP_SIMPLEDOWN_PUBLIC' => 'Public',
    'ACP_SIMPLEDOWN_PRIVATE' => 'Private',
    'ACP_SIMPLEDOWN_UPLOAD_FILE' => 'Upload File',
    'ACP_SIMPLEDOWN_REPLACE_FILE' => 'Replace file',
    'ACP_SIMPLEDOWN_REPLACE_FILE_EXPLAIN' => 'Check to upload a new file. The old one will be deleted.',
    'ACP_SIMPLEDOWN_REPLACE_FILE_WARNING' => 'The old file will be permanently deleted upon saving.',
    'ACP_SIMPLEDOWN_REPLACE_FILE_HELP' => 'The old file will be permanently deleted. The new one will be saved with a sanitized name (may be auto-renamed on conflict).',
    'ACP_SIMPLEDOWN_CURRENT_FILE' => 'Current file',
    'ACP_SIMPLEDOWN_CURRENT_SERVER_FILE' => 'Current server filename',
    'ACP_SIMPLEDOWN_SIZE' => 'Size',
    'ACP_SIMPLEDOWN_DOWNLOADS' => 'Downloads',
    'ACP_SIMPLEDOWN_FILE_ADDED' => 'File added successfully!',
    'ACP_SIMPLEDOWN_FILE_EDITED' => 'File updated successfully!',
    'ACP_SIMPLEDOWN_FILE_DELETED' => 'File deleted successfully!',
    'ACP_SIMPLEDOWN_NO_FILES_YET' => 'No files yet.',
    'ACP_SIMPLEDOWN_NO_DESCRIPTION' => 'No description available.',
    'ACP_SIMPLEDOWN_TOTAL_FILES' => 'Total files',
    'ACP_SIMPLEDOWN_ITEMS_PER_PAGE' => 'Items per page',
    'ACP_SIMPLEDOWN_ALL_ITEMS' => 'All',
    // ===================================================================
    // Thumbnails
    // ===================================================================
    'ACP_SIMPLEDOWN_UPLOAD_THUMB' => 'Upload Thumbnail',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB_EXPLAIN' => 'Upload an image to be used as thumbnail on the details page. Recommended: 300x300px or larger.',
    'ACP_SIMPLEDOWN_THUMB_ALREADY_EXISTS_WARNING' => 'Warning: A thumbnail with this name already existed and has been overwritten.',
    'ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS' => 'Thumbnail uploaded successfully!',
    'ACP_SIMPLEDOWN_SELECT_THUMB' => 'Select existing thumbnail',
    'ACP_SIMPLEDOWN_NO_THUMB' => 'No thumbnail',
    'ACP_SIMPLEDOWN_NO_THUMBS' => 'No thumbnails found in the thumbs folder.',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW' => 'Thumbnail preview',
    // ===================================================================
    // Automatic Forum Announcements
    // ===================================================================
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE' => 'Automatic Forum Announcements',
    'ACP_SIMPLEDOWN_ANNOUNCE_EXPLAIN' => 'When enabled, adding a new file will automatically create a topic in the configured forum.',
    'ACP_SIMPLEDOWN_AUTO_ANNOUNCE' => 'Enable automatic topic creation',
    'ACP_SIMPLEDOWN_ANNOUNCE_FORUM' => 'Announcement Forum',
    'ACP_SIMPLEDOWN_NO_FORUM' => '-- No forum selected --',
    // Topic type
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE' => 'Topic type to create',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_EXPLAIN' => 'Choose the type of topic that will be automatically created when adding a file.',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_NORMAL' => 'Normal',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_STICKY' => 'Sticky',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_ANNOUNCE' => 'Announcement',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_GLOBAL' => 'Global Announcement',
    // Locked topic
    'ACP_SIMPLEDOWN_ANNOUNCE_LOCKED' => 'Create locked topic',
    'ACP_SIMPLEDOWN_ANNOUNCE_LOCKED_EXPLAIN' => 'If enabled, the announcement topic will be created already locked (no replies allowed).',
    // Templates
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_TEMPLATE' => 'Topic title template',
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_EXPLAIN' => 'Available placeholders:<br><strong>{NAME}</strong> – File name<br><strong>{VERSION}</strong> – Version<br><br><em>Recommended example: [New Download] {NAME} v{VERSION}</em>',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_TEMPLATE' => 'Topic message template',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_EXPLAIN' => 'Available placeholders:<br><strong>{NAME}</strong> – File name<br><strong>{VERSION}</strong> – Version<br><strong>{DESC_SHORT}</strong> – Short description<br><strong>{DESC_FORMATTED}</strong> – Full description with BBCode<br><strong>{URL_DETAILS}</strong> – Link to details page<br><strong>{URL_DOWNLOAD}</strong> – Direct download link<br><br><em>Complete example already filled by default.</em>',
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_TEMPLATE_DEFAULT' => '[New Download] {NAME} v{VERSION}',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_TEMPLATE_DEFAULT' => "{DESC_FORMATTED}\n\n[center][url={URL_DETAILS}]Download now[/url][/center]",
   
    // Admin action logs
    'LOG_SIMPLEDOWN_FILE_DELETED' => 'Deleted file “%s”',
    'LOG_SIMPLEDOWN_FILE_EDITED' => 'Edited file “%s”',
    'LOG_SIMPLEDOWN_ANNOUNCE_CREATED' => 'Created announcement topic for file “%s”',
    'LOG_SIMPLEDOWN_ANNOUNCE_LOCK_TOGGLED' => 'Changed announcement lock status for file “%1$s” to %2$s',
    'LOG_SIMPLEDOWN_ANNOUNCE_DELETED' => 'Deleted announcement topic for file “%s”',
    'LOG_SIMPLEDOWN_CAT_ADDED' => 'Added category “%s”',
    'LOG_SIMPLEDOWN_CAT_DELETED' => 'Deleted category “%s”',
    'LOG_SIMPLEDOWN_THUMB_ADDED' => 'Added thumbnail “%s”',
    'LOG_SIMPLEDOWN_THUMB_DELETED' => 'Deleted thumbnail “%s”',
    'LOG_SIMPLEDOWN_ORPHAN_DELETED' => 'Deleted orphan file “%s”',
    'LOG_SIMPLEDOWN_LOGS_DELETED' => 'Deleted %s log entries',
    'LOG_SIMPLEDOWN_LOGS_CLEARED_OLD' => 'Cleared old logs (older than 6 months)',
    'LOG_SIMPLEDOWN_LOGS_CLEARED_ALL' => 'Cleared all download logs',
    'LOG_SIMPLEDOWN_FILE_DOWNLOADED' => '<strong>%1$s</strong> downloaded file “%2$s”',
    'LOG_SIMPLEDOWN_FILE_ADDED' => 'Added file “%s”',
    // ===================================================================
    // Download Logs Tab
    // ===================================================================
    'ACP_SIMPLEDOWN_LOGS_EXPLAIN' => 'Detailed record of all download-related actions (views, blocked attempts, and successful downloads).',
    'ACP_SIMPLEDOWN_TOTAL_LOGS' => 'Total entries',
    'ACP_SIMPLEDOWN_STATS_TOTAL_DOWNLOADS' => 'Total registered downloads',
    'ACP_SIMPLEDOWN_STATS_TOP_FILE' => 'Most downloaded file',
    'ACP_SIMPLEDOWN_LOG_TIME' => 'Date/Time',
    'ACP_SIMPLEDOWN_LOG_USERNAME' => 'User',
    'ACP_SIMPLEDOWN_LOG_FILE' => 'File',
    'ACP_SIMPLEDOWN_LOG_ACTION' => 'Action',
    'ACP_SIMPLEDOWN_LOG_IP' => 'IP Address',
    'ACP_SIMPLEDOWN_LOG_USER_AGENT' => 'Browser/Device',
    'ACP_SIMPLEDOWN_LOG_ACTION_DOWNLOAD' => 'Download',
    'ACP_SIMPLEDOWN_LOG_ACTION_PREVIEW' => 'View',
    'ACP_SIMPLEDOWN_LOG_ACTION_DENIED' => 'Access denied',
    'ACP_SIMPLEDOWN_UNKNOWN_FILE' => 'Unknown file',
    'ACP_SIMPLEDOWN_NONE' => 'None',
    'NO_LOGS_FOUND' => 'No logs found.',
    'NO_LOGS_SELECTED' => 'No logs selected for deletion.',
    'ACP_SIMPLEDOWN_DELETE_SELECTED' => 'Delete selected',
    'ACP_SIMPLEDOWN_CLEAR_OLD_LOGS' => 'Clear old logs (older than 6 months)',
    'ACP_SIMPLEDOWN_CLEAR_ALL_LOGS' => 'Clear all logs',
    'CONFIRM_DELETE_SELECTED_LOGS' => 'Are you sure you want to delete the selected logs?',
    'CONFIRM_CLEAR_OLD_LOGS' => 'Are you sure you want to delete all logs older than 6 months?',
    'CONFIRM_CLEAR_ALL_LOGS' => 'Are you sure you want to delete ALL logs? This action cannot be undone!',
    'LOGS_DELETED_SUCCESS' => '%d logs deleted successfully.',
    'LOGS_CLEARED_OLD_SUCCESS' => 'Old logs cleared successfully.',
    'LOGS_CLEARED_ALL_SUCCESS' => 'All logs cleared successfully.',
    // ===================================================================
    // Tools Tab
    // ===================================================================
    'ACP_SIMPLEDOWN_THUMBNAILS_MANAGEMENT' => 'Thumbnails Management',
    'ACP_SIMPLEDOWN_THUMBNAILS_EXPLAIN_SIMPLE' => 'Lists all thumbnails present in the <code>/files/thumbs/</code> folder.',
    'ACP_SIMPLEDOWN_AVAILABLE_THUMBS' => 'Available thumbnails',
    'ACP_SIMPLEDOWN_SELECT_ONE_THUMB' => '-- Select a thumbnail --',
    'ACP_SIMPLEDOWN_PREVIEW_TITLE' => 'Preview',
    'ACP_SIMPLEDOWN_DELETE_THIS_THUMB' => 'Delete this thumbnail',
    'ACP_SIMPLEDOWN_NO_THUMBS_FOUND' => 'No thumbnails found in <code>/files/thumbs/</code> folder.',
    'ACP_SIMPLEDOWN_TOTAL_THUMBS' => 'Total thumbnails',
    'ACP_SIMPLEDOWN_THUMB_DELETED' => 'Thumbnail deleted successfully.',
    'ACP_SIMPLEDOWN_ASSOCIATED_FILES' => 'Associated Files',
    'ACP_SIMPLEDOWN_ASSOCIATED_FILES_EXPLAIN' => 'Physical files in the <code>/files/</code> folder that are linked to an active database record (in use).',
    'ACP_SIMPLEDOWN_TOTAL_ASSOCIATED' => 'Total associated files',
    'ACP_SIMPLEDOWN_NO_ASSOCIATED_FILES' => 'No associated files found.',
    'ACP_SIMPLEDOWN_ORPHAN_FILES_MANAGEMENT' => 'Orphan Files',
    'ACP_SIMPLEDOWN_ORPHAN_FILES_EXPLAIN' => 'Physical files in the <code>/files/</code> folder that are not associated with any database record. They can be safely deleted.',
    'ACP_SIMPLEDOWN_AVAILABLE_ORPHAN_FILES' => 'Available orphan files',
    'ACP_SIMPLEDOWN_SELECT_ONE_FILE' => '-- Select a file --',
    'ACP_SIMPLEDOWN_DELETE_THIS_FILE' => 'Delete this file',
    'ACP_SIMPLEDOWN_NO_ORPHAN_FILES_FOUND' => 'No orphan files found.',
    'ACP_SIMPLEDOWN_TOTAL_ORPHAN_FILES' => 'Total orphan files',
    'ACP_SIMPLEDOWN_ORPHAN_WARNING' => 'Warning: these files are not being used by any active download.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETED' => 'Orphan file deleted successfully.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETE_FAILED' => 'Failed to delete orphan file.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETE_WARNING' => 'You are about to permanently delete the selected file from the server. This action cannot be undone.',
    'ACP_SIMPLEDOWN_TOOLS_LEGEND' => 'Custom content for Tools tab',
    'ACP_SIMPLEDOWN_TOOLS_LABEL' => 'Custom Text/HTML:',
    'ACP_SIMPLEDOWN_TOOLS_EXPLAIN' => 'Write any content you want to display in the Tools tab.<br />Supports basic HTML (links, images, lists, bold, etc.).',
    'ACP_SIMPLEDOWN_SAVE_TOOLS_CONTENT' => 'Save content',
    // ===================================================================
    // General Messages and Actions
    // ===================================================================
    'ACP_SIMPLEDOWN_ACTIONS' => 'Actions',
    'ACP_SIMPLEDOWN_EDIT' => 'Edit',
    'ACP_SIMPLEDOWN_DELETE' => 'Delete',
    'ACP_SIMPLEDOWN_SAVE_CHANGES' => 'Save Changes',
    'ACP_SIMPLEDOWN_CANCEL' => 'Cancel',
    'ACP_SIMPLEDOWN_SEARCH_FILES' => 'Search files',
    'ACP_SIMPLEDOWN_SEARCH_PLACEHOLDER' => 'Enter file name...',
    'ACP_SIMPLEDOWN_VIEW_FULL_DESC' => 'View full description',
    'ACP_SIMPLEDOWN_CHOOSE_FILE' => 'Choose file',
    'ACP_SIMPLEDOWN_NO_FILE_SELECTED' => 'No file selected',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE' => 'Are you sure you want to delete this file? This action cannot be undone.',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE_FILE' => 'Are you sure you want to delete this file? This action cannot be undone.',
    // ===================================================================
    // Security and Validations
    // ===================================================================
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TITLE' => 'Attention!',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_1' => 'Executable files (.exe, .bat, .js, .vbs, etc.) are <strong>automatically blocked</strong>.',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_2' => 'Avoid uploading potentially malicious files.',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TITLE' => 'Allowed Files',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_1' => 'Allowed formats:',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_2' => 'PDF, ZIP, RAR, 7Z, DOC/DOCX, XLS/XLSX, PPT/PPTX, images, TXT, MP3/WAV/OGG, MP4/AVI/MKV/MOV.',
    'ACP_SIMPLEDOWN_NO_FILE_UPLOADED' => 'No file uploaded.',
    'ACP_SIMPLEDOWN_FILE_TOO_LARGE' => 'File too large. Maximum limit: %d MB.',
    'ACP_SIMPLEDOWN_INVALID_MIME_TYPE' => 'Invalid file type.',
    'ACP_SIMPLEDOWN_DANGEROUS_FILE' => 'Upload blocked: executable or malicious files are not allowed.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE' => 'This file has already been uploaded.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE_DETECTED' => 'This file was previously uploaded as "<strong>%1$s</strong>" (server name: <code>%2$s</code>).<br />Use the <strong>Files</strong> tab to edit it or upload a different version.',
    'ACP_SIMPLEDOWN_UPLOAD_FAILED' => 'Failed to upload file.',
    'ACP_SIMPLEDOWN_UPLOAD_DIR_ERROR' => 'Error creating upload directory.',
    'ACP_SIMPLEDOWN_FILE_NOT_FOUND' => 'File not found.',
    'ACP_SIMPLEDOWN_FILE_NAME_REQUIRED' => 'File name is required.',
    'ACP_SIMPLEDOWN_THUMB_NOT_FOUND' => 'Thumbnail not found.',
    // ===================================================================
    // General Messages and BBCode
    // ===================================================================
    'ACP_SIMPLEDOWN_ERROR' => 'Error',
    'ACP_SIMPLEDOWN_SUCCESS' => 'Success',
    'ACP_SIMPLEDOWN_CLOSE' => 'Close',
    'ACP_SIMPLEDOWN_WARNING' => 'Warning',
    'CHARACTERS' => 'characters',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_TITLE' => 'Font size',
    'ACP_SIMPLEDOWN_BBCODE_SIZE' => 'Size',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_VERY_SMALL' => '50% (very small)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_SMALL' => '85% (small)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_NORMAL' => '100% (normal)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_LARGE' => '150% (large)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_VERY_LARGE' => '200% (very large)',
    // ===================================================================
    // phpBB standard validations
    // ===================================================================
    'TOO_FEW_CHARS' => 'The value provided contains too few characters.',
    'TOO_MANY_CHARS' => 'The value provided contains too many characters.',
    'TOO_SMALL' => 'The value provided is too small.',
    'TOO_LARGE' => 'The value provided is too large.',
   
    // ===================================================================
    // BBCode Toolbar
    // ===================================================================
    'ACP_SIMPLEDOWN_BBCODE_BOLD' => 'Bold',
    'ACP_SIMPLEDOWN_BBCODE_ITALIC' => 'Italic',
    'ACP_SIMPLEDOWN_BBCODE_UNDERLINE' => 'Underline',
    'ACP_SIMPLEDOWN_BBCODE_QUOTE' => 'Quote',
    'ACP_SIMPLEDOWN_BBCODE_CODE' => 'Code',
    'ACP_SIMPLEDOWN_BBCODE_URL' => 'Link',
    'ACP_SIMPLEDOWN_BBCODE_IMG' => 'Image',
    'ACP_SIMPLEDOWN_BBCODE_LIST' => 'List',
    'ACP_SIMPLEDOWN_BBCODE_COLOR' => 'Color',
    'CONFIRM_DELETE_FILE' => 'Are you sure you want to delete this file?<br /><br /><strong>Warning:</strong> This action is irreversible and will also permanently delete the associated announcement topic and all its replies in the forum.',
]);