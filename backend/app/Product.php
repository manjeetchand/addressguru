<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function mcategory()
    {
        return $this->belongsTo('App\Mcategory', 'category_id');
    }

    public function medias()
    {
        return $this->HasMany('App\Media', 'product_id');
    }

    public function msubcategory()
    {
        return $this->belongsTo('App\Msubcategory', 'subcategory_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function views()
    {
        return $this->HasMany('App\Views', 'product_id');
    }
}
