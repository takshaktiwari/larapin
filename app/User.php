<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'email_verified_at', 
        'api_token', 
        'role_id', 
        'mobile',
        'facebook_id',
        'google_id',
        'twitter_id',
        'user_img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function wishlists($value='')
    {
        return $this->hasMany('App\Wishlist');
    }

    public function addresses()
    {
        return $this->hasMany('App\User_address');
    }

    public function coupons()
    {
        return $this->belongsToMany('App\Coupon');
    }

    public function reviews()
    {
        return $this->hasMany('App\Product_review');
    }
}
