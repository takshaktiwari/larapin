<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];

    public function children($value='')
    {
    	return $this->hasMany('App\Permission', 'parent', 'id');
    }
}
