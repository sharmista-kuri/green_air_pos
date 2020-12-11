<?php

namespace App\Http\Controllers;

use App\User;
use App\Brand;
use App\Product;
use App\Category;
use App\Customer;
use App\Employee;
use App\Supplier;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $employees = User::get();
        $customers = Customer::get();
        $suppliers = Supplier::get();
        $products = Product::get();
        $categories = Category::get();
        $brands = Brand::get();
        return view('customers_report',compact('employees','customers','suppliers','products','categories','brands'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('customer');
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
        $customer_id = Customer::create($request->all())->id;
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

    public function customer_id(){
        $customer_id = Customer::select('id')->orderBy('id','desc')->first();
        echo json_encode($customer_id);
    }

    public function customer_select_box(){
        $customers = Customer::orderBy('id','desc')->get();
        foreach ($customers as $customer){
            $cus[]=array(
				'value'=>$customer->id,
				'label'=>$customer->name
				);          
        }

        $data = array(
            'cus' => $cus,
        );
        echo json_encode($data);
    }

    public function customer_info(Request $request){
        $customer = Customer::find($request->customer_id);
        echo json_encode($customer);
    }

    public function grid(Request $request){

        
		$pagenum = $request->pagenum;
		$pagesize = $request->per_pagess;
        $start = $pagenum * $pagesize;


        $filterscount = $request->filterscount;
        $sortdatafield = $request->sortdatafield;
        $sortorder = $request->sortorder;

        
		$where="customers.id<>0";         
        
        
        if($request->customer_name != '') 
        {$where.=" AND name = '".trim($request->customer_name)."'";}

        if($request->email != '') 
        {$where.=" AND email = '".trim($request->email)."'";}

        if($request->contact != '') 
        {$where.=" AND (primary_contact = '".trim($request->contact)."' OR secondary_contact = '".trim($request->contact)."')";}

        if($request->customer_type != '') 
        {$where.=" AND FIND_IN_SET(".$request->customer_type.",customer_type) ";}

		
        $q = Customer::whereRaw($where)
        ->get();
	
		
		$result["total"] = $q->count();
		
		if ($q->count() > 0){        
			$result["Rows"] = $q;
		} else {
			$result["Rows"] = array();
		}  		
		
	
		
		
		echo "{\"total\":".json_encode($result['total']).",\"data\":".json_encode($result['Rows'])."}";

    }

    function customer_update(Request $request){
        echo'<pre>';print_r($request->all());exit;
        Customer::where('id',$request->id)->update($request->all());
    }
}
