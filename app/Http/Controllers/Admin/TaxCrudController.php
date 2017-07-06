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
