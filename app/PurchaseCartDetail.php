<?php

namespace App;

use App\Purchase;
use Illuminate\Database\Eloquent\Model;

class PurchaseCartDetail extends Model
{
    //
    protected $fillable = [
        'purchase_id', 'product_id', 'quantity','rate', 'amount'
    ];
    public function purchases()
    {
        return $this->belongsTo('Purchase');
    }
}
