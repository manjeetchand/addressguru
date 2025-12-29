<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
    	'post_id','name','path','product_id','property_id',
    ];

    public function coaching()
    {
    	return $this->belongsTo('App\Coaching');
    }
}
