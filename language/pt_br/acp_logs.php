<?php
/**
 * SimpleDown - Arquivo de idioma ACP Logs (Português do Brasil)
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

    // Título e descrição da página
    'ACP_SIMPLEDOWN_LOGS'               => 'Logs de Downloads',
    'ACP_SIMPLEDOWN_LOGS_EXPLAIN'       => 'Registro detalhado de todas as ações relacionadas aos downloads: visualizações, tentativas bloqueadas e downloads realizados.',

    // Cabeçalhos da tabela
    'ACP_SIMPLEDOWN_LOG_TIME'           => 'Data/Hora',
    'ACP_SIMPLEDOWN_LOG_USERNAME'       => 'Usuário',
    'ACP_SIMPLEDOWN_LOG_FILE'           => 'Arquivo',
    'ACP_SIMPLEDOWN_LOG_ACTION'         => 'Ação',
    'ACP_SIMPLEDOWN_LOG_IP'             => 'Endereço IP',
    'ACP_SIMPLEDOWN_LOG_USER_AGENT'     => 'Navegador/Dispositivo',

    // Valores especiais
    'ACP_SIMPLEDOWN_UNKNOWN_FILE'       => 'Arquivo desconhecido',
    'ACP_SIMPLEDOWN_NONE'               => 'Nenhum',

    // Filtros
    'ACP_LOGS_FILTER_USERNAME'          => 'Filtrar por usuário',
    'ACP_LOGS_ACTION_DOWNLOAD'          => 'Download',
    'ACP_LOGS_ACTION_PREVIEW'           => 'Visualização',
    'ACP_LOGS_ACTION_DENIED'            => 'Acesso negado',
    'DATE_FROM'                         => 'De',
    'DATE_TO'                           => 'Até',
    'ALL'                               => 'Todos',

    // Legenda do fieldset (filtros e ações)
    'ACP_LOGS_FILTERS_ACTIONS'          => 'Filtros e Ações em Massa',

    // Botões de ação
    'ACP_LOGS_CLEAR_ALL'                => 'Limpar Todos os Logs',
    'ACP_LOGS_CLEAR_OLD'                => 'Limpar Logs Antigos (6 meses)',

    // Botão de exclusão seletiva
    'DELETE_SELECTED'                   => 'Excluir Selecionados',

    // Mensagens de sucesso
    'LOGS_DELETED_SUCCESS'              => '%d log(s) excluído(s) com sucesso.',
    'LOGS_CLEARED_OLD_SUCCESS'          => 'Logs antigos (mais de 6 meses) foram excluídos com sucesso.',
    'LOGS_CLEARED_ALL_SUCCESS'          => 'Todos os logs foram excluídos com sucesso.',

    // Mensagens de confirmação
    'CONFIRM_DELETE_SELECTED_LOGS'      => 'Tem certeza que deseja excluir os logs selecionados?',
    'CONFIRM_CLEAR_OLD_LOGS'            => 'Tem certeza que deseja excluir todos os logs com mais de 6 meses? Esta ação é irreversível.',
    'CONFIRM_CLEAR_ALL_LOGS'            => 'Tem certeza que deseja excluir TODOS os logs? Esta ação não pode ser desfeita!',

    // Aviso de limite de exibição
    'ACP_LOGS_MAX_DISPLAY_WARNING'      => 'Existem mais de 10.000 registros. Por razões de desempenho, apenas os 10.000 mais recentes estão sendo exibidos.',

    // Mensagem quando não há logs
    'NO_LOGS_FOUND'                     => 'Nenhum registro encontrado',

    // Mensagem de erro (caso nenhum log seja selecionado)
    'NO_LOGS_SELECTED'                  => 'Nenhum log foi selecionado.',

    // Estatísticas no topo
    'ACP_SIMPLEDOWN_TOTAL_LOGS'         => 'Total de registros',
    'ACP_SIMPLEDOWN_STATS_TOTAL_DOWNLOADS' => 'Total de downloads registrados',
    'ACP_SIMPLEDOWN_STATS_TOTAL_VIEWS'     => 'Total de visualizações registradas',
    'ACP_SIMPLEDOWN_STATS_TOTAL_DENIED'    => 'Total de acessos negados registrados',
    'ACP_SIMPLEDOWN_STATS_TOP_FILE'        => 'Arquivo mais baixado',

    // Filtro (label acima do select)
    'ACP_LOGS_ACTION'                   => 'Ação',

    // Cabeçalho da tabela (mais descritivo)
    'ACP_SIMPLEDOWN_LOG_ACTION'         => 'Ação',

]);