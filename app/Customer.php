<?php

namespace App;

use App\Sale;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'name', 'address', 'area','country', 'primary_contact', 'secondary_contact',
        'email', 'customer_type','due'
    ];

    public function sales()
    {
        return $this->hasMany('Sale');
    }
}
