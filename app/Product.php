<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function scopeActive($query)
    {
        return $query->where('is_hidden', 0);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_hidden', 1);
    }

}
