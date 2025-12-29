<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketPlace extends Model{
    
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'marketplaces'; 
    protected $guarded = [];


    protected $casts = [
        'images' => 'array',
    ];

     // Custom relationship-like method
    public function services()
    {
       return $this->belongsTo(Service::class, 'service');
    }
}


