<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\ProductImage;
use App\Models\Tax;
use App\Models\SpecificPrice;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductCrudController extends CrudController
{

    public function setUp()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Product");
        $this->crud->setRoute("admin/products");
        $this->crud->setEntityNameStrings('product', 'products');

        /*
        |--------------------------------------------------------------------------
        | BUTTONS
        |--------------------------------------------------------------------------
        | See setPermissions method
        */

        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
            'name'  => 'name',
            'label' => trans('product.name'),
            ],
            [
            'type'      => "select_multiple",
            'label'     => trans('category.categories'),
            'name'      => 'categories',
            'entity'    => 'categories',
            'attribute' => "name",
            'model'     => "App\Models\Category",
            ],
            [
            'name'  => 'sku',
            'label' => trans('product.sku'),
            ],
            [
            'name'  => 'price',
            'label' => trans('product.price'),
            ],
            [
            'name'  => 'stock',
            'label' => trans('product.stock'),
            ],
            [
            'name'      => 'active',
            'label'     => trans('common.status'),
            'type'      => 'boolean',
            'options'   => [
            0 => trans('common.inactive'),
            1 => trans('common.active')
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
        if ($user->can('list_products')) {
            $this->crud->allowAccess('list');
        }

        // Allow create access
        if ($user->can('create_product')) {
            $this->crud->allowAccess('create');
        }

        // Allow update access
        if ($user->can('update_product')) {
            $this->crud->allowAccess('update');
        }

        // Allow clone access
        if ($user->can('clone_product')) {
            $this->crud->addButtonFromView('line', trans('product.clone'), 'clone_product', 'end');
        }

        // Allow delete access
        if ($user->can('delete_product')) {
            $this->crud->allowAccess('delete');
        }
    }

    public function setFields()
    {
        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => trans('product.name'),
                'type'  => 'text',

                    // TAB
                'tab'   => trans('product.general_tab'),
            ],
            [
                'name'  => 'description',
                'label' => trans('product.description'),
                // 'type'  => 'ckeditor',
                'type'  => 'text',

                    // TAB
                'tab'   => trans('product.general_tab'),
            ],
            [
                'name'      => 'categories',
                'label'     => trans('category.categories'),
                'hint'      => trans('product.hint_category'),
                'type'      => 'select2_multiple',
                'entity'    => 'categories',
                'attribute' => 'name',
                'model'     => "App\Models\Category",
                'pivot'     => true,

                    // TAB
                'tab'   => trans('product.general_tab'),
            ],
            [
                'name'  => 'sku',
                'label' => trans('product.sku'),
                'type'  => 'text',

                    // TAB
                'tab'   => trans('product.general_tab'),
            ],
            [
                'name'  => 'stock',
                'label' => trans('product.stock'),
                'type'  => 'number',

                    // TAB
                'tab'   => trans('product.general_tab'),
            ],
            [
                'name'  => 'price_with_vat',
                'label' => trans('product.price'),
                'type'  => 'number',
                'attributes' => [
                    'step' => 'any',
                ],

                    // TAB
                'tab'   => trans('product.general_tab'),
            ],
            [
                'name'          => 'price',
                'label'         => trans('product.price_without_vat'),
                'type'          => 'text',
                'attributes'    => [
                    'readonly'  => 'readonly',
                ],

                    // TAB
                'tab'   => trans('product.general_tab'),
            ],
            [
                'name'  => 'price_vat_calculator',
                'type'  => 'product_vat',
                'tab'   => trans('product.general_tab'),

            ],
            [
                'type'           => 'select2_tax',
                'label'          => trans('tax.tax'),
                'name'           => 'tax_id',
                'entity'         => 'tax',
                'attribute'      => 'name',
                'data_value'     => 'value',
                'model'          => "App\Models\Tax",
                'attributes'     => [
                'id'    => 'tax',
            ],

                    // TAB
                'tab'   => trans('product.general_tab'),
            ],
            [
                'name'    => 'active',
                'label'   => trans('common.status'),
                'type'    => 'select_from_array',
                'options' => [
                '0' => trans('common.inactive'),
                '1' => trans('common.active'),
            ],

                    // TAB
                'tab'   => trans('product.general_tab'),
            ],
            [
                'name'       => 'attribute_set_id',
                'label'      => trans('attribute.attribute_sets'),
                'type'       => 'select2',
                'entity'     => 'attributes',
                'attribute'  => 'name',
                'model'      => "App\Models\AttributeSet",
                'attributes' => [
                'id'    => 'attributes-set'
            ],

                   // TAB
                'tab'   => trans('product.attributes_tab'),
            ],
            [
                'name'  => 'attribute_types',
                'label' => trans('attribute.name'),
                'type'  => 'product_attributes',

                    // TAB
                'tab'   => trans('product.attributes_tab'),
            ]
            ]);

        $this->crud->addField([
                'name'          => 'dropzone',
                'type'          => 'dropzone',
                'disk'          => 'products', // disk where images will be uploaded
                'mimes'         => [
                'image/*'
                ],
                'filesize'      => 5, // maximum file size in MB

                    // TAB
                'tab'           => trans('product.product_images_tab'),
            ], 'update');

        $this->crud->addField([
                'name'          => 'product_group',
                'type'          => 'product_group',
                'model'         => 'App\Models\Product',

                    // TAB
                'tab'           => trans('product.group_tab'),
            ], 'update');


        // Specific price functionality
        $this->crud->addFields([
             [
                'name'  => 'discount_type',
                'label' => trans('specificprice.discount_type'),
                'model' =>'App\Models\SpecificPrice',
                'entity' => 'specificPrice',
                'type'  => 'enum_discount_simple',

                    // TAB
                'tab'   => trans('specificprice.specific_price')
            ],
            [
                'name'  => 'reduction',
                'label' => trans('specificprice.reduction'),
                'model' => 'App\Models\SpecificPrice',
                'attribute'   => 'reduction',
                'type'  => 'number',


                    // TAB
                'tab'   => trans('specificprice.specific_price')
            ],
            [
                'name'  => 'start_date',
                'label' => trans('specificprice.start_date'),
                'type'  => 'datetime_picker',
                'model' => 'App\Models\SpecificPrice',
                'attribute'   => 'start_date',
                    // TAB
                'tab'   => trans('specificprice.specific_price')
            ],
            [
                'name'  => 'expiration_date',
                'label' => trans('specificprice.expiration_date'),
                'type'  => 'datetime_picker',
                'model' => 'App\Models\SpecificPrice',
                'attribute'   => 'expiration_date',

                    // TAB
                'tab'   => trans('specificprice.specific_price')
            ],

        ]);

    }

    public function ajaxUploadProductImages(Request $request, Product $product)
    {
        $images = [];
        $disk   = "products";

        if ($request->file && $request->id) {
            $product = $product->find($request->id);
            $productImages = $product->images->toArray();

            if ($productImages) {
                $ord = count($productImages);
            } else {
                $ord = 0;
            }

            foreach ($request->file as $file) {
                $file_content = file_get_contents($file);
                $filename = md5(uniqid('', true)).'.'.$file->extension();

                Storage::disk($disk)->put($filename, $file_content);

                $images[] = [
                    'product_id'    => $product->id,
                    'name'          => $filename,
                    'order'         => $ord++
                ];
            }

            $product->images()->insert($images);

            return response()->json($product->load('images')->images->toArray());
        }
    }

    public function ajaxReorderProductImages(Request $request, ProductImage $productImage)
    {
        if ($request->order) {
            foreach ($request->order as $position => $id) {
                $productImage->find($id)->update(['order' => $position]);
            }
        }
    }

    public function ajaxDeleteProductImage(Request $request, ProductImage $productImage)
    {
        $disk = "products";

        if ($request->id) {
            $productImage = $productImage->find($request->id);

            if (Storage::disk($disk)->has($productImage->name)) {
                if (Storage::disk($disk)->delete($productImage->name)) {
                    $productImage->delete();

                    return response()->json(['success' => true, 'message' => trans('product.image_deleted')]);
                }
            }

            return response()->json(['success' => false, 'message' => trans('product.image_not_found')]);
        }
    }

    public function store(StoreRequest $request, ProductGroup $productGroup, SpecificPrice $specificPrice)
    {
        // Create group entry
        $productGroup = $productGroup->create();

        $request->merge([
            'group_id' => $productGroup->id
        ]);

        $redirect_location = parent::storeCrud($request);

        // Save product's attribute values
        if ($request->input('attributes')) {
            foreach ($request->input('attributes') as $key => $attr_value) {
                if (is_array($attr_value)) {
                    foreach ($attr_value as $value) {
                        $this->crud->entry->attributes()->attach([$key => ['value' => $value]]);
                    }
                } else {
                    $this->crud->entry->attributes()->attach([$key => ['value' => $attr_value]]);
                }
            }
        }

        $productId = $this->crud->entry->id;
        $reduction = $request->input('reduction');
        $discountType = $request->input('discount_type');
        $startDate = $request->input('start_date');
        $expirationDate = $request->input('expiration_date');

        if(!$request->has('start_date') || !$request->has('expiration_date')) {
            \Alert::error(trans('specificprice.dates_cant_be_null'))->flash();
            return $redirect_location;
        }

        // Check if a specific price reduction doesn't already exist in this period
        if(!$this->validateProductDates($productId, $startDate, $expirationDate)) {
            $product = Product::find($productId);
            $productName = $product->name;

            \Alert::error(trans('specificprice.wrong_dates', ['productName' => $productName]))->flash();
            return $redirect_location;
        }

        // Check if the price after reduction is not less than 0
        if($request->has('reduction') && $request->has('discount_type')) {
            if(!$this->validateReductionPrice($productId, $reduction,
            $discountType)) {
                \Alert::error(
                    trans('specificprice.reduction_price_not_ok'))->flash();
            }
            else{
                // Save specific price
                $specificPrice->discount_type = $discountType;
                $specificPrice->reduction = $reduction;
                $specificPrice->start_date = $startDate;
                $specificPrice->expiration_date = $expirationDate;
                $specificPrice->product_id = $productId;
                $specificPrice = $specificPrice->save();
            }
        }



        return $redirect_location;
    }


    public function update(UpdateRequest $request, Attribute $attribute, Product $product)
    {
        // Get current product data
        $product = $product->findOrFail($this->crud->request->id);

        $redirect_location = parent::updateCrud($request);

        // Add product attributes ids and values in attribute_product_value (pivot)
        if ($request->input('attributes')) {

            // Set attributes upload disk
            $disk = 'attributes';

            // Get old product atrribute values
            $oldAttributes = [];

            foreach ($this->crud->entry->attributes as $oldAttribute) {
                $oldAttributes[$oldAttribute->id] = $oldAttribute->pivot->value;
            }

            // Check if attribute set was changed and delete uploaded data from disk on attribute type media
            if ($product->attribute_set_id != $this->crud->request->attribute_set_id) {
                foreach ($oldAttributes as $key => $oldAttribute) {
                    if (\Storage::disk($disk)->has($oldAttribute) && $attribute->find($key)->values->first()->value != $oldAttribute) {
                        \Storage::disk($disk)->delete($oldAttribute);
                    }
                }
            }

            $this->crud->entry->attributes()->detach();

            foreach ($request->input('attributes') as $key => $attr_value) {
                if (is_array($attr_value)) {
                    foreach ($attr_value as $value) {
                        $this->crud->entry->attributes()->attach([$key => ['value' => $value]]);
                    }
                } else {
                    if(starts_with($attr_value, 'data:image')) {
                        // 1. Delete old image
                        if ($product->attribute_set_id == $this->crud->request->attribute_set_id) {
                            if (\Storage::disk($disk)->has($oldAttributes[$key]) && $attribute->find($key)->values->first()->value != $oldAttributes[$key]) {
                                \Storage::disk($disk)->delete($oldAttributes[$key]);
                            }
                        }
                        // 2. Make the image
                        $image = \Image::make($attr_value);
                        // 3. Generate a filename.
                        $filename = md5($attr_value.time()).'.jpg';
                        // 4. Store the image on disk.
                        \Storage::disk($disk)->put($filename, $image->stream());
                        // 5. Update image filename to attributes_value
                        $attr_value = $filename;
                    }

                    $this->crud->entry->attributes()->attach([$key => ['value' => $attr_value]]);
                }
            }
        }


        $discountType = $request->input('discount_type');
        $reduction = $request->input('reduction');
        $startDate = $request->input('start_date');
        $expirationDate = $request->input('expiration_date');
        $productId = $this->crud->entry->id;


        // Check if the price after reduction is not less than 0
        if($request->reduction && $request->discount_type && $discountType) {
            if(!$this->validateReductionPrice($productId, $reduction,
            $discountType)) {
                \Alert::error(
                    trans('specificprice.reduction_price_not_ok'))->flash();
                return $redirect_location;
            }
        }

        // Check if a specific price reduction doesn't already exist in this period
        if(!$this->validateProductDates($productId, $startDate, $expirationDate)) {
            $product = Product::find($productId);
            $productName = $product->name;

            \Alert::error(trans('specificprice.wrong_dates', ['productName' => $productName]))->flash();
            return $redirect_location;
        }

        if($request->reduction && $request->discount_type && $discountType) {
            if(!$request->start_date || !$request->expiration_date) {
                \Alert::error(trans('specificprice.dates_cant_be_null'))->flash();
                return $redirect_location;
            }

            // Save specific price
            $specificPrice = new SpecificPrice();

            $specificPrice->discount_type = $discountType;
            $specificPrice->reduction = $reduction;
            $specificPrice->start_date = $startDate;
            $specificPrice->expiration_date = $expirationDate;
            $specificPrice->product_id = $productId;
            $specificPrice = $specificPrice->save();
        }


        return $redirect_location;
    }

    /**
     * @param Product $product
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function cloneProduct(Product $product, Request $request)
    {
        $id = $request->input('product_id');
        $cloneSku = $request->input('clone_sku');

        // Check if cloned product has sku
        if (!$cloneSku) {
            \Alert::error(trans('product.sku_required'))->flash();

            return redirect()->back();
        }

        // Check if product sku exist
        if ($product->where('sku', $cloneSku)->first()) {
            \Alert::error(trans('product.sku_unique'))->flash();

            return redirect()->back();
        }

        // Find product and load relations specified in
        $product = $product->loadCloneRelations()->find($id);

        // Redirect back if product what need to be cloned doesn't exist
        if (!$product) {
            \Alert::error(trans('product.cannot_find_product'))->flash();

            return redirect()->back();
        }

        // Create clone object
        $clone = $product->replicate();
        $clone->sku = $cloneSku;

        // Save cloned product
        $clone->push();

        // Clone product relations
        foreach ($product->getRelations() as $relationName => $values){
            $relationType = getRelationType($product->{$relationName}());

            switch($relationType) {
                case 'hasMany':
                if (count($product->{$relationName}) > 0) {
                    foreach ($product->{$relationName} as $relationValue) {
                        $clone->{$relationName}()->create($relationValue->toArray());
                    }
                }
                break;

                case 'hasOne':
                if ($product->{$relationName}) {
                    $clone->{$relationName}()->create($values->toArray());
                }
                break;

                case 'belongsToMany':
                $clone->{$relationName}()->sync($values);
                break;
            }
        }

        \Alert::success(trans('product.clone_success'))->flash();

        return redirect()->back();
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
             if($expirationDate >= $existingStartDate
                && $startDate <= $existingExpirationDate) {
                return false;
            }
            if($expirationDate >= $existingStartDate
                && $startDate <= $existingExpirationDate) {
                return false;
            }
            if($startDate <= $existingStartDate
                && $expirationDate >= $existingExpirationDate) {
                return false;
            }
        }

        return true;
    }

}



