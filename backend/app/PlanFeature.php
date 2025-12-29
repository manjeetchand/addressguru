<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    protected $fillable = [
        'plan_id',
        'feature_id',
        'status',
        'value'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
