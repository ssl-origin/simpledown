<?php
/**
 * Arquivo de Idioma - Comum (Português do Brasil)
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
    // Título e mensagens gerais
    'SIMPLEDOWN_TITLE'                  => 'Downloads',
    'SIMPLEDOWN_NO_CATEGORY'            => 'Sem Categoria',
    'SIMPLEDOWN_SHOW_ALL_CATEGORIES'    => 'Mostrar todas as categorias',
    'SIMPLEDOWN_NO_DOWNLOADS_AVAILABLE' => 'Nenhum download disponível.',
    'SIMPLEDOWN_NO_CATEGORIES_YET'      => 'Nenhuma categoria ainda.',
    'SIMPLEDOWN_FILE_NOT_FOUND'         => 'Arquivo não encontrado.',

    // Visibilidade - Público / Privado (frontend)
    'SIMPLEDOWN_PUBLIC_FILE'            => 'Público',
    'SIMPLEDOWN_PRIVATE_FILE'           => 'Privado',
    'SIMPLEDOWN_LOGIN_REQUIRED'         => 'Você precisa estar logado para baixar este arquivo.',

    // Informações do arquivo
    'SIMPLEDOWN_DOWNLOADS'              => 'Downloads',
    'SIMPLEDOWN_DOWNLOADS_LOWER'        => 'downloads',
    'SIMPLEDOWN_SIZE'                   => 'Tamanho',
    'SIMPLEDOWN_NO_DESCRIPTION'         => 'Nenhuma descrição disponível.',
    'SIMPLEDOWN_NO_SHORT_DESCRIPTION'   => 'Nenhuma descrição curta disponível.',
    'SIMPLEDOWN_VERSION'                => 'Versão',
    'SIMPLEDOWN_NO_VERSION'             => 'Sem versão',

    // Miniaturas
    'SIMPLEDOWN_THUMBNAIL'              => 'Miniatura',
    'SIMPLEDOWN_NO_THUMBNAIL'           => 'Sem miniatura',
    'SIMPLEDOWN_SELECT_THUMB'           => 'Selecionar miniatura existente',
    'SIMPLEDOWN_UPLOAD_THUMB'           => 'Enviar nova miniatura',
    'SIMPLEDOWN_THUMB_PREVIEW'          => 'Pré-visualização da miniatura',

    // Botões e navegação
    'DOWNLOAD_BUTTON'                   => 'Download',
    'SIMPLEDOWN_DETAILS_BUTTON'         => 'Detalhes',
    'SIMPLEDOWN_BACK_TO_DOWNLOADS'      => 'Voltar aos Downloads',

    // Categoria
    'SIMPLEDOWN_CATEGORY'               => 'Categoria',

    // Pré-visualização de imagem
    'SIMPLEDOWN_PREVIEW_IMAGE'          => 'Pré-visualizar imagem',
    'SIMPLEDOWN_IMAGE_PREVIEW_ALT'      => 'Pré-visualização da imagem',

    // Busca
    'SIMPLEDOWN_SEARCH_PLACEHOLDER'     => 'Buscar por nome ou descrição...',
    'SIMPLEDOWN_CLEAR_SEARCH'           => 'Limpar busca',
    'SIMPLEDOWN_SEARCH_EMPTY'           => 'Nenhum resultado encontrado para sua busca...',
    'SIMPLEDOWN_SEARCH_EMPTY_HINT'      => 'Tente usar termos diferentes ou remover alguns filtros.',

    // Ordenação
    'SIMPLEDOWN_SORT_DEFAULT'           => 'Ordenar por',
    'SORT_NAME_ASC'                     => 'Nome (A → Z)',
    'SORT_NAME_DESC'                    => 'Nome (Z → A)',
    'SORT_DOWNLOADS_DESC'               => 'Mais baixados',
    'SORT_DOWNLOADS_ASC'                => 'Menos baixados',
    'SORT_SIZE_DESC'                    => 'Maior tamanho',
    'SORT_SIZE_ASC'                     => 'Menor tamanho',

    // Contagem
    'SIMPLEDOWN_FILES'                  => 'arquivos',

    // Logs
    'LOG_SIMPLEDOWN_FILE_DOWNLOADED'    => 'Arquivo SimpleDown baixado: %s',

    // ACP - Administração (algumas chaves usadas também no frontend)
    'ACP_SIMPLEDOWN_TITLE'              => 'SimpleDown - Gerenciar Downloads',
    'ACP_SIMPLEDOWN_SETTINGS'           => 'Configurações',
    'ACP_SIMPLEDOWN_EXISTING_FILES'     => 'Arquivos existentes',
    'ACP_SIMPLEDOWN_ADD_FILE'           => 'Adicionar arquivo',
    'ACP_SIMPLEDOWN_UPLOAD_FILE'        => 'Enviar arquivo',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB'       => 'Enviar miniatura',
    'ACP_SIMPLEDOWN_REPLACE_FILE'       => 'Substituir arquivo',
    'ACP_SIMPLEDOWN_SELECT_THUMB'       => 'Selecionar miniatura existente',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW'      => 'Pré-visualização',
    'ACP_SIMPLEDOWN_NO_THUMBS'          => 'Nenhuma miniatura disponível.',
    'ACP_SIMPLEDOWN_SAVE_CHANGES'       => 'Salvar alterações',
    'ACP_SIMPLEDOWN_CANCEL'             => 'Cancelar',
    'ACP_SIMPLEDOWN_FILE_EDITED'        => 'Arquivo editado com sucesso.',
    'ACP_SIMPLEDOWN_FILE_DELETED'       => 'Arquivo deletado com sucesso.',
        // Modal de login para arquivos privados
    'SIMPLEDOWN_PRIVATE_MODAL_TEXT'      => 'Este arquivo é exclusivo para membros cadastrados. Faça login ou registre-se para baixar.',
    'SIMPLEDOWN_LOGIN_BUTTON'            => 'Fazer Login',
    'SIMPLEDOWN_REGISTER_BUTTON'         => 'Criar Conta',
        // Frontend - Detalhes e lista
    'L_OR'                              => 'ou',
    'L_DOWNLOAD_BUTTON'                 => 'Baixar',
    'L_SIMPLEDOWN_BACK_TO_DOWNLOADS'    => '← Voltar para Downloads',
    'L_SIMPLEDOWN_DETAILS_BUTTON'       => 'Ver Detalhes',

    // Ordenação
    'L_SIMPLEDOWN_SORT_DEFAULT'         => 'Ordenar por',
    'L_SORT_NAME_ASC'                   => 'Nome (A → Z)',
    'L_SORT_NAME_DESC'                  => 'Nome (Z → A)',
    'L_SORT_DOWNLOADS_DESC'             => 'Mais baixados',
    'L_SORT_DOWNLOADS_ASC'              => 'Menos baixados',
    'L_SORT_SIZE_DESC'                  => 'Maior tamanho',
    'L_SORT_SIZE_ASC'                   => 'Menor tamanho',

    // Busca
    'L_SIMPLEDOWN_SEARCH_EMPTY'         => 'Nenhum arquivo encontrado para a sua busca.',
    'L_SIMPLEDOWN_SEARCH_EMPTY_HINT'    => 'Tente palavras diferentes ou remover filtros.',

    // Modal privado
    'L_SIMPLEDOWN_PRIVATE_MODAL_TEXT'   => 'Este arquivo é exclusivo para membros registrados.<br>Faça login ou crie uma conta para baixar.',
    'L_SIMPLEDOWN_LOGIN_BUTTON'         => 'Entrar',
    'L_SIMPLEDOWN_REGISTER_BUTTON'      => 'Registrar',
]);