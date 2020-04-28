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
}
