<?php
/**
 * Language File - Common (English)
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, [
    // Title and general messages
    'SIMPLEDOWN_TITLE' => 'Téléchargement',
    'SIMPLEDOWN_NO_CATEGORY' => 'Il n’y a aucune catégorie',
    'SIMPLEDOWN_SHOW_ALL_CATEGORIES' => 'Afficher toutes les catégories',
    'SIMPLEDOWN_NO_DOWNLOADS_AVAILABLE' => 'l n’y a aucun téléchargement de disponible.',
    'SIMPLEDOWN_NO_CATEGORIES_YET' => 'Il n’y a aucune catégorie.',
    'SIMPLEDOWN_FILE_NOT_FOUND' => 'Fichier introuvable.',
    // Visibility - Public / Private (frontend)
    'SIMPLEDOWN_PUBLIC_FILE' => 'Public',
    'SIMPLEDOWN_PRIVATE_FILE' => 'Privé',
    'SIMPLEDOWN_LOGIN_REQUIRED' => 'Vous devez être connecté pour télécharger ce fichier.',
    // File information
    'SIMPLEDOWN_DOWNLOADS' => 'Téléchargements',
    'SIMPLEDOWN_DOWNLOADS_LOWER' => 'Téléchargements',
    'SIMPLEDOWN_SIZE' => 'Taille',
    'SIMPLEDOWN_NO_DESCRIPTION' => 'Il n’y a aucune description de disponible.',
    'SIMPLEDOWN_NO_SHORT_DESCRIPTION' => 'Il n’y a aucune courte description de disponible.',
    'SIMPLEDOWN_VERSION' => 'Version',
    'SIMPLEDOWN_NO_VERSION' => 'Il n’y a aucune version',
    // Thumbnails
    'SIMPLEDOWN_THUMBNAIL' => 'Miniature',
    'SIMPLEDOWN_NO_THUMBNAIL' => 'Il n’y a aucune miniature',
    'SIMPLEDOWN_SELECT_THUMB' => 'Sélectionnez une miniature existante',
    'SIMPLEDOWN_UPLOAD_THUMB' => 'Téléverser une nouvelle miniature',
    'SIMPLEDOWN_THUMB_PREVIEW' => 'Aperçu de la miniature',
    // Buttons and navigation
    'DOWNLOAD_BUTTON' => 'Télécharger',
    'SIMPLEDOWN_DETAILS_BUTTON' => 'Détails',
    'SIMPLEDOWN_BACK_TO_DOWNLOADS' => 'Retouner à la page principale',
    // Category
    'SIMPLEDOWN_CATEGORY' => 'Catégorie',
    // Image preview
    'SIMPLEDOWN_PREVIEW_IMAGE' => 'Image de l’aperçu',
    'SIMPLEDOWN_IMAGE_PREVIEW_ALT' => 'Aperçu de l’image',
    // Search
    'SIMPLEDOWN_SEARCH_PLACEHOLDER' => 'Rechercher par nom ou description...',
    'SIMPLEDOWN_CLEAR_SEARCH' => 'Effacer l’historique de recherche',
    'SIMPLEDOWN_SEARCH_EMPTY' => 'Aucun résultat trouvé pour votre recherche...',
    'SIMPLEDOWN_SEARCH_EMPTY_HINT' => 'Essayez d’utiliser des termes différents ou de supprimer certains filtres.',
    // Sorting
    'SIMPLEDOWN_SORT_DEFAULT' => 'Trier par',
    'SORT_NAME_ASC' => 'Nom (A → Z)',
    'SORT_NAME_DESC' => 'Nom (Z → A)',
    'SORT_DOWNLOADS_DESC' => 'Le plus téléchargés',
    'SORT_DOWNLOADS_ASC' => 'Le moins téléchargés',
    'SORT_SIZE_DESC' => 'Taille maximale',
    'SORT_SIZE_ASC' => 'Taille minimale',
    // Count
    'SIMPLEDOWN_FILES' => 'fichiers',
    // Logs
    'LOG_SIMPLEDOWN_FILE_DOWNLOADED' => 'SimpleDown fichier téléchargé: %s',
    // ACP - Administration (some keys also used in frontend)
    'ACP_SIMPLEDOWN_TITLE' => 'SimpleDown - Gérer les téléchargements',
    'ACP_SIMPLEDOWN_SETTINGS' => 'Paramètres',
    'ACP_SIMPLEDOWN_EXISTING_FILES' => 'Fichiers existants',
    'ACP_SIMPLEDOWN_ADD_FILE' => 'Ajouter un fichier',
    'ACP_SIMPLEDOWN_UPLOAD_FILE' => 'Téléverser un fichier',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB' => 'Téléverser une miniature',
    'ACP_SIMPLEDOWN_REPLACE_FILE' => 'Remplacer le fichier',
    'ACP_SIMPLEDOWN_SELECT_THUMB' => 'Sélectionnez une miniature existante',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW' => 'Aperçu',
    'ACP_SIMPLEDOWN_NO_THUMBS' => 'Aucune miniature de disponible.',
    'ACP_SIMPLEDOWN_SAVE_CHANGES' => 'Enregistrer les modifications',
    'ACP_SIMPLEDOWN_CANCEL' => 'Annuler',
    'ACP_SIMPLEDOWN_FILE_EDITED' => 'Fichier modifié avec succès.',
    'ACP_SIMPLEDOWN_FILE_DELETED' => 'Fichier supprimé avec succès.',
    // Private file login modal
    'SIMPLEDOWN_PRIVATE_MODAL_TEXT' => 'Ce fichier est réservé aux membres inscrits.<br>Connectez-vous ou inscrivez-vous pour le télécharger.',
    'SIMPLEDOWN_LOGIN_BUTTON' => 'Se connecter',
    'SIMPLEDOWN_REGISTER_BUTTON' => 'Créer un compte',
    // Frontend - Details and list
    'L_OR' => 'ou',
    'L_DOWNLOAD_BUTTON' => 'Télécharger',
    'L_SIMPLEDOWN_BACK_TO_DOWNLOADS' => '← Retouner à la page principale',
    'L_SIMPLEDOWN_DETAILS_BUTTON' => 'Voir les détails',
    // Sorting
    'L_SIMPLEDOWN_SORT_DEFAULT' => 'Trier par',
    'L_SORT_NAME_ASC' => 'Nom (A → Z)',
    'L_SORT_NAME_DESC' => 'Nom (Z → A)',
    'L_SORT_DOWNLOADS_DESC' => 'Le plus téléchargés',
    'L_SORT_DOWNLOADS_ASC' => 'Le moins téléchargés',
    'L_SORT_SIZE_DESC' => 'Taille maximale',
    'L_SORT_SIZE_ASC' => 'Taille minimale',
    // Search
    'L_SIMPLEDOWN_SEARCH_EMPTY' => 'Aucun fichier de trouvé.',
    'L_SIMPLEDOWN_SEARCH_EMPTY_HINT' => 'Essayez d’utiliser des termes différents ou de supprimer certains filtres.',
    // Private modal
    'L_SIMPLEDOWN_PRIVATE_MODAL_TEXT' => 'Ce fichier est réservé aux membres inscrits et connectés.<br>Connectez-vous ou créez un compte pour télécharger le fichier.',
    'L_SIMPLEDOWN_LOGIN_BUTTON' => 'Se connecter',
    'L_SIMPLEDOWN_REGISTER_BUTTON' => 'Inscrivez-vous',
]);