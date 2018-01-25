<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AttributeRequest as StoreRequest;
use App\Http\Requests\AttributeUpdateRequest as UpdateRequest;
use App\Models\AttributeValue;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class AttributeCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\Attribute");
        $this->crud->setRoute("admin/attributes");
        $this->crud->setEntityNameStrings('attribute', 'attributes');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'name'  => 'name',
                'label' => trans('attribute.name'),
            ],
            [
                'name'  => 'type',
                'label' => trans('attribute.type'),
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
        if ($user->can('list_attributes')) {
            $this->crud->allowAccess('list');
        }

        // Allow create access
        if ($user->can('create_attribute')) {
            $this->crud->allowAccess('create');
        }

        // Allow update access
        if ($user->can('update_attribute')) {
            $this->crud->allowAccess('update');
        }

        // Allow delete access
        if ($user->can('delete_attribute')) {
            $this->crud->allowAccess('delete');
        }
    }

    public function setFields()
    {
        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => trans('attribute.name'),
                'type'  => 'text',
            ],
            [
                'name'    => 'type',
                'label'   => trans('attribute.type'),
                'type'    => 'select_from_array',
                'options' => [
                    '0'                 => '--',
                    'text'              => trans('attribute.text'),
                    'textarea'          => trans('attribute.textarea'),
                    'date'              => trans('attribute.date'),
                    'multiple_select'   => trans('attribute.multiple_select'),
                    'dropdown'          => trans('attribute.dropdown'),
                    'media'             => trans('attribute.media')
                ],
                'attributes' => [
                    'id' => 'attribute_type'
                ]
            ],
            [
                'name'          => "media",
                'label'         => trans('attribute.default')." ".trans('attribute.media'),
                'type'          => 'attribute_type_image',
                'default'       => 'default.png',
                'disk'          => 'attributes',
                'upload'        => true,
                'aspect_ratio'  => 0,
            ],
            [
                'name'  => 'attribute_types',
                'label' => trans('attribute.name'),
                'type'  => 'attribute_types',
            ]
        ]);
    }

	public function store(StoreRequest $request)
	{
        $redirect_location = parent::storeCrud();
        $entryId           = $this->crud->entry->id;

        // Define Storage disk for media attribute type
        $disk = "attributes";

        // Init attributeValue array
        $attributeValue = [];

        switch($request->type) {
            case 'text':
            case 'textarea':
            case 'date':
                $attributeValue = [
                    'attribute_id' => $entryId,
                    'value'        => $request->{$request->type}
                ];
            break;

            case 'multiple_select':
            case 'dropdown':
                foreach ($request->option as $option) {
                    $attributeValue[] = [
                        'attribute_id' => $entryId,
                        'value'        => $option
                    ];
                }
            break;

            case 'media':
                if (starts_with($request->media, 'data:image')) {
                    // 1. Make the image
                    $image = \Image::make($request->media);
                    // 2. Generate a filename.
                    $filename = md5($request->media.time()).'.jpg';
                    // 3. Store the image on disk.
                    \Storage::disk($disk)->put($filename, $image->stream());
                    // 4. Save the path to attributes_value
                    $attributeValue = ['attribute_id' => $entryId, 'value' => $filename];
                }
            break;
        }

        $insert_attribute_values = AttributeValue::insert($attributeValue);

        return $redirect_location;
	}

	public function update(UpdateRequest $request, AttributeValue $attributeValue)
	{
        // Define Storage disk for media attribute type
        $disk = 'attributes';

        switch ($request->type) {
            case 'text':
            case 'textarea':
            case 'date':
                $attributeValue->where('attribute_id', $request->id)->update(['value' => $request->{$request->type}]);
            break;

            case 'multiple_select':
            case 'dropdown':
                if (isset($request->current_option)) {
                    foreach ($request->current_option as $key => $current_option) {
                        $attributeValue->where('id', $key)->update(['value' => $current_option]);
                    }
                }

                if (isset($request->option)) {
                    foreach ($request->option as $option) {
                        $attribute_values[] = ['attribute_id' => $request->id, 'value' => $option];
                    }

                    $insert_new_option = $attributeValue->insert($attribute_values);
                }
            break;

            case 'media':
                if (starts_with($request->media, 'data:image')) {
                    // 0. Get current image filename
                    $current_image_filename = $attributeValue->where('attribute_id', $request->id)->first()->value;
                    // 1. delete image file if exist
                    if (\Storage::disk($disk)->has($current_image_filename)) {
                        \Storage::disk($disk)->delete($current_image_filename);
                    }
                    // 2. Make the image
                    $image = \Image::make($request->media);
                    // 3. Generate a filename.
                    $filename = md5($request->media.time()).'.jpg';
                    // 4. Store the image on disk.
                    \Storage::disk($disk)->put($filename, $image->stream());
                    // 5. Update image filename to attributes_value
                    $attributeValue->where('attribute_id', $request->id)->update(['value' => $filename]);
                }
            break;
        }

        $redirect_location = parent::updateCrud();

        return $redirect_location;
	}
}
