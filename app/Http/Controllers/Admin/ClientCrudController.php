<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserStoreRequest as StoreRequest;
use App\Http\Requests\UserUpdateRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Requests\CrudRequest;
use Illuminate\Http\Request;

class ClientCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/clients');
        $this->crud->setEntityNameStrings('client', 'clients');
        $this->crud->addClause('whereHas', 'roles', function ($query) {
            $clientRoleName = env('CLIENT_ROLE_NAME');
            $query->whereName($clientRoleName ?: 'client');
        });

        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'name'        => 'salutation',
                'label'       => trans('client.salutation'),
            ],
            [
                'name'  => 'name',
                'label' => trans('client.name'),
            ],
            [
                'name'      => 'gender',
                'label'     => trans('client.gender'),
                'type'      => 'boolean',
                'options'   => [
                    1 => trans('client.male'),
                    2 => trans('client.female'),
                ],
            ],
            [
                'name'  => 'email',
                'label' => trans('client.email'),
            ],
            [
                'name'      => 'active',
                'label'     => trans('common.status'),
                'type'      => 'boolean',
                'options'   => [
                    0 => trans('common.inactive'),
                    1 => trans('common.active'),
                ],
            ]

        ]);

        /*
        |--------------------------------------------------------------------------
        | FIELDS
        |--------------------------------------------------------------------------
        */
        $this->setFields();

        /*
        |--------------------------------------------------------------------------
        | AJAX TABLE VIEW
        |--------------------------------------------------------------------------
        */
        $this->crud->enableAjaxTable();

    }

    public function setFields()
    {

        // dd($this->crud->model->find(1)->roles->first()->name);

        $this->crud->addFields([
            [
                'name'  => 'salutation',
                'label' => trans('client.salutation'),
                'type'  => 'text',

                'tab'   => trans('client.tab_general'),
            ],
            [
                'name'  => 'name',
                'label' => trans('client.name'),
                'type'  => 'text',

                'tab'   => trans('client.tab_general'),
            ],
            [
                'name'  => 'email',
                'label' => trans('client.email'),
                'type'  => 'email',

                'tab'   => trans('client.tab_general'),
            ],
            [
                'name'  => 'password',
                'label' => trans('client.password'),
                'type'  => 'password',

                'tab'   => trans('client.tab_general'),
            ],
            [
                'name'  => 'password_confirmation',
                'label' => trans('client.password_confirmation'),
                'type'  => 'password',

                'tab'   => trans('client.tab_general'),
            ],
            [
                'name'      => 'gender',
                'label'     => trans('client.gender'),
                'type'      => 'select_from_array',
                'options'   => [
                    1 => trans('client.male'),
                    2 => trans('client.female'),
                ],

                'tab'   => trans('client.tab_general'),
            ],
            [
                'name'  => 'birthday',
                'label' => trans('client.birthday'),
                'type'  => 'date',

                'tab'   => trans('client.tab_general'),
            ],
            [
                'name'      => 'active',
                'label'     => trans('common.status'),
                'type'      => 'select_from_array',
                'options'   => [
                    0 => trans('common.inactive'),
                    1 => trans('common.active'),
                ],

                'tab'   => trans('client.tab_general'),
            ],
            [
            // two interconnected entities
            'label'             => trans('permissionmanager.user_role_permission'),
            'field_unique_name' => 'user_role_permission',
            'type'              => 'checklist_dependency',
            'name'              => 'roles_and_permissions',
            'subfields'         => [
                    'primary' => [
                        'label'            => trans('permissionmanager.roles'),
                        'name'             => 'roles',
                        'entity'           => 'roles',
                        'entity_secondary' => 'permissions',
                        'attribute'        => 'name',
                        'model'            => config('laravel-permission.models.role'),
                        'pivot'            => true,
                        'number_columns'   => 3, //can be 1,2,3,4,6
                    ],
                    'secondary' => [
                        'label'          => ucfirst(trans('permissionmanager.permission_singular')),
                        'name'           => 'permissions',
                        'entity'         => 'permissions',
                        'entity_primary' => 'roles',
                        'attribute'      => 'name',
                        'model'          => "Backpack\PermissionManager\app\Models\Permission",
                        'pivot'          => true,
                        'number_columns' => 3, //can be 1,2,3,4,6
                    ],
                ],

                'tab'   => trans('client.tab_permissions'),
            ],
        ]);

        $this->crud->addField([
            'name'          => 'client_address',
            'type'          => 'client_address',
            'country_model' => 'App\Models\Country',

            'tab'           => trans('client.tab_address'),
        ], 'update');

        $this->crud->addField([
            'name'          => 'client_company',
            'type'          => 'client_company',
            'country_model' => 'App\Models\Company',

            'tab'           => trans('client.tab_company'),
        ], 'update');
    }

    public function store(StoreRequest $request)
    {
        $clientRoleName = env('CLIENT_ROLE_NAME');

        $this->handlePasswordInput($request);

        $redirect_location = parent::storeCrud($request);
        $clientRoleID = \DB::table('roles')->whereName( $clientRoleName ?: 'client')->first()->id;
        $this->crud->entry->roles()->attach($clientRoleID);

        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $this->handlePasswordInput($request);

        $redirect_location = parent::updateCrud($request);

        return $redirect_location;
    }

    /**
     * Handle password input fields.
     *
     * @param CrudRequest $request
     */
    protected function handlePasswordInput(CrudRequest $request)
    {
        // Remove fields not present on the user.
        $request->request->remove('password_confirmation');

        // Encrypt password if specified.
        if ($request->input('password')) {
            $request->request->set('password', bcrypt($request->input('password')));
        } else {
            $request->request->remove('password');
        }
    }
}
