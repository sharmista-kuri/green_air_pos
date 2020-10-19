<?php

namespace App;

use App\Sale;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class SalesCartDetail extends Model
{
    //
    protected $fillable = [
        'sales_id', 'product_id', 'quantity','rate', 'amount'
    ];
    public function sales()
    {
        return $this->belongsTo('Sale');
    }

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
