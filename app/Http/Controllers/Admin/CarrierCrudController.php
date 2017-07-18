<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CarrierRequest as StoreRequest;
use App\Http\Requests\CarrierRequest as UpdateRequest;

class CarrierCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\Carrier");
        $this->crud->setRoute("admin/carriers");
        $this->crud->setEntityNameStrings('carrier', 'carriers');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'name'  => 'name',
                'label' => trans('category.name'),
            ]
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

        /*
        |--------------------------------------------------------------------------
        | AJAX TABLE VIEW
        |--------------------------------------------------------------------------
        */
        $this->crud->enableAjaxTable();

    }

    public function setPermissions()
    {
        // Get authenticated user
        $user = auth()->user();

        // Deny all accesses
        $this->crud->denyAccess(['list', 'create', 'update', 'delete']);

        // Allow list access
        if ($user->can('list_carriers')) {
            $this->crud->allowAccess('list');
        }

        // Allow create access
        if ($user->can('create_carrier')) {
            $this->crud->allowAccess('create');
        }

        // Allow update access
        if ($user->can('update_carrier')) {
            $this->crud->allowAccess('update');
        }

        // Allow delete access
        if ($user->can('delete_carrier')) {
            $this->crud->allowAccess('delete');
        }
    }

    public function setFields()
    {
        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => trans('carrier.name'),
                'type'  => 'text',
            ],
            [
                'name'       => 'price',
                'label'      => trans('carrier.price'),
                'type'       => 'number',
                'attributes' => [
                    'step' => 'any'
                ]
            ],
            [
                'name'  => 'delivery_text',
                'label' => trans('carrier.delivery_text'),
                'type'  => 'text',
            ],
            [
                'name'    => "logo",
                'label'   => trans('carrier.logo'),
                'type'    => 'image',
                'upload'  => true,
                'crop'    => false,
                'default' => 'default.png',
                'prefix'  => 'uploads/carriers/'
            ]
        ]);
    }


	public function store(StoreRequest $request)
	{
        $redirect_location = parent::storeCrud();

        return $redirect_location;
	}

	public function update(UpdateRequest $request)
	{
        $redirect_location = parent::updateCrud();

        return $redirect_location;
	}
}
