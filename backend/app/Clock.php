<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Clock extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [

    	'post_id', 'day', 'start_time', 'end_time',

    ];
}
