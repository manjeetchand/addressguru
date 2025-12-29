<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $fillable = [

    	'user_id',
    	'post_id',
    	'name',
    	'about',
    	'price',
    	'dates',


    ];

    public function coaching()
    {
    	return $this->belongsTo('App\Coaching');
    }
}
