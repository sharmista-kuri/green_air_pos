<?php

namespace App;

use App\Purchase;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = [
        'name', 'address', 'area','country', 'primary_contact', 'secondary_contact',
        'email', 'supplier_type'
    ];

    public function purchases()
    {
        return $this->hasMany('Purchase');
    }
}
