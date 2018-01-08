<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable, HasRoles, CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'users';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'salutation',
        'birthday',
        'gender',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $notificationVars = [
        'userSalutation',
        'userName',
        'userEmail',
        'age',
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
            'age'            => $this->age(),
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function age()
    {
        if ($this->birthday) {
            return \Carbon\Carbon::createFromFormat('d-m-Y', $this->birthday)->age;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function companies()
    {
        return $this->hasMany('App\Models\Company');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function cartRules()
    {
        return $this->belongsToMany('App\Models\CartRule');
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
    public function getBirthdayAttribute($value)
    {
        if ($value) {
            return \Carbon\Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
        }
    }

}
