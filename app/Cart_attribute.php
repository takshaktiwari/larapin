<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart_attribute extends Model
{
    protected $guarded = [];

    public function cart()
    {
    	return $this->belongsTo('App\Cart');
    }

    public function attribute()
    {
    	return $this->belongsTo('App\Attribute');
    }

    public function attr_option()
    {
    	$this->belongsTo('App\Att_option');
    }
}
