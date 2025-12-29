<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpeningHours extends Model{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'opening_hours'; 
    protected $guarded = [];

    public function listing(){
        return $this->hasOne(listing::class,'id','listing_id');
    }
    
}


