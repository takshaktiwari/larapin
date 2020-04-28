<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public function states()
    {
    	return $this->hasMany('App\State');
    }

    public function locations()
    {
    	return $this->hasManyThrough('App\Location', 'App\State');
    }
}
