<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount_category extends Model
{
    protected $fillable = ['category_id', 'discount', 'expires_at'];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
