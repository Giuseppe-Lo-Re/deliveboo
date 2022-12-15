<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'cover',
        'description',
        'ingredients',
        'cooking_time',
        'price',
        'visible',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function orders() {
        return $this->belongsToMany('App\Order');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
