<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function details()
    {
    	return $this->hasOne('App\Product_detail');
    }

    public function variants()
    {
    	return $this->hasMany('App\Product_variant');
    }

    public function images()
    {
    	return $this->hasMany('App\Product_image');
    }
}
