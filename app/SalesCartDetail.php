<?php

namespace App;

use App\Sale;
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
}
