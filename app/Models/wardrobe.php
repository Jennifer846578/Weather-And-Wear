<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wardrobe extends Model
{
    //
    protected $fillable=[
        'userid',
        'imagePath',
        'category',
        'color',
        'style',
    ];
}
