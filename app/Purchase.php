<?php

namespace App;

use App\Employee;
use App\Supplier;
use App\PurchaseCartDetail;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $fillable = [
        'invoice_no', 'employee_id', 'purchase_date','purchase_type', 'supplier_id', 'subtotal',
        'vat', 'transport_labour', 'discount','total', 'paid', 'due','remarks'
    ];

    public function purchase_cart_details()
    {
        return $this->hasMany('PurchaseCartDetail');
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
