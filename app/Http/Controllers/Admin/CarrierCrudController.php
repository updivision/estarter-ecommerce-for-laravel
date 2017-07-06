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
