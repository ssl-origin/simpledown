<?php
/**
 * Fichier de langue ACP (Français)
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
    // ===================================================================
    // Titres et Navigation Générale
    // ===================================================================
    'ACP_SIMPLEDOWN_TITLE' => 'Simple Downloads',
    'ACP_SIMPLEDOWN_SETTINGS' => 'Paramètres',
    'ACP_SIMPLEDOWN_FILES' => 'Fichiers',
    'ACP_SIMPLEDOWN_TOOLS' => 'Outils',
    'ACP_SIMPLEDOWN_LOGS' => 'Journaux de téléchargement', // ← AJOUTÉ
    'ACP_SIMPLEDOWN_ADD_FILE' => 'Ajouter un fichier',
    'ACP_SIMPLEDOWN_EXISTING_FILES' => 'Fichiers existants',
    // ===================================================================
    // Onglet Journaux de téléchargement
    // ===================================================================
    'ACP_SIMPLEDOWN_LOGS_EXPLAIN' => 'Enregistrement détaillé de toutes les actions liées aux téléchargements (consultations, tentatives bloquées et téléchargements réussis).',
    'ACP_SIMPLEDOWN_TOTAL_LOGS' => 'Total d’enregistrements',
    'ACP_SIMPLEDOWN_FILTER_BY_USERNAME' => 'Filtrer par utilisateur',
    'ACP_SIMPLEDOWN_FILTER_BY_ACTION' => 'Filtrer par action',
    'ACP_SIMPLEDOWN_FILTER_BY_DATE' => 'Filtrer par date',
    'ACP_SIMPLEDOWN_FROM' => 'Du',
    'ACP_SIMPLEDOWN_TO' => 'Au',
    'ACP_SIMPLEDOWN_CLEAR_FILTERS' => 'Effacer les filtres',
    'ACP_SIMPLEDOWN_LOG_TIME' => 'Date/Heure',
    'ACP_SIMPLEDOWN_LOG_USERNAME' => 'Utilisateur',
    'ACP_SIMPLEDOWN_LOG_IP' => 'Adresse IP',
    'ACP_SIMPLEDOWN_LOG_ACTION' => 'Action',
    'ACP_SIMPLEDOWN_LOG_FILE' => 'Fichier',
    'ACP_SIMPLEDOWN_LOG_USER_AGENT' => 'Navigateur/Appareil',
    'ACP_SIMPLEDOWN_LOG_ACTION_DOWNLOAD' => 'Téléchargement',
    'ACP_SIMPLEDOWN_LOG_ACTION_PREVIEW' => 'Consultation',
    'ACP_SIMPLEDOWN_LOG_ACTION_DENIED' => 'Accès refusé',
    'ACP_SIMPLEDOWN_UNKNOWN_FILE' => 'Fichier inconnu',
    'ACP_SIMPLEDOWN_NONE' => 'Aucun',
    // Actions en masse
    'ACP_SIMPLEDOWN_DELETE_SELECTED' => 'Supprimer la sélection',
    'ACP_SIMPLEDOWN_CLEAR_OLD_LOGS' => 'Supprimer les journaux anciens (plus de 6 mois)',
    'ACP_SIMPLEDOWN_CLEAR_ALL_LOGS' => 'Supprimer tous les journaux',
    // Confirmations
    'CONFIRM_DELETE_SELECTED_LOGS' => 'Êtes-vous sûr de vouloir supprimer les journaux sélectionnés ?',
    'CONFIRM_CLEAR_OLD_LOGS' => 'Êtes-vous sûr de vouloir supprimer tous les journaux de plus de 6 mois ?',
    'CONFIRM_CLEAR_ALL_LOGS' => 'Êtes-vous sûr de vouloir supprimer TOUS les journaux ? Cette action est irréversible !',
    // Messages de succès
    'LOGS_DELETED_SUCCESS' => '%d journaux supprimés avec succès.',
    'LOGS_CLEARED_OLD_SUCCESS' => 'Les journaux anciens ont été supprimés avec succès.',
    'LOGS_CLEARED_ALL_SUCCESS' => 'Tous les journaux ont été supprimés avec succès.',
    // Statistiques
    'ACP_SIMPLEDOWN_STATS_TOTAL_DOWNLOADS' => 'Total de téléchargements enregistrés',
    'ACP_SIMPLEDOWN_STATS_TOP_FILE' => 'Fichier le plus téléchargé',
    // ===================================================================
    // Paramètres généraux
    // ===================================================================
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE' => 'Taille maximale d’upload',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE_EXPLAIN' => 'Limite en Mo pour les fichiers envoyés (par défaut : 100 Mo).',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT' => 'Limite de caractères pour la description courte',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT_EXPLAIN' => 'Nombre maximum de caractères pour la description courte affichée sur les cartes (par défaut : 150).',
    // Contrôle de confidentialité par catégories
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES' => 'Catégories privées',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_EXPLAIN' => 'Sélectionnez les catégories dont les fichiers nécessiteront une connexion pour être téléchargés. Laissez vide pour aucune confidentialité par catégorie (le contrôle individuel reste actif).',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_HOLD_CTRL'=> 'Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs catégories.',
    // Visibilité par défaut pour les nouveaux fichiers
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY' => 'Visibilité par défaut pour les nouveaux fichiers',
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY_EXPLAIN' => 'Cette option définit la valeur pré-sélectionnée (publique ou privée) lors de l’ajout d’un nouveau fichier.<br /><strong style="color: #c62828;">Les paramètres individuels des fichiers ont toujours la priorité maximale :</strong> si vous marquez un fichier spécifique comme Public, il sera accessible à tous (même si le défaut est Privé), et vice versa.',
    'ACP_SIMPLEDOWN_SAVE_CONFIG' => 'Enregistrer les paramètres',
    // ===================================================================
    // Mise en page de la page publique
    // ===================================================================
    'ACP_SIMPLEDOWN_CARDS_PER_ROW' => 'Nombre de cartes par ligne',
    'ACP_SIMPLEDOWN_CARDS_PER_ROW_EXPLAIN' => 'Définit combien de cartes de téléchargement sont affichées côte à côte sur la page principale.<br />• <strong>3 cartes</strong> : disposition par défaut (recommandée pour ordinateurs).<br />• <strong>2 cartes</strong> : disposition plus large et confortable sur écrans moyens.',
    'ACP_SIMPLEDOWN_CARDS' => 'cartes par ligne',
    'ACP_SIMPLEDOWN_ALLOW_USER_LAYOUT_CHOICE' => 'Permettre aux utilisateurs de choisir la mise en page',
    'ACP_SIMPLEDOWN_ALLOW_USER_LAYOUT_CHOICE_EXPLAIN' => 'Lorsque activé, les visiteurs peuvent basculer entre vue en grille (cartes) et vue en liste sur la page publique. Le choix est sauvegardé dans un cookie.',
    'ACP_SIMPLEDOWN_VIEW_GRID' => 'Vue en grille',
    'ACP_SIMPLEDOWN_VIEW_LIST' => 'Vue en liste',
    // ===================================================================
    // Gestion des catégories
    // ===================================================================
    'ACP_SIMPLEDOWN_CATEGORY' => 'Catégorie',
    'ACP_SIMPLEDOWN_ADD_CATEGORY' => 'Ajouter une catégorie',
    'ACP_SIMPLEDOWN_CATEGORY_NAME' => 'Nom de la catégorie',
    'ACP_SIMPLEDOWN_DELETE_CATEGORY' => 'Supprimer la catégorie',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_TO_DELETE' => 'Sélectionnez une catégorie à supprimer',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_YET' => 'Aucune catégorie pour le moment.',
    'ACP_SIMPLEDOWN_NO_CATEGORY' => 'Sans catégorie',
    'ACP_SIMPLEDOWN_NO_CATEGORY_NAME' => 'Le nom de la catégorie est obligatoire.',
    'ACP_SIMPLEDOWN_CATEGORY_NOT_FOUND' => 'Catégorie non trouvée.',
    'ACP_SIMPLEDOWN_CATEGORY_DUPLICATE' => 'Cette catégorie existe déjà.',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_REQUIRED' => 'Sélectionnez une catégorie',
    // ===================================================================
    // Gestion des fichiers
    // ===================================================================
    'ACP_SIMPLEDOWN_FILE_NAME' => 'Nom du fichier',
    'ACP_SIMPLEDOWN_FILE_NAME_EXPLAIN' => 'C’est le nom affiché sur la page des téléchargements.',
    'ACP_SIMPLEDOWN_DISPLAY_NAME' => 'Nom affiché (titre du téléchargement)',
    'ACP_SIMPLEDOWN_DISPLAY_NAME_EXPLAIN' => 'C’est le nom que les utilisateurs verront dans la liste des téléchargements. Il n’affecte pas le nom réel du fichier sur le serveur.',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION' => 'Description courte',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION_EXPLAIN' => 'Résumé bref affiché sur les cartes (recommandé 100-150 caractères).',
    'ACP_SIMPLEDOWN_DESCRIPTION' => 'Description complète',
    'ACP_SIMPLEDOWN_DESCRIPTION_EXPLAIN' => 'Description complète affichée sur la page de détails.',
    'ACP_SIMPLEDOWN_EDIT_DESCRIPTION' => 'Modifier la description',
    'ACP_SIMPLEDOWN_UPLOAD_FILE' => 'Envoyer un fichier',
    'ACP_SIMPLEDOWN_SIZE' => 'Taille',
    'ACP_SIMPLEDOWN_NO_FILES_YET' => 'Aucun fichier pour le moment.',
    'ACP_SIMPLEDOWN_NO_DESCRIPTION' => 'Aucune description disponible.',
    'ACP_SIMPLEDOWN_VERSION' => 'Version',
    'ACP_SIMPLEDOWN_VERSION_EXPLAIN' => 'Optionnel : ex. 1.0, 2.1-beta, Finale 2025',
    'ACP_SIMPLEDOWN_REPLACE_FILE' => 'Remplacer le fichier',
    'ACP_SIMPLEDOWN_REPLACE_FILE_EXPLAIN' => 'Cochez pour envoyer un nouveau fichier. L’ancien sera supprimé.',
    'ACP_SIMPLEDOWN_REPLACE_FILE_WARNING' => 'L’ancien fichier sera supprimé définitivement lors de l’enregistrement.',
    'ACP_SIMPLEDOWN_REPLACE_FILE_HELP' => 'L’ancien fichier sera supprimé définitivement. Le nouveau sera enregistré avec un nom sanitizé (peut être renommé automatiquement en cas de conflit).',
    'ACP_SIMPLEDOWN_CURRENT_FILE' => 'Fichier actuel',
    'ACP_SIMPLEDOWN_CURRENT_SERVER_FILE' => 'Nom actuel sur le serveur',
    // ===================================================================
    // Visibilité Publique/Privée (individuelle)
    // ===================================================================
    'ACP_SIMPLEDOWN_VISIBILITY' => 'Visibilité du fichier',
    'ACP_SIMPLEDOWN_VISIBILITY_EXPLAIN' => 'Définissez si le fichier est public (tout visiteur) ou privé (seuls les utilisateurs connectés peuvent télécharger).',
    'ACP_SIMPLEDOWN_PUBLIC' => 'Public',
    'ACP_SIMPLEDOWN_PRIVATE' => 'Privé',
    // ===================================================================
    // Miniatures
    // ===================================================================
    'ACP_SIMPLEDOWN_UPLOAD_THUMB' => 'Envoyer une miniature',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB_EXPLAIN' => 'Envoyez une image à utiliser comme miniature sur la page de détails. Recommandé : 300x300px ou plus.',
    'ACP_SIMPLEDOWN_THUMB_ALREADY_EXISTS_WARNING' => 'Attention : une miniature portant ce nom existait déjà et a été écrasée.',
    'ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS' => 'Miniature envoyée avec succès !',
    'ACP_SIMPLEDOWN_SELECT_THUMB' => 'Sélectionner une miniature existante',
    'ACP_SIMPLEDOWN_NO_THUMB' => 'Aucune miniature',
    'ACP_SIMPLEDOWN_NO_THUMBS' => 'Aucune miniature trouvée dans le dossier thumbs.',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW' => 'Aperçu de la miniature',
    // ===================================================================
    // Tableau et contrôles
    // ===================================================================
    'ACP_SIMPLEDOWN_DOWNLOADS' => 'Téléchargements',
    'ACP_SIMPLEDOWN_ACTIONS' => 'Actions',
    'ACP_SIMPLEDOWN_EDIT' => 'Modifier',
    'ACP_SIMPLEDOWN_DELETE' => 'Supprimer',
    'ACP_SIMPLEDOWN_SAVE_CHANGES' => 'Enregistrer les modifications',
    'ACP_SIMPLEDOWN_CANCEL' => 'Annuler',
    'ACP_SIMPLEDOWN_TOTAL_FILES' => 'Total de fichiers',
    'ACP_SIMPLEDOWN_ITEMS_PER_PAGE' => 'Éléments par page',
    'ACP_SIMPLEDOWN_ALL_ITEMS' => 'Tous',
    // ===================================================================
    // Avertissements et sécurité
    // ===================================================================
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TITLE' => 'Attention !',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_1' => 'Les fichiers exécutables (.exe, .bat, .js, .vbs, etc.) sont <strong>bloqués automatiquement</strong>.',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_2' => 'Évitez d’envoyer des fichiers potentiellement malveillants.',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TITLE' => 'Fichiers autorisés',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_1' => 'Formats autorisés :',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_2' => 'PDF, ZIP, RAR, 7Z, DOC/DOCX, XLS/XLSX, PPT/PPTX, images, TXT, MP3/WAV/OGG, MP4/AVI/MKV/MOV.',
    // ===================================================================
    // Messages de succès
    // ===================================================================
    'ACP_SIMPLEDOWN_CONFIG_SAVED' => 'Paramètres enregistrés avec succès !',
    'ACP_SIMPLEDOWN_CAT_ADDED' => 'Catégorie ajoutée avec succès !',
    'ACP_SIMPLEDOWN_CAT_DELETED' => 'Catégorie supprimée avec succès !',
    'ACP_SIMPLEDOWN_FILE_ADDED' => 'Fichier ajouté avec succès !',
    'ACP_SIMPLEDOWN_FILE_EDITED' => 'Fichier mis à jour avec succès !',
    'ACP_SIMPLEDOWN_FILE_DELETED' => 'Fichier supprimé avec succès !',
    'ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS' => 'Miniature envoyée avec succès !',
    'ACP_SIMPLEDOWN_ORPHANS_DELETED' => '%d miniatures orphelines ont été supprimées.',
    'ACP_SIMPLEDOWN_THUMB_DELETED' => 'Miniature supprimée avec succès.',
    // ===================================================================
    // Erreurs et validation
    // ===================================================================
    'ACP_SIMPLEDOWN_NO_FILE_UPLOADED' => 'Aucun fichier envoyé.',
    'ACP_SIMPLEDOWN_CATEGORY_REQUIRED' => 'Vous devez sélectionner une catégorie valide pour le fichier.',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_EXIST' => 'Aucune catégorie n’a encore été créée. Créez au moins une catégorie avant d’ajouter des fichiers.',
    'ACP_SIMPLEDOWN_FILE_TOO_LARGE' => 'Fichier trop volumineux. Limite maximale : %d Mo.',
    'ACP_SIMPLEDOWN_INVALID_MIME_TYPE' => 'Type de fichier invalide.',
    'ACP_SIMPLEDOWN_DANGEROUS_FILE' => 'Envoi bloqué : les fichiers exécutables ou malveillants ne sont pas autorisés.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE' => 'Ce fichier a déjà été envoyé.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE_DETECTED' => 'Ce fichier a déjà été envoyé précédemment sous le nom "<strong>%1$s</strong>" (nom sur le serveur : <code>%2$s</code>).<br />Utilisez l’onglet <strong>Fichiers</strong> pour le modifier ou envoyez une version différente.',
    'ACP_SIMPLEDOWN_UPLOAD_FAILED' => 'Échec de l’envoi du fichier.',
    'ACP_SIMPLEDOWN_UPLOAD_DIR_ERROR' => 'Erreur lors de la création du répertoire d’upload.',
    'ACP_SIMPLEDOWN_FILE_NOT_FOUND' => 'Fichier non trouvé.',
    'ACP_SIMPLEDOWN_FILE_NAME_REQUIRED' => 'Le nom du fichier est obligatoire.',
    'ACP_SIMPLEDOWN_THUMB_NOT_FOUND' => 'Miniature non trouvée.',
    // ===================================================================
    // Clés pour upload personnalisé et recherche
    // ===================================================================
    'ACP_SIMPLEDOWN_CHOOSE_FILE' => 'Choisir un fichier',
    'ACP_SIMPLEDOWN_NO_FILE_SELECTED' => 'Aucun fichier sélectionné',
    'ACP_SIMPLEDOWN_SEARCH_FILES' => 'Rechercher des fichiers',
    'ACP_SIMPLEDOWN_SEARCH_PLACEHOLDER' => 'Saisissez le nom du fichier...',
    'ACP_SIMPLEDOWN_VIEW_FULL_DESC' => 'Voir la description complète',
    // ===================================================================
    // Modal et messages généraux
    // ===================================================================
    'ACP_SIMPLEDOWN_ERROR' => 'Erreur',
    'ACP_SIMPLEDOWN_SUCCESS' => 'Succès',
    'ACP_SIMPLEDOWN_CLOSE' => 'Fermer',
    'ACP_SIMPLEDOWN_WARNING' => 'Attention',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE' => 'Êtes-vous sûr de vouloir supprimer ce fichier ? Cette action est irréversible.',
    'CHARACTERS' => 'caractères',
    // ===================================================================
    // Onglet Outils
    // ===================================================================
    'ACP_SIMPLEDOWN_TOOLS_LEGEND' => 'Contenu personnalisé de l’onglet Outils',
    'ACP_SIMPLEDOWN_TOOLS_LABEL' => 'Texte/HTML personnalisé :',
    'ACP_SIMPLEDOWN_TOOLS_EXPLAIN' => 'Écrivez ici tout contenu que vous souhaitez afficher dans l’onglet Outils.<br />Supporte le HTML de base (liens, images, listes, gras, etc.).',
    'ACP_SIMPLEDOWN_SAVE_TOOLS_CONTENT' => 'Enregistrer le contenu',
    // Gestion des miniatures
    'ACP_SIMPLEDOWN_THUMBNAILS_MANAGEMENT' => 'Gestion des miniatures',
    'ACP_SIMPLEDOWN_THUMBNAILS_EXPLAIN_SIMPLE' => 'Sélectionnez une miniature ci-dessous pour voir les détails et l’option de suppression.',
    'ACP_SIMPLEDOWN_AVAILABLE_THUMBS' => 'Miniatures disponibles :',
    'ACP_SIMPLEDOWN_SELECT_ONE_THUMB' => '-- Sélectionnez une image --',
    'ACP_SIMPLEDOWN_PREVIEW_TITLE' => 'Aperçu :',
    'ACP_SIMPLEDOWN_DELETE_THIS_THUMB' => 'Supprimer cette miniature',
    'ACP_SIMPLEDOWN_NO_THUMBS_FOUND' => 'Aucune miniature trouvée dans le dossier <code>/files/thumbs/</code>.',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE_THUMB' => 'Êtes-vous sûr de vouloir supprimer la miniature "%s" ?',
    'ACP_SIMPLEDOWN_CONFIRM_CLEAN_THUMBS' => 'Êtes-vous sûr de vouloir supprimer toutes les miniatures orphelines ?',
    'ACP_SIMPLEDOWN_ORPHAN_THUMB' => 'Orpheline (non utilisée)',
    'ACP_SIMPLEDOWN_TOTAL_THUMBS' => 'Total de miniatures',
    'ACP_SIMPLEDOWN_ORPHAN_THUMBS' => 'Miniatures orphelines',
    'ACP_SIMPLEDOWN_CLEAN_ORPHAN_THUMBS' => 'Supprimer toutes les miniatures orphelines',
    // ===================================================================
    // Gestion des fichiers orphelins (dossier /files/)
    // ===================================================================
    'ACP_SIMPLEDOWN_ORPHAN_FILES_MANAGEMENT' => 'Gestion des fichiers orphelins',
    'ACP_SIMPLEDOWN_ORPHAN_FILES_EXPLAIN' => 'Liste les fichiers physiques dans le dossier <code>ext/mundophpbb/simpledown/files/</code> qui ne sont associés à aucun enregistrement dans la base de données (fichiers orphelins).',
    'ACP_SIMPLEDOWN_AVAILABLE_ORPHAN_FILES' => 'Fichiers orphelins disponibles :',
    'ACP_SIMPLEDOWN_SELECT_ONE_FILE' => '-- Sélectionnez un fichier --',
    'ACP_SIMPLEDOWN_DELETE_THIS_FILE' => 'Supprimer ce fichier',
    'ACP_SIMPLEDOWN_NO_ORPHAN_FILES_FOUND' => 'Aucun fichier orphelin trouvé dans le dossier <code>/files/</code>.',
    'ACP_SIMPLEDOWN_FILE_DELETED' => 'Fichier orphelin supprimé avec succès.',
    'ACP_SIMPLEDOWN_FILE_DELETE_FAILED' => 'Échec de la suppression du fichier orphelin.',
    'ACP_SIMPLEDOWN_TOTAL_ORPHAN_FILES' => 'Total de fichiers orphelins trouvés',
    'ACP_SIMPLEDOWN_ORPHAN_DELETE_WARNING' => 'Vous êtes sur le point de supprimer définitivement le fichier sélectionné du serveur.',
    // ===================================================================
    // Thème du site public
    // ===================================================================
    'ACP_SIMPLEDOWN_THEME' => 'Thème de l’interface',
    'ACP_SIMPLEDOWN_SITE_THEME' => 'Thème du site',
    'ACP_SIMPLEDOWN_SITE_THEME_EXPLAIN' => 'Choisissez le thème visuel par défaut (clair ou sombre) qui sera affiché sur la page publique de SimpleDown pour tous les visiteurs.',
    'ACP_SIMPLEDOWN_LIGHT_THEME' => 'Thème clair',
    'ACP_SIMPLEDOWN_DARK_THEME' => 'Thème sombre',
]);