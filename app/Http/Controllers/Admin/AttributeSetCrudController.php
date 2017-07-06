<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AttributeSetRequest as StoreRequest;
use App\Http\Requests\AttributeSetRequest as UpdateRequest;
use App\Models\Attribute;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;

class AttributeSetCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\AttributeSet");
        $this->crud->setRoute("admin/attributes-sets");
        $this->crud->setEntityNameStrings('attribute set', 'Attribute Sets');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'name'  => 'name',
                'label' => trans('attribute.name'),
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
                'name'      => 'name',
                'label'     => trans('attribute.name'),
                'type'      => 'text',
            ],
            [
                'type'      => 'select2_multiple',
                'label'     => trans('attribute.attributes'),
                'name'      => 'attributes',
                'entity'    => 'attributes',
                'attribute' => 'name',
                'model'     => "App\Models\Attribute",
                'pivot'     => true,
            ]
        ]);

    }

    public function ajaxGetAttributesBySetId(Request $request, Attribute $attribute)
    {
        // Init old as an empty array
        $old = [];

        // Set old inputs as array from $request
        if (isset($request->old)) {
            $old = json_decode($request->old, true);
        }

        // Get attributes with values by set id
        $attributes = $attribute->with('values')->whereHas('sets', function ($q) use ($request) {
            $q->where('id', $request->setId);
        })->get();

        return view('renders.product_attributes', compact('attributes', 'old'));
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
