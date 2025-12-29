<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SEO extends Model
{
	 use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [

    	'post_id',
    	'user_id',
    	's_description',
    	'keywords',

    ];

    public function coaching()
    {
    	return $this->belongsTo('App\Coaching');
    }
}
