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
    'add'                 => 'Adaugă',
    'back_to_all'         => 'Înapoi la toate ',
    'cancel'              => 'Anulează',
    'add_a_new'           => 'Adaugă un nou ',

        // Create form - advanced options
        'after_saving'            => 'După salvare',
        'go_to_the_table_view'    => 'du-mă la toate intrările',
        'let_me_add_another_item' => 'vreu să adaug o altă intrare',
        'edit_the_new_item'       => 'vreau să editez intrarea',

    // Edit form
    'edit'                 => 'Editează',
    'save'                 => 'Salvează',

    // Revisions
    'revisions'            => 'Reviziile',
    'no_revisions'         => 'Reviziile Determinat',
    'created_this'          => 'creatd acest lucru',
    'changed_the'          => 'schimbat',
    'restore_this_value'   => 'a restabili această valoare',
    'from'                 => 'din',
    'to'                   => 'la',
    'undo'                 => 'Anula',
    'revision_restored'    => 'Revizia restaurat cu succes',

    // CRUD table view
    'all'                  => 'Toate ',
    'in_the_database'      => 'din baza de date',
    'list'                 => 'Listă',
    'actions'              => 'Operațiuni',
    'preview'              => 'Previzualizează',
    'delete'               => 'Șterge',

        // Confirmation messages and bubbles
        'delete_confirm'                              => 'Ești sigur că vrei să ștergi această intrare?',
        'delete_confirmation_title'                   => 'Intrare ștearsă',
        'delete_confirmation_message'                 => 'Intrarea a fost ștearsă cu succes.',
        'delete_confirmation_not_title'               => 'Eroare',
        'delete_confirmation_not_message'             => 'A avut loc o eroare. E posibil ca intrarea să nu fi fost ștearsă.',
        'delete_confirmation_not_deleted_title'       => 'Intrarea nu a fost ștearsă',
        'delete_confirmation_not_deleted_message'     => 'Nu am șters intrarea din baza de date.',

        // DataTables translation
        'emptyTable'     => 'Nu există intrări în baza de date',
        'info'           => 'Sunt afișate intrările _START_-_END_ din _TOTAL_',
        'infoEmpty'      => 'Sunt afișate toate intrarile. Adică niciuna.',
        'infoFiltered'   => '(filtrate din _MAX_ intrări în total)',
        'infoPostFix'    => '',
        'thousands'      => ',',
        'lengthMenu'     => '_MENU_ intrări pe pagină',
        'loadingRecords' => 'Se încarcă...',
        'processing'     => 'Se procesează...',
        'search'         => 'Caută: ',
        'zeroRecords'    => 'Nu au fost găsite intrări care să se potrivească',
        'paginate'       => [
            'first'    => 'Prima pagină',
            'last'     => 'Ultima pagină',
            'next'     => 'Pagina următoare',
            'previous' => 'Pagina anterioară',
        ],
        'aria' => [
            'sortAscending'  => ': activează pentru a ordona ascendent coloana',
            'sortDescending' => ': activează petnru a ordona descendent coloana',
        ],

    // global crud - errors
    'unauthorized_access' => 'Acces neautorizat - Nu ai permisiunea necesară pentru a accesa pagina.',
    'please_fix' => 'Va rugăm să reparați următoarele erori:',

    // global crud - success / error notification bubbles
    'insert_success' => 'Intrarea a fost adăugată cu succes.',
    'update_success' => 'Intrarea a fost modificată cu succes.',

    // CRUD reorder view
    'reorder'                      => 'Reordonare',
    'reorder_text'                 => 'Folosește drag&drop pentru a reordona.',
    'reorder_success_title'        => 'Terminat',
    'reorder_success_message'      => 'Ordinea a fost salvată.',
    'reorder_error_title'          => 'Eroare',
    'reorder_error_message'        => 'Ordinea nu a fost salvată.',

    // CRUD yes/no
    'yes' => 'Da',
    'no' => 'Nu',

    // Fields
    'browse_uploads' => 'Alege din fișierele urcate',
    'clear' => 'Curăță',
    'page_link' => 'Link către pagină',
    'page_link_placeholder' => 'http://example.com/pagina-dorita-de-tine',
    'internal_link' => 'Link intern',
    'internal_link_placeholder' => 'Rută internă. De ex: \'admin/page\' (fără ghilimele) pentru \':url\'',
    'external_link' => 'Link extern',
    'choose_file' => 'Alege fișier',
];
