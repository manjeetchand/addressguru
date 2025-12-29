<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoryforms extends Model
{
    use SoftDeletes; // Use the SoftDeletes trait

    protected $guarded = []; // This allows mass assignment for all fields
    protected $table = 'category_form'; 
    // Optionally, you can define the date fields
    protected $dates = ['deleted_at'];
}