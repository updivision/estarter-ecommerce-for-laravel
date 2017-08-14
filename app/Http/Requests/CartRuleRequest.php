<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CartRuleRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
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
            'name'                      => 'required|min:5|max:255',
            'code'                      => 'required|min:5|max:255',
            'priority'                  => 'required|numeric',
            'start_date'                => 'required|date',
            'expiration_date'           => 'required|date',
            'promo_label'               => 'max:255',
            'promo_text'                => 'max:1000',     
            'multiply_gift'             => 'numeric',
            'min_nr_products'           => 'numeric',
            'reduction_amount'          => 'numeric',
            'total_available'           => 'numeric',
            'total_available_each_user' => 'numeric',
            
       
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
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
