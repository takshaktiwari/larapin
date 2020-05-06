<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_option extends Model
{
    protected $guarded = [];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function atrribute()
    {
    	return $this->belongsTo('App\Attribute');
    }

    public function attr_option()
    {
    	return $this->belongsTo('App\Attr_option');
    }

    public function product_attr()
    {
    	return $this->belongsTo('App\Product_attr');
    }
}
