<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dick Crud Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the CRUD interface.
    | You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // Create form
    'add'                 => 'Ajouter',
    'back_to_all'         => 'Retour à la liste ',
    'cancel'              => 'Annuler',
    'add_a_new'           => 'Ajouter un nouvel élément ',

        // Create form - advanced options
        'after_saving'            => 'Après enregistrement',
        'go_to_the_table_view'    => 'retourner à la liste',
        'let_me_add_another_item' => 'ajouter un autre élément',
        'edit_the_new_item'       => 'modifier l’élément ajouté',

    // Edit form
    'edit'                 => 'Modifier',
    'save'                 => 'Enregistrer',

    // Revisions
    'revisions'            => 'Révisions',
    'no_revisions'         => 'Pas de révisions',
    'created_this'          => 'Créé Cette',
    'changed_the'          => 'Modifié le',
    'restore_this_value'   => 'Restaurer Cette valeur',
    'from'                 => 'De',
    'to'                   => 'À',
    'undo'                 => 'annuler',
    'revision_restored'    => 'révision Restauré',

    // CRUD table view
    'all'                       => 'Tous les ',
    'in_the_database'           => 'en base de donnée',
    'list'                      => 'Liste',
    'actions'                   => 'Actions',
    'preview'                   => 'Aperçu',
    'delete'                    => 'Supprimer',
    'admin'                     => 'Administration',
    'details_row'               => 'Ligne de détail. Modifiez la à volonté.',
    'details_row_loading_error' => 'Une erreur est survenue en chargeant les détails. Veuillez réessayer.',

        // Confirmation messages and bubbles
        'delete_confirm'                              => 'Souhaitez-vous réelement supprimer cet élément?',
        'delete_confirmation_title'                   => 'Élément supprimé',
        'delete_confirmation_message'                 => 'L’élément a été supprimé avec succès.',
        'delete_confirmation_not_title'               => 'NON supprimé',
        'delete_confirmation_not_message'             => 'Une erreur est survenue. Votre élément n’a peut-être pas été effacé.',
        'delete_confirmation_not_deleted_title'       => 'Non supprimé',
        'delete_confirmation_not_deleted_message'     => 'Aucune modification. Votre élément a été conservé.',

        // DataTables translation
        'emptyTable'     => 'Aucune donnée à afficher.',
        'info'           => 'Affichage des éléments _START_ à _END_ sur _TOTAL_',
        'infoEmpty'      => 'Affichage des éléments 0 à 0 sur 0',
        'infoFiltered'   => '(filtré à partir de _MAX_ éléments au total)',
        'infoPostFix'    => '',
        'thousands'      => ',',
        'lengthMenu'     => '_MENU_ enregistrement par page',
        'loadingRecords' => 'Chargement...',
        'processing'     => 'Traitement...',
        'search'         => 'Recherche: ',
        'zeroRecords'    => 'Aucun enregistrement correspondant trouvé',
        'paginate'       => [
            'first'    => 'Premier',
            'last'     => 'Dernier',
            'next'     => 'Suivant',
            'previous' => 'Précédent',
        ],
        'aria' => [
            'sortAscending'  => ': activez pour trier la colonne par ordre croissant',
            'sortDescending' => ': activez pour trier la colonne par ordre décroissant',
        ],

    // global crud - errors
    'unauthorized_access' => 'Accès non autorisé - vous n’avez pas les droits nécessaires à la consultation de cette page.',
    'please_fix' => 'Veuillez corriger les erreurs suivantes:',

    // global crud - success / error notification bubbles
    'insert_success' => 'L’élément a été ajouté avec succès.',
    'update_success' => 'L’élément a été modifié avec succès.',

    // CRUD reorder view
    'reorder'                      => 'Réordonner',
    'reorder_text'                 => 'Utilisez le glisser-déposer pour réordonner.',
    'reorder_success_title'        => 'Fait',
    'reorder_success_message'      => 'L’ordre a été enregistré.',
    'reorder_error_title'          => 'Erreur',
    'reorder_error_message'        => 'L’ordre n’a pas pu être enregistré.',

    // CRUD yes/no
    'yes' => 'Oui',
    'no' => 'Non',

    // Fields
    'browse_uploads' => 'Parcourir les fichier chargés',
    'clear' => 'Effacer',
    'page_link' => 'Lien de la page',
    'page_link_placeholder' => 'http://example.com/votre-page',
    'internal_link' => 'Lien interne',
    'internal_link_placeholder' => 'Identifiant de lien interne. Ex: \'admin/page\' (sans guillemets) pour \':url\'',
    'external_link' => 'Lien externe',
    'choose_file' => 'Choisissez un fichier',

];
