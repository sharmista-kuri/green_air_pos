<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Brand;
use App\Product;
use App\Category;
use App\Customer;
use App\Employee;
use App\Transaction;
use App\SalesCartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::get();
        $customers = Customer::get();
        $products = Product::get();
        $categories = Category::get();
        $brands = Brand::get();
        return view('sales_report',compact('employees','customers','products','categories','brands'));
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
        $customers = Customer::get();
        $products = Product::get();
        $categories = Category::get();
        $brands = Brand::get();
        return view('sales',compact('employees','customers','products','categories','brands'));
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
        $sale_id = Sale::create($request->all())->id;
        $counter = $request->tr_counter;

        for($i=1; $i<$counter; $i++){
            $data = array();
            if($request['delete_'.$i]==0){
                $data['sales_id']=$sale_id;
                $data['product_id']=$request['product_'.$i];
                $data['quantity']=$request['quantity_'.$i];
                $data['rate']=$request['rate_'.$i];
                $data['amount']=$request['amount_'.$i];
                $salesCart = SalesCartDetail::create($data);
                
                $id = $request['product_'.$i];
                $quantity = $request['quantity_'.$i];
                $products = Product::select('current_stock')->whereId($id)->first();
                $current_stock = $products->current_stock - $quantity;
                $data_product['current_stock'] = $current_stock;
                Product::whereId($id)->update($data_product);
            }
            
        }

        $data_transaction['date']=$request['sale_date'];
        $data_transaction['transaction_type_id']=1;
        $data_transaction['account_type_id']=1;
        $data_transaction['account_id']=$request['customer_id'];
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

    

    public function product_info(Request $request){
        //echo'<pre>';print_r($request->product_id);exit;
        $product = Product::find($request->product_id);
        //echo'<pre>';print_r($product);exit;
        echo json_encode($product);
    }


    public function grid(Request $request){

        
		$pagenum = $request->pagenum;
		$pagesize = $request->per_pagess;
        $start = $pagenum * $pagesize;


        $filterscount = $request->filterscount;
        $sortdatafield = $request->sortdatafield;
        $sortorder = $request->sortorder;

        
		$where="sales.id<>0";  
		$where1="sales_cart_details.id<>0";  

        
        if($request->invoice_no != '') 
        {$where.=" AND invoice_no = '".trim($request->invoice_no)."' ";}
        
        if($request->employee_id != '') 
		{$where.=" AND employee_id = ".$request->employee_id;}
        
        if($request->sale_date_from != '') 
        {$where.=" AND sale_date >= '".trim($request->sale_date_from)."' ";}

        if($request->sale_date_to != '') 
        {$where.=" AND sale_date <= '".trim($request->sale_date_to)."' ";}
        
        if($request->sale_type != '') 
        {$where.=" AND sale_type = ".$request->sale_type;}

        if($request->customer_id != '') 
        {$where.=" AND customer_id = ".$request->customer_id;}
        
        if($request->product_id != '') 
        {$where1.=" AND product_id = ".$request->product_id;}
        
        $products = SalesCartDetail::whereRaw($where1);
		
        $q = Sale::with(['employees'])->with(['customers'])->whereRaw($where)
        ->joinSub($products, 'sales_cart_details', function ($join) {
            $join->on('sales.id', '=', 'sales_cart_details.sales_id');
        })
        ->join('products','products.id','=','sales_cart_details.product_id')
        ->get();
	
        
		
		$result["total"] = $q->count();
		
		if ($q->count() > 0){        
			$result["Rows"] = $q;
		} else {
			$result["Rows"] = array();
		}  		
		
	
		
		
		echo "{\"total\":".json_encode($result['total']).",\"data\":".json_encode($result['Rows'])."}";

    }

    

    
}
