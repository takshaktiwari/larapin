<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_address extends Model
{
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function location()
    {
    	return $this->belongsTo('App\Location');
    }

    public function pincode()
    {
        return $this->belongsTo('App\Pincode');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function state()
    {
    	return $this->belongsTo('App\State');
    }

    public function country()
    {
    	return $this->belongsTo('App\Country');
    }
}
