<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [

    	'post_id',
        'user_id',
        'category_id',
        'subcategory_id',
        'post_status',
    	'name',
    	'email',
    	'state',
    	'city',
        'location',
    	'ph_number',
    	'ph_number',
        'agent',
        'verify',
        'is_active',
        'status',


    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function coaching()
    {
        return $this->belongsTo('App\Coaching');
    }

    public function post()
    {
        return $this->belongsTo('App\Coaching');
    }

}
