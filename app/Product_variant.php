<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_variant extends Model
{
    protected $guarded = [];

    public function product()
    {
    	return $this->belongsTo('App\Product');
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
