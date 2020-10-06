<?php

namespace App;

use App\Sale;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public function sales()
    {
        return $this->hasMany('Sale');
    }
}
