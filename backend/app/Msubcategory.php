<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Msubcategory extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [

    	'category_id', 'name', 'icon', 'colors', 'og',

    ];

    public function mcategory()
    {
        return $this->belongsTo('App\Mcategory', 'category_id');
    }

    public function products()
    {
        return $this->HasMany('App\Product', 'subcategory_id');
    }
    
    public function childcategory()
    {
        return $this->hasMany('App\ChildCategory', 'msub_category_id', 'id');
    }
}
