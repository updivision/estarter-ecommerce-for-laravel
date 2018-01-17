<?php

namespace App\Models;

use App\Mail\NotificationTemplateMail;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'orders';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'status_id',
        'comment',
        'invoice_date',
        'delivery_date',
        'shipping_address',
        'billing_address',
        'total_discount',
        'total_discount_tax',
        'total_shipping',
        'total_shipping_tax',
        'total',
        'total_tax'
    ];
    // protected $hidden = [];
    // protected $dates = [];
    public $notificationVars = [
        'userSalutation',
        'userName',
        'userEmail',
        'carrier',
        'total',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | NOTIFICATIONS VARIABLES
    |--------------------------------------------------------------------------
    */
    public function notificationVariables()
    {
        return [
            'userSalutation' => $this->user->salutation,
            'userName'       => $this->user->name,
            'userEmail'      => $this->user->email,
            'total'          => $this->total(),
            'carrier'        => $this->carrier()->first()->name,
            'status'         => $this->status->name
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | EVENTS
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::updating(function($order) {
            // Send notification when order status was changed
            $oldStatus = $order->getOriginal();
            if ($order->status_id != $oldStatus['status_id'] && $order->status->notification != 0) {
                // example of usage: (be sure that a notification template mail with the slug "test2" exists in db)
                return \Mail::to($order->user->email)->send(new NotificationTemplateMail($order, "test2"));
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function total()
    {
        return decimalFormat($this->products->sum(function ($product) {
            return $product->pivot->price_with_tax * $product->pivot->quantity;
        }, 0) + $this->carrier->price);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function status()
    {
        return $this->hasOne('App\Models\OrderStatus', 'id', 'status_id');
    }

    public function statusHistory()
    {
        return $this->hasMany('App\Models\OrderStatusHistory')->orderBy('created_at', 'DESC');
    }

    public function carrier()
    {
        return $this->hasOne('App\Models\Carrier', 'id', 'carrier_id');
    }

    public function shippingAddress()
    {
        return $this->hasOne('App\Models\Address', 'id', 'shipping_address_id');
    }

    public function billingAddress()
    {
        return $this->hasOne('App\Models\Address', 'id', 'billing_address_id');
    }

    public function billingCompanyInfo()
    {
        return $this->hasOne('App\Models\Company', 'id', 'billing_company_id');
    }

    public function currency()
    {
        return $this->hasOne('App\Models\Currency', 'id', 'currency_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot(['name', 'sku', 'price', 'price_with_tax',  'quantity']);
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
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y H:i:s');
    }
}
