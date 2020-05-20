<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_product_attr extends Model
{
    protected $guarded = [];

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function order_product()
    {
    	return $this->belongsTo('App\Order_product');
    }

    public function attribute()
    {
    	return $this->belongsTo('App\Attribute');
    }

    public function attr_option()
    {
    	return $this->belongsTo('App\Attr_option');
    }
}
