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
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function sales_cart_details()
    {
        return $this->hasMany(SalesCartDetail::class,'product_id');
    }
}
