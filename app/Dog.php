<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    protected $fillable = [
        'name', 'description', 'type', 'price', 'image_path'
    ];
}
