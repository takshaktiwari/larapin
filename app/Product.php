<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function brand()
    {
        return $this->hasOne('App\Brand');
    }

    public function details()
    {
    	return $this->hasOne('App\Product_detail');
    }

    public function product_attrs()
    {
    	return $this->hasMany('App\Product_attr');
    }

    public function product_options()
    {
        return $this->hasMany('App\Product_option');
    }

    public function primary_img()
    {
        return $this->hasOne('App\Product_image')->where('primary_img', true);
    }

    public function images()
    {
    	return $this->hasMany('App\Product_image');
    }

    public function reviews()
    {
        return $this->hasMany('App\Product_review');
    }

    public function discount()
    {
        return $this->hasOne('App\Discount_product');
    }
}
