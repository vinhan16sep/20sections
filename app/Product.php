<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function Branding()
    {
        return $this->belongsTo('App\Branding');
    }
}
