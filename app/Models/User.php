<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Session;
use Crypt;
use Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'token_code',
        'shop_name',
        'phone_number',
        'whatsapp_token',
        'tipo_usuario',
        'whatsapp_token',
        'phone_number',
        'url_wordpress',
        'url_api_shopify',
        'commerse_code',
        'triidyPass',
        'triidyUser'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function setPasswordAttribute($pass){
    //     // if(!empty($pass)){
    //     //     $this->attributes['password'] = \Hash::make($pass);
    //     // }
    // }
}
