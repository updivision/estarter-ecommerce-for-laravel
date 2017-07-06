<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CategoryRequest as StoreRequest;
use App\Http\Requests\CategoryUpdateRequest as UpdateRequest;

class CategoryCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\Category");
        $this->crud->setRoute("admin/categories");
        $this->crud->setEntityNameStrings('category', 'categories');

        /*
        |--------------------------------------------------------------------------
        | BUTTONS
        |--------------------------------------------------------------------------
        */
        $this->crud->enableReorder('name', 0);
        $this->crud->allowAccess('reorder');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'type'      => "select",
                'label'     => trans('category.parent'),
                'name'      => 'parent_id',
                'entity'    => 'parent',
                'attribute' => "name",
                'model'     => "App\Models\Category",
            ],
            [
                'name'  => 'name',
                'label' => trans('category.name'),
            ],
            [
                'name'  => 'slug',
                'label' => trans('category.slug'),
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
                'label' => trans('category.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'slug',
                'label' => trans('category.slug'),
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
