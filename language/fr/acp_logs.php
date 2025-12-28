<?php
/**
 * SimpleDown - Fichier de langue ACP Logs (Français)
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
    // Titre et description de la page
    'ACP_SIMPLEDOWN_LOGS' => 'Journaux de téléchargements',
    'ACP_SIMPLEDOWN_LOGS_EXPLAIN' => 'Enregistrement détaillé de toutes les actions liées aux téléchargements : consultations, tentatives bloquées et téléchargements réussis.',
    // En-têtes du tableau
    'ACP_SIMPLEDOWN_LOG_TIME' => 'Date/Heure',
    'ACP_SIMPLEDOWN_LOG_USERNAME' => 'Utilisateur',
    'ACP_SIMPLEDOWN_LOG_FILE' => 'Fichier',
    'ACP_SIMPLEDOWN_LOG_ACTION' => 'Action',
    'ACP_SIMPLEDOWN_LOG_IP' => 'Adresse IP',
    'ACP_SIMPLEDOWN_LOG_USER_AGENT' => 'Navigateur/Appareil',
    // Valeurs spéciales
    'ACP_SIMPLEDOWN_UNKNOWN_FILE' => 'Fichier inconnu',
    'ACP_SIMPLEDOWN_NONE' => 'Aucun',
    // Filtres
    'ACP_LOGS_FILTER_USERNAME' => 'Filtrer par utilisateur',
    'ACP_LOGS_ACTION_DOWNLOAD' => 'Téléchargement',
    'ACP_LOGS_ACTION_PREVIEW' => 'Consultation',
    'ACP_LOGS_ACTION_DENIED' => 'Accès refusé',
    'DATE_FROM' => 'Du',
    'DATE_TO' => 'Au',
    'ALL' => 'Tous',
    // Légende du fieldset (filtres et actions)
    'ACP_LOGS_FILTERS_ACTIONS' => 'Filtres et Actions en masse',
    // Boutons d’action
    'ACP_LOGS_CLEAR_ALL' => 'Vider tous les journaux',
    'ACP_LOGS_CLEAR_OLD' => 'Vider les journaux anciens (6 mois)',
    // Bouton de suppression sélective
    'DELETE_SELECTED' => 'Supprimer la sélection',
    // Messages de succès
    'LOGS_DELETED_SUCCESS' => '%d journal(aux) supprimé(s) avec succès.',
    'LOGS_CLEARED_OLD_SUCCESS' => 'Les journaux anciens (plus de 6 mois) ont été supprimés avec succès.',
    'LOGS_CLEARED_ALL_SUCCESS' => 'Tous les journaux ont été supprimés avec succès.',
    // Messages de confirmation
    'CONFIRM_DELETE_SELECTED_LOGS' => 'Êtes-vous sûr de vouloir supprimer les journaux sélectionnés ?',
    'CONFIRM_CLEAR_OLD_LOGS' => 'Êtes-vous sûr de vouloir supprimer tous les journaux de plus de 6 mois ? Cette action est irréversible.',
    'CONFIRM_CLEAR_ALL_LOGS' => 'Êtes-vous sûr de vouloir supprimer TOUS les journaux ? Cette action ne peut pas être annulée !',
    // Avertissement de limite d’affichage
    'ACP_LOGS_MAX_DISPLAY_WARNING' => 'Il existe plus de 10 000 enregistrements. Pour des raisons de performance, seuls les 10 000 plus récents sont affichés.',
    // Message quand aucun log
    'NO_LOGS_FOUND' => 'Aucun enregistrement trouvé',
    // Message d’erreur (aucun log sélectionné)
    'NO_LOGS_SELECTED' => 'Aucun journal n’a été sélectionné.',
    // Statistiques en haut
    'ACP_SIMPLEDOWN_TOTAL_LOGS' => 'Total d’enregistrements',
    'ACP_SIMPLEDOWN_STATS_TOTAL_DOWNLOADS' => 'Total de téléchargements enregistrés',
    'ACP_SIMPLEDOWN_STATS_TOP_FILE' => 'Fichier le plus téléchargé',
    // Label du filtre au-dessus du select
    'ACP_LOGS_ACTION' => 'Action',
    // En-tête du tableau (plus descriptif)
    'ACP_SIMPLEDOWN_LOG_ACTION' => 'Action',
]);