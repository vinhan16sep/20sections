<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branding extends Model
{
    protected $table = 'branding';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
