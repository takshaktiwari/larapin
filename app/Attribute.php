<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarded = [];

    public function attr_options()
    {
    	return $this->hasMany('App\Attr_option');
    }
}
