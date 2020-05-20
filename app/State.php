<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = [];

    public function country()
    {
    	return $this->belongsTo('App\Country');
    }

    public function districts($value='')
    {
    	return $this->hasMany('App\District');
    }

    public function pincodes($value='')
    {
        return $this->hasMany('App\Pincode');
    }

    public function locations($value='')
    {
    	return $this->hasMany('App\Location');
    }
}
