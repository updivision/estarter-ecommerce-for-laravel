<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Models\Currency;
use App\Models\Product;

class SpecificPrice extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'specific_prices';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['reduction',
                           'start_date',
                           'expiration_date',
                           'product_id',
                           'currency_id',
                           'discount_type'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | EVENTS
    |--------------------------------------------------------------------------
    */
    
    
    /*

    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getReduction()
    {
        $reduction = $this->reduction;

        if(isset($reduction)){
            if($this->discount_type=='Percent') {
                return $reduction . ' %';
            }
            return $reduction;
        }
        return '-'; 
    }

    public function getOldPrice()
    {
        $product = Product::find($this->product_id);
        if(isset($product)) {
            return number_format($product->price . $product->currency, 2);
        }
        return '-';
    }

    public function getReducedPrice()
    {  
        $product = Product::find($this->product_id);

        if(isset($product)) {
            $oldPrice = $product->price;
            if($this->discount_type == 'Percent'){
                return number_format($oldPrice - $this->reduction/100 * $oldPrice, 2);
            }
            if($this->discount_type == 'Amount'){
                return number_format($oldPrice - $this->reduction, 2);
            }
            return number_format($product->price, 2);
        }
        return '-';
    }

    public function getProductName()
    {
        $product = Product::find($this->product_id);
        if(isset($product)) {
            return $product->name;
        }
        return "-";
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function product(){
        return $this->hasOne('App\Models\Product');
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
