<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function parent_category()
    {
    	return $this->hasOne('App\Category', 'id', 'parent');
    }

    public function child_categories()
    {
        return $this->hasMany('App\Category', 'parent', 'id');
    }

    public function countries()
    {
        return $this->belongsToMany('App\Country');
    }

    public function states()
    {
        return $this->belongsToMany('App\State');
    }

    public function districts()
    {
        return $this->belongsToMany('App\District');
    }

    public function pincodes()
    {
    	return $this->belongsToMany('App\Pincode');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Attribute');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function discount_category()
    {
        return $this->hasOne('App\Discount_category');
    }

}
