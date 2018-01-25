<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CurrencyRequest as StoreRequest;
use App\Http\Requests\CurrencyRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Facades\DB;

class CurrencyCrudController extends CrudController
{

    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Currency");
        $this->crud->setRoute("admin/currencies");
        $this->crud->setEntityNameStrings('currency', 'currencies');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'name'  => 'name',
                'label' => trans('currency.name'),
            ],
            [
                'name'  => 'iso',
                'label' => trans('currency.iso'),
            ],
            [
                'name'  => 'value',
                'label' => trans('currency.value'),
            ],
            [
                'name'    => 'default',
                'label'   => trans('currency.default'),
                'type'    => 'boolean',
                'options' => [
                    '0' => '',
                    '1' => trans('currency.default'),
                ],
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
        if ($user->can('list_currencies')) {
            $this->crud->allowAccess('list');
        }

        // Allow create access
        if ($user->can('create_currency')) {
            $this->crud->allowAccess('create');
        }

        // Allow update access
        if ($user->can('update_currency')) {
            $this->crud->allowAccess('update');
        }

        // Allow delete access
        if ($user->can('delete_currency')) {
            $this->crud->allowAccess('delete');
        }
    }

    public function setFields()
    {
        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => trans('currency.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'iso',
                'label' => trans('currency.iso'),
                'type'  => 'text',
            ],
            [
                'name'  => 'value',
                'label' => trans('currency.value'),
                'type'  => 'text',
            ],
            [
                'name'  => 'default',
                'label' => trans('currency.default'),
                'type'  => 'checkbox',
            ]
        ]);
    }

    public function store(StoreRequest $request)
    {
        if ($request->default == 1) {
            $table = $this->crud->model->getTable();
            DB::table($table)->update(['default' => 0]);
        }

        $redirect_location = parent::storeCrud();

        if ($request->default == 1) {
            $this->crud->model->find($this->crud->entry->id)->update(['value' => 1]);
        }

        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        if ($request->default == 1) {
            $table = $this->crud->model->getTable();
            DB::table($table)->update(['default' => 0]);
        }

        $redirect_location = parent::updateCrud();

        if ($request->default == 1) {
            $this->crud->model->find($request->id)->update(['value' => 1]);
        }

        return $redirect_location;
    }

}
