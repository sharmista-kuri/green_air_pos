<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name','brand_id','description'
    ];

    public function products()
    {
        return $this->hasMany('Product');
    }

    public function brands()
    {
        return $this->belongsTo('Brand');
    }
}
