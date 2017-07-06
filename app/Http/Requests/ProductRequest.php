<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Attribute;

class ProductRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|max:255',
            'description'       => 'required|min:3',
            'price'             => 'required|numeric|between:0,9999999999999.999999',
            'categories'        => 'required',
            'sku'               => 'required|unique:products,sku'.($this->request->get('id') ? ','.$this->request->get('id') : ''),
            'stock'             => 'required|numeric',
            'active'            => 'required|numeric|between:0,1',
            'attribute_set_id' => 'required',
            'attributes'        => 'sometimes|required',
            'attributes.*'      => 'sometimes|required'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {

        $attributes = [];

        if ($this->input('attributes')) {
            foreach ($this->input('attributes') as $key => $option) {
                $attributes['attributes.'.$key] = strtolower(trans('attribute.attribute'))." \"".Attribute::find($key)->name."\"";
            }
        }

        return $attributes;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
