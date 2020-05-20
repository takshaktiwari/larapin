<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
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

    public function pincode()
    {
    	return $this->belongsTo('App\Pincode');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }
}
