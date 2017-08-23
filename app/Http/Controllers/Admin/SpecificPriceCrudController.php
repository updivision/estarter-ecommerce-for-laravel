<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

use App\Http\Requests\SpecificPriceRequest as StoreRequest;
use App\Http\Requests\SpecificPriceRequest as UpdateRequest;
use App\Models\SpecificPrice;
use App\Models\Product;


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
        $startDate = $request->input()['start_date'];
        $expirationDate = $request->input()['expiration_date'];


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

        if(!$this->validateProductDates($productId, $startDate, $expirationDate)) {
            $product = Product::find($productId);
            $productName = $product->name;

             \Alert::error(trans('specificprice.wrong_dates', ['productName' => $productName]))->flash();
            return redirect()->back()->withInput();                        
        }


        $redirect_location = parent::updateCrud();
        
        return $redirect_location;
    }


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
    public function getInvalidReductionProduct($productIDs, $reduction, $discountType)
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
            if($item->product_id == $productId) {
                break;
            }
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
    
}
