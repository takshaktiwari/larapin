<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    protected $guarded = [];

    public function state()
    {
    	return $this->belongsTo('App\State');
    }

    public function country()
    {
    	return $this->belongsTo('App\Country');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function locations()
    {
    	return $this->hasMany('App\Location');
    }
}
