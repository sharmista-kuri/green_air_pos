<?php

namespace App;

use App\Sale;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'name', 'address', 'area','country', 'primary_contact', 'secondary_contact',
        'email', 'customer_type'
    ];

    public function sales()
    {
        return $this->hasMany('Sale');
    }
}
