<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $guarded = [];

    public function branding()
    {
        return $this->hasMany('App\Branding');
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
