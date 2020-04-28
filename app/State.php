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

    public function locations($value='')
    {
    	return $this->hasMany('App\Location');
    }
}
