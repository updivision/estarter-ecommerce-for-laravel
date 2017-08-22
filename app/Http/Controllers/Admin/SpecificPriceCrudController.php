<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SpecificPriceRequest as StoreRequest;
use App\Http\Requests\SpecificPriceRequest as UpdateRequest;
use App\Models\SpecificPrice;
use App\Models\Product;
// use App\Models\Currency;

class SpecificPriceCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\SpecificPrice');
        $this->crud->setRoute('admin/specific-prices');
        $this->crud->setEntityNameStrings('specific price', 'specific prices');

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
                'name'          => 'product_id',
                'label'         => trans('specificprice.product'),
                'attribute'     => 'name',
                'model'         => 'App\Models\Product',
                'type'          => "model_function",
                'function_name' => 'getProductName', 
            ],
            [
                'name'  => 'start_date',
                'label' => trans('specificprice.start_date'),
            ],
            [
                'name'  => 'expiration_date',
                'label' => trans('specificprice.expiration_date'),
            ],
            [
                'name'  => 'discount_type',
                'label' => trans('specificprice.discount_type'),
                'type'  => 'enum',
            ],
            // [
            //     'name'  => 'reduction',
            //     'label' => trans('specificprice.reduction'),
            // ],
            // [
            //    'name' => "currency_column",
            //    'label' => trans('specificprice.currency'),
            //    'type' => "model_function",
            //    'function_name' => 'getCurrencyName', 
            // ],
            //  [
            //    'name' => "reduction_with_currency",
            //    'label' => trans('specificprice.reduction'),
            //    'type' => "model_function",
            //    'function_name' => 'getReductionWithCurrency', 
            // ],
             [
               'name'           => "reduction",
               'label'          => trans('specificprice.reduction'),
               'type'           => "model_function",
               'function_name'  => 'getReduction', 
            ],
            [
               'name'           => "old_price",
               'label'          => trans('specificprice.old_price'),
               'type'           => "model_function",
               'function_name'  => 'getOldPrice', 
            ],
            [
               'name'           => "reduced_price",
               'label'          => trans('specificprice.reduced_price'),
               'type'           => "model_function",
               'function_name'  => 'getReducedPrice', 
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
        if ($user->can('list_specific_prices')) {
            $this->crud->allowAccess('list');
        }

        // Allow create access
        if ($user->can('create_specific_price')) {
            $this->crud->allowAccess('create');
        }

        // Allow update access
        if ($user->can('update_specific_price')) {
            $this->crud->allowAccess('update');
        }

        // Allow delete access
        if ($user->can('delete_specific_price')) {
            $this->crud->allowAccess('delete');
        }

    }

    public function setFields(){
         $this->crud->addField(
             [
                'name'      => 'product_id',
                'label'     => trans('specificprice.product') . ' *',
                'model'     => 'App\Models\Product',
                'entity'    => 'product',
                'attribute' => 'name',
                'type'      =>'select2',
            ], 'update');
        
        $this->crud->addField(
             [
                'name'      => 'product_id',
                'label'     => trans('specificprice.products'). ' *',
                'model'     => 'App\Models\Product',
                'entity'    => 'product',
                'attribute' => 'name',
                'type'      =>'select2_multiple',
            ], 'create');
        
        $this->crud->addFields([
           
            [
                'name'      => 'discount_type',
                'label'     => trans('specificprice.discount_type'). ' *',
                'type'      => 'enum_discount_type',
                'attributes'=> ['field_to_enable' => 'currency_id', 
                                'enable_field_on_option' => 'Amount'],
            ],
            [
                'name'  => 'reduction',
                'label' => trans('specificprice.reduction'). ' *',
                'model' => 'App\Models\SpecificPrice',
                'type'  => 'number',
            ],
            // [
            //     'name'          => 'currency_id',
            //     'label'         => trans('specificprice.currency'),
            //     'entity'        => 'currency',
            //     'attribute'     => 'name',
            //     'model'         => 'App\Models\Currency',
            //     'wrapperAttributes'     => [
            //                                 'class' => 'form-group col-md-4'
            //     ],
            //     'type'                  => 'select2_currency',
            //     'default_currency'      => $this->getDefaultCurrencyName(),
            //     'default_currency_id'   => $this->getDefaultCurrencyId(),
                
            // ],
            [
                'name'  => 'start_date',
                'label' => trans('specificprice.start_date'). ' *',
                'type'  => 'datetime_picker',
            ],
            
            [
                'name'  => 'expiration_date',
                'label' => trans('specificprice.expiration_date'). ' *',
                 'type'  => 'datetime_picker',
            ],

        ]);
    }

    // public function getDefaultCurrencyName() {
    //     $default_currency = Currency::where('default', 1)->first();
    //     if(isset($default_currency)){
    //         $default_currency_name = $default_currency->name;
    //     }
    //     else
    //         $default_currency_name = '-';    
    //     return $default_currency_name;
    // }


    // public function getDefaultCurrencyId() {
    //     $default_currency = Currency::where('default', 1)->first();
    //     if(isset($default_currency)){
    //         $default_currency_id = $default_currency->id;
    //     }
    //     else
    //         $default_currency_id = NULL;
    //     return $default_currency_id;
    // }


    /**
     * Validate if the price after reduction is not less than 0
     *
     * @return boolean
     */
    public function validateReductionPrice($productId, $reduction, 
        $discountType)
    {
        $product = Product::find($productId);
        $oldPrice = $product->price;
        if($discountType == 'Amount') {
            $newPrice = $oldPrice - $reduction;
        }
        if($discountType == 'Percent') {
            $newPrice = $oldPrice - $reduction/100.00 * $oldPrice;
        }

        if($newPrice < 0) {
            return false;
        }
        return true;
    }

    /**
     * Get the first product name which price is less than 0 after reduction, or NULL
     *
     * @return string or NULL
     */
    public function getInvalidReductionProduct($productIDs, 
        $reduction, $discountType)
    {
        foreach ($productIDs as $productId) {
            if(!$this->validateReductionPrice($productId, $reduction, $discountType)) {
                $product = Product::find($productId);
                $productName = $product->name;

                return $productName;
            }
        }
        return NULL; 
    }   

     /**
     * Check if it doesn't already exist a specific price reduction for the same 
     * period for a product
     *
     * @return boolean
     */
    public function validateProductDates($productId, $startDate, $expirationDate) 
    {
        $specificPrice = SpecificPrice::where('product_id', $productId)->get();
        
        foreach ($specificPrice as $item) {
            $existingStartDate = $item->start_date;
            $existingExpirationDate = $item->expiration_date;    
            if($startDate >= $existingStartDate && $startDate <= $existingExpirationDate) {
                return false;
            }
            if($expirationDate >= $existingStartDate && $startDate <= $existingExpirationDate) {
                return false;
            }
        }
       
        return true;
    }
    

    public function store(StoreRequest $request)
    {

        $productIDs = $request->input()['product_id'];
        $nrOfRequests = count($request->input()['product_id']);
        
        $discountType = $request->input()['discount_type'];
        $reduction = $request->input()['reduction'];
        $startDate = $request->input()['start_date'];
        $expirationDate = $request->input()['expiration_date'];


        // Get the first product which price is less than 0 after reduction
        $productNotValidatedName = $this
            ->getInvalidReductionProduct($productIDs, $reduction, $discountType);

        if (isset($productNotValidatedName)) {
            \Alert::error(
                trans('specificprice.reduction_price_not_ok', ['productName' => $productNotValidatedName ]))
                    ->flash();

            return redirect()->back()->withInput();                     
        }

        foreach ($productIDs as $productId) {
            if(!$this->validateProductDates($productId, $startDate, $expirationDate)) {
                $product = Product::find($productId);
                $productName = $product->name;

                 \Alert::error(trans('specificprice.wrong_dates', ['productName' => $productName]))->flash();
                return redirect()->back()->withInput();                        
            }
        }
    

        // Save request for each product separately
        for($i=0; $i<$nrOfRequests; $i++){
            $request->request->set('product_id', $productIDs[$i]);        
            $specific_price = SpecificPrice::create(
                $request->except(['save_action', '_token', '_method']));
        }

        $redirectUrl = $this->crud->route;
        return \Redirect::to($redirectUrl);
    }



    public function update(UpdateRequest $request)
    {
        $productId = $request->input()['product_id'];
        
        $discountType = $request->input()['discount_type'];
        $reduction = $request->input()['reduction'];

        // Check if price after reduction is not less than 0
        if(!$this->validateReductionPrice($productId, $reduction, 
        $discountType)) {
            $product = Product::find($productId);
            $productName = $product->name;
            \Alert::error(
                trans('specificprice.reduction_price_not_ok', 
                    ['productName' => $productName ]))->flash();
            return redirect()->back()->withInput();   
        }


        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry

        
        return $redirect_location;
    }
}
