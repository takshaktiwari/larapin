<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_attr extends Model
{
    protected $guarded = [];

    public function attribute()
    {
    	return $this->belongsTo('App\Attribute');
    }

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function product_options()
    {
    	return $this->hasMany('App\Product_option');
    }
}
