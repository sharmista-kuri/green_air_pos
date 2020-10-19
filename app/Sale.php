<?php

namespace App;

use App\Customer;
use App\SalesCartDetail;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $fillable = [
        'invoice_no', 'employee_id', 'sale_date','sale_type', 'customer_id', 'subtotal',
        'vat', 'transport_labour', 'discount','total', 'paid', 'due','remarks'
    ];

    public function sales_cart_details()
    {
        return $this->hasMany('SalesCartDetail');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
