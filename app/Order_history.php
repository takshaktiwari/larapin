<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_history extends Model
{
    protected $guarded = [];

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
