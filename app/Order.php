<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];


    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function coupon()
    {
    	return $this->belongsTo('App\Coupon');
    }

    public function pincode($value='')
    {
    	return $this->belongsTo('App\Pincode');
    }

    public function order_products()
    {
    	return $this->hasMany('App\Order_product');
    }

    public function order_product_attrs()
    {
    	return $this->hasMany('App\Order_product_attr');
    }

    public function shipping_slot()
    {
        return $this->belongsTo('App\Shipping_slot');
    }

    public function order_histories()
    {
        return $this->hasMany('App\Order_history');
    }
}
