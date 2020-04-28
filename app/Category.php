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

    public function locations()
    {
    	return $this->belongsToMany('App\Location');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Attribute');
    }

    public function attr_options()
    {
        return $this->belongsToMany('App\Attr_option');
    }
}
