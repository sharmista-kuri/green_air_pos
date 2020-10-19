<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Category;
use App\Customer;
use App\Employee;
use App\Purchase;
use App\Supplier;
use App\Transaction;
use App\PurchaseCartDetail;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = Employee::get();
        $suppliers = Supplier::get();
        $products = Product::get();
        $categories = Category::get();
        $brands = Brand::get();
        return view('purchases',compact('employees','suppliers','products','categories','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $employees = Employee::get();
        $suppliers = Supplier::get();
        $products = Product::get();
        $categories = Category::get();
        $brands = Brand::get();
        return view('purchases',compact('employees','suppliers','products','categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //echo'<pre>';print_r($request->all());exit;
        $purchase_id = Purchase::create($request->all())->id;
        $counter = $request->tr_counter;
        for($i=1; $i<$counter; $i++){
            if($request['delete_'.$i]==0){
                $data['purchase_id']=$purchase_id;
                $data['product_id']=$request['product_'.$i];
                $data['quantity']=$request['quantity_'.$i];
                $data['rate']=$request['rate_'.$i];
                $data['amount']=$request['amount_'.$i];
                $salesCart = PurchaseCartDetail::create($data);
                
                $id = $request['product_'.$i];
                $quantity = $request['quantity_'.$i];
                $products = Product::select('current_stock')->whereId($id)->first();
                $current_stock = $products->current_stock + $quantity;
                $data_product['current_stock'] = $current_stock;
                Product::whereId($id)->update($data_product);
            }
            
        }

        $data_transaction['date']=$request['purchase_date'];
        $data_transaction['transaction_type_id']=2;
        $data_transaction['account_type_id']=2;
        $data_transaction['account_id']=$request['supplier_id'];
        $data_transaction['description']=$request['remarks'];
        $data_transaction['amount']=$request['paid'];

        $transaction = Transaction::create($data_transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
