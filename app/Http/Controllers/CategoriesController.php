<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
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
        return view('category');
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
        $category_id = Category::create($request->all())->id;
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


    public function category_select_box(){
        $categories = Category::orderBy('id','desc')->get();
        foreach ($categories as $category){
            $cat[]=array(
				'value'=>$category->id,
				'label'=>$category->name
				);          
        }

        $data = array(
            'cat' => $cat,
        );
        echo json_encode($data);
    }

    public function category_product(Request $request){
        $category_id = $request->category_id;
        $products = Product::where('category_id',$category_id)->get();
        $brands = Product::select(DB::raw('brands.id as id, brands.name as name'))
        ->where('category_id',$category_id)
        ->join('brands','brands.id','=','products.brand_id')
        ->get();
        $pro=array();
        $brnd=array();
        foreach ($products as $product){
            $pro[]=array(
				'value'=>$product->id,
				'label'=>$product->name
				);          
        }
        foreach ($brands as $brand){
            $brnd[]=array(
				'value'=>$brand->id,
				'label'=>$brand->name
				);          
        }

        $data = array(
            'pro' => $pro,
            'brnd' => $brnd,
        );
        echo json_encode($data);
    }

}
