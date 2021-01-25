<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Official;
use App\Supplier;
use App\AccountType;
use App\Transaction;
use App\OfficialType;
use App\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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
        $official_types = OfficialType::get();
        $account_types = AccountType::get();
        return view('transaction_report',compact('official_types','account_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $official_types = OfficialType::get();
        $account_types = AccountType::get();
        return view('transaction',compact('official_types','account_types'));
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
        $account_id = $request->account_id;
        $due = $request->amount;
        //echo'<pre>';print_r($request->all());exit;
        //echo'<pre>';print_r($request->account_type_id);exit;

        if($request['account_type_id']=='1'){
            if($request['transaction_type_id']=='1'){
                $customer = Customer::find($account_id);
                $cust_name = $customer->name;
                $cust_due = $customer->due - $due;
                $data_cus['due'] = $cust_due;
                Customer::whereId($account_id)->update($data_cus);
            }

            if($request['transaction_type_id']==2){
                $customer = Customer::find($account_id);
                $cust_name = $customer->name;
                $cust_due = $customer->due + $due;
                $data_cus['due'] = $cust_due;
                Customer::whereId($account_id)->update($data_cus);
            }
        }

        if($request['account_type_id']==2){
            if($request['transaction_type_id']==1){
                $supplier = Supplier::find($account_id);
                $supplier_name = $supplier->name;
                $supplier_due = $supplier->due + $due;
                $data_supplier['due'] = $supplier_due;
                Supplier::whereId($account_id)->update($data_supplier);
            }

            if($request['transaction_type_id']==2){
                $supplier = Supplier::find($account_id);
                $supplier_name = $supplier->name;
                $supplier_due = $supplier->due - $due;
                $data_supplier['due'] = $supplier_due;
                Supplier::whereId($account_id)->update($data_supplier);
            }
        }

        $desc = 'Transaction added ';
        $user_act[]=array(
            'Activities_Id'=>1,
            'Activities_by'=>Auth::user()->id,
            'Activities_dt'=>date('Y-m-d H:i:s'),
            'IP'=>$request->ip(),
            'Operate_Id'=>$transaction_id,
            'table_name'=>"transactions",
            'Description'=>$desc,
            );

        $user_activity = DB::table('usr_activities_histry')->insert($user_act); 

        return redirect()->action('TransactionsController@create');

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
            $accounts = Customer::get();
        }
        else if($request['account_type']==2){
            $accounts = Supplier::get();
        }
        else if($request['account_type']==3){
            $accounts = Official::where('official_type_id','=',$request->official_type)->get();
        }
        else{
            $accounts = array();
        }
        $acc = array();
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

    public function account_info_select_box(Request $request){
        if($request['account_type']==1){
            $accounts = Customer::find($request->account_id);  
        }
        else if($request['account_type']==2){
            $accounts = Supplier::find($request->account_id);  
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

    public function grid(Request $request){

        
		$pagenum = $request->pagenum;
		$pagesize = $request->per_pagess;
        $start = $pagenum * $pagesize;


        $filterscount = $request->filterscount;
        $sortdatafield = $request->sortdatafield;
        $sortorder = $request->sortorder;

        
		$where="transactions.id<>0";         
        
        if($request->transaction_id != '') 
        {$where.=" AND transactions.id = '".trim($request->transaction_id)."' ";}
        
        if($request->sales_invoice_no != '') 
        {$where.=" AND sales.invoice_no = '".trim($request->sales_invoice_no)."' ";}

        if($request->purchase_invoice_no != '') 
        {$where.=" AND purchases.invoice_no = '".trim($request->purchase_invoice_no)."' ";}

        if($request->officials_name != '') 
        {$where.=" AND officials.name like '%".trim($request->officials_name)."%'";}

        if($request->employee_name != '') 
        {$where.=" AND users.name like '%".trim($request->employee_name)."%'";}

        if($request->customer_name != '') 
        {$where.=" AND customers.name like '%".trim($request->customer_name)."%'";}

        if($request->supplier_name != '') 
        {$where.=" AND suppliers.name like '%".trim($request->supplier_name)."%'";}

        if($request->transaction_type != '') 
        {$where.=" AND transactions.transaction_type_id = ".$request->transaction_type."";}

        if($request->official_type_id != '') 
        {$where.=" AND transactions.official_type_id = ".$request->official_type_id."";}


        if($request->account_type_id != '') 
        {$where.=" AND transactions.account_type_id = ".$request->account_type_id."";}

        if($request->log_date_from != '') 
        {$where.=" AND usr_activities_histry.Activities_dt >= '".trim($request->log_date_from)."' ";}

        if($request->log_date_to != '') 
        {$where.=" AND usr_activities_histry.Activities_dt <= '".trim($request->log_date_to)."' ";}

        if($request->date_from != '') 
        {$where.=" AND transactions.date >= '".trim($request->date_from)."' ";}

        if($request->date_to != '') 
        {$where.=" AND transactions.date <= '".trim($request->date_to)."' ";}

        


        $q = DB::table('transactions')
        ->selectRaw('IF(transactions.sales_purchase_id = 0,CONCAT(DATE_FORMAT(usr_activities_histry.Activities_dt, "%d-%m-%Y "),
        DATE_FORMAT(DATE_ADD(usr_activities_histry.Activities_dt, INTERVAL 6 HOUR), "%h"),
        DATE_FORMAT(usr_activities_histry.Activities_dt, ":%i %p")),

        IF(transactions.account_type_id=1,
        CONCAT(DATE_FORMAT(u.Activities_dt, "%d-%m-%Y "),
        DATE_FORMAT(DATE_ADD(u.Activities_dt, INTERVAL 6 HOUR), "%h"),
        DATE_FORMAT(u.Activities_dt, ":%i %p")),

        CONCAT(DATE_FORMAT(p.Activities_dt, "%d-%m-%Y "),
        DATE_FORMAT(DATE_ADD(p.Activities_dt, INTERVAL 6 HOUR), "%h"),
        DATE_FORMAT(p.Activities_dt, ":%i %p")))
        ) as Activities_dt,

        DATE_FORMAT(transactions.date, "%d-%m-%Y") as dates,
        
        official_types.name as official_types_name, account_types.name as account_types_name, transaction_types.name transaction_types_name, IF(officials.name IS NULL,IF(customers.name IS NULL,IF(suppliers.name IS NULL,"",suppliers.name),customers.name),officials.name) particulars,IF(users.name IS NULL,"",users.name) users_name ,transactions.*')
        ->whereRaw($where)
        ->leftjoin('transaction_types','transaction_types.id','=','transactions.transaction_type_id')
        ->leftjoin('account_types','account_types.id','=','transactions.account_type_id')
        
        ->leftjoin('sales','sales.id','=','transactions.sales_purchase_id')
        ->leftjoin('purchases','purchases.id','=','transactions.sales_purchase_id')
        ->leftjoin('customers', function($join)
        {
            $join->on('customers.id', '=', 'transactions.account_id')->where('transactions.account_type_id', '=', 1);
        })
        ->leftjoin('suppliers', function($join)
        {
            $join->on('suppliers.id', '=', 'transactions.account_id')->where('transactions.account_type_id', '=', 2);
        })
        ->leftjoin('officials', function($join)
        {
            $join->on('officials.id', '=', 'transactions.account_id')->where('transactions.account_type_id', '=', 3);
        })
        ->leftjoin('usr_activities_histry', function($join)
        {
            $join->on('usr_activities_histry.Operate_Id', '=', 'transactions.id')->where('usr_activities_histry.table_name', '=', "transactions");
        })
        ->leftjoin('usr_activities_histry as u', function($join)
        {
            $join->on(DB::raw('u.Operate_Id'), '=', 'transactions.sales_purchase_id')->where(DB::raw('u.table_name'), '=', "sales");
        })

        ->leftjoin('usr_activities_histry as p', function($join)
        {
            $join->on(DB::raw('p.Operate_Id'), '=', 'transactions.sales_purchase_id')->where(DB::raw('p.table_name'), '=', "purchases");
        })
        ->leftjoin('users','users.id','=','usr_activities_histry.Activities_by')
        ->leftjoin('official_types','official_types.id','=','officials.official_type_id')
        
        
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
