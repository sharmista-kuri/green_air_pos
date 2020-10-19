<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name', 'category_id', 'description','purchase_price', 'sale_price', 'current_stock'
    ];

    public function categories()
    {
        return $this->belongsTo('Category');
    }

    public function sales_cart_details()
    {
        return $this->hasMany(SalesCartDetail::class,'product_id');
    }
}
