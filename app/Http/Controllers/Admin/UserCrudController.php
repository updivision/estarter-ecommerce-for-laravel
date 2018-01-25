<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserStoreRequest as StoreRequest;
use App\Http\Requests\UserUpdateRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Requests\CrudRequest;
use Illuminate\Http\Request;

class UserCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/users');
        $this->crud->setEntityNameStrings('user', 'users');

        // Include all users except clients
        $this->crud->addClause('whereDoesntHave', 'roles', function ($query) {
            $clientRoleName = env('CLIENT_ROLE_NAME');
            return $query->where("name", $clientRoleName ?: 'client');
        });

       
        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'name'  => 'salutation',
                'label' => trans('user.salutation'),
            ],
            [
                'name'  => 'name',
                'label' => trans('user.name'),
            ],
            [
                'name'      => 'gender',
                'label'     => trans('user.gender'),
                'type'      => 'boolean',
                'options'   => [
                    1 => trans('user.male'),
                    2 => trans('user.female'),
                ],
            ],
            [
                'name'  => 'email',
                'label' => trans('user.email'),
            ],
            [
               'label'     => trans('permissionmanager.roles'),
               'type'      => 'select_multiple',
               'name'      => 'roles',
               'entity'    => 'roles',
               'attribute' => 'name',
               'model'     => config('laravel-permission.models.role'),
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
                'name'  => 'name',
                'label' => trans('user.name'),
                'type'  => 'text',

                'tab'   => trans('user.tab_general'),
            ],
            [
                'name'  => 'email',
                'label' => trans('user.email'),
                'type'  => 'email',

                'tab'   => trans('user.tab_general'),
            ],
            [
                'name'  => 'password',
                'label' => trans('user.password'),
                'type'  => 'password',

                'tab'   => trans('user.tab_general'),
            ],
            [
                'name'  => 'password_confirmation',
                'label' => trans('user.password_confirmation'),
                'type'  => 'password',

                'tab'   => trans('user.tab_general'),
            ],
             [
                'name'      => 'active',
                'label'     => trans('common.status'),
                'type'      => 'select_from_array',
                'options'   => [
                    0 => trans('common.inactive'),
                    1 => trans('common.active'),
                ],

                'tab'   => trans('user.tab_general'),
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

                'tab'   => trans('user.tab_permissions'),
            ],
        ]);
    }

    public function store(StoreRequest $request)
    {

        $this->handlePasswordInput($request);

        $redirect_location = parent::storeCrud($request);

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
