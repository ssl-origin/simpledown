<?php
/**
 * SimpleDown - ACP Logs Language File (English)
 *
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
 */
if (!defined('IN_PHPBB'))
{
    exit;
}
$lang = array_merge($lang, [
    // Page title and description
    'ACP_SIMPLEDOWN_LOGS' => 'Download Logs',
    'ACP_SIMPLEDOWN_LOGS_EXPLAIN' => 'Detailed record of all actions related to downloads: views, blocked attempts, and successful downloads.',
    // Table headers
    'ACP_SIMPLEDOWN_LOG_TIME' => 'Date/Time',
    'ACP_SIMPLEDOWN_LOG_USERNAME' => 'User',
    'ACP_SIMPLEDOWN_LOG_FILE' => 'File',
    'ACP_SIMPLEDOWN_LOG_ACTION' => 'Action',
    'ACP_SIMPLEDOWN_LOG_IP' => 'IP Address',
    'ACP_SIMPLEDOWN_LOG_USER_AGENT' => 'Browser/Device',
    // Special values
    'ACP_SIMPLEDOWN_UNKNOWN_FILE' => 'Unknown file',
    'ACP_SIMPLEDOWN_NONE' => 'None',
    // Filters
    'ACP_LOGS_FILTER_USERNAME' => 'Filter by user',
    'ACP_LOGS_ACTION_DOWNLOAD' => 'Download',
    'ACP_LOGS_ACTION_PREVIEW' => 'View',
    'ACP_LOGS_ACTION_DENIED' => 'Access denied',
    'DATE_FROM' => 'From',
    'DATE_TO' => 'To',
    'ALL' => 'All',
    // Fieldset legend (filters and actions)
    'ACP_LOGS_FILTERS_ACTIONS' => 'Filters and Bulk Actions',
    // Action buttons
    'ACP_LOGS_CLEAR_ALL' => 'Clear All Logs',
    'ACP_LOGS_CLEAR_OLD' => 'Clear Old Logs (6 months)',
    // Selective deletion button
    'DELETE_SELECTED' => 'Delete Selected',
    // Success messages
    'LOGS_DELETED_SUCCESS' => '%d log(s) deleted successfully.',
    'LOGS_CLEARED_OLD_SUCCESS' => 'Old logs (over 6 months) have been deleted successfully.',
    'LOGS_CLEARED_ALL_SUCCESS' => 'All logs have been deleted successfully.',
    // Confirmation messages
    'CONFIRM_DELETE_SELECTED_LOGS' => 'Are you sure you want to delete the selected logs?',
    'CONFIRM_CLEAR_OLD_LOGS' => 'Are you sure you want to delete all logs older than 6 months? This action is irreversible.',
    'CONFIRM_CLEAR_ALL_LOGS' => 'Are you sure you want to delete ALL logs? This action cannot be undone!',
    // Display limit warning
    'ACP_LOGS_MAX_DISPLAY_WARNING' => 'There are more than 10,000 records. For performance reasons, only the 10,000 most recent are being displayed.',
    // No logs message
    'NO_LOGS_FOUND' => 'No records found',
    // Error message (no logs selected)
    'NO_LOGS_SELECTED' => 'No logs were selected.',
    // Top statistics
    'ACP_SIMPLEDOWN_TOTAL_LOGS' => 'Total records',
    'ACP_SIMPLEDOWN_STATS_TOTAL_DOWNLOADS' => 'Total registered downloads',
    'ACP_SIMPLEDOWN_STATS_TOP_FILE' => 'Most downloaded file',
    // Filter label above select
    'ACP_LOGS_ACTION' => 'Action',
    // Table header (more descriptive)
    'ACP_SIMPLEDOWN_LOG_ACTION' => 'Action',
]);