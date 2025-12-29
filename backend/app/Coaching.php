<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coaching extends Model
{
    use Sluggable, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 
        'category_id',
        'subcategory_id',
        'status',
        'post_status',
        'business_name',         
        'business_address',
        'ad_description',
        'map',
        'lat',
        'lng',
        'video',
        'payment',
        'course',
        'facility',
        'service',
        'web_link',
        'floor',
        'area',
        'furnished',
        'bathroom',
        'religion_view',
        'only_for',
        'rent',
        'h_star',
        'slug',
        'photo',
        'r_type',
        'ifsc',
        'list_by',
        'pet_friend',
        'bedroom',
        'facing',
        'dwelling',
        'job_category',
        'ip',
        'postal_code',
        'tin_no',
    ];

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
        return $this->HasMany('App\Media', 'post_id');
    }

    public function personals()
    {
        return $this->HasMany('App\Personal', 'post_id');
    }
    
    public function s_e_o_s()
    {
        return $this->HasMany('App\SEO', 'post_id');
    }
    
    public function ratings()
    {
        return $this->HasMany('App\Rating', 'post_id');
    }

    public function views()
    {
        return $this->HasMany('App\Views', 'post_id');
    }

    public function packages()
    {
        return $this->HasMany('App\Packages', 'post_id');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\SubCategory');
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

   
    public function quires(){
        return $this->HasMany('App\Query', 'post_id');
    }
    public function report(){
        return $this->HasMany('App\Report', 'post_id');
    }
}
