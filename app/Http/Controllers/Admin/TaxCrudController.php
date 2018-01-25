<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TaxRequest as StoreRequest;
use App\Http\Requests\TaxRequest as UpdateRequest;

class TaxCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\Tax");
        $this->crud->setRoute("admin/taxes");
        $this->crud->setEntityNameStrings('tax', 'taxes');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'name'  => 'name',
                'label' => trans('tax.name'),
            ],
            [
                'name'  => 'value',
                'label' => trans('tax.value'),
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
        if ($user->can('list_taxes')) {
            $this->crud->allowAccess('list');
        }

        // Allow create access
        if ($user->can('create_tax')) {
            $this->crud->allowAccess('create');
        }

        // Allow update access
        if ($user->can('update_tax')) {
            $this->crud->allowAccess('update');
        }

        // Allow delete access
        if ($user->can('delete_tax')) {
            $this->crud->allowAccess('delete');
        }
    }

    public function setFields()
    {
        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => trans('tax.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'value',
                'label' => trans('tax.value'),
                'hint'  => trans('tax.hint_value'),
                'type'  => 'text',
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
