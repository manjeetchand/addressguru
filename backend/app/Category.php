<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Category extends Model

{

    protected $guarded =  [];



    public function sub_categories()

    {

        return $this->hasMany('App\SubCategory');

    }



    public function subcategory()

    {

        return $this->belongsTo('App\SubCategory');

    }

    

    public function facilities()

    {

        return $this->hasMany('App\Facility');  

    }

    public function services()

    {

        return $this->hasMany('App\Service');  

    }

    

    public function forms(){

         return $this->hasMany('App\Categoryforms');  

    }

    

     

    public function childcategory()

    {

        return $this->hasMany('App\ChildCategory');  

    }

    public function attributes() {
        return $this->belongsToMany(Attribute::class, 'attribute_category');
    }

}

