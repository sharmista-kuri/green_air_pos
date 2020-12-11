<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Official;
use App\Supplier;
use App\AccountType;
use App\Transaction;
use App\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaction_types = TransactionType::get();
        $account_types = AccountType::get();
        return view('transaction',compact('transaction_types','account_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $transaction_types = TransactionType::get();
        $account_types = AccountType::get();
        return view('transaction',compact('transaction_types','account_types'));
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
        $transaction_id = Transaction::create($request->all())->id;
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

    public function account_select_box(Request $request){
        if($request['account_type']==1){
            $accounts = Customer::orderBy('id','desc')->get();
        }
        else if($request['account_type']==2){
            $accounts = Supplier::orderBy('id','desc')->get();
        }
        else{
            $accounts = Official::orderBy('id','desc')->get();
        }
        foreach ($accounts as $account){
            $acc[]=array(
				'value'=>$account->id,
				'label'=>$account->name
				);          
        }

        $data = array(
            'acc' => $acc,
        );
        echo json_encode($data);
    }

    /* public function account_select_box(Request $request){
        if($request['account_type']==1){
            $accounts = Customer::orderBy('id','desc')->get();
        }
        else if($request['account_type']==2){
            $accounts = Supplier::orderBy('id','desc')->get();
        }
        else{
            $accounts = Official::orderBy('id','desc')->get();
        }
        
        
        $str = "";
        $str.='<select onchange="account_info()" id="account_id" name="account_id" class="form-control">';
        foreach ($accounts as $account){
            $str.= '<option value="'.$account->id.'">'.$account->name.' ( '.$account->id.' )</option>';           
        }
        $str.= '  </select>';
        
        return $str;
    } */
    public function account_info_select_box(Request $request){
        if($request['account_type']==1){
            //$accounts = Customer::with('sale')->sum('sale.due')->find($request->account_id); 
            $accounts = DB::select( DB::raw("SELECT c.name, ROUND( (SELECT SUM(s.`total`) FROM `sales` s) - (SELECT SUM(t.`amount`) FROM `transactions` t WHERE t.`account_id`= $request->account_id AND t.`transaction_type_id`=1) ,2)AS due
            FROM `customers` c
            ")); 
        }
        else if($request['account_type']==2){
           /*  $accounts = DB::select( DB::raw("SELECT s.name, ROUND(( SUM(p.`total`)- SUM(t.`amount`) ) ,2) due due FROM `purchases` p
            JOIN `transactions` t ON (t.`account_id`=p.`supplier_id` AND t.`transaction_type_id`=2)
            JOIN `suppliers` s ON (s.id=p.`supplier_id`)
            WHERE p.`supplier_id`=$request->account_id
            GROUP BY p.`supplier_id`
            "));  */

            $accounts = DB::select( DB::raw("SELECT c.name,ROUND ( (SELECT SUM(p.`total`) FROM `purchases` p) - (SELECT SUM(t.`amount`) FROM `transactions` t WHERE t.`account_id`= $request->account_id AND t.`transaction_type_id`=2) ,2)AS due
            FROM `customers` c
            ")); 
        }
        else{
            $accounts = Official::find($request->account_id);
        }
        
        echo json_encode($accounts);
    }

    public function transaction_id(){
        $transaction_id = Transaction::select('id')->orderBy('id','desc')->first();
        echo json_encode($transaction_id);
    }


}
