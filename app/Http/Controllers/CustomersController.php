<?php

namespace App\Http\Controllers;

use App\Customer;
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
        $str = "";
        $str.='<select onchange="cust_info()" id="customer_id" name="customer_id" class="form-control">';
        foreach ($customers as $customer){
            $str.= '<option value="'.$customer->id.'">'.$customer->name.' ( '.$customer->id.' )</option>';           
        }
        $str.= '  </select>';
        
        return $str;
    }

    public function customer_info(Request $request){
        $customer = Customer::find($request->customer_id);
        echo json_encode($customer);
    }
}
