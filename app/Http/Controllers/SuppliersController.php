<?php

namespace App\Http\Controllers;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
