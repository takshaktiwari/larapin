<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function cart_attributes()
    {
    	return $this->hasMany('App\Cart_attribute');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Coupon');
    }
}
