<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserRequest as StoreRequest;
use App\Http\Requests\UserRequest as UpdateRequest;

class UserCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/users');
        $this->crud->setEntityNameStrings('user', 'users');

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
        $this->crud->addFields([

        ]);
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
