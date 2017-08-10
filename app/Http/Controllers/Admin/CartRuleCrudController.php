<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CartRuleRequest as StoreRequest;
use App\Http\Requests\CartRuleRequest as UpdateRequest;

class CartRuleCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\CartRule');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/cartrule');
        $this->crud->setEntityNameStrings('cart rule', 'cart rules');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();

        /*
        |--------------------------------------------------------------------------
        | CRUD COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'name'  => 'name',
                'label' => trans('cartrule.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'code',
                'label' => trans('cartrule.code'),
            ],
            [
                'name'  => 'priority',
                'label' => trans('cartrule.priority'),
            ],
            [
                'name'  => 'start_date',
                'label' => trans('cartrule.start_date'),
            ],
            [
                'name'  => 'expiration_date',
                'label' => trans('cartrule.expiration_date'),
            ],
            [
                'name'  => 'status',
                'label' => trans('cartrule.status'),
            ]

            /*
            |---------------------------------------------------------------------
            | CRUD ADDITIONAL COLUMNS
            | These columns are also available from database
            | You can add them to the existing table
            |---------------------------------------------------------------------
            */
            // 
            //[
            //     'name'  => 'highlight',
            //     'label' => trans('cartrule.highlight'),
            // ],
            // [
            //     'name'  => 'minimum_amount',
            //     'label' => trans('cartrule.minimum_amount'),
            // ],
            // [
            //     'name'  => 'total_available',
            //     'label' => trans('cartrule.total_available'),
            // ],
            // [
            //     'name'  => 'total_available_each_customer',
            //     'label' => trans('cartrule.total_available_each_customer'),
            // ],
            // [
            //     'name'  => 'promo_label',
            //     'label' => trans('cartrule.promo_label'),
            // ],
            // [
            //     'name'  => 'promo_text',
            //     'label' => trans('cartrule.promo_text'),
            // ],
            // [
            //     'name'  => 'multiply_gift',
            //     'label' => trans('cartrule.multiply_gift'),
            // ],
            // [
            //     'name'  => 'customer_id',
            //     'label' => trans('cartrule.limit_to_one_customer'),
            // ],
            // [
            //     'name'  => 'gift_product_id',
            //     'label' => trans('cartrule.gift'),
            // ],
            // [
            //     'name'  => 'min_nr_products',
            //     'label' => trans('cartrule.min_nr_products'),
            // ],
            // [
            //     'name'  => 'discount_type',
            //     'label' => trans('cartrule.discount_type'),
            //     'type'  => 'enum',
            // ],
            // [
            //     'name'  => 'reduction_amount',
            //     'label' => trans('cartrule.reduction_amount'),
            // ],
            // [
            //     'name'  => 'currency_id',
            //     'label' => trans('cartrule.currency'),
            //     'type'  => 'select',
            //     'model' => 'App\Models\Currency',
            // ]

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
        // $this->crud->enableAjaxTable();

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function setPermissions()
    {
         // Get authenticated user
        $user = auth()->user();

        // Deny all accesses
        $this->crud->denyAccess(['list', 'create', 'update', 'delete']);

        // Allow list access
        if ($user->can('list_cart_rules')) {
            $this->crud->allowAccess('list');
        }

        // Allow create access
        if ($user->can('create_cart_rule')) {
            $this->crud->allowAccess('create');
        }

        // Allow update access
        if ($user->can('update_cart_rule')) {
            $this->crud->allowAccess('update');
        }

        // Allow delete access
        if ($user->can('delete_cart_rule')) {
            $this->crud->allowAccess('delete');
        }

    }


    public function setFields()
    {
        $this->crud->addFields([
            // INFORMATION TAB
            [
                'name'  => 'name',
                'label' => trans('cartrule.name'),
                'type'  => 'text',
                'attributes' => [
                    'required' => 'true',
                ],
                'tab'   => trans('cartrule.information_tab'),
            ],
            [
                'name'  => 'code',
                'label' => trans('cartrule.code'),
                'tab'   => trans('cartrule.information_tab'),
            ],
            [
                'name'  => 'highlight',
                'label' => trans('cartrule.highlight'),
                'type'  => 'toggle_switch',
                'tab'   => trans('cartrule.information_tab'),
            ],
            [
                'name'  => 'priority',
                'label' => trans('cartrule.priority'),
                'tab'   => trans('cartrule.information_tab'),
            ],
            [
                'name'  => 'status',
                'label' => trans('cartrule.status'),
                'type'  => 'toggle_switch',
                'tab'   => trans('cartrule.information_tab'),
            ],
            [
                'name'  => 'promo_label',
                'label' => trans('cartrule.promo_label'),
                'tab'   => trans('cartrule.information_tab'),
            ],
            [
                'name'  => 'promo_text',
                'label' => trans('cartrule.promo_text'),
                'tab'   => trans('cartrule.information_tab'),
                'type'  => 'textarea',
            ],
            // CONDITIONS TAB
            [
                'name'  => 'customer_id',
                'label' => trans('cartrule.limit_to_one_customer'),
                'tab'   => trans('cartrule.conditions_tab'),
                'type'  => 'select2',
                'entity'=> 'user',
                'attribute' => 'name',
                'model' => 'App\User',
            ],
            [
                'name'  => 'start_date',
                'label' => trans('cartrule.start_date'),
                'type'  => 'date_picker',
                'tab'   => trans('cartrule.conditions_tab'),
            ],
            [
                'name'  => 'expiration_date',
                'label' => trans('cartrule.expiration_date'),
                'type'  => 'date_picker',
                'tab'   => trans('cartrule.conditions_tab'),
            ],
             [
                'name'  => 'minimum_amount',
                'label' => trans('cartrule.minimum_amount'),
                'tab'   => trans('cartrule.conditions_tab'),
            ],
            [
                'name'  => 'minimum_amount_currency_id',
                'label' => trans('cartrule.currency'),
                'type'  => 'select',
                'entity'    => 'currency',
                'attribute' => 'name',
                'model' => 'App\Models\Currency',
                'tab'   => trans('cartrule.conditions_tab'),
            ],
            [
                'name'  => 'total_available',
                'label' => trans('cartrule.total_available'),
                'tab'   => trans('cartrule.conditions_tab'),
            ],
            [
                'name'  => 'total_available_each_customer',
                'label' => trans('cartrule.total_available_each_customer'),
                'tab'   => trans('cartrule.conditions_tab'),
            ],
            [
                'name'  => 'min_nr_products',
                'label' => trans('cartrule.min_nr_products'),
                'tab'   => trans('cartrule.conditions_tab'),
            ],
            // ACTIONS TAB
            [
                'name'  => 'free_delivery',
                'label' => trans('cartrule.free_delivery'),
                'tab'   => trans('cartrule.actions_tab'),
                'type'  => 'toggle_switch',
            ],
            [
                'name'  => 'discount_type',
                'label' => trans('cartrule.discount_type'),
                'type'  => 'enum',
                'tab'   => trans('cartrule.actions_tab'),
            ],

            [
                'name'  => 'reduction_amount',
                'label' => trans('cartrule.reduction_value'),
                'tab'   => trans('cartrule.actions_tab'),
            ],
            [
                'name'  => 'reduction_currency_id',
                'label' => trans('cartrule.currency'),
                'type'  => 'select',
                'entity'    => 'currency',
                'attribute' => 'name',
                'model' => 'App\Models\Currency',
                'tab'   => trans('cartrule.actions_tab'),
            ],
            [
                'name'  => 'multiply_gift',
                'label' => trans('cartrule.multiply_gift'),
                'tab'   => trans('cartrule.actions_tab'),
            ],
            [
                'name'  => '',
                'label' => 'send a free gift',
                'type'  => 'toggle_switch',
                'tab'   => trans('cartrule.actions_tab'),
            ],
            [
                'name'  => 'gift_product_id',
                'label' => trans('cartrule.gift'),
                'tab'   => trans('cartrule.actions_tab'),
                'type'  => 'select2',
                'entity'=> 'products',
                'attribute'=> 'name',
                'model' => 'App\Models\Product'
            ]

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
