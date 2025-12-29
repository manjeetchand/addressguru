<?php



namespace App;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class Query extends Model

{



	 use SoftDeletes;



    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function queryable()
    {
        return $this->morphTo();
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

