<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'date', 'transaction_type_id', 'account_type_id','account_id', 'description', 'amount'
    ];
}
