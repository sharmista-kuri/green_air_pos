<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Category;
use App\Customer;
use App\Employee;
use App\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
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
        $customers = Customer::get();
        $suppliers = Supplier::get();
        $products = Product::get();
        $categories = Category::get();
        $brands = Brand::get();
        return view('suppliers_report',compact('employees','customers','suppliers','products','categories','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('supplier');
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
        $supplier_id = Supplier::create($request->all())->id;
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

     public function grid(Request $request){

        
        $pagenum = $request->pagenum;
        $pagesize = $request->per_pagess;
        $start = $pagenum * $pagesize;


        $filterscount = $request->filterscount;
        $sortdatafield = $request->sortdatafield;
        $sortorder = $request->sortorder;

        
        $where="suppliers.id<>0";         
        
        
        if($request->supplier_name != '') 
        {$where.=" AND name = '".trim($request->supplier_name)."'";}

        if($request->email != '') 
        {$where.=" AND email = '".trim($request->email)."'";}

        if($request->contact != '') 
        {$where.=" AND (primary_contact = '".trim($request->contact)."' OR secondary_contact = '".trim($request->contact)."')";}

        if($request->customer_type != '') 
        {$where.=" AND FIND_IN_SET(".$request->customer_type.",supplier_type) ";}

        
        $q = Supplier::whereRaw($where)
        ->get();
    
        
        $result["total"] = $q->count();
        
        if ($q->count() > 0){        
            $result["Rows"] = $q;
        } else {
            $result["Rows"] = array();
        }       

        echo "{\"total\":".json_encode($result['total']).",\"data\":".json_encode($result['Rows'])."}";

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
    
    public function supplier_id(){
        $supplier_id = Supplier::select('id')->orderBy('id','desc')->first();
        echo json_encode($supplier_id);
    }

    public function supplier_select_box(){
        $suppliers = Supplier::orderBy('id','desc')->get();
        foreach ($suppliers as $supplier){
            $sup[]=array(
				'value'=>$supplier->id,
				'label'=>$supplier->name
				);          
        }

        $data = array(
            'sup' => $sup,
        );
        echo json_encode($data);
    }

    public function supplier_info(Request $request){
        $supplier = Supplier::find($request->supplier_id);
        echo json_encode($supplier);
    }

    
}
