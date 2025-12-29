<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQuery extends Model
{
    use HasFactory;
    protected $table = "job_queries";
    protected $guarded = [];
 
}
