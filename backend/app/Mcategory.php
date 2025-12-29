<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mcategory extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [

    	'name', 'icon', 'colors', 'des',

    ];

    public function msubcategory()
    {
        return $this->HasMany('App\Msubcategory', 'category_id');
    }

    public function products()
    {
        return $this->HasMany('App\Product', 'category_id');
    }
    
    public function childcategory()
    {
        return $this->hasMany('App\ChildCategory','mcategory_id' ,'id');  
    }
}
