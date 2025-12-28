<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
 */

namespace mundophpbb\simpledown\controller;

use phpbb\config\config;
use phpbb\db\driver\driver_interface;
use phpbb\language\language;
use phpbb\log\log_interface as log;
use phpbb\pagination;
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
    protected $u_action;
    protected $table_prefix;
    protected $logs_table;

    public function __construct(
        config $config,
        driver_interface $db,
        language $language,
        log $log,
        request $request,
        template $template,
        user $user,
        string $table_prefix,
        pagination $pagination
    ) {
        $this->config       = $config;
        $this->db           = $db;
        $this->language     = $language;
        $this->log          = $log;
        $this->request      = $request;
        $this->template     = $template;
        $this->user         = $user;
        $this->table_prefix = $table_prefix;
        $this->logs_table   = $table_prefix . 'simpledown_logs';
        $this->pagination   = $pagination;
    }

    /**
     * Define a URL da página atual (usada para redirecionamentos e links)
     */
    public function set_page_url(string $u_action): void
    {
        $this->u_action = $u_action;
    }

    public function handle(): void
    {
        // Carrega idiomas específicos da extensão
        $this->user->add_lang_ext('mundophpbb/simpledown', 'acp/info_acp_simpledown');
        $this->user->add_lang_ext('mundophpbb/simpledown', 'acp_logs');

        add_form_key('acp_simpledown_logs');

        $action = $this->request->variable('action', '');

        // Detecta clique no botão de exclusão seletiva
        if ($this->request->is_set_post('delete_selected'))
        {
            $action = 'delete_selected';
        }

        // Validação inicial para delete_selected: verifica se há logs selecionados
        if ($action === 'delete_selected')
        {
            $log_ids = $this->request->variable('log_id', [0]);
            if (empty($log_ids))
            {
                trigger_error($this->language->lang('NO_LOGS_SELECTED') . adm_back_link($this->u_action), E_USER_WARNING);
            }
        }

        // Executa ação se já confirmada
        if ($action && confirm_box(true))
        {
            $this->perform_action($action);
        }
        // Pede confirmação
        else if ($action)
        {
            $message = match ($action) {
                'delete_selected' => $this->language->lang('CONFIRM_DELETE_SELECTED_LOGS'),
                'clear_old'       => $this->language->lang('CONFIRM_CLEAR_OLD_LOGS'),
                'clear_all'       => $this->language->lang('CONFIRM_CLEAR_ALL_LOGS'),
                default           => '',
            };

            if ($message)
            {
                // Para delete_selected, mantém os log_id[] no hidden fields
                $hidden_fields = ['action' => $action];
                if ($action === 'delete_selected')
                {
                    foreach ($log_ids ?? $this->request->variable('log_id', [0]) as $id)
                    {
                        $hidden_fields['log_id'][] = (int) $id;
                    }
                }

                confirm_box(false, $message, build_hidden_fields($hidden_fields));
            }
        }

        // Exibe a lista de logs
        $this->display_logs();
    }

    protected function display_logs(): void
    {
        $per_page = (int)($this->config['simpledown_logs_per_page'] ?? 50);
        $start    = $this->request->variable('start', 0);

        // Filtros
        $filters = [
            'username'  => $this->request->variable('username', '', true),
            'action'    => $this->request->variable('action', ''),
            'date_from' => $this->request->variable('date_from', ''),
            'date_to'   => $this->request->variable('date_to', ''),
        ];

        $where  = [];
        $params = [];

        if ($filters['username'])
        {
            $where[]  = 'l.username LIKE ?';
            $params[] = '%' . $this->db->sql_escape($filters['username']) . '%';
        }
        if ($filters['action'])
        {
            $where[]  = 'l.action = ?';
            $params[] = $filters['action'];
        }
        if ($filters['date_from'])
        {
            $where[]  = 'l.log_time >= ?';
            $params[] = strtotime($filters['date_from'] . ' 00:00:00');
        }
        if ($filters['date_to'])
        {
            $where[]  = 'l.log_time <= ?';
            $params[] = strtotime($filters['date_to'] . ' 23:59:59');
        }

        $where_sql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

        // Total de registros
        $sql    = 'SELECT COUNT(*) AS total FROM ' . $this->logs_table . ' l ' . $where_sql;
        $result = $this->db->sql_query_limit($sql, 1, 0, 0, $params);
        $total_logs = (int) $this->db->sql_fetchfield('total');
        $this->db->sql_freeresult($result);

        $max_display = 10000;
        if ($total_logs > $max_display)
        {
            $total_logs = $max_display;
            $this->template->assign_var('S_MAX_DISPLAY_WARNING', true);
        }

        if ($start >= $total_logs && $total_logs > 0)
        {
            $start = max(0, $total_logs - $per_page);
        }

        // Lista de logs
        $sql = 'SELECT l.*, f.file_realname, u.username AS real_username, u.user_colour
                FROM ' . $this->logs_table . ' l
                LEFT JOIN ' . $this->table_prefix . 'simpledown_files f ON f.id = l.file_id
                LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = l.user_id
                ' . $where_sql . '
                ORDER BY l.log_time DESC';

        $result = $this->db->sql_query_limit($sql, $per_page, $start, 0, $params);

        while ($row = $this->db->sql_fetchrow($result))
        {
            $this->template->assign_block_vars('logs', [
                'LOG_ID'      => $row['log_id'],
                'LOG_TIME'    => $this->user->format_date($row['log_time']),
                'USERNAME'    => $row['user_id']
                    ? get_username_string('full', $row['user_id'], $row['real_username'] ?: $row['username'], $row['user_colour'])
                    : $row['username'] . ' (' . $this->language->lang('GUEST') . ')',
                'IP_ADDRESS'  => $row['ip_address'],
                'ACTION'      => $row['action'],
                'FILE_NAME'   => $row['file_realname'] ?: $this->language->lang('ACP_SIMPLEDOWN_UNKNOWN_FILE'),
                'USER_AGENT'  => utf8_substr($row['user_agent'], 0, 100) . (utf8_strlen($row['user_agent']) > 100 ? '...' : ''),
            ]);
        }
        $this->db->sql_freeresult($result);

        // Estatísticas
        $this->assign_stats();

        // Paginação moderna
        $base_url = $this->u_action . '&amp;' . http_build_query($filters, '', '&amp;');
        $this->pagination->generate_template_pagination($base_url, 'pagination', 'start', $total_logs, $per_page, $start);

        $this->template->assign_vars([
            'U_ACTION'         => $this->u_action,
            'TOTAL_LOGS'       => $total_logs,
            'USERNAME_FILTER'  => $filters['username'],
            'ACTION_FILTER'    => $filters['action'],
            'DATE_FROM'        => $filters['date_from'],
            'DATE_TO'          => $filters['date_to'],
        ]);
    }

    protected function assign_stats(): void
    {
        // Total de downloads registrados
        $sql = 'SELECT COUNT(*) AS total_downloads
                FROM ' . $this->logs_table . '
                WHERE action = "download"';

        $result = $this->db->sql_query($sql);
        $total_downloads = (int) $this->db->sql_fetchfield('total_downloads');
        $this->db->sql_freeresult($result);

        // Arquivo mais baixado
        $top_file_name = $this->language->lang('ACP_SIMPLEDOWN_NONE');

        $sql = 'SELECT f.file_realname, COUNT(*) AS cnt
                FROM ' . $this->logs_table . ' l
                JOIN ' . $this->table_prefix . 'simpledown_files f ON f.id = l.file_id
                WHERE l.action = "download"
                GROUP BY l.file_id, f.file_realname
                ORDER BY cnt DESC';

        $result = $this->db->sql_query($sql);
        $top_file = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if ($top_file)
        {
            $top_file_name = $top_file['file_realname'] . ' (' . $top_file['cnt'] . ')';
        }

        $this->template->assign_vars([
            'STATS_TOTAL_DOWNLOADS' => $total_downloads,
            'STATS_TOP_FILE'        => $top_file_name,
        ]);
    }

    protected function perform_action(string $action): void
    {
        switch ($action)
        {
            case 'delete_selected':
                $log_ids = $this->request->variable('log_id', [0]);

                if (empty($log_ids))
                {
                    trigger_error($this->language->lang('NO_LOGS_SELECTED') . adm_back_link($this->u_action), E_USER_WARNING);
                }

                $sql = 'DELETE FROM ' . $this->logs_table . '
                        WHERE ' . $this->db->sql_in_set('log_id', $log_ids);
                $this->db->sql_query($sql);

                $count = $this->db->sql_affectedrows();

                trigger_error($this->language->lang('LOGS_DELETED_SUCCESS', $count) . adm_back_link($this->u_action));
                break;

            case 'clear_old':
                $cutoff = time() - (180 * 86400); // 6 meses
                $sql = 'DELETE FROM ' . $this->logs_table . ' WHERE log_time < ' . (int) $cutoff;
                $this->db->sql_query($sql);
                trigger_error($this->language->lang('LOGS_CLEARED_OLD_SUCCESS') . adm_back_link($this->u_action));
                break;

            case 'clear_all':
                $sql = 'TRUNCATE TABLE ' . $this->logs_table;
                $this->db->sql_query($sql);
                trigger_error($this->language->lang('LOGS_CLEARED_ALL_SUCCESS') . adm_back_link($this->u_action));
                break;
        }

        // Redireciona (nunca chega aqui se usar trigger_error antes)
        redirect($this->u_action);
    }
}