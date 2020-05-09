<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];

    public function coupon_uses()
    {
    	return $this->hasMany('App\Coupon_use');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User')->withPivot('created_at');
    }

}
