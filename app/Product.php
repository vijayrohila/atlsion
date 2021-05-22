<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'start_date','end_date','image','question'
    ];

    public function option()
    {
        return $this->hasMany(Product_option::class);
    }
}
