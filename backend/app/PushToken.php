<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PushToken extends Model
{
    use SoftDeletes;

    protected $table = "push_token";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'token', 'status'
    ];

}
