<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_option extends Model
{
    protected $fillable = [
        'product_id','option','answer'
    ];

    
}
