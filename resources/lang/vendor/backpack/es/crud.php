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
    'add'                 => 'Añadir',
    'back_to_all'         => 'Volver al listado ',
    'cancel'              => 'Cancelar',
    'add_a_new'           => 'Añadir nuevo ',

        // Create form - advanced options
        'after_saving'            => 'Después de guardar',
        'go_to_the_table_view'    => 'ir al listado',
        'let_me_add_another_item' => 'añadir otro item',
        'edit_the_new_item'       => 'editar este item',

    // Edit form
    'edit'                 => 'Editar',
    'save'                 => 'Guardar',

    // Revisions
    'revisions'            => 'Las revisiones',
    'no_revisions'         => 'No hay revisiones encontrados',
    'created_this'          => 'creado este',
    'changed_the'          => 'cambiado el',
    'restore_this_value'   => 'restaurar este valor',
    'from'                 => 'de',
    'to'                   => 'a',
    'undo'                 => 'Deshacer',
    'revision_restored'    => 'Revisión restaurado correctamente',

    // CRUD table view
    'all'                       => 'Todos ',
    'in_the_database'           => 'en la base de datos',
    'list'                      => 'Listar',
    'actions'                   => 'Acciones',
    'preview'                   => 'Vista previa',
    'delete'                    => 'Eliminar',
    'admin'                     => 'Admin',
    'details_row'               => 'Esta es la fila de detalles. Modificar a su gusto.',
    'details_row_loading_error' => 'Se ha producido un error al cargar los datos. Por favor, intente de nuevo.',

        // Confirmation messages and bubbles
        'delete_confirm'                              => '¿Está seguro que desea eliminar este elemento?',
        'delete_confirmation_title'                   => 'Elemento eliminado',
        'delete_confirmation_message'                 => 'El elemento ha sido eliminado satisfactoriamente.',
        'delete_confirmation_not_title'               => 'No se pudo eliminar',
        'delete_confirmation_not_message'             => 'Ha ocurrido un error. Puede que el elemento no haya sido eliminado.',
        'delete_confirmation_not_deleted_title'       => 'No se pudo eliminar',
        'delete_confirmation_not_deleted_message'     => 'No ha ocurrido nada. Su elemento está seguro.',

        // DataTables translation
        'emptyTable'     => 'No hay datos disponibles en la tabla',
        'info'           => 'Mostrando _START_ hasta _END_ de _TOTAL_ registros',
        'infoEmpty'      => 'Mostrando 0 hasta 0 de 0 registros',
        'infoFiltered'   => '(filtrando de _MAX_ registros totales)',
        'infoPostFix'    => '',
        'thousands'      => ',',
        'lengthMenu'     => '_MENU_ elementos por página',
        'loadingRecords' => 'Cargando...',
        'processing'     => 'Procesando...',
        'search'         => 'Buscar: ',
        'zeroRecords'    => 'No se encontraron elementos',
        'paginate'       => [
            'first'    => 'Primero',
            'last'     => 'Último',
            'next'     => 'Siguiente',
            'previous' => 'Anterior',
        ],
        'aria' => [
            'sortAscending'  => ': activar para ordenar ascendentemente',
            'sortDescending' => ': activar para ordenar descendentemente',
        ],

    // global crud - errors
    'unauthorized_access' => 'Acceso denegado - usted no tiene los permisos necesarios para ver esta página.',
    'please_fix' => 'Por favor corrija los siguientes errores:',

    // global crud - success / error notification bubbles
    'insert_success' => 'El elemento ha sido añadido satisfactoriamente.',
    'update_success' => 'El elemento ha sido modificado satisfactoriamente.',

    // CRUD reorder view
    'reorder'                      => 'Reordenar',
    'reorder_text'                 => 'Arrastrar y soltar para reordenar.',
    'reorder_success_title'        => 'Hecho',
    'reorder_success_message'      => 'El orden ha sido guardado.',
    'reorder_error_title'          => 'Error',
    'reorder_error_message'        => 'El orden no se ha guardado.',

    // CRUD yes/no
    'yes' => 'Si',
    'no' => 'No',

    // Fields
    'browse_uploads' => 'Subir archivos',
    'clear' => 'Limpiar',
    'page_link' => 'Enlace',
    'page_link_placeholder' => 'http://example.com/su-pagina',
    'internal_link' => 'Enlace interno',
    'internal_link_placeholder' => 'Slug interno. Ejplo: \'admin/page\' (sin comillas) para \':url\'',
    'external_link' => 'Enlace externo',

];
