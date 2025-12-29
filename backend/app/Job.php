<?php



namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\SoftDeletes;



class Job extends Model

{

    use Sluggable, Notifiable, SoftDeletes;



    protected $dates = ['deleted_at'];



    protected $guarded = [];

   protected $table = 'jobs';



	public function sluggable(): array

    {

        return [

            'slug' => [

                'source' => 'business_name',

                'onUpdate' => true

            ]

        ];

    }



     public function mcategory()

    {

        return $this->belongsTo('App\Mcategory', 'category_id');

    }



    public function msubcategory()

    {

        return $this->belongsTo('App\Msubcategory', 'subcategory_id');

    }

    

    public function inactiveJobs()

    {

        return $this->belongsTo('App\InactiveJob', 'inactive_job_id');

    }



    public function s_e_o_s()

    {

        return $this->HasMany('App\SEO', 'post_id');

    }

    

    public function views()

    {

        return $this->HasMany('App\Views', 'job_id');

    }



    public function packages()

    {

        return $this->HasMany('App\Packages', 'post_id');

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

    public function company(){
        return $this->belongsTo('App\Company','company_id');
    }

    public function qualification(){
        return $this->belongsTo('App\EducationLevel','qualification');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function job_type(){
        return $this->belongsTo('App\JobType', 'job_type_id');
    }

    public function queries()
    {
        return $this->morphMany(Query::class, 'queryable');
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'queryable');
    }

}

