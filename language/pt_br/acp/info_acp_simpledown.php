<?php
/**
 * Arquivo de idioma ACP (Português) - Autoload automático no ACP
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
    'ACP_SIMPLEDOWN_TITLE'              => 'Downloads Simples',
    'ACP_SIMPLEDOWN_SETTINGS'           => 'Configurações',
    'ACP_SIMPLEDOWN_DOWNLOADS'          => 'Downloads',
    'ACP_SIMPLEDOWN_ACTIONS'            => 'Ações',
    'ACP_SIMPLEDOWN_CANCEL'             => 'Cancelar',
    'ACP_SIMPLEDOWN_DELETE'             => 'Excluir',
    'ACP_SIMPLEDOWN_EDIT'               => 'Editar',
    'ACP_SIMPLEDOWN_SAVE_CHANGES'       => 'Salvar Alterações',

    // Gestão de Categorias
    'ACP_SIMPLEDOWN_CATEGORY'           => 'Categoria',
    'ACP_SIMPLEDOWN_ADD_CATEGORY'       => 'Adicionar Categoria',
    'ACP_SIMPLEDOWN_CATEGORY_NAME'      => 'Nome da Categoria',
    'ACP_SIMPLEDOWN_EXISTING_CATEGORIES'=> 'Categorias Existentes',
    'ACP_SIMPLEDOWN_DELETE_CATEGORY'    => 'Excluir Categoria',
    'ACP_SIMPLEDOWN_NO_CATEGORY'        => 'Sem Categoria',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_YET'  => 'Nenhuma categoria ainda.',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_TO_DELETE' => 'Selecione uma categoria para excluir',

    // Gestão de Arquivos
    'ACP_SIMPLEDOWN_ADD_FILE'           => 'Adicionar Arquivo',
    'ACP_SIMPLEDOWN_FILE_NAME'          => 'Nome do Arquivo',
    'ACP_SIMPLEDOWN_FILE_NAME_EXPLAIN'  => 'Este é o nome exibido na página de downloads. Não afeta o nome real do arquivo no servidor.',
    'ACP_SIMPLEDOWN_DESCRIPTION'        => 'Descrição',
    'ACP_SIMPLEDOWN_EDIT_DESCRIPTION'   => 'Editar Descrição',
    'ACP_SIMPLEDOWN_UPLOAD_FILE'        => 'Carregar Arquivo',
    'ACP_SIMPLEDOWN_EXISTING_FILES'     => 'Arquivos Existentes',
    'ACP_SIMPLEDOWN_SIZE'               => 'Tamanho',
    'ACP_SIMPLEDOWN_NO_FILES_YET'       => 'Nenhum arquivo ainda.',

    // Configurações do Sistema
    'ACP_SIMPLEDOWN_SAVE_CONFIG'        => 'Salvar configurações',
    'ACP_SIMPLEDOWN_FILES_PER_PAGE'     => 'Arquivos por página',
    'ACP_SIMPLEDOWN_FILES_PER_PAGE_EXPLAIN' => 'Número de arquivos exibidos inicialmente por categoria.',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE'    => 'Tamanho máximo de upload',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE_EXPLAIN' => 'Limite em MB para arquivos enviados (padrão: 100 MB).',

    // Segurança e Avisos
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TITLE'  => 'Arquivos Permitidos',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_1' => 'Os seguintes formatos são <strong>permitidos</strong> para upload:',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_2' => 'PDF, ZIP, RAR, 7Z, DOC/DOCX, XLS/XLSX, PPT/PPTX, imagens (JPG, PNG, GIF, WEBP, SVG), TXT, MP3/WAV/OGG, MP4/AVI/MKV/MOV.',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TITLE'  => 'Atenção!',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_1' => 'Arquivos executáveis (.exe, .bat, .js, .vbs, etc.) são <strong>bloqueados automaticamente</strong> por segurança.',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_2' => 'Mesmo sendo administrador, evite subir arquivos potencialmente maliciosos.',

    // Mensagens de Sucesso
    'ACP_SIMPLEDOWN_CONFIG_SAVED'       => 'Configurações salvas com sucesso!',
    'ACP_SIMPLEDOWN_CAT_ADDED'          => 'Categoria adicionada com sucesso!',
    'ACP_SIMPLEDOWN_CAT_DELETED'        => 'Categoria excluída com sucesso!',
    'ACP_SIMPLEDOWN_FILE_ADDED'         => 'Arquivo adicionado com sucesso!',
    'ACP_SIMPLEDOWN_FILE_EDITED'        => 'Descrição do arquivo editada com sucesso!',
    'ACP_SIMPLEDOWN_FILE_DELETED'       => 'Arquivo excluído com sucesso!',

    // Erros e Validações
    'ACP_SIMPLEDOWN_DANGEROUS_FILE'     => 'Upload bloqueado: arquivos executáveis ou potencialmente maliciosos (ex: .exe, .bat, .js) não são permitidos por razões de segurança.',
    'ACP_SIMPLEDOWN_FILE_TOO_LARGE'     => 'Arquivo muito grande. Limite máximo: %d MB.',
    'ACP_SIMPLEDOWN_INVALID_MIME_TYPE'  => 'Tipo de arquivo não permitido. O conteúdo do arquivo não corresponde à extensão.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE'     => 'Este arquivo já foi enviado.',
    'ACP_SIMPLEDOWN_FILE_NOT_FOUND'     => 'Arquivo não encontrado.',
    'ACP_SIMPLEDOWN_UPLOAD_FAILED'      => 'Falha no upload.',
    'ACP_SIMPLEDOWN_NO_FILE_UPLOADED'   => 'Nenhum arquivo enviado.',
    'ACP_SIMPLEDOWN_NO_CATEGORY_NAME'   => 'Nome da categoria obrigatório.',
    'ACP_SIMPLEDOWN_CATEGORY_NOT_FOUND' => 'Categoria não encontrada.',
    'ACP_SIMPLEDOWN_CATEGORY_DUPLICATE' => 'Categoria já existe. Escolha um nome diferente.',
    'ACP_SIMPLEDOWN_CATEGORY_REQUIRED'  => 'Você deve selecionar uma categoria.',
    'ACP_SIMPLEDOWN_NO_CATEGORY_SELECTED' => 'Nenhuma categoria selecionada para exclusão.',
    'ACP_SIMPLEDOWN_UPLOAD_DIR_ERROR'   => 'Erro ao criar o diretório de upload.',

    // Logs de Administração
    'LOG_SIMPLEDOWN_FILE_ADDED'         => 'Arquivo SimpleDown adicionado: %s',
    'LOG_SIMPLEDOWN_CAT_ADDED'          => 'Categoria SimpleDown adicionada: %s',
    'LOG_SIMPLEDOWN_FILE_DELETED'       => 'Arquivo SimpleDown excluído: %s',
    'LOG_SIMPLEDOWN_CAT_DELETED'        => 'Categoria SimpleDown excluída: %s',
    'LOG_SIMPLEDOWN_FILE_EDITED'        => 'Descrição do arquivo SimpleDown editada: %s',
        'ACP_SIMPLEDOWN_SECURITY_WARNING_TITLE' => 'Atenção!',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_1' => 'Arquivos executáveis (.exe, .bat, .js, .vbs etc.) são bloqueados automaticamente.',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_2' => 'Evite arquivos potencialmente maliciosos.',

    'ACP_SIMPLEDOWN_ALLOWED_FILES_TITLE' => 'Arquivos Permitidos',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_1' => 'Permitidos: PDF, ZIP/RAR/7Z, DOC/XLS/PPT, imagens (JPG/PNG/GIF/WEBP/SVG), TXT, MP3/WAV/OGG, MP4/AVI/MKV/MOV.',
]);