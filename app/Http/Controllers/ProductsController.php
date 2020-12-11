<?php

namespace App\Http\Controllers;

use App\User;
use App\Brand;
use App\Product;
use App\Category;
use App\Employee;
use App\Supplier;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
        $suppliers = Supplier::get();
        $products = Product::get();
        $categories = Category::get();
        $brands = Brand::get();
        return view('products_report',compact('employees','suppliers','products','categories','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::get();
        $brands = Brand::get();
        return view('product',compact('categories','brands'));
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
        $product = Product::create($request->all())->id;
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
        Product::where('id',$request->id)->update($request->all());
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

    public function product_id(){
        $product_id = Product::select('id')->orderBy('id','desc')->first();
        echo json_encode($product_id);
    }

    public function product_select_box(){
        $products = Product::orderBy('id','desc')->get();
        foreach ($products as $product){
            $pro[]=array(
				'value'=>$product->id,
				'label'=>$product->name
				);          
        }

        $data = array(
            'pro' => $pro,
        );
        echo json_encode($data);
    }

    public function grid(Request $request){

        
		$pagenum = $request->pagenum;
		$pagesize = $request->per_pagess;
        $start = $pagenum * $pagesize;


        $filterscount = $request->filterscount;
        $sortdatafield = $request->sortdatafield;
        $sortorder = $request->sortorder;

        
		$where="products.id<>0";         
        
        
        if($request->product_id != '') 
        {$where.=" AND id = ".$request->product_id;}

        if($request->category_id != '') 
        {$where.=" AND category_id = ".$request->category_id;}
        
        if($request->brand_id != '') 
        {$where.=" AND brand_id = ".$request->brand_id;}
        
		
        $q = Product::with(['categories'])->with(['brands'])->whereRaw($where)
        ->get();
	
		
		$result["total"] = $q->count();
		
		if ($q->count() > 0){        
			$result["Rows"] = $q;
		} else {
			$result["Rows"] = array();
		}  		
		
	
		
		
		echo "{\"total\":".json_encode($result['total']).",\"data\":".json_encode($result['Rows'])."}";

    }


    function products_update_price(Request $request){
        //echo'<pre>';print_r($request->all());exit;
        Product::where('id',$request->id)->update($request->all());
    }


    
}
