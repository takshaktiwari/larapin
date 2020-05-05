<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function permissions()
    {
    	return $this->hasMany('App\Role_permission', 'role_id', 'id');
    }
}
