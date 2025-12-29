<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class listing extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'listings'; 
    protected $guarded = [];


    protected $casts = [
        'images'    => 'array',
        'services'  => 'array',
        'payments'  => 'array',
        'facilities'=> 'array',
    ];

     // Custom relationship-like method
    public function service()
    {
        return Service::whereIn('id', $this->services ?? [])->get();
    }

    public function getServiceIdsAttribute()
    {
        return Service::whereIn('id', $this->services ?? [])->pluck('id')->toArray() ?? [];
    }

    public function getServiceNamesAttribute()
    {
        return Service::whereIn('id', $this->services ?? [])->pluck('name')->toArray() ?? [];
    }

    public function getFacilitieIdsAttribute()
    {
        return Facility::whereIn('id', $this->facilities ?? [])->pluck('id')->toArray();
    }

    public function getFacilitieNamesAttribute()
    {
        return Facility::whereIn('id', $this->facilities ?? [])->pluck('name')->toArray();
    }

    public function getPaymentIdsAttribute()
    {
        return PaymentMode::whereIn('id', $this->payments ?? [])->pluck('id')->toArray();
    }

    public function getPaymentNamesAttribute()
    {
        return PaymentMode::whereIn('id', $this->payments ?? [])->pluck('name')->toArray();
    }

    public function queries()
    {
        return $this->morphMany(Query::class, 'queryable');
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'queryable');
    }
    
    public function claim()
    {
        return $this->morphMany(Claim::class, 'queryable');
    }

    public function report()
    {
        return $this->morphMany(Report::class, 'queryable');
    }

    public function view()
    {
        return $this->morphOne(Views::class, 'queryable');
    }

    public function viewLogs()
    {
        return $this->morphMany(ViewLog::class, 'queryable');
    }
    
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function opening_hours()
    {
        return $this->hasMany(OpeningHours::class, 'listing_id', 'id');
    }
}