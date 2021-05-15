<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_id','name','email','network','country','language','promotional_link','image','cost','post_type','company_name','mobile'
    ];

    public function language()
    {
    	return $this->belongsTo(Language::class);
    }

    public function country()
    {
    	return $this->belongsTo(Country::class);
    }

    public function network()
    {
    	return $this->belongsTo(Network::class);
    }
}
