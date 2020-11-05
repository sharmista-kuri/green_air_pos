<?php

namespace App;

use App\Brand;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name', 'category_id', 'brand_id', 'description','purchase_price', 'sale_price', 'current_stock'
    ];

    public function categories()
    {
        return $this->belongsTo('Category');
    }

    public function brands()
    {
        return $this->belongsTo('Brand');
    }

    public function sales_cart_details()
    {
        return $this->hasMany(SalesCartDetail::class,'product_id');
    }
}
