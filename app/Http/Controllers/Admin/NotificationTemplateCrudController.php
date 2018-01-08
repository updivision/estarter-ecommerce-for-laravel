<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NotificationTemplateRequest as StoreRequest;
use App\Http\Requests\NotificationTemplateRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;

class NotificationTemplateCrudController extends CrudController
{

    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\NotificationTemplate');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/notification-templates');
        $this->crud->setEntityNameStrings(trans('notification_templates.notification_template'), trans('notification_templates.notification_templates'));

        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'name'  => 'name',
                'label' => trans('notification_templates.name'),
            ],
            [
                'name'  => 'slug',
                'label' => trans('notification_templates.slug'),
            ],
            [
                'name'  => 'body',
                'label' => trans('notification_templates.body'),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PERMISSIONS
        |-------------------------------------------------------------------------
        */
        $this->setPermissions();

        /*
        |--------------------------------------------------------------------------
        | FIELDS
        |--------------------------------------------------------------------------
        */
        $this->setFields();

    }

    public function setPermissions()
    {
        // Get authenticated user
        $user = auth()->user();

        // Deny all accesses
        $this->crud->denyAccess(['list', 'create', 'update', 'delete']);

        // Allow list access
        if ($user->can('list_notification_templates')) {
            $this->crud->allowAccess('list');
        }

        // Allow create access
        if ($user->can('create_notification_template')) {
            $this->crud->allowAccess('create');
        }

        // Allow update access
        if ($user->can('update_notification_template')) {
            $this->crud->allowAccess('update');
        }

        // Uncomment if you want to allow delete functionality
        // Allow delete access
        // if ($user->can('delete_notification_template')) {
        //     $this->crud->allowAccess('delete');
        // }
    }

    public function setFields()
    {
        $availableModels = [
            'User' => 'App\Models\User',
            'Order' => 'App\Models\Order'
        ];

        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => trans('notification_templates.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'slug',
                'label' => trans('notification_templates.slug'),
                'type'  => 'slug',
                // 'attributes' => ['disabled' => 'disabled']
            ],
            [
                'name'    => 'model',
                'label'   => trans('notification_templates.model'),
                'type'    => 'select2_from_array_notification_template_model',
                'options' => $availableModels
            ],
            [
                'name'  => 'body',
                'label' => trans('notification_templates.body'),
                'type'  => 'ckeditor',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-9 col-xs-12'
                ]
            ],
            [
                'name'  => 'notification_list_variables',
                'label' => trans('notification_templates.available_variables'),
                'type'  => 'notification_list_variables',
                'wrapperAttributes' => [
                    'class' => 'form-group available-variables col-md-3 col-xs-12'
                ]
            ],
        ]);
    }

    public function listModelVars(Request $request)
    {
        $modelClass = 'App\\Models\\'.$request->input('model');

        if ($request->input('model') === 'User') {
            $modelClass = 'App\\'.$request->input('model');
        }

        if (class_exists($modelClass)) {
            $model = new $modelClass;

            return response()->json($model->notificationVars);
        }

        return null;
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
