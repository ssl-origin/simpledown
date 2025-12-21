<?php
/**
 * Arquivo de Idioma - Common (Português Brasileiro)
 *
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
 */

if (!defined('IN_PHPBB')) {
    exit;
}

if (empty($lang) || !is_array($lang)) {
    $lang = array();
}

$lang = array_merge($lang, array(
    // Título e mensagens gerais
    'SIMPLEDOWN_TITLE'                  => 'Downloads',
    'SIMPLEDOWN_NO_CATEGORY'            => 'Sem Categoria',
    'SIMPLEDOWN_SHOW_ALL_CATEGORIES'    => 'Mostrar todas categorias',
    'SIMPLEDOWN_NO_DOWNLOADS_AVAILABLE' => 'Nenhum download disponível.',
    'SIMPLEDOWN_NO_CATEGORIES_YET'      => 'Nenhuma categoria ainda.',
    'SIMPLEDOWN_FILE_NOT_FOUND'         => 'Arquivo não encontrado.',

    // Informações do arquivo
    'SIMPLEDOWN_DOWNLOADS'              => 'Downloads',
    'SIMPLEDOWN_DOWNLOADS_LOWER'        => 'downloads',
    'SIMPLEDOWN_SIZE'                   => 'Tamanho',
    'SIMPLEDOWN_NO_DESCRIPTION'         => 'Sem descrição disponível.',

    // Botões e navegação
    'DOWNLOAD_BUTTON'                 => 'Download',
    'SIMPLEDOWN_DETAILS_BUTTON'         => 'Detalhes',
    'SIMPLEDOWN_BACK_TO_DOWNLOADS'      => 'Voltar para Downloads',

    // Categoria
    'SIMPLEDOWN_CATEGORY'             => 'Categoria',  // usada com {L_...}

    // Pré-visualização de imagem
    'SIMPLEDOWN_PREVIEW_IMAGE'          => 'Pré-visualizar imagem',
    'SIMPLEDOWN_IMAGE_PREVIEW_ALT'      => 'Pré-visualização da imagem',

    // Busca
    'SIMPLEDOWN_SEARCH_PLACEHOLDER'     => 'Buscar por nome ou descrição...',

    // Ordenação
    'SIMPLEDOWN_SORT_DEFAULT'           => 'Ordenar',
    'SORT_NAME_ASC'                     => 'Nome (A → Z)',
    'SORT_NAME_DESC'                    => 'Nome (Z → A)',
    'SORT_DOWNLOADS_DESC'               => 'Mais baixados',
    'SORT_DOWNLOADS_ASC'                => 'Menos baixados',
    'SORT_SIZE_DESC'                    => 'Maior tamanho',
    'SORT_SIZE_ASC'                     => 'Menor tamanho',

    // Contagem
    'SIMPLEDOWN_FILES'                  => 'arquivos',
    'SIMPLEDOWN_FILE_NOT_FOUND' => 'Arquivo não encontrado.',

    // Logs
    'LOG_SIMPLEDOWN_FILE_DOWNLOADED'    => 'Arquivo SimpleDown baixado: %s',
));