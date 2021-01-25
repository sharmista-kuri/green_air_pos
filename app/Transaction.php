<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'date','sales_purchase_id', 'transaction_type_id', 'account_type_id','account_id', 'description', 'amount','official_type_id'
    ];
}
