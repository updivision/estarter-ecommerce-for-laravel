<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class CartRule extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'cart_rules';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'code',
        'priority',
        'start_date',
        'expiration_date',
        'status',
        'highlight',
        'minimum_amount',
        'total_available',
        'total_available_each_user',
        'promo_label',
        'promo_text',
        'multiply_gift',
        'min_nr_products',
        'discount_type',
        'reduction_amount',
        'reduction_currency_id',
        'minimum_amount_currency_id',
        'gift_product_id',
        'customer_id',
        'free_delivery',
    ];
    // protected $hidden = [];
    // protected $dates = [];


    /*
    |--------------------------------------------------------------------------
    | EVENTS
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($model) {
            $model->compatibleCartRules()->detach();
            $model->products()->detach();
            $model->categories()->detach();
            $model->productGroups()->detach();
            $model->customers()->detach();
        });

    }
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function customer()
    {
        return $this->hasOne('App\User');
    }

    public function gift()
    {
        return $this->hasOne('App\Models\Product');
    }

    public function reductionCurrency()
    {
        return $this->hasOne('App\Models\Currency');
    }

    public function minimumAmountCurrency()
    {
        return $this->hasOne('App\Models\Currency');
    }

    public function compatibleCartRules()
    {
        return $this->belongsToMany('App\Models\CartRule', 'cart_rules_combinations', 'cart_rule_id_1', 'cart_rule_id_2');
    }


    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 
            'cart_rules_products', 'cart_rule_id', 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 
            'cart_rules_categories', 'cart_rule_id', 'category_id');
    }

    public function productGroups()
    {
        return $this->belongsToMany('App\Models\ProductGroup',
            'cart_rules_product_groups', 'cart_rule_id', 'product_group_id');
    }

    public function customers()
    {
        return $this->belongsToMany('App\User',
            'cart_rules_customer_groups', 'cart_rule_id', 'customer_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
