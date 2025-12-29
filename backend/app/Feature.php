<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    
    protected $guarded = [];
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_features')
                    ->withPivot('status', 'value')
                    ->withTimestamps();
    }
}
