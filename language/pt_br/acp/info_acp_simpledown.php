<?php
/**
 * Arquivo de Idioma ACP (Português do Brasil)
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
    // Títulos e Navegação Geral
    // ===================================================================
    'ACP_SIMPLEDOWN_TITLE'              => 'Simple Downloads',
    'ACP_SIMPLEDOWN_SETTINGS'           => 'Configurações',
    'ACP_SIMPLEDOWN_FILES'              => 'Arquivos',
    'ACP_SIMPLEDOWN_TOOLS'              => 'Ferramentas',
    'ACP_SIMPLEDOWN_LOGS'               => 'Logs de Download',
    'ACP_SIMPLEDOWN_ADD_FILE'           => 'Adicionar Arquivo',
    'ACP_SIMPLEDOWN_EXISTING_FILES'     => 'Arquivos Existentes',

    // ===================================================================
    // Aba Configurações Gerais
    // ===================================================================
    'ACP_SIMPLEDOWN_GENERAL_SETTINGS'           => 'Configurações Gerais',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE'            => 'Tamanho máximo de upload',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE_EXPLAIN'    => 'Limite em MB para arquivos enviados (padrão: 100 MB).',
    'ACP_SIMPLEDOWN_UPLOAD_SIZE'                => 'MB',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE_EXPLAIN'    => 'Tamanho máximo do arquivo para upload em MB (mínimo de 1 MB)',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT'           => 'Limite de caracteres da descrição curta',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT_EXPLAIN'   => 'Máximo de caracteres para a descrição curta exibida nos cards (padrão: 150).',
    'ACP_SIMPLEDOWN_SITE_THEME'                 => 'Tema do site',
    'ACP_SIMPLEDOWN_SITE_THEME_EXPLAIN'         => 'Escolha o tema visual padrão (claro ou escuro) que será exibido na página pública do SimpleDown para todos os visitantes.',
    'ACP_SIMPLEDOWN_LIGHT_THEME'                => 'Tema claro',
    'ACP_SIMPLEDOWN_DARK_THEME'                 => 'Tema escuro',
    'ACP_SIMPLEDOWN_CARDS_PER_ROW'              => 'Número de cards por linha',
    'ACP_SIMPLEDOWN_CARDS_PER_ROW_EXPLAIN'      => 'Define quantos cards de download são exibidos lado a lado na página principal de downloads.<br />• <strong>3 cards</strong>: layout padrão (recomendado para desktops).<br />• <strong>2 cards</strong>: layout mais amplo e confortável em telas médias.',
    'ACP_SIMPLEDOWN_CARDS'                      => 'cards por linha',
    'ACP_SIMPLEDOWN_ALLOW_USER_LAYOUT_CHOICE'   => 'Permitir que usuários escolham o layout',
    'ACP_SIMPLEDOWN_ALLOW_USER_LAYOUT_CHOICE_EXPLAIN' => 'Quando ativado, os visitantes poderão alternar entre visualização em grade (cards) e lista na página pública de downloads. A escolha é salva em cookie.',
    'ACP_SIMPLEDOWN_VIEW_GRID'                  => 'Visualização em grade',
    'ACP_SIMPLEDOWN_VIEW_LIST'                  => 'Visualização em lista',
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY'         => 'Visibilidade padrão para novos arquivos',
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY_EXPLAIN' => 'Esta opção define o valor pré-selecionado (público ou privado) ao adicionar um novo arquivo.<br /><strong style="color: #c62828;">A configuração individual de cada arquivo sempre tem prioridade máxima:</strong> se você marcar um arquivo específico como Público, ele será acessível a todos (mesmo que o padrão seja Privado), e vice-versa.',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES'         => 'Categorias privadas',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_EXPLAIN' => 'Selecione as categorias cujos arquivos exigirão login para download. Deixe vazio para que nenhum arquivo seja privado por categoria (o controle individual continua funcionando).',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_HOLD_CTRL' => 'Segure Ctrl (ou Cmd no Mac) para selecionar múltiplas categorias.',

    // Mensagem personalizável para arquivos privados
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE'            => 'Mensagem para arquivos privados',
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE_EXPLAIN'    => 'Esta mensagem é exibida quando um visitante não logado tenta acessar um arquivo privado ou de categoria privada.',
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE_DEFAULT'    => 'Este arquivo é exclusivo para membros cadastrados. Faça login ou registre-se para baixar.',

    'ACP_SIMPLEDOWN_SAVE_CONFIG'                => 'Salvar Configurações',
    'ACP_SIMPLEDOWN_CONFIG_SAVED'               => 'Configurações salvas com sucesso!',

    // ===================================================================
    // Categorias
    // ===================================================================
    'ACP_SIMPLEDOWN_CATEGORY'                   => 'Categoria',
    'ACP_SIMPLEDOWN_CATEGORIES'                 => 'Adicionar Categoria',
    'ACP_SIMPLEDOWN_ADD_CATEGORY'               => 'Adicionar Categoria',
    'ACP_SIMPLEDOWN_CATEGORY_NAME'              => 'Nome da Categoria',
    'ACP_SIMPLEDOWN_DELETE_CATEGORY'            => 'Excluir Categoria',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_TO_DELETE'  => 'Selecione uma categoria para excluir',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_YET'          => 'Nenhuma categoria ainda.',
    'ACP_SIMPLEDOWN_NO_CATEGORY'                => 'Sem Categoria',
    'ACP_SIMPLEDOWN_NO_CATEGORY_NAME'           => 'O nome da categoria é obrigatório.',
    'ACP_SIMPLEDOWN_CATEGORY_NOT_FOUND'         => 'Categoria não encontrada.',
    'ACP_SIMPLEDOWN_CATEGORY_DUPLICATE'         => 'Esta categoria já existe.',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_REQUIRED'   => 'Selecione uma categoria',
    'ACP_SIMPLEDOWN_CAT_ADDED'                  => 'Categoria adicionada com sucesso!',
    'ACP_SIMPLEDOWN_CAT_DELETED'                => 'Categoria excluída com sucesso!',
    'ACP_SIMPLEDOWN_CATEGORY_REQUIRED'          => 'Você deve selecionar uma categoria válida para o arquivo.',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_EXIST'        => 'Nenhuma categoria foi criada ainda. Crie pelo menos uma categoria antes de adicionar arquivos.',

    // ===================================================================
    // Gestão de Arquivos (Adicionar/Editar)
    // ===================================================================
    'ACP_SIMPLEDOWN_FILE_NAME'                  => 'Nome do Arquivo',
    'ACP_SIMPLEDOWN_FILE_NAME_EXPLAIN'          => 'Este é o nome exibido na página de downloads.',
    'ACP_SIMPLEDOWN_DISPLAY_NAME'               => 'Nome exibido (título do download)',
    'ACP_SIMPLEDOWN_DISPLAY_NAME_EXPLAIN'       => 'Este é o nome que os usuários verão na lista de downloads. Não afeta o nome do arquivo no servidor.',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION'          => 'Descrição Curta',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION_EXPLAIN'  => 'Resumo breve exibido nos cards (recomendado 100-150 caracteres).',
    'ACP_SIMPLEDOWN_DESCRIPTION'                => 'Descrição Completa',
    'ACP_SIMPLEDOWN_DESCRIPTION_EXPLAIN'        => 'Descrição completa exibida na página de detalhes. Suporta BBCode.',
    'ACP_SIMPLEDOWN_EDIT_DESCRIPTION'           => 'Editar Descrição',
    'ACP_SIMPLEDOWN_VERSION'                    => 'Versão',
    'ACP_SIMPLEDOWN_VERSION_EXPLAIN'            => 'Opcional: ex., 1.0, 2.1-beta, Final 2025',
    'ACP_SIMPLEDOWN_VISIBILITY'                 => 'Visibilidade do arquivo',
    'ACP_SIMPLEDOWN_VISIBILITY_EXPLAIN'         => 'Defina se o arquivo é público (qualquer visitante) ou privado (apenas usuários logados podem baixar).',
    'ACP_SIMPLEDOWN_PUBLIC'                     => 'Público',
    'ACP_SIMPLEDOWN_PRIVATE'                    => 'Privado',
    'ACP_SIMPLEDOWN_UPLOAD_FILE'                => 'Enviar Arquivo',
    'ACP_SIMPLEDOWN_REPLACE_FILE'               => 'Substituir arquivo',
    'ACP_SIMPLEDOWN_REPLACE_FILE_EXPLAIN'       => 'Marque para enviar um novo arquivo. O antigo será excluído.',
    'ACP_SIMPLEDOWN_REPLACE_FILE_WARNING'       => 'O arquivo antigo será excluído permanentemente ao salvar.',
    'ACP_SIMPLEDOWN_REPLACE_FILE_HELP'          => 'O arquivo antigo será excluído permanentemente. O novo será salvo com nome sanitizado (pode ser renomeado automaticamente se houver conflito).',
    'ACP_SIMPLEDOWN_CURRENT_FILE'               => 'Arquivo atual',
    'ACP_SIMPLEDOWN_CURRENT_SERVER_FILE'        => 'Nome atual no servidor',
    'ACP_SIMPLEDOWN_SIZE'                       => 'Tamanho',
    'ACP_SIMPLEDOWN_DOWNLOADS'                  => 'Downloads',
    'ACP_SIMPLEDOWN_FILE_ADDED'                 => 'Arquivo adicionado com sucesso!',
    'ACP_SIMPLEDOWN_FILE_EDITED'                => 'Arquivo atualizado com sucesso!',
    'ACP_SIMPLEDOWN_FILE_DELETED'               => 'Arquivo excluído com sucesso!',
    'ACP_SIMPLEDOWN_NO_FILES_YET'               => 'Nenhum arquivo ainda.',
    'ACP_SIMPLEDOWN_NO_DESCRIPTION'             => 'Nenhuma descrição disponível.',
    'ACP_SIMPLEDOWN_TOTAL_FILES'                => 'Total de arquivos',
    'ACP_SIMPLEDOWN_ITEMS_PER_PAGE'             => 'Itens por página',
    'ACP_SIMPLEDOWN_ALL_ITEMS'                  => 'Todos',

    // ===================================================================
    // Miniaturas (Thumbnails)
    // ===================================================================
    'ACP_SIMPLEDOWN_UPLOAD_THUMB'               => 'Enviar Miniatura',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB_EXPLAIN'       => 'Envie uma imagem para ser usada como miniatura na página de detalhes. Recomendado: 300x300px ou maior.',
    'ACP_SIMPLEDOWN_THUMB_ALREADY_EXISTS_WARNING' => 'Atenção: Já existia uma miniatura com este nome e ela foi sobrescrita.',
    'ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS'       => 'Miniatura enviada com sucesso!',
    'ACP_SIMPLEDOWN_SELECT_THUMB'               => 'Selecionar miniatura existente',
    'ACP_SIMPLEDOWN_NO_THUMB'                   => 'Sem thumbnail',
    'ACP_SIMPLEDOWN_NO_THUMBS'                  => 'Nenhuma miniatura encontrada na pasta thumbs.',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW'              => 'Pré-visualização da miniatura',

    // ===================================================================
    // Anúncios Automáticos em Fóruns
    // ===================================================================
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE'             => 'Anúncios Automáticos em Fóruns',
    'ACP_SIMPLEDOWN_ANNOUNCE_EXPLAIN'           => 'Quando ativado, ao adicionar um novo arquivo será criado automaticamente um tópico no fórum configurado.',
    'ACP_SIMPLEDOWN_AUTO_ANNOUNCE'              => 'Ativar criação automática de tópicos',
    'ACP_SIMPLEDOWN_ANNOUNCE_FORUM'             => 'Fórum de Anúncio',
    'ACP_SIMPLEDOWN_NO_FORUM'                   => '-- Nenhum fórum selecionado --',

    // Tipo de tópico
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE'              => 'Tipo de tópico criado',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_EXPLAIN'      => 'Escolha o tipo de tópico que será criado automaticamente ao adicionar um arquivo.',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_NORMAL'       => 'Normal',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_STICKY'       => 'Fixo',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_ANNOUNCE'     => 'Anúncio',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_GLOBAL'       => 'Anúncio global',

    // Tópico trancado
    'ACP_SIMPLEDOWN_ANNOUNCE_LOCKED'            => 'Criar tópico trancado',
    'ACP_SIMPLEDOWN_ANNOUNCE_LOCKED_EXPLAIN'    => 'Se ativado, o tópico de anúncio será criado já trancado (sem respostas permitidas).',

    // Templates
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_TEMPLATE'    => 'Template do título do tópico',
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_EXPLAIN'     => 'Placeholders disponíveis:<br><strong>{NAME}</strong> – Nome do arquivo<br><strong>{VERSION}</strong> – Versão<br><br><em>Exemplo recomendado: [Novo Download] {NAME} v{VERSION}</em>',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_TEMPLATE'  => 'Template da mensagem do tópico',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_EXPLAIN'   => 'Placeholders disponíveis:<br><strong>{NAME}</strong> – Nome do arquivo<br><strong>{VERSION}</strong> – Versão<br><strong>{DESC_SHORT}</strong> – Descrição curta<br><strong>{DESC_FORMATTED}</strong> – Descrição completa com BBCode<br><strong>{URL_DETAILS}</strong> – Link para página de detalhes<br><strong>{URL_DOWNLOAD}</strong> – Link direto para download<br><br><em>Exemplo completo já preenchido por padrão.</em>',
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_TEMPLATE_DEFAULT'   => '[Novo Download] {NAME} v{VERSION}',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_TEMPLATE_DEFAULT' => "{DESC_FORMATTED}\n\n[center][url={URL_DETAILS}]Baixar agora[/url][/center]",
    
    // Logs de ações administrativas
'LOG_SIMPLEDOWN_FILE_DELETED'               => 'Excluiu o arquivo “%s”',
'LOG_SIMPLEDOWN_FILE_EDITED'                => 'Editou o arquivo “%s”',
'LOG_SIMPLEDOWN_ANNOUNCE_CREATED'           => 'Criou tópico de anúncio para o arquivo “%s”',
'LOG_SIMPLEDOWN_ANNOUNCE_LOCK_TOGGLED'      => 'Alterou o status de bloqueio do anúncio do arquivo “%1$s” para %2$s',
'LOG_SIMPLEDOWN_ANNOUNCE_DELETED'           => 'Excluiu o tópico de anúncio do arquivo “%s”', // já existe, mas incluí para referência
'LOG_SIMPLEDOWN_CAT_ADDED'                  => 'Adicionou a categoria “%s”',
'LOG_SIMPLEDOWN_CAT_DELETED'                => 'Excluiu a categoria “%s”',
'LOG_SIMPLEDOWN_THUMB_ADDED'                => 'Adicionou miniatura “%s”',
'LOG_SIMPLEDOWN_THUMB_DELETED'              => 'Excluiu miniatura “%s”',
'LOG_SIMPLEDOWN_ORPHAN_DELETED'             => 'Excluiu arquivo órfão “%s”',
'LOG_SIMPLEDOWN_LOGS_DELETED'               => 'Excluiu %s registros de log',
'LOG_SIMPLEDOWN_LOGS_CLEARED_OLD'           => 'Limpar logs antigos (mais de 6 meses)',
'LOG_SIMPLEDOWN_LOGS_CLEARED_ALL'           => 'Limpar todos os logs de download',
'LOG_SIMPLEDOWN_FILE_DOWNLOADED'            => '<strong>%1$s</strong> baixou o arquivo “%2$s”', // este é log de usuário (aparece no perfil do usuário também)
'LOG_SIMPLEDOWN_FILE_ADDED'                 => 'Adicionou o arquivo “%s”',

    // ===================================================================
    // Aba Logs de Download
    // ===================================================================
    'ACP_SIMPLEDOWN_LOGS_EXPLAIN'               => 'Registro detalhado de todas as ações relacionadas aos downloads (visualizações, tentativas bloqueadas e downloads efetivos).',
    'ACP_SIMPLEDOWN_TOTAL_LOGS'                 => 'Total de registros',
    'ACP_SIMPLEDOWN_STATS_TOTAL_DOWNLOADS'      => 'Total de downloads registrados',
    'ACP_SIMPLEDOWN_STATS_TOP_FILE'             => 'Arquivo mais baixado',
    'ACP_SIMPLEDOWN_LOG_TIME'                   => 'Data/Hora',
    'ACP_SIMPLEDOWN_LOG_USERNAME'               => 'Usuário',
    'ACP_SIMPLEDOWN_LOG_FILE'                   => 'Arquivo',
    'ACP_SIMPLEDOWN_LOG_ACTION'                 => 'Ação',
    'ACP_SIMPLEDOWN_LOG_IP'                     => 'Endereço IP',
    'ACP_SIMPLEDOWN_LOG_USER_AGENT'             => 'Navegador/Dispositivo',
    'ACP_SIMPLEDOWN_LOG_ACTION_DOWNLOAD'        => 'Download',
    'ACP_SIMPLEDOWN_LOG_ACTION_PREVIEW'         => 'Visualização',
    'ACP_SIMPLEDOWN_LOG_ACTION_DENIED'          => 'Acesso negado',
    'ACP_SIMPLEDOWN_UNKNOWN_FILE'               => 'Arquivo desconhecido',
    'ACP_SIMPLEDOWN_NONE'                       => 'Nenhum',
    'NO_LOGS_FOUND'                             => 'Nenhum registro encontrado.',
    'NO_LOGS_SELECTED'                          => 'Nenhum log selecionado para exclusão.',
    'ACP_SIMPLEDOWN_DELETE_SELECTED'            => 'Excluir selecionados',
    'ACP_SIMPLEDOWN_CLEAR_OLD_LOGS'             => 'Limpar logs antigos (mais de 6 meses)',
    'ACP_SIMPLEDOWN_CLEAR_ALL_LOGS'             => 'Limpar todos os logs',
    'CONFIRM_DELETE_SELECTED_LOGS'              => 'Tem certeza que deseja excluir os logs selecionados?',
    'CONFIRM_CLEAR_OLD_LOGS'                    => 'Tem certeza que deseja excluir todos os logs com mais de 6 meses?',
    'CONFIRM_CLEAR_ALL_LOGS'                    => 'Tem certeza que deseja excluir TODOS os logs? Esta ação é irreversível!',
    'LOGS_DELETED_SUCCESS'                      => '%d logs excluídos com sucesso.',
    'LOGS_CLEARED_OLD_SUCCESS'                  => 'Logs antigos foram excluídos com sucesso.',
    'LOGS_CLEARED_ALL_SUCCESS'                  => 'Todos os logs foram excluídos com sucesso.',

    // ===================================================================
    // Aba Ferramentas
    // ===================================================================
    'ACP_SIMPLEDOWN_THUMBNAILS_MANAGEMENT'      => 'Gerenciamento de Miniaturas',
    'ACP_SIMPLEDOWN_THUMBNAILS_EXPLAIN_SIMPLE'  => 'Lista todas as miniaturas presentes na pasta <code>/files/thumbs/</code>.',
    'ACP_SIMPLEDOWN_AVAILABLE_THUMBS'           => 'Miniaturas disponíveis',
    'ACP_SIMPLEDOWN_SELECT_ONE_THUMB'           => '-- Selecione uma miniatura --',
    'ACP_SIMPLEDOWN_PREVIEW_TITLE'              => 'Pré-visualização',
    'ACP_SIMPLEDOWN_DELETE_THIS_THUMB'          => 'Excluir esta miniatura',
    'ACP_SIMPLEDOWN_NO_THUMBS_FOUND'            => 'Nenhuma miniatura encontrada na pasta <code>/files/thumbs/</code>.',
    'ACP_SIMPLEDOWN_TOTAL_THUMBS'               => 'Total de miniaturas',
    'ACP_SIMPLEDOWN_THUMB_DELETED'              => 'Miniatura excluída com sucesso.',

    'ACP_SIMPLEDOWN_ASSOCIATED_FILES'           => 'Arquivos Associados',
    'ACP_SIMPLEDOWN_ASSOCIATED_FILES_EXPLAIN'   => 'Arquivos presentes na pasta <code>/files/</code> que estão vinculados a um registro ativo no banco de dados (em uso).',
    'ACP_SIMPLEDOWN_TOTAL_ASSOCIATED'           => 'Total de arquivos associados',
    'ACP_SIMPLEDOWN_NO_ASSOCIATED_FILES'        => 'Nenhum arquivo associado encontrado.',

    'ACP_SIMPLEDOWN_ORPHAN_FILES_MANAGEMENT'    => 'Arquivos Órfãos',
    'ACP_SIMPLEDOWN_ORPHAN_FILES_EXPLAIN'       => 'Arquivos físicos na pasta <code>/files/</code> que não estão associados a nenhum registro no banco de dados. Podem ser excluídos com segurança.',
    'ACP_SIMPLEDOWN_AVAILABLE_ORPHAN_FILES'     => 'Arquivos órfãos disponíveis',
    'ACP_SIMPLEDOWN_SELECT_ONE_FILE'            => '-- Selecione um arquivo --',
    'ACP_SIMPLEDOWN_DELETE_THIS_FILE'           => 'Excluir este arquivo',
    'ACP_SIMPLEDOWN_NO_ORPHAN_FILES_FOUND'      => 'Nenhum arquivo órfão encontrado.',
    'ACP_SIMPLEDOWN_TOTAL_ORPHAN_FILES'         => 'Total de arquivos órfãos',
    'ACP_SIMPLEDOWN_ORPHAN_WARNING'             => 'Atenção: estes arquivos não estão sendo usados por nenhum download ativo.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETED'             => 'Arquivo órfão excluído com sucesso.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETE_FAILED'       => 'Falha ao excluir o arquivo órfão.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETE_WARNING'      => 'Você está prestes a excluir permanentemente o arquivo selecionado do servidor. Esta ação não pode ser desfeita.',

    'ACP_SIMPLEDOWN_TOOLS_LEGEND'               => 'Conteúdo personalizado da aba Ferramentas',
    'ACP_SIMPLEDOWN_TOOLS_LABEL'                => 'Texto/HTML personalizado:',
    'ACP_SIMPLEDOWN_TOOLS_EXPLAIN'              => 'Escreva aqui qualquer conteúdo que deseja exibir na aba Ferramentas.<br />Suporta HTML básico (links, imagens, listas, negrito, etc.).',
    'ACP_SIMPLEDOWN_SAVE_TOOLS_CONTENT'         => 'Salvar conteúdo',

    // ===================================================================
    // Mensagens Gerais e Ações
    // ===================================================================
    'ACP_SIMPLEDOWN_ACTIONS'                    => 'Ações',
    'ACP_SIMPLEDOWN_EDIT'                       => 'Editar',
    'ACP_SIMPLEDOWN_DELETE'                     => 'Excluir',
    'ACP_SIMPLEDOWN_SAVE_CHANGES'               => 'Salvar Alterações',
    'ACP_SIMPLEDOWN_CANCEL'                     => 'Cancelar',
    'ACP_SIMPLEDOWN_SEARCH_FILES'               => 'Buscar arquivos',
    'ACP_SIMPLEDOWN_SEARCH_PLACEHOLDER'         => 'Digite o nome do arquivo...',
    'ACP_SIMPLEDOWN_VIEW_FULL_DESC'             => 'Ver descrição completa',
    'ACP_SIMPLEDOWN_CHOOSE_FILE'                => 'Escolher arquivo',
    'ACP_SIMPLEDOWN_NO_FILE_SELECTED'           => 'Nenhum arquivo selecionado',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE'             => 'Tem certeza que deseja excluir este arquivo? Esta ação não pode ser desfeita.',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE_FILE'        => 'Tem certeza que deseja excluir este arquivo? Esta ação não pode ser desfeita.',

    // ===================================================================
    // Segurança e Validações
    // ===================================================================
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TITLE'     => 'Atenção!',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_1'    => 'Arquivos executáveis (.exe, .bat, .js, .vbs, etc.) são <strong>bloqueados automaticamente</strong>.',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_2'    => 'Evite enviar arquivos potencialmente maliciosos.',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TITLE'        => 'Arquivos Permitidos',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_1'       => 'Formatos permitidos:',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_2'       => 'PDF, ZIP, RAR, 7Z, DOC/DOCX, XLS/XLSX, PPT/PPTX, imagens, TXT, MP3/WAV/OGG, MP4/AVI/MKV/MOV.',
    'ACP_SIMPLEDOWN_NO_FILE_UPLOADED'           => 'Nenhum arquivo enviado.',
    'ACP_SIMPLEDOWN_FILE_TOO_LARGE'             => 'Arquivo muito grande. Limite máximo: %d MB.',
    'ACP_SIMPLEDOWN_INVALID_MIME_TYPE'          => 'Tipo de arquivo inválido.',
    'ACP_SIMPLEDOWN_DANGEROUS_FILE'             => 'Envio bloqueado: arquivos executáveis ou maliciosos não são permitidos.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE'             => 'Este arquivo já foi enviado.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE_DETECTED'    => 'Este arquivo já foi enviado anteriormente como "<strong>%1$s</strong>" (nome no servidor: <code>%2$s</code>).<br />Use a aba <strong>Arquivos</strong> para editá-lo ou envie uma versão diferente.',
    'ACP_SIMPLEDOWN_UPLOAD_FAILED'              => 'Falha ao enviar o arquivo.',
    'ACP_SIMPLEDOWN_UPLOAD_DIR_ERROR'           => 'Erro ao criar o diretório de upload.',
    'ACP_SIMPLEDOWN_FILE_NOT_FOUND'             => 'Arquivo não encontrado.',
    'ACP_SIMPLEDOWN_FILE_NAME_REQUIRED'         => 'O nome do arquivo é obrigatório.',
    'ACP_SIMPLEDOWN_THUMB_NOT_FOUND'            => 'Miniatura não encontrada.',

    // ===================================================================
    // Mensagens Genéricas e BBCode
    // ===================================================================
    'ACP_SIMPLEDOWN_ERROR'                      => 'Erro',
    'ACP_SIMPLEDOWN_SUCCESS'                    => 'Sucesso',
    'ACP_SIMPLEDOWN_CLOSE'                      => 'Fechar',
    'ACP_SIMPLEDOWN_WARNING'                    => 'Atenção',
    'CHARACTERS'                                => 'caracteres',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_TITLE'          => 'Tamanho da fonte',
    'ACP_SIMPLEDOWN_BBCODE_SIZE'                => 'Tamanho',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_VERY_SMALL'     => '50% (muito pequeno)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_SMALL'          => '85% (pequeno)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_NORMAL'         => '100% (padrão)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_LARGE'          => '150% (grande)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_VERY_LARGE'     => '200% (muito grande)',

    // ===================================================================
    // Validações padrão do phpBB
    // ===================================================================
    'TOO_FEW_CHARS'                             => 'O valor fornecido contém poucos caracteres.',
    'TOO_MANY_CHARS'                            => 'O valor fornecido contém caracteres demais.',
    'TOO_SMALL'                                 => 'O valor fornecido é muito pequeno.',
    'TOO_LARGE'                                 => 'O valor fornecido é muito grande.',
    
    // ===================================================================
    // Toolbar BBCode
    // ===================================================================
    'ACP_SIMPLEDOWN_BBCODE_BOLD'                => 'Negrito',
    'ACP_SIMPLEDOWN_BBCODE_ITALIC'              => 'Itálico',
    'ACP_SIMPLEDOWN_BBCODE_UNDERLINE'           => 'Sublinhado',
    'ACP_SIMPLEDOWN_BBCODE_QUOTE'               => 'Citação',
    'ACP_SIMPLEDOWN_BBCODE_CODE'                => 'Código',
    'ACP_SIMPLEDOWN_BBCODE_URL'                 => 'Link',
    'ACP_SIMPLEDOWN_BBCODE_IMG'                 => 'Imagem',
    'ACP_SIMPLEDOWN_BBCODE_LIST'                => 'Lista',
    'ACP_SIMPLEDOWN_BBCODE_COLOR'               => 'Cor',
    'LOG_SIMPLEDOWN_ANNOUNCE_DELETED'           => 'Excluiu o tópico de anúncio do arquivo “%s”',
    'CONFIRM_DELETE_FILE'                       => 'Tem certeza de que deseja excluir este arquivo?<br /><br /><strong>Atenção:</strong> Esta ação é irreversível e também excluirá permanentemente o tópico de anúncio associado e todas as suas respostas no fórum.',
]);