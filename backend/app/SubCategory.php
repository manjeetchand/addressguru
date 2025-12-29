<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [

    	'category_id',
    	'name',

    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function facilities()
    {
        return $this->hasMany('App\Facility');  
    }
    public function services()
    {
        return $this->hasMany('App\Service');  
    }
    
    public function childcategory()
    {
        return $this->hasMany('App\ChildCategory');  
    }
    
}
