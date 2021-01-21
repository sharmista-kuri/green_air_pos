<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('brand');
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
        $brand_id = Brand::create($request->all())->id;

        $desc = 'Brand Added';
        $user_act[]=array(
            'Activities_Id'=>1,
            'Activities_by'=>Auth::user()->id,
            'Activities_dt'=>date('Y-m-d H:i:s'),
            'IP'=>$request->ip(),
            'Operate_Id'=>$brand_id,
            'table_name'=>"brands",
            'Description'=>$desc,
            );

        $user_activity = DB::table('usr_activities_histry')->insert($user_act); 
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

    public function brand_select_box(){
        $brands = Brand::orderBy('id','desc')->get();
        foreach ($brands as $brand){
            $b[]=array(
				'value'=>$brand->id,
				'label'=>$brand->name
				);          
        }

        $data = array(
            'b' => $b,
        );
        echo json_encode($data);

    }

    public function brand_product(Request $request){
        $brand_id = $request->brand_id;
        $category_id = $request->category_id;
        $products = Product::where('brand_id',$brand_id)->where('category_id',$category_id)->get();
        $pro=array();

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
}
