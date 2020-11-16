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
        return view('purchases_report',compact('employees','suppliers','products','categories','brands'));
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
                //echo'<pre>';print_r($request->all());exit;
                $product_id = $request['product_'.$i];
                $quantity = $request['quantity_'.$i];
                $exists = Product::whereId($product_id)->exists();
                
                if($exists){
                    $products = Product::select('current_stock')->whereId($product_id)->first();
                    if($products->current_stock==null){
                        $current_stocks = 0;
                    }
                    else{
                        $current_stocks = $products->current_stock;
                    }
                    
                }
                else{
                    $current_stocks = 0;
                }

                $current_stock = $current_stocks + $quantity;
                $data_product['current_stock'] = $current_stock;
                Product::whereId($product_id)->update($data_product);
            }
            
        }

        $data_transaction['date']=$request['purchase_date'];
        $data_transaction['transaction_type_id']=2;
        $data_transaction['account_type_id']=2;
        $data_transaction['account_id']=$request['supplier_id'];
        $data_transaction['description']=$request['remarks'];
        $data_transaction['amount']=$request['paid'];

        $transaction = Transaction::create($data_transaction);

        return redirect()->action('PurchasesController@create');
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

    public function grid(Request $request){

        
		$pagenum = $request->pagenum;
		$pagesize = $request->per_pagess;
        $start = $pagenum * $pagesize;


        $filterscount = $request->filterscount;
        $sortdatafield = $request->sortdatafield;
        $sortorder = $request->sortorder;

        
		$where="purchases.id<>0";  
		$where1="purchase_cart_details.id<>0";  

        
        if($request->invoice_no != '') 
        {$where.=" AND invoice_no = '".trim($request->invoice_no)."' ";}
        
        if($request->employee_id != '') 
		{$where.=" AND employee_id = ".$request->employee_id;}
        
        if($request->purchase_date_from != '') 
        {$where.=" AND purchase_date >= '".trim($request->purchase_date_from)."' ";}

        if($request->purchase_date_to != '') 
        {$where.=" AND purchase_date <= '".trim($request->purchase_date_to)."' ";}
        
        if($request->purchase_type != '') 
        {$where.=" AND purchase_type = ".$request->purchase_type;}

        if($request->supplier_id != '') 
        {$where.=" AND supplier_id = ".$request->supplier_id;}
        
        if($request->product_id != '') 
        {$where1.=" AND product_id = ".$request->product_id;}
        
        $products = PurchaseCartDetail::whereRaw($where1);
		
        $q = Purchase::with(['employees'])->with(['suppliers'])->whereRaw($where)
        ->joinSub($products, 'purchase_cart_details', function ($join) {
            $join->on('purchases.id', '=', 'purchase_cart_details.purchase_id');
        })
        ->join('products','products.id','=','purchase_cart_details.product_id')
        ->get();
	
        
		
		$result["total"] = $q->count();
		
		if ($q->count() > 0){        
			$result["Rows"] = $q;
		} else {
			$result["Rows"] = array();
		}  		
		
	
		
		
		echo "{\"total\":".json_encode($result['total']).",\"data\":".json_encode($result['Rows'])."}";

    }

    function purchase_invoice_create(){
        $purchase_id = Purchase::select('id')->orderBy('id','desc')->first();
        echo json_encode($purchase_id);
    }

    
}
