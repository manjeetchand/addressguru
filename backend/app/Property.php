<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class property extends Model
{
    use Sluggable, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'business_name',
                'onUpdate' => true
            ]
        ];
    }

    public function media()
    {
        return $this->HasMany('App\Media', 'property_id');
    }
    
     public function personals()
    {
        return $this->HasMany('App\Personal', 'property_id');
    }

    public function s_e_o_s()
    {
        return $this->HasMany('App\SEO', 'post_id');
    }
    
    public function views()
    {
        return $this->HasMany('App\Views', 'property_id');
    }

    public function packages()
    {
        return $this->HasMany('App\Packages', 'post_id');
    }

    public function ratings()
    {
        return $this->HasMany('App\Rating', 'property_id');
    }

    public function mcategory()
    {
        return $this->belongsTo('App\Mcategory', 'category_id');
    }

    public function msubcategory()
    {
        return $this->belongsTo('App\Msubcategory', 'subcategory_id');
    }
    

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function lapp()
    {
        return $this->hasOne('App\lapp');
    }

    public function lapps()
    {
        return $this->HasMany('App\lapp');
    }
}
