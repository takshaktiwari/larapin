<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{
    protected $guarded = [];

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function order_product_attrs($value='')
    {
    	return $this->hasMany('App\Order_product_attr');
    }
}
