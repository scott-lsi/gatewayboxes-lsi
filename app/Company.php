<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['company','free_budget'];

    public function users() {
    	return $this->hasMany('App\User');
    }

    public function orders() {
        return $this->hasManyThrough('App\Order', 'App\User');
    }
}
