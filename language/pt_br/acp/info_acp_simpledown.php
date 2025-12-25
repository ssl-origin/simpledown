<?php
/**
 * Arquivo de Idioma ACP (Português do Brasil)
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
    // Títulos e Navegação Geral
    'ACP_SIMPLEDOWN_TITLE'                     => 'Simple Downloads',
    'ACP_SIMPLEDOWN_SETTINGS'                  => 'Configurações',
    'ACP_SIMPLEDOWN_FILES'                     => 'Arquivos',
    'ACP_SIMPLEDOWN_TOOLS'                     => 'Ferramentas',
    'ACP_SIMPLEDOWN_ADD_FILE'                  => 'Adicionar Arquivo',
    'ACP_SIMPLEDOWN_EXISTING_FILES'            => 'Arquivos Existentes',

    // Configurações Gerais
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE'           => 'Tamanho máximo de upload',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE_EXPLAIN'   => 'Limite em MB para arquivos enviados (padrão: 100 MB).',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT'          => 'Limite de caracteres da descrição curta',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT_EXPLAIN'  => 'Máximo de caracteres para a descrição curta exibida nos cards (padrão: 150).',

    // Controle de privacidade por categorias
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES'        => 'Categorias privadas',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_EXPLAIN'=> 'Selecione as categorias cujos arquivos exigirão login para download. Deixe vazio para que nenhum arquivo seja privado por categoria (o controle individual continua funcionando).',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_HOLD_CTRL'=> 'Segure Ctrl (ou Cmd no Mac) para selecionar múltiplas categorias.',

    // Visibilidade padrão para novos arquivos
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY'        => 'Visibilidade padrão para novos arquivos',
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY_EXPLAIN' => 'Esta opção define o valor pré-selecionado (público ou privado) ao adicionar um novo arquivo.<br /><strong style="color: #c62828;">A configuração individual de cada arquivo sempre tem prioridade máxima:</strong> se você marcar um arquivo específico como Público, ele será acessível a todos (mesmo que o padrão seja Privado), e vice-versa.',

    'ACP_SIMPLEDOWN_SAVE_CONFIG'               => 'Salvar Configurações',

    // Gerenciamento de Categorias
    'ACP_SIMPLEDOWN_CATEGORY'                  => 'Categoria',
    'ACP_SIMPLEDOWN_ADD_CATEGORY'              => 'Adicionar Categoria',
    'ACP_SIMPLEDOWN_CATEGORY_NAME'             => 'Nome da Categoria',
    'ACP_SIMPLEDOWN_DELETE_CATEGORY'           => 'Excluir Categoria',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_TO_DELETE' => 'Selecione uma categoria para excluir',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_YET'         => 'Nenhuma categoria ainda.',
    'ACP_SIMPLEDOWN_NO_CATEGORY'               => 'Sem Categoria',

    // Gerenciamento de Arquivos
    'ACP_SIMPLEDOWN_FILE_NAME'                 => 'Nome do Arquivo',
    'ACP_SIMPLEDOWN_FILE_NAME_EXPLAIN'         => 'Este é o nome exibido na página de downloads.',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION'         => 'Descrição Curta',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION_EXPLAIN' => 'Resumo breve exibido nos cards (recomendado 100-150 caracteres).',
    'ACP_SIMPLEDOWN_DESCRIPTION'               => 'Descrição Completa',
    'ACP_SIMPLEDOWN_DESCRIPTION_EXPLAIN'       => 'Descrição completa exibida na página de detalhes.',
    'ACP_SIMPLEDOWN_EDIT_DESCRIPTION'          => 'Editar Descrição',
    'ACP_SIMPLEDOWN_UPLOAD_FILE'               => 'Enviar Arquivo',
    'ACP_SIMPLEDOWN_SIZE'                      => 'Tamanho',
    'ACP_SIMPLEDOWN_NO_FILES_YET'              => 'Nenhum arquivo ainda.',
    'ACP_SIMPLEDOWN_NO_DESCRIPTION'            => 'Nenhuma descrição disponível.',
    'ACP_SIMPLEDOWN_VERSION'                   => 'Versão',
    'ACP_SIMPLEDOWN_VERSION_EXPLAIN'           => 'Opcional: ex., 1.0, 2.1-beta, Final 2025',
    'ACP_SIMPLEDOWN_REPLACE_FILE'              => 'Substituir arquivo',
    'ACP_SIMPLEDOWN_REPLACE_FILE_EXPLAIN'      => 'Marque para enviar um novo arquivo. O antigo será excluído.',

    // Visibilidade Pública/Privada (individual)
    'ACP_SIMPLEDOWN_VISIBILITY'                => 'Visibilidade do arquivo',
    'ACP_SIMPLEDOWN_VISIBILITY_EXPLAIN'        => 'Defina se o arquivo é público (qualquer visitante) ou privado (apenas usuários logados podem baixar).',
    'ACP_SIMPLEDOWN_PUBLIC'                    => 'Público',
    'ACP_SIMPLEDOWN_PRIVATE'                   => 'Privado',

    // Miniaturas (thumbs)
    'ACP_SIMPLEDOWN_UPLOAD_THUMB'              => 'Enviar Miniatura',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB_EXPLAIN'      => 'Envie uma imagem para ser usada como miniatura na página de detalhes. Recomendado: 300x300px ou maior.',
    'ACP_SIMPLEDOWN_THUMB_ALREADY_EXISTS_WARNING' => 'Atenção: Já existia uma miniatura com este nome e ela foi sobrescrita.',
    'ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS'      => 'Miniatura enviada com sucesso!',
    'ACP_SIMPLEDOWN_SELECT_THUMB'              => 'Selecionar miniatura existente',
    'ACP_SIMPLEDOWN_NO_THUMB'                  => 'Sem thumbnail',
    'ACP_SIMPLEDOWN_NO_THUMBS'                 => 'Nenhuma miniatura encontrada na pasta thumbs.',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW'             => 'Pré-visualização da miniatura selecionada',

    // Tabela
    'ACP_SIMPLEDOWN_DOWNLOADS'                 => 'Downloads',
    'ACP_SIMPLEDOWN_ACTIONS'                   => 'Ações',
    'ACP_SIMPLEDOWN_EDIT'                      => 'Editar',
    'ACP_SIMPLEDOWN_DELETE'                    => 'Excluir',
    'ACP_SIMPLEDOWN_SAVE_CHANGES'              => 'Salvar Alterações',
    'ACP_SIMPLEDOWN_CANCEL'                    => 'Cancelar',

    // Paginação e contagem
    'ACP_SIMPLEDOWN_TOTAL_FILES'               => 'Total de arquivos',
    'ACP_SIMPLEDOWN_ITEMS_PER_PAGE'            => 'Itens por página',
    'ACP_SIMPLEDOWN_ALL_ITEMS'                 => 'Todos',

    // Avisos e Segurança
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TITLE'    => 'Atenção!',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_1'   => 'Arquivos executáveis (.exe, .bat, .js, .vbs, etc.) são <strong>bloqueados automaticamente</strong>.',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_2'   => 'Evite enviar arquivos potencialmente maliciosos.',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TITLE'       => 'Arquivos Permitidos',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_1'      => 'Formatos permitidos:',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_2'      => 'PDF, ZIP, RAR, 7Z, DOC/DOCX, XLS/XLSX, PPT/PPTX, imagens, TXT, MP3/WAV/OGG, MP4/AVI/MKV/MOV.',

    // Mensagens de Sucesso
    'ACP_SIMPLEDOWN_CONFIG_SAVED'              => 'Configurações salvas com sucesso!',
    'ACP_SIMPLEDOWN_CAT_ADDED'                 => 'Categoria adicionada com sucesso!',
    'ACP_SIMPLEDOWN_CAT_DELETED'               => 'Categoria excluída com sucesso!',
    'ACP_SIMPLEDOWN_FILE_ADDED'                => 'Arquivo adicionado com sucesso!',
    'ACP_SIMPLEDOWN_FILE_EDITED'               => 'Arquivo atualizado com sucesso!',
    'ACP_SIMPLEDOWN_FILE_DELETED'              => 'Arquivo excluído com sucesso!',
    'ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS'      => 'Miniatura enviada com sucesso!',

    // Erros e Validações
    'ACP_SIMPLEDOWN_NO_FILE_UPLOADED'          => 'Nenhum arquivo enviado.',
    'ACP_SIMPLEDOWN_CATEGORY_REQUIRED'         => 'Você deve selecionar uma categoria antes de enviar o arquivo.',
    'ACP_SIMPLEDOWN_FILE_TOO_LARGE'            => 'Arquivo muito grande. Limite máximo: %d MB.',
    'ACP_SIMPLEDOWN_INVALID_MIME_TYPE'         => 'Tipo de arquivo inválido.',
    'ACP_SIMPLEDOWN_DANGEROUS_FILE'            => 'Envio bloqueado: arquivos executáveis ou maliciosos não são permitidos.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE'            => 'Este arquivo já foi enviado.',
    'ACP_SIMPLEDOWN_UPLOAD_FAILED'             => 'Falha ao enviar o arquivo.',
    'ACP_SIMPLEDOWN_UPLOAD_DIR_ERROR'          => 'Erro ao criar o diretório de upload.',
    'ACP_SIMPLEDOWN_FILE_NOT_FOUND'            => 'Arquivo não encontrado.',
    'ACP_SIMPLEDOWN_NO_CATEGORY_NAME'          => 'O nome da categoria é obrigatório.',
    'ACP_SIMPLEDOWN_CATEGORY_NOT_FOUND'        => 'Categoria não encontrada.',
    'ACP_SIMPLEDOWN_CATEGORY_DUPLICATE'        => 'Esta categoria já existe.',
    'ACP_SIMPLEDOWN_FILE_NAME_REQUIRED'        => 'O nome do arquivo é obrigatório.',

    // Chaves para upload personalizado
    'ACP_SIMPLEDOWN_CHOOSE_FILE'               => 'Escolher arquivo',
    'ACP_SIMPLEDOWN_NO_FILE_SELECTED'          => 'Nenhum arquivo selecionado',
    'ACP_SIMPLEDOWN_SEARCH_FILES'              => 'Buscar arquivos',
    'ACP_SIMPLEDOWN_SEARCH_PLACEHOLDER'        => 'Digite o nome do arquivo...',

    // Tooltip do ícone de preview
    'ACP_SIMPLEDOWN_VIEW_FULL_DESC'            => 'Ver descrição completa',

    // Modal e mensagens
    'ACP_SIMPLEDOWN_ERROR'                     => 'Erro',
    'ACP_SIMPLEDOWN_SUCCESS'                   => 'Sucesso',
    'ACP_SIMPLEDOWN_CLOSE'                     => 'Fechar',
    'ACP_SIMPLEDOWN_WARNING'                   => 'Atenção',

    // Correção do erro fatal (sem %d)
    'CHARACTERS'                               => 'caracteres',

    // Aba Ferramentas
    'ACP_SIMPLEDOWN_TOOLS_LEGEND'              => 'Conteúdo personalizado da aba Ferramentas',
    'ACP_SIMPLEDOWN_TOOLS_LABEL'               => 'Texto/HTML personalizado:',
    'ACP_SIMPLEDOWN_TOOLS_EXPLAIN'             => 'Escreva aqui qualquer conteúdo que deseja exibir na aba Ferramentas.<br />Suporta HTML básico (links, imagens, listas, negrito, etc.).',
    'ACP_SIMPLEDOWN_SAVE_TOOLS_CONTENT'        => 'Salvar conteúdo',
    'ACP_SIMPLEDOWN_TOOLS'                     => 'Ferramentas',
    'ACP_SIMPLEDOWN_THUMBNAILS_MANAGEMENT'     => 'Gerenciamento de Miniaturas',
    'ACP_SIMPLEDOWN_THUMBNAILS_EXPLAIN'        => 'Lista todas as miniaturas existentes. Miniaturas órfãs (não usadas por nenhum arquivo) estão em vermelho.',
    'ACP_SIMPLEDOWN_TOTAL_THUMBS'              => 'Total de miniaturas',
    'ACP_SIMPLEDOWN_ORPHAN_THUMBS'             => 'Miniaturas órfãs',
    'ACP_SIMPLEDOWN_CLEAN_ORPHAN_THUMBS'       => 'Excluir todas as miniaturas órfãs',
    'ACP_SIMPLEDOWN_CONFIRM_CLEAN_THUMBS'      => 'Tem certeza que deseja excluir todas as miniaturas órfãs?',
    'ACP_SIMPLEDOWN_ORPHANS_DELETED'           => '%d miniaturas órfãs foram excluídas.',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE_THUMB'      => 'Tem certeza que deseja excluir a miniatura "%s"?',
    'ACP_SIMPLEDOWN_THUMB_DELETED'             => 'Miniatura excluída com sucesso.',
    'ACP_SIMPLEDOWN_THUMB_NOT_FOUND'           => 'Miniatura não encontrada.',
    'ACP_SIMPLEDOWN_ORPHAN_THUMB'              => 'Órfã (não usada)',
    'ACP_SIMPLEDOWN_THUMBNAILS_EXPLAIN_SIMPLE'   => 'Selecione uma miniatura para visualizar e excluir.',
    'ACP_SIMPLEDOWN_SELECT_THUMB_TO_DELETE'      => 'Miniatura para excluir',
    'ACP_SIMPLEDOWN_SELECT_ONE'                  => '-- Selecione uma miniatura --',
    'ACP_SIMPLEDOWN_DELETE_SELECTED_THUMB'       => 'Excluir miniatura selecionada',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW'               => 'Pré-visualização da miniatura',
    'ACP_SIMPLEDOWN_NO_THUMBS'                   => 'Nenhuma miniatura encontrada.',
        // Ferramentas - Gerenciamento de Miniaturas (continuação e novas)
    'ACP_SIMPLEDOWN_THUMBNAILS_MANAGEMENT'       => 'Gerenciamento de Miniaturas',
    'ACP_SIMPLEDOWN_THUMBNAILS_EXPLAIN_SIMPLE'   => 'Selecione uma miniatura abaixo para visualizar os detalhes e a opção de exclusão.',
    'ACP_SIMPLEDOWN_AVAILABLE_THUMBS'            => 'Miniaturas disponíveis:',
    'ACP_SIMPLEDOWN_SELECT_ONE_THUMB'            => '-- Selecione uma imagem --',
    'ACP_SIMPLEDOWN_PREVIEW_TITLE'               => 'Visualização:',
    'ACP_SIMPLEDOWN_DELETE_THIS_THUMB'           => 'Excluir esta miniatura',
    'ACP_SIMPLEDOWN_NO_THUMBS_FOUND'             => 'Nenhuma miniatura encontrada na pasta <code>/files/thumbs/</code>.',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE_THUMB'        => 'Tem certeza que deseja excluir a miniatura "%s"?',
    'ACP_SIMPLEDOWN_THUMB_DELETED'               => 'Miniatura excluída com sucesso.',
    'ACP_SIMPLEDOWN_THUMB_NOT_FOUND'             => 'Miniatura não encontrada.',
    'ACP_SIMPLEDOWN_THEME'              => 'Tema da interface',
    // Seleção de tema para o site público (frontend/index)
    'ACP_SIMPLEDOWN_SITE_THEME'             => 'Tema do site',
    'ACP_SIMPLEDOWN_SITE_THEME_EXPLAIN'     => 'Escolha o tema visual padrão (claro ou escuro) que será exibido na página pública do SimpleDown para todos os visitantes.',
    'ACP_SIMPLEDOWN_LIGHT_THEME'            => 'Tema claro',
    'ACP_SIMPLEDOWN_DARK_THEME'             => 'Tema escuro',    
]);