<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2026 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */
namespace mundophpbb\simpledown\controller;

use phpbb\config\config;
use phpbb\db\driver\driver_interface;
use phpbb\language\language;
use phpbb\log\log_interface as log;
use phpbb\pagination;
use phpbb\path_helper;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;

class acp_logs_controller
{
    protected $config;
    protected $db;
    protected $language;
    protected $log;
    protected $request;
    protected $template;
    protected $user;
    protected $pagination;
    protected $path_helper;
    protected $root_path;
    protected $php_ext;
    protected $table_prefix;
    protected $logs_table;
    protected $u_action;

    public function __construct(
        config $config,
        driver_interface $db,
        language $language,
        log $log,
        request $request,
        template $template,
        user $user,
        pagination $pagination,
        path_helper $path_helper,
        string $root_path,
        string $php_ext,
        string $table_prefix
    ) {
        $this->config = $config;
        $this->db = $db;
        $this->language = $language;
        $this->log = $log;
        $this->request = $request;
        $this->template = $template;
        $this->user = $user;
        $this->pagination = $pagination;
        $this->path_helper = $path_helper;
        $this->root_path = $root_path;
        $this->php_ext = $php_ext;
        $this->table_prefix = $table_prefix;
        $this->logs_table = $table_prefix . 'simpledown_logs';
    }

    public function set_page_url(string $u_action): void
    {
        $this->u_action = $u_action;
    }

    public function handle(): void
    {
        $this->user->add_lang_ext('mundophpbb/simpledown', 'acp/info_acp_simpledown');
        $this->user->add_lang_ext('mundophpbb/simpledown', 'acp_logs');
        add_form_key('acp_simpledown_logs');

        $action = '';
        if ($this->request->is_set_post('delete_selected')) {
            $action = 'delete_selected';
        } elseif ($this->request->is_set_post('clear_old')) {
            $action = 'clear_old';
        } elseif ($this->request->is_set_post('clear_all')) {
            $action = 'clear_all';
        }

        if ($action) {
            if (!check_form_key('acp_simpledown_logs')) {
                trigger_error('FORM_INVALID');
            }
            $this->perform_action($action);
        }

        $this->display_logs();
    }

    protected function display_logs(): void
    {
        $per_page = (int)($this->config['simpledown_logs_per_page'] ?? 50);
        $start = $this->request->variable('start', 0);

        // Contagem total
        $sql_count = 'SELECT COUNT(*) AS total FROM ' . $this->logs_table;
        $result_count = $this->db->sql_query($sql_count);
        $total_logs = (int) $this->db->sql_fetchfield('total');
        $this->db->sql_freeresult($result_count);

        $max_display = 10000;
        if ($total_logs > $max_display) {
            $total_logs = $max_display;
            $this->template->assign_var('S_MAX_DISPLAY_WARNING', true);
        }

        if ($start >= $total_logs && $total_logs > 0) {
            $start = max(0, $total_logs - $per_page);
        }

        // Listagem
        $sql = 'SELECT l.*, f.file_realname, u.username AS real_username, u.user_colour
                FROM ' . $this->logs_table . ' l
                LEFT JOIN ' . $this->table_prefix . 'simpledown_files f ON f.id = l.file_id
                LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = l.user_id
                ORDER BY l.log_time DESC';
        $result = $this->db->sql_query_limit($sql, $per_page, $start);

        $row_count = 0;
        while ($row = $this->db->sql_fetchrow($result)) {
            $row_count++;

            $action_display = $this->language->lang(strtoupper($row['action']) ?: 'UNKNOWN');

            $this->template->assign_block_vars('logs', [
                'LOG_ID'          => $row['log_id'],
                'LOG_TIME'        => $this->user->format_date($row['log_time']),
                'USERNAME'        => $row['user_id']
                    ? get_username_string('full', $row['user_id'], $row['real_username'] ?: $row['username'], $row['user_colour'])
                    : $row['username'] . ' (' . $this->language->lang('GUEST') . ')',
                'U_USER_PROFILE'  => $row['user_id'] ? append_sid("{$this->root_path}memberlist.{$this->php_ext}", 'mode=viewprofile&u=' . $row['user_id']) : '',
                'USER_ID'         => $row['user_id'],
                'IP_ADDRESS'      => $row['ip_address'],
                'ACTION'          => $action_display,
                'FILE_NAME'       => $row['file_realname'] ?: $this->language->lang('ACP_SIMPLEDOWN_UNKNOWN_FILE'),
                'USER_AGENT'      => utf8_substr($row['user_agent'], 0, 100) . (utf8_strlen($row['user_agent']) > 100 ? '...' : ''),
                'USER_AGENT_FULL' => $row['user_agent'],
                'S_ROW_COUNT'     => $row_count,
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->assign_stats();

        $base_url = $this->u_action;
        $this->pagination->generate_template_pagination($base_url, 'pagination', 'start', $total_logs, $per_page, $start);

        $this->template->assign_vars([
            'U_ACTION'   => $this->u_action,
            'TOTAL_LOGS' => $total_logs,
        ]);
    }

    protected function assign_stats(): void
    {
        $sql = 'SELECT COUNT(*) AS total FROM ' . $this->logs_table . ' WHERE action = "download"';
        $result = $this->db->sql_query($sql);
        $total_downloads = (int) $this->db->sql_fetchfield('total');
        $this->db->sql_freeresult($result);

        $sql = 'SELECT COUNT(*) AS total FROM ' . $this->logs_table . ' WHERE action = "view"';
        $result = $this->db->sql_query($sql);
        $total_views = (int) $this->db->sql_fetchfield('total');
        $this->db->sql_freeresult($result);

        $sql = 'SELECT COUNT(*) AS total FROM ' . $this->logs_table . ' WHERE action = "denied"';
        $result = $this->db->sql_query($sql);
        $total_denied = (int) $this->db->sql_fetchfield('total');
        $this->db->sql_freeresult($result);

        $top_file_name = $this->language->lang('ACP_SIMPLEDOWN_NONE');
        $sql = 'SELECT f.file_realname, COUNT(*) AS cnt
                FROM ' . $this->logs_table . ' l
                JOIN ' . $this->table_prefix . 'simpledown_files f ON f.id = l.file_id
                WHERE l.action = "download"
                GROUP BY l.file_id, f.file_realname
                ORDER BY cnt DESC
                LIMIT 1';
        $result = $this->db->sql_query($sql);
        $top_file = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if ($top_file) {
            $top_file_name = $top_file['file_realname'] . ' (' . $top_file['cnt'] . ')';
        }

        $this->template->assign_vars([
            'STATS_TOTAL_DOWNLOADS' => $total_downloads,
            'STATS_TOTAL_VIEWS'     => $total_views,
            'STATS_TOTAL_DENIED'    => $total_denied,
            'STATS_TOP_FILE'        => $top_file_name,
        ]);
    }

    protected function perform_action(string $action): void
    {
        switch ($action) {
            case 'delete_selected':
                $log_ids = $this->request->variable('log_id', [0]);
                if (empty($log_ids)) {
                    trigger_error($this->language->lang('NO_LOGS_SELECTED') . adm_back_link($this->u_action), E_USER_WARNING);
                }

                $sql = 'DELETE FROM ' . $this->logs_table . '
                        WHERE ' . $this->db->sql_in_set('log_id', $log_ids);
                $this->db->sql_query($sql);

                $count = $this->db->sql_affectedrows();
                $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_LOGS_DELETED', false, [$count]);
                trigger_error($this->language->lang('LOGS_DELETED_SUCCESS', $count) . adm_back_link($this->u_action));
                break;

            case 'clear_old':
                $cutoff = time() - (180 * 86400); // 6 meses
                $sql = 'DELETE FROM ' . $this->logs_table . ' WHERE log_time < ' . (int) $cutoff;
                $this->db->sql_query($sql);

                $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_LOGS_CLEARED_OLD');
                trigger_error($this->language->lang('LOGS_CLEARED_OLD_SUCCESS') . adm_back_link($this->u_action));
                break;

            case 'clear_all':
                $sql = 'TRUNCATE TABLE ' . $this->logs_table;
                $this->db->sql_query($sql);

                $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SIMPLEDOWN_LOGS_CLEARED_ALL');
                trigger_error($this->language->lang('LOGS_CLEARED_ALL_SUCCESS') . adm_back_link($this->u_action));
                break;
        }
    }
}