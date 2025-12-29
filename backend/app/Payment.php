<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     protected $fillable = [

    	'post_id',
        'user_id',
        'product_id',
        'banner_id',
        'amount',
    	'payment_id',
    	'payment_request_id',

    ];
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Coaching');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
