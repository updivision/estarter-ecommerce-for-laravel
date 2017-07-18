<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest as StoreRequest;
use App\Http\Requests\OrderRequest as UpdateRequest;
use App\Models\OrderStatus;
use App\Models\OrderStatusHistory;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;

class OrderCrudController extends CrudController
{

    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Order");
        $this->crud->setRoute("admin/orders");
        $this->crud->setEntityNameStrings('order', 'orders');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'name'  => 'id',
                'label' => '#',
            ],
            [
                'label'     => trans('client.client'),
                'type'      => 'select',
                'name'      => 'user_id',
                'entity'    => 'user',
                'attribute' => 'name',
                'model'     => 'App\User',
            ],
            [
                'label'     => trans('order.status'),
                'type'      => 'select',
                'name'      => 'status_id',
                'entity'    => 'status',
                'attribute' => 'name',
                'model'     => 'App\Models\OrderStatus',
            ],
            [
                'name'  => 'total',
                'label' => trans('common.total'),
            ],
            [
                'label'     => trans('currency.currency'),
                'type'      => 'select',
                'name'      => 'currency_id',
                'entity'    => 'currency',
                'attribute' => 'name',
                'model'     => 'App\Models\Currency',
            ],
            [
                'name'  => 'created_at',
                'label' => trans('order.created_at'),
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
        // $this->setFields();

        /*
        |--------------------------------------------------------------------------
        | AJAX TABLE VIEW
        |--------------------------------------------------------------------------
        */
        // $this->crud->enableAjaxTable();


    }

    public function setPermissions()
    {
        // Get authenticated user
        $user = auth()->user();

        // Deny all accesses
        $this->crud->denyAccess(['create', 'delete', 'update']);

        // Allow access to show and replace preview button with view
        $this->crud->allowAccess('show');
        $this->crud->removeButton('preview');
        $this->crud->addButtonFromView('line', 'view', 'view', 'end');
    }

    // public function setFields()
    // {
    // }

    public function show($id)
    {
        $this->crud->hasAccessOrFail('show');

        $order = $this->crud->getEntry($id);
        $orderStatuses = OrderStatus::get();
        $crud = $this->crud;

        return view('admin.order.view', compact('crud', 'order', 'orderStatuses'));
    }

    public function updateStatus(Request $request, OrderStatusHistory $orderStatusHistory)
    {
        // Create history entry
        $orderStatusHistory->create($request->except('_token'));

        $this->crud->update($request->input('order_id'), ['status_id' => $request->input('status_id')]);

        \Alert::success(trans('order.status_updated'))->flash();

        return redirect()->back();
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
