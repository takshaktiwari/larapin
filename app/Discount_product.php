<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount_product extends Model
{
    protected $guarded = [];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}
