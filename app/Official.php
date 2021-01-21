<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    //
    protected $fillable = [
        'name','official_type_id'
    ];

    public function official_types()
    {
        return $this->belongsTo(OfficialType::class,'official_type_id');
    }
}
