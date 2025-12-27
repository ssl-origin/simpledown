<?php
/**
 * Fichier de langue - Commun (Français)
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
    // Titre et messages généraux
    'SIMPLEDOWN_TITLE'                  => 'Téléchargements',
    'SIMPLEDOWN_NO_CATEGORY'            => 'Sans catégorie',
    'SIMPLEDOWN_SHOW_ALL_CATEGORIES'    => 'Afficher toutes les catégories',
    'SIMPLEDOWN_NO_DOWNLOADS_AVAILABLE' => 'Aucun téléchargement disponible.',
    'SIMPLEDOWN_NO_CATEGORIES_YET'      => 'Aucune catégorie pour le moment.',
    'SIMPLEDOWN_FILE_NOT_FOUND'         => 'Fichier non trouvé.',

    // Visibilité - Public / Privé (frontend)
    'SIMPLEDOWN_PUBLIC_FILE'            => 'Public',
    'SIMPLEDOWN_PRIVATE_FILE'           => 'Privé',
    'SIMPLEDOWN_LOGIN_REQUIRED'         => 'Vous devez être connecté pour télécharger ce fichier.',

    // Informations du fichier
    'SIMPLEDOWN_DOWNLOADS'              => 'Téléchargements',
    'SIMPLEDOWN_DOWNLOADS_LOWER'        => 'téléchargements',
    'SIMPLEDOWN_SIZE'                   => 'Taille',
    'SIMPLEDOWN_NO_DESCRIPTION'         => 'Aucune description disponible.',
    'SIMPLEDOWN_NO_SHORT_DESCRIPTION'   => 'Aucune description courte disponible.',
    'SIMPLEDOWN_VERSION'                => 'Version',
    'SIMPLEDOWN_NO_VERSION'             => 'Sans version',

    // Miniatures
    'SIMPLEDOWN_THUMBNAIL'              => 'Miniature',
    'SIMPLEDOWN_NO_THUMBNAIL'           => 'Sans miniature',
    'SIMPLEDOWN_SELECT_THUMB'           => 'Sélectionner une miniature existante',
    'SIMPLEDOWN_UPLOAD_THUMB'           => 'Envoyer une nouvelle miniature',
    'SIMPLEDOWN_THUMB_PREVIEW'          => 'Aperçu de la miniature',

    // Boutons et navigation
    'DOWNLOAD_BUTTON'                   => 'Télécharger',
    'SIMPLEDOWN_DETAILS_BUTTON'         => 'Détails',
    'SIMPLEDOWN_BACK_TO_DOWNLOADS'      => 'Retour aux Téléchargements',

    // Catégorie
    'SIMPLEDOWN_CATEGORY'               => 'Catégorie',

    // Prévisualisation d'image
    'SIMPLEDOWN_PREVIEW_IMAGE'          => 'Prévisualiser l\'image',
    'SIMPLEDOWN_IMAGE_PREVIEW_ALT'      => 'Aperçu de l\'image',

    // Recherche
    'SIMPLEDOWN_SEARCH_PLACEHOLDER'     => 'Rechercher par nom ou description...',
    'SIMPLEDOWN_CLEAR_SEARCH'           => 'Effacer la recherche',
    'SIMPLEDOWN_SEARCH_EMPTY'           => 'Aucun résultat trouvé pour votre recherche...',
    'SIMPLEDOWN_SEARCH_EMPTY_HINT'      => 'Essayez d\'utiliser des termes différents ou de supprimer certains filtres.',

    // Tri
    'SIMPLEDOWN_SORT_DEFAULT'           => 'Trier par',
    'SORT_NAME_ASC'                     => 'Nom (A → Z)',
    'SORT_NAME_DESC'                    => 'Nom (Z → A)',
    'SORT_DOWNLOADS_DESC'               => 'Plus téléchargés',
    'SORT_DOWNLOADS_ASC'                => 'Moins téléchargés',
    'SORT_SIZE_DESC'                    => 'Plus grande taille',
    'SORT_SIZE_ASC'                     => 'Plus petite taille',

    // Comptage
    'SIMPLEDOWN_FILES'                  => 'fichiers',

    // Logs
    'LOG_SIMPLEDOWN_FILE_DOWNLOADED'    => 'Fichier SimpleDown téléchargé : %s',

    // ACP - Administration
    'ACP_SIMPLEDOWN_TITLE'              => 'SimpleDown - Gérer les téléchargements',
    'ACP_SIMPLEDOWN_SETTINGS'           => 'Paramètres',
    'ACP_SIMPLEDOWN_EXISTING_FILES'     => 'Fichiers existants',
    'ACP_SIMPLEDOWN_ADD_FILE'           => 'Ajouter un fichier',
    'ACP_SIMPLEDOWN_UPLOAD_FILE'        => 'Envoyer un fichier',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB'       => 'Envoyer une miniature',
    'ACP_SIMPLEDOWN_REPLACE_FILE'       => 'Remplacer le fichier',
    'ACP_SIMPLEDOWN_SELECT_THUMB'       => 'Sélectionner une miniature existante',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW'      => 'Aperçu',
    'ACP_SIMPLEDOWN_NO_THUMBS'          => 'Aucune miniature disponible.',
    'ACP_SIMPLEDOWN_SAVE_CHANGES'       => 'Enregistrer les modifications',
    'ACP_SIMPLEDOWN_CANCEL'             => 'Annuler',
    'ACP_SIMPLEDOWN_FILE_EDITED'        => 'Fichier modifié avec succès.',
    'ACP_SIMPLEDOWN_FILE_DELETED'       => 'Fichier supprimé avec succès.',

    // Modal de connexion pour fichiers privés
    'SIMPLEDOWN_PRIVATE_MODAL_TEXT'     => 'Ce fichier est réservé aux membres inscrits.<br>Veuillez vous connecter ou vous enregistrer pour le télécharger.',
    'SIMPLEDOWN_LOGIN_BUTTON'           => 'Se connecter',
    'SIMPLEDOWN_REGISTER_BUTTON'        => 'Créer un compte',

    // Frontend - Détails et liste
    'L_OR'                              => 'ou',
    'L_DOWNLOAD_BUTTON'                 => 'Télécharger',
    'L_SIMPLEDOWN_BACK_TO_DOWNLOADS'    => '← Retour aux Téléchargements',
    'L_SIMPLEDOWN_DETAILS_BUTTON'       => 'Voir les détails',

    // Tri (L_ prefix)
    'L_SIMPLEDOWN_SORT_DEFAULT'         => 'Trier par',
    'L_SORT_NAME_ASC'                   => 'Nom (A → Z)',
    'L_SORT_NAME_DESC'                  => 'Nom (Z → A)',
    'L_SORT_DOWNLOADS_DESC'             => 'Plus téléchargés',
    'L_SORT_DOWNLOADS_ASC'              => 'Moins téléchargés',
    'L_SORT_SIZE_DESC'                  => 'Plus grande taille',
    'L_SORT_SIZE_ASC'                   => 'Plus petite taille',

    // Recherche (L_ prefix)
    'L_SIMPLEDOWN_SEARCH_EMPTY'         => 'Aucun fichier trouvé pour votre recherche.',
    'L_SIMPLEDOWN_SEARCH_EMPTY_HINT'    => 'Essayez d\'autres mots-clés ou supprimez les filtres.',

    // Modal privé (L_ prefix)
    'L_SIMPLEDOWN_PRIVATE_MODAL_TEXT'   => 'Ce fichier est exclusif aux membres enregistrés.<br>Connectez-vous ou créez un compte pour télécharger.',
    'L_SIMPLEDOWN_LOGIN_BUTTON'         => 'Connexion',
    'L_SIMPLEDOWN_REGISTER_BUTTON'      => 'S\'enregistrer',
]);