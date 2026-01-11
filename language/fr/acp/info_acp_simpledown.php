<?php
/**
 * Fichier de langue ACP (Français)
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
    // Titres et Navigation Générale
    // ===================================================================
    'ACP_SIMPLEDOWN_TITLE'              => 'Simple Downloads',
    'ACP_SIMPLEDOWN_SETTINGS'           => 'Paramètres',
    'ACP_SIMPLEDOWN_FILES'              => 'Fichiers',
    'ACP_SIMPLEDOWN_TOOLS'              => 'Outils',
    'ACP_SIMPLEDOWN_LOGS'               => 'Journaux de téléchargements',
    'ACP_SIMPLEDOWN_ADD_FILE'           => 'Ajouter un fichier',
    'ACP_SIMPLEDOWN_EXISTING_FILES'     => 'Fichiers existants',

    // ===================================================================
    // Onglet Paramètres Généraux
    // ===================================================================
    'ACP_SIMPLEDOWN_GENERAL_SETTINGS'   => 'Paramètres généraux',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE'    => 'Taille maximale d\'upload',
    'ACP_SIMPLEDOWN_MAX_UPLOAD_SIZE_EXPLAIN' => 'Limite en Mo pour les fichiers envoyés (par défaut : 100 Mo).',
    'ACP_SIMPLEDOWN_UPLOAD_SIZE'        => 'Mo',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT'   => 'Limite de caractères pour la description courte',
    'ACP_SIMPLEDOWN_SHORT_DESC_LIMIT_EXPLAIN' => 'Nombre maximum de caractères pour la description courte affichée dans les cartes (par défaut : 150).',
    'ACP_SIMPLEDOWN_SITE_THEME'         => 'Thème du site',
    'ACP_SIMPLEDOWN_SITE_THEME_EXPLAIN' => 'Choisissez le thème visuel par défaut (clair ou sombre) affiché sur la page publique de SimpleDown pour tous les visiteurs.',
    'ACP_SIMPLEDOWN_LIGHT_THEME'        => 'Thème clair',
    'ACP_SIMPLEDOWN_DARK_THEME'         => 'Thème sombre',
    'ACP_SIMPLEDOWN_CARDS_PER_ROW'      => 'Nombre de cartes par ligne',
    'ACP_SIMPLEDOWN_CARDS_PER_ROW_EXPLAIN' => 'Définit combien de cartes de téléchargement sont affichées côte à côte sur la page principale.<br />• <strong>3 cartes</strong> : mise en page standard (recommandé pour desktop).<br />• <strong>2 cartes</strong> : mise en page plus large et confortable sur écrans moyens.',
    'ACP_SIMPLEDOWN_CARDS'              => 'cartes par ligne',
    'ACP_SIMPLEDOWN_ALLOW_USER_LAYOUT_CHOICE' => 'Autoriser les utilisateurs à choisir la disposition',
    'ACP_SIMPLEDOWN_ALLOW_USER_LAYOUT_CHOICE_EXPLAIN' => 'Quand activé, les visiteurs pourront basculer entre la vue en grille (cartes) et la vue en liste. Le choix est sauvegardé via cookie.',
    'ACP_SIMPLEDOWN_VIEW_GRID'          => 'Vue en grille',
    'ACP_SIMPLEDOWN_VIEW_LIST'          => 'Vue en liste',
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY' => 'Visibilité par défaut des nouveaux fichiers',
    'ACP_SIMPLEDOWN_DEFAULT_VISIBILITY_EXPLAIN' => 'Cette option définit la valeur pré-sélectionnée (public ou privé) lors de l\'ajout d\'un nouveau fichier.<br /><strong style="color: #c62828;">La configuration individuelle de chaque fichier a toujours la priorité maximale :</strong> si vous marquez un fichier spécifique comme Public, il sera accessible à tous (même si le défaut est Privé), et vice-versa.',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES' => 'Catégories privées',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_EXPLAIN' => 'Sélectionnez les catégories dont les fichiers nécessiteront une connexion pour le téléchargement. Laissez vide pour qu\'aucun fichier ne soit privé par catégorie (le contrôle individuel reste fonctionnel).',
    'ACP_SIMPLEDOWN_PRIVATE_CATEGORIES_HOLD_CTRL' => 'Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs catégories.',
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE'    => 'Message pour les fichiers privés',
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE_EXPLAIN' => 'Ce message est affiché quand un visiteur non connecté tente d\'accéder à un fichier privé ou d\'une catégorie privée.',
    'ACP_SIMPLEDOWN_PRIVATE_MESSAGE_DEFAULT' => 'Ce fichier est réservé aux membres inscrits. Connectez-vous ou inscrivez-vous pour le télécharger.',
    'ACP_SIMPLEDOWN_SAVE_CONFIG'        => 'Enregistrer les paramètres',
    'ACP_SIMPLEDOWN_CONFIG_SAVED'       => 'Paramètres enregistrés avec succès !',

    // ===================================================================
    // Catégories
    // ===================================================================
    'ACP_SIMPLEDOWN_CATEGORY'           => 'Catégorie',
    'ACP_SIMPLEDOWN_CATEGORIES'         => 'Ajouter une catégorie',
    'ACP_SIMPLEDOWN_ADD_CATEGORY'       => 'Ajouter une catégorie',
    'ACP_SIMPLEDOWN_CATEGORY_NAME'      => 'Nom de la catégorie',
    'ACP_SIMPLEDOWN_DELETE_CATEGORY'    => 'Supprimer la catégorie',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_TO_DELETE' => 'Sélectionnez une catégorie à supprimer',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_YET'  => 'Aucune catégorie pour le moment.',
    'ACP_SIMPLEDOWN_NO_CATEGORY'        => 'Sans catégorie',
    'ACP_SIMPLEDOWN_NO_CATEGORY_NAME'   => 'Le nom de la catégorie est obligatoire.',
    'ACP_SIMPLEDOWN_CATEGORY_NOT_FOUND' => 'Catégorie non trouvée.',
    'ACP_SIMPLEDOWN_CATEGORY_DUPLICATE' => 'Cette catégorie existe déjà.',
    'ACP_SIMPLEDOWN_SELECT_CATEGORY_REQUIRED' => 'Veuillez sélectionner une catégorie',
    'ACP_SIMPLEDOWN_CAT_ADDED'          => 'Catégorie ajoutée avec succès !',
    'ACP_SIMPLEDOWN_CAT_DELETED'        => 'Catégorie supprimée avec succès !',
    'ACP_SIMPLEDOWN_CATEGORY_REQUIRED'  => 'Vous devez sélectionner une catégorie valide pour le fichier.',
    'ACP_SIMPLEDOWN_NO_CATEGORIES_EXIST' => 'Aucune catégorie n\'a encore été créée. Créez au moins une catégorie avant d\'ajouter des fichiers.',

    // ===================================================================
    // Gestion des fichiers (Ajout/Édition)
    // ===================================================================
    'ACP_SIMPLEDOWN_FILE_NAME'          => 'Nom du fichier',
    'ACP_SIMPLEDOWN_FILE_NAME_EXPLAIN'  => 'C\'est le nom affiché sur la page des téléchargements.',
    'ACP_SIMPLEDOWN_DISPLAY_NAME'       => 'Nom affiché (titre du téléchargement)',
    'ACP_SIMPLEDOWN_DISPLAY_NAME_EXPLAIN' => 'C\'est le nom que les utilisateurs verront dans la liste des téléchargements. N\'affecte pas le nom du fichier sur le serveur.',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION'  => 'Description courte',
    'ACP_SIMPLEDOWN_SHORT_DESCRIPTION_EXPLAIN' => 'Résumé bref affiché dans les cartes (recommandé 100-150 caractères).',
    'ACP_SIMPLEDOWN_DESCRIPTION'        => 'Description complète',
    'ACP_SIMPLEDOWN_DESCRIPTION_EXPLAIN' => 'Description complète affichée sur la page de détails. Supporte le BBCode.',
    'ACP_SIMPLEDOWN_EDIT_DESCRIPTION'   => 'Modifier la description',
    'ACP_SIMPLEDOWN_VERSION'            => 'Version',
    'ACP_SIMPLEDOWN_VERSION_EXPLAIN'    => 'Optionnel : ex. 1.0, 2.1-beta, Final 2025',
    'ACP_SIMPLEDOWN_VISIBILITY'         => 'Visibilité du fichier',
    'ACP_SIMPLEDOWN_VISIBILITY_EXPLAIN' => 'Définissez si le fichier est public (tout le monde) ou privé (seuls les utilisateurs connectés peuvent télécharger).',
    'ACP_SIMPLEDOWN_PUBLIC'             => 'Public',
    'ACP_SIMPLEDOWN_PRIVATE'            => 'Privé',
    'ACP_SIMPLEDOWN_UPLOAD_FILE'        => 'Envoyer le fichier',
    'ACP_SIMPLEDOWN_REPLACE_FILE'       => 'Remplacer le fichier',
    'ACP_SIMPLEDOWN_REPLACE_FILE_EXPLAIN' => 'Cochez pour envoyer un nouveau fichier. L\'ancien sera supprimé.',
    'ACP_SIMPLEDOWN_REPLACE_FILE_WARNING' => 'L\'ancien fichier sera supprimé définitivement lors de l\'enregistrement.',
    'ACP_SIMPLEDOWN_REPLACE_FILE_HELP'  => 'L\'ancien fichier sera supprimé définitivement. Le nouveau sera enregistré avec un nom nettoyé (peut être renommé automatiquement en cas de conflit).',
    'ACP_SIMPLEDOWN_CURRENT_FILE'       => 'Fichier actuel',
    'ACP_SIMPLEDOWN_CURRENT_SERVER_FILE'=> 'Nom actuel sur le serveur',
    'ACP_SIMPLEDOWN_SIZE'               => 'Taille',
    'ACP_SIMPLEDOWN_DOWNLOADS'          => 'Téléchargements',
    'ACP_SIMPLEDOWN_FILE_ADDED'         => 'Fichier ajouté avec succès !',
    'ACP_SIMPLEDOWN_FILE_EDITED'        => 'Fichier mis à jour avec succès !',
    'ACP_SIMPLEDOWN_FILE_DELETED'       => 'Fichier supprimé avec succès !',
    'ACP_SIMPLEDOWN_NO_FILES_YET'       => 'Aucun fichier pour le moment.',
    'ACP_SIMPLEDOWN_NO_DESCRIPTION'     => 'Aucune description disponible.',
    'ACP_SIMPLEDOWN_TOTAL_FILES'        => 'Total de fichiers',
    'ACP_SIMPLEDOWN_ITEMS_PER_PAGE'     => 'Éléments par page',
    'ACP_SIMPLEDOWN_ALL_ITEMS'          => 'Tous',

    // ===================================================================
    // Miniatures (Thumbnails)
    // ===================================================================
    'ACP_SIMPLEDOWN_UPLOAD_THUMB'       => 'Envoyer une miniature',
    'ACP_SIMPLEDOWN_UPLOAD_THUMB_EXPLAIN' => 'Envoyez une image pour être utilisée comme miniature sur la page de détails. Recommandé : 300x300px ou plus grand.',
    'ACP_SIMPLEDOWN_THUMB_ALREADY_EXISTS_WARNING' => 'Attention : Une miniature avec ce nom existait déjà et a été écrasée.',
    'ACP_SIMPLEDOWN_THUMB_UPLOAD_SUCCESS' => 'Miniature envoyée avec succès !',
    'ACP_SIMPLEDOWN_SELECT_THUMB'       => 'Sélectionner une miniature existante',
    'ACP_SIMPLEDOWN_NO_THUMB'           => 'Aucune miniature',
    'ACP_SIMPLEDOWN_NO_THUMBS'          => 'Aucune miniature trouvée dans le dossier thumbs.',
    'ACP_SIMPLEDOWN_THUMB_PREVIEW'      => 'Aperçu de la miniature',

    // ===================================================================
    // Annonces Automatiques dans les Forums
    // ===================================================================
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE'     => 'Annonces automatiques dans les forums',
    'ACP_SIMPLEDOWN_ANNOUNCE_EXPLAIN'   => 'Quand activé, l\'ajout d\'un nouveau fichier créera automatiquement un sujet dans le forum configuré.',
    'ACP_SIMPLEDOWN_AUTO_ANNOUNCE'      => 'Activer la création automatique de sujets',
    'ACP_SIMPLEDOWN_ANNOUNCE_FORUM'     => 'Forum d\'annonce',
    'ACP_SIMPLEDOWN_NO_FORUM'           => '-- Aucun forum sélectionné --',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE'      => 'Type de sujet créé',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_EXPLAIN' => 'Choisissez le type de sujet qui sera créé automatiquement lors de l\'ajout d\'un fichier.',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_NORMAL'   => 'Normal',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_STICKY'   => 'Épinglé',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_ANNOUNCE' => 'Annonce',
    'ACP_SIMPLEDOWN_ANNOUNCE_TYPE_GLOBAL'   => 'Annonce globale',
    'ACP_SIMPLEDOWN_ANNOUNCE_LOCKED'        => 'Créer un sujet verrouillé',
    'ACP_SIMPLEDOWN_ANNOUNCE_LOCKED_EXPLAIN' => 'Si activé, le sujet d\'annonce sera créé déjà verrouillé (aucune réponse permise).',
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_TEMPLATE' => 'Modèle du titre du sujet',
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_EXPLAIN' => 'Variables disponibles :<br><strong>{NAME}</strong> – Nom du fichier<br><strong>{VERSION}</strong> – Version<br><br><em>Exemple recommandé : [Nouveau Téléchargement] {NAME} v{VERSION}</em>',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_TEMPLATE' => 'Modèle du message du sujet',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_EXPLAIN' => 'Variables disponibles :<br><strong>{NAME}</strong> – Nom du fichier<br><strong>{VERSION}</strong> – Version<br><strong>{DESC_SHORT}</strong> – Description courte<br><strong>{DESC_FORMATTED}</strong> – Description complète avec BBCode<br><strong>{URL_DETAILS}</strong> – Lien vers la page de détails<br><strong>{URL_DOWNLOAD}</strong> – Lien direct de téléchargement<br><br><em>Exemple complet pré-rempli par défaut.</em>',
    'ACP_SIMPLEDOWN_ANNOUNCE_TITLE_TEMPLATE_DEFAULT' => '[Nouveau Téléchargement] {NAME} v{VERSION}',
    'ACP_SIMPLEDOWN_ANNOUNCE_MESSAGE_TEMPLATE_DEFAULT' => "{DESC_FORMATTED}\n\n[center][url={URL_DETAILS}]Télécharger maintenant[/url][/center]",

    // Logs d'actions administratives
    'LOG_SIMPLEDOWN_FILE_DELETED'       => 'A supprimé le fichier « %s »',
    'LOG_SIMPLEDOWN_FILE_EDITED'        => 'A modifié le fichier « %s »',
    'LOG_SIMPLEDOWN_FILE_ADDED'         => 'A ajouté le fichier « %s »',
    'LOG_SIMPLEDOWN_ANNOUNCE_CREATED'   => 'A créé un sujet d\'annonce pour le fichier « %s »',
    'LOG_SIMPLEDOWN_ANNOUNCE_LOCK_TOGGLED' => 'A modifié le statut de verrouillage de l\'annonce du fichier « %1$s » à %2$s',
    'LOG_SIMPLEDOWN_ANNOUNCE_DELETED'   => 'A supprimé le sujet d\'annonce du fichier « %s »',
    'LOG_SIMPLEDOWN_CAT_ADDED'          => 'A ajouté la catégorie « %s »',
    'LOG_SIMPLEDOWN_CAT_DELETED'        => 'A supprimé la catégorie « %s »',
    'LOG_SIMPLEDOWN_THUMB_ADDED'        => 'A ajouté la miniature « %s »',
    'LOG_SIMPLEDOWN_THUMB_DELETED'      => 'A supprimé la miniature « %s »',
    'LOG_SIMPLEDOWN_ORPHAN_DELETED'     => 'A supprimé le fichier orphelin « %s »',
    'LOG_SIMPLEDOWN_LOGS_DELETED'       => 'A supprimé %s entrées de journal',
    'LOG_SIMPLEDOWN_LOGS_CLEARED_OLD'   => 'A nettoyé les anciens journaux (plus de 6 mois)',
    'LOG_SIMPLEDOWN_LOGS_CLEARED_ALL'   => 'A nettoyé tous les journaux de téléchargements',
    'LOG_SIMPLEDOWN_FILE_DOWNLOADED'    => '<strong>%1$s</strong> a téléchargé le fichier « %2$s »',

    // ===================================================================
    // Onglet Journaux de téléchargements
    // ===================================================================
    'ACP_SIMPLEDOWN_LOGS_EXPLAIN'       => 'Journal détaillé de toutes les actions liées aux téléchargements (vues, tentatives bloquées et téléchargements effectifs).',
    'ACP_SIMPLEDOWN_TOTAL_LOGS'         => 'Total d\'entrées',
    'ACP_SIMPLEDOWN_STATS_TOTAL_DOWNLOADS' => 'Total de téléchargements enregistrés',
    'ACP_SIMPLEDOWN_STATS_TOP_FILE'     => 'Fichier le plus téléchargé',
    'ACP_SIMPLEDOWN_LOG_TIME'           => 'Date/Heure',
    'ACP_SIMPLEDOWN_LOG_USERNAME'       => 'Utilisateur',
    'ACP_SIMPLEDOWN_LOG_FILE'           => 'Fichier',
    'ACP_SIMPLEDOWN_LOG_ACTION'         => 'Action',
    'ACP_SIMPLEDOWN_LOG_IP'             => 'Adresse IP',
    'ACP_SIMPLEDOWN_LOG_USER_AGENT'     => 'Navigateur/Appareil',
    'ACP_SIMPLEDOWN_LOG_ACTION_DOWNLOAD'=> 'Téléchargement',
    'ACP_SIMPLEDOWN_LOG_ACTION_PREVIEW' => 'Visualisation',
    'ACP_SIMPLEDOWN_LOG_ACTION_DENIED'  => 'Accès refusé',
    'ACP_SIMPLEDOWN_UNKNOWN_FILE'       => 'Fichier inconnu',
    'ACP_SIMPLEDOWN_NONE'               => 'Aucun',
    'NO_LOGS_FOUND'                     => 'Aucun journal trouvé.',
    'NO_LOGS_SELECTED'                  => 'Aucun journal sélectionné pour suppression.',
    'ACP_SIMPLEDOWN_DELETE_SELECTED'    => 'Supprimer la sélection',
    'ACP_SIMPLEDOWN_CLEAR_OLD_LOGS'     => 'Nettoyer les anciens journaux (plus de 6 mois)',
    'ACP_SIMPLEDOWN_CLEAR_ALL_LOGS'     => 'Nettoyer tous les journaux',
    'CONFIRM_DELETE_SELECTED_LOGS'      => 'Êtes-vous sûr de vouloir supprimer les journaux sélectionnés ?',
    'CONFIRM_CLEAR_OLD_LOGS'            => 'Êtes-vous sûr de vouloir supprimer tous les journaux de plus de 6 mois ?',
    'CONFIRM_CLEAR_ALL_LOGS'            => 'Êtes-vous sûr de vouloir supprimer TOUS les journaux ? Cette action est irréversible !',
    'LOGS_DELETED_SUCCESS'              => '%d journaux supprimés avec succès.',
    'LOGS_CLEARED_OLD_SUCCESS'          => 'Anciens journaux supprimés avec succès.',
    'LOGS_CLEARED_ALL_SUCCESS'          => 'Tous les journaux ont été supprimés avec succès.',

    // ===================================================================
    // Onglet Outils
    // ===================================================================
    'ACP_SIMPLEDOWN_THUMBNAILS_MANAGEMENT' => 'Gestion des miniatures',
    'ACP_SIMPLEDOWN_THUMBNAILS_EXPLAIN_SIMPLE' => 'Liste toutes les miniatures présentes dans le dossier <code>/files/thumbs/</code>.',
    'ACP_SIMPLEDOWN_AVAILABLE_THUMBS'   => 'Miniatures disponibles',
    'ACP_SIMPLEDOWN_SELECT_ONE_THUMB'   => '-- Sélectionnez une miniature --',
    'ACP_SIMPLEDOWN_PREVIEW_TITLE'      => 'Aperçu',
    'ACP_SIMPLEDOWN_DELETE_THIS_THUMB'  => 'Supprimer cette miniature',
    'ACP_SIMPLEDOWN_NO_THUMBS_FOUND'    => 'Aucune miniature trouvée dans le dossier <code>/files/thumbs/</code>.',
    'ACP_SIMPLEDOWN_TOTAL_THUMBS'       => 'Total de miniatures',
    'ACP_SIMPLEDOWN_THUMB_DELETED'      => 'Miniature supprimée avec succès.',
    'ACP_SIMPLEDOWN_ASSOCIATED_FILES'   => 'Fichiers associés',
    'ACP_SIMPLEDOWN_ASSOCIATED_FILES_EXPLAIN' => 'Fichiers présents dans le dossier <code>/files/</code> qui sont liés à un enregistrement actif dans la base de données (en utilisation).',
    'ACP_SIMPLEDOWN_TOTAL_ASSOCIATED'   => 'Total de fichiers associés',
    'ACP_SIMPLEDOWN_NO_ASSOCIATED_FILES'=> 'Aucun fichier associé trouvé.',
    'ACP_SIMPLEDOWN_ORPHAN_FILES_MANAGEMENT' => 'Fichiers orphelins',
    'ACP_SIMPLEDOWN_ORPHAN_FILES_EXPLAIN' => 'Fichiers physiques dans le dossier <code>/files/</code> qui ne sont associés à aucun enregistrement dans la base de données. Peuvent être supprimés en toute sécurité.',
    'ACP_SIMPLEDOWN_AVAILABLE_ORPHAN_FILES' => 'Fichiers orphelins disponibles',
    'ACP_SIMPLEDOWN_SELECT_ONE_FILE'    => '-- Sélectionnez un fichier --',
    'ACP_SIMPLEDOWN_DELETE_THIS_FILE'   => 'Supprimer ce fichier',
    'ACP_SIMPLEDOWN_NO_ORPHAN_FILES_FOUND' => 'Aucun fichier orphelin trouvé.',
    'ACP_SIMPLEDOWN_TOTAL_ORPHAN_FILES' => 'Total de fichiers orphelins',
    'ACP_SIMPLEDOWN_ORPHAN_WARNING'     => 'Attention : ces fichiers ne sont utilisés par aucun téléchargement actif.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETED'     => 'Fichier orphelin supprimé avec succès.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETE_FAILED' => 'Échec de la suppression du fichier orphelin.',
    'ACP_SIMPLEDOWN_ORPHAN_DELETE_WARNING' => 'Vous êtes sur le point de supprimer définitivement le fichier sélectionné du serveur. Cette action est irréversible.',
    'ACP_SIMPLEDOWN_TOOLS_LEGEND'       => 'Contenu personnalisé de l\'onglet Outils',
    'ACP_SIMPLEDOWN_TOOLS_LABEL'        => 'Texte/HTML personnalisé :',
    'ACP_SIMPLEDOWN_TOOLS_EXPLAIN'      => 'Écrivez ici tout contenu que vous souhaitez afficher dans l\'onglet Outils.<br />Supporte le HTML de base (liens, images, listes, gras, etc.).',
    'ACP_SIMPLEDOWN_SAVE_TOOLS_CONTENT' => 'Enregistrer le contenu',

    // ===================================================================
    // Messages généraux et Actions
    // ===================================================================
    'ACP_SIMPLEDOWN_ACTIONS'            => 'Actions',
    'ACP_SIMPLEDOWN_EDIT'               => 'Modifier',
    'ACP_SIMPLEDOWN_DELETE'             => 'Supprimer',
    'ACP_SIMPLEDOWN_SAVE_CHANGES'       => 'Enregistrer les modifications',
    'ACP_SIMPLEDOWN_CANCEL'             => 'Annuler',
    'ACP_SIMPLEDOWN_SEARCH_FILES'       => 'Rechercher des fichiers',
    'ACP_SIMPLEDOWN_SEARCH_PLACEHOLDER'=> 'Entrez le nom du fichier...',
    'ACP_SIMPLEDOWN_VIEW_FULL_DESC'     => 'Voir la description complète',
    'ACP_SIMPLEDOWN_CHOOSE_FILE'        => 'Choisir un fichier',
    'ACP_SIMPLEDOWN_NO_FILE_SELECTED'   => 'Aucun fichier sélectionné',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE'     => 'Êtes-vous sûr de vouloir supprimer ce fichier ? Cette action est irréversible.',
    'ACP_SIMPLEDOWN_CONFIRM_DELETE_FILE'=> 'Êtes-vous sûr de vouloir supprimer ce fichier ? Cette action est irréversible.',

    // ===================================================================
    // Sécurité et Validations
    // ===================================================================
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TITLE' => 'Attention !',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_1' => 'Les fichiers exécutables (.exe, .bat, .js, .vbs, etc.) sont <strong>bloqués automatiquement</strong>.',
    'ACP_SIMPLEDOWN_SECURITY_WARNING_TEXT_2' => 'Évitez d\'envoyer des fichiers potentiellement malveillants.',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TITLE'=> 'Fichiers autorisés',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_1' => 'Formats autorisés :',
    'ACP_SIMPLEDOWN_ALLOWED_FILES_TEXT_2' => 'PDF, ZIP, RAR, 7Z, DOC/DOCX, XLS/XLSX, PPT/PPTX, images, TXT, MP3/WAV/OGG, MP4/AVI/MKV/MOV.',
    'ACP_SIMPLEDOWN_NO_FILE_UPLOADED'   => 'Aucun fichier envoyé.',
    'ACP_SIMPLEDOWN_FILE_TOO_LARGE'     => 'Fichier trop volumineux. Limite maximale : %d Mo.',
    'ACP_SIMPLEDOWN_INVALID_MIME_TYPE'  => 'Type de fichier invalide.',
    'ACP_SIMPLEDOWN_DANGEROUS_FILE'     => 'Envoi bloqué : les fichiers exécutables ou malveillants ne sont pas autorisés.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE'     => 'Ce fichier a déjà été envoyé.',
    'ACP_SIMPLEDOWN_FILE_DUPLICATE_DETECTED' => 'Ce fichier a déjà été envoyé précédemment sous le nom « <strong>%1$s</strong> » (nom sur le serveur : <code>%2$s</code>).<br />Utilisez l\'onglet <strong>Fichiers</strong> pour le modifier ou envoyez une version différente.',
    'ACP_SIMPLEDOWN_UPLOAD_FAILED'      => 'Échec de l\'envoi du fichier.',
    'ACP_SIMPLEDOWN_UPLOAD_DIR_ERROR'   => 'Erreur lors de la création du dossier d\'upload.',
    'ACP_SIMPLEDOWN_FILE_NOT_FOUND'     => 'Fichier non trouvé.',
    'ACP_SIMPLEDOWN_FILE_NAME_REQUIRED' => 'Le nom du fichier est obligatoire.',
    'ACP_SIMPLEDOWN_THUMB_NOT_FOUND'    => 'Miniature non trouvée.',

    // ===================================================================
    // Messages génériques et BBCode
    // ===================================================================
    'ACP_SIMPLEDOWN_ERROR'              => 'Erreur',
    'ACP_SIMPLEDOWN_SUCCESS'            => 'Succès',
    'ACP_SIMPLEDOWN_CLOSE'              => 'Fermer',
    'ACP_SIMPLEDOWN_WARNING'            => 'Attention',
    'CHARACTERS'                        => 'caractères',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_TITLE'  => 'Taille de la police',
    'ACP_SIMPLEDOWN_BBCODE_SIZE'        => 'Taille',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_VERY_SMALL' => '50% (très petit)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_SMALL'  => '85% (petit)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_NORMAL' => '100% (normal)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_LARGE'  => '150% (grand)',
    'ACP_SIMPLEDOWN_BBCODE_SIZE_VERY_LARGE' => '200% (très grand)',

    // ===================================================================
    // Validations standards phpBB
    // ===================================================================
    'TOO_FEW_CHARS'                     => 'La valeur fournie contient trop peu de caractères.',
    'TOO_MANY_CHARS'                    => 'La valeur fournie contient trop de caractères.',
    'TOO_SMALL'                         => 'La valeur fournie est trop petite.',
    'TOO_LARGE'                         => 'La valeur fournie est trop grande.',

    // ===================================================================
    // Barre d'outils BBCode
    // ===================================================================
    'ACP_SIMPLEDOWN_BBCODE_BOLD'        => 'Gras',
    'ACP_SIMPLEDOWN_BBCODE_ITALIC'      => 'Italique',
    'ACP_SIMPLEDOWN_BBCODE_UNDERLINE'   => 'Souligné',
    'ACP_SIMPLEDOWN_BBCODE_QUOTE'       => 'Citation',
    'ACP_SIMPLEDOWN_BBCODE_CODE'        => 'Code',
    'ACP_SIMPLEDOWN_BBCODE_URL'         => 'Lien',
    'ACP_SIMPLEDOWN_BBCODE_IMG'         => 'Image',
    'ACP_SIMPLEDOWN_BBCODE_LIST'        => 'Liste',
    'ACP_SIMPLEDOWN_BBCODE_COLOR'       => 'Couleur',

    'CONFIRM_DELETE_FILE'               => 'Êtes-vous sûr de vouloir supprimer ce fichier ?<br /><br /><strong>Attention :</strong> Cette action est irréversible et supprimera également définitivement le sujet d\'annonce associé et toutes ses réponses sur le forum.',
]);