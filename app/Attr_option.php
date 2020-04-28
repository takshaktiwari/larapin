<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attr_option extends Model
{
    protected $guarded = [];

    public function attribute()
    {
    	return $this->belongsTo('App\Attribute');
    }
}
