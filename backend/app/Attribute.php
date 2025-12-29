<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    // protected $casts = [
    //     'options' => 'array',
    // ];
    public function categories() {
        return $this->belongsToMany(Category::class, 'attribute_category');
    }

}