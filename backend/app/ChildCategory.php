<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\SubCategory');
    }

    public function parentcat()
    {
        return $this->hasMany(ChildCategory::class, 'parent', 'id');
    }
}
