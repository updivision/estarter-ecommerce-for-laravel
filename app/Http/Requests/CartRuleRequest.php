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
           // TO DO:
            'name'                      => 'required|min:5|max:255',
            'code'                      => 'required|min:5|max:255',
            'priority'                  => 'required|integer',
            'start_date'                => 'required|date',
            'expiration_date'           => 'required|date',
            'promo_label'               => 'max:255',
            'promo_text'                => 'max:1000',     
            'multiply_gift'             => 'integer',
            'min_nr_products'           => 'integer',
            'reduction_amount'          => 'integer',
            'total_available'           => 'integer',
            'total_available_each_user' => 'integer'
            
       
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
