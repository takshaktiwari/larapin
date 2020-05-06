<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount_category extends Model
{
    protected $guarded = [];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
