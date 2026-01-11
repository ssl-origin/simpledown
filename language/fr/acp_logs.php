<?php
/**
 * SimpleDown - Fichier de langue des journaux ACP (Français)
 *
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
 */

if (!defined('IN_PHPBB'))
{
    exit;
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

    // Titre et description de la page
    'ACP_SIMPLEDOWN_LOGS'               => 'Journaux de téléchargements',
    'ACP_SIMPLEDOWN_LOGS_EXPLAIN'       => 'Registre détaillé de toutes les actions liées aux téléchargements : vues, tentatives bloquées et téléchargements effectués.',

    // En-têtes du tableau
    'ACP_SIMPLEDOWN_LOG_TIME'           => 'Date/Heure',
    'ACP_SIMPLEDOWN_LOG_USERNAME'       => 'Utilisateur',
    'ACP_SIMPLEDOWN_LOG_FILE'           => 'Fichier',
    'ACP_SIMPLEDOWN_LOG_ACTION'         => 'Action',
    'ACP_SIMPLEDOWN_LOG_IP'             => 'Adresse IP',
    'ACP_SIMPLEDOWN_LOG_USER_AGENT'     => 'Navigateur/Appareil',

    // Valeurs spéciales
    'ACP_SIMPLEDOWN_UNKNOWN_FILE'       => 'Fichier inconnu',
    'ACP_SIMPLEDOWN_NONE'               => 'Aucun',

    // Filtres
    'ACP_LOGS_FILTER_USERNAME'          => 'Filtrer par utilisateur',
    'ACP_LOGS_ACTION_DOWNLOAD'          => 'Téléchargement',
    'ACP_LOGS_ACTION_PREVIEW'           => 'Aperçu',
    'ACP_LOGS_ACTION_DENIED'            => 'Accès refusé',
    'DATE_FROM'                         => 'Du',
    'DATE_TO'                           => 'Au',
    'ALL'                               => 'Tous',

    // Légende du fieldset (filtres et actions)
    'ACP_LOGS_FILTERS_ACTIONS'          => 'Filtres et Actions groupées',

    // Boutons d'action
    'ACP_LOGS_CLEAR_ALL'                => 'Effacer tous les journaux',
    'ACP_LOGS_CLEAR_OLD'                => 'Nettoyer les anciens journaux (6 mois)',

    // Bouton de suppression sélective
    'DELETE_SELECTED'                   => 'Supprimer la sélection',

    // Messages de succès
    'LOGS_DELETED_SUCCESS'              => '%d journal/journaux supprimé(s) avec succès.',
    'LOGS_CLEARED_OLD_SUCCESS'          => 'Les anciens journaux (plus de 6 mois) ont été supprimés avec succès.',
    'LOGS_CLEARED_ALL_SUCCESS'          => 'Tous les journaux ont été supprimés avec succès.',

    // Messages de confirmation
    'CONFIRM_DELETE_SELECTED_LOGS'      => 'Êtes-vous sûr de vouloir supprimer les journaux sélectionnés ?',
    'CONFIRM_CLEAR_OLD_LOGS'            => 'Êtes-vous sûr de vouloir supprimer tous les journaux de plus de 6 mois ? Cette action est irréversible.',
    'CONFIRM_CLEAR_ALL_LOGS'            => 'Êtes-vous sûr de vouloir supprimer TOUS les journaux ? Cette action ne peut pas être annulée !',

    // Avertissement de limite d'affichage
    'ACP_LOGS_MAX_DISPLAY_WARNING'      => 'Il y a plus de 10 000 enregistrements. Pour des raisons de performance, seuls les 10 000 plus récents sont affichés.',

    // Message quand il n'y a pas de logs
    'NO_LOGS_FOUND'                     => 'Aucun enregistrement trouvé',

    // Message d'erreur (si aucun log n'est sélectionné)
    'NO_LOGS_SELECTED'                  => 'Aucun journal n\'a été sélectionné.',

    // Statistiques en haut
    'ACP_SIMPLEDOWN_TOTAL_LOGS'            => 'Total des enregistrements',
    'ACP_SIMPLEDOWN_STATS_TOTAL_DOWNLOADS' => 'Total des téléchargements enregistrés',
    'ACP_SIMPLEDOWN_STATS_TOTAL_VIEWS'     => 'Total des vues enregistrées',
    'ACP_SIMPLEDOWN_STATS_TOTAL_DENIED'    => 'Total des accès refusés enregistrés',
    'ACP_SIMPLEDOWN_STATS_TOP_FILE'        => 'Fichier le plus téléchargé',

    // Filtre (label au-dessus du select)
    'ACP_LOGS_ACTION'                   => 'Action',

    // En-tête du tableau (plus descriptif)
    'ACP_SIMPLEDOWN_LOG_ACTION'         => 'Action',

]);