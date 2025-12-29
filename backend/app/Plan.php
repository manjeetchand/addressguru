<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $guarded = [];
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'plan_features')
                    ->withPivot('status', 'value')
                    ->withTimestamps();
    }
}