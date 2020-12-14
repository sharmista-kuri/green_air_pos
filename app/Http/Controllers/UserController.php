<?php


namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Category;
use App\Customer;
use App\Employee;
use App\Supplier;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class UserController extends Controller
{

	public function index()
    {
        //

        $employees = Employee::get();
        $customers = Customer::get();
        $suppliers = Supplier::get();
        $products = Product::get();
        $categories = Category::get();
        $brands = Brand::get();
        $users = User::get();
        return view('user_rights',compact('employees','customers','suppliers','products','categories','brands','users'));

    }
     public function grid(Request $request){

        
		$pagenum = $request->pagenum;
		$pagesize = $request->per_pagess;
        $start = $pagenum * $pagesize;


        $filterscount = $request->filterscount;
        $sortdatafield = $request->sortdatafield;
        $sortorder = $request->sortorder;

        
		$where="users.id<>0";         
        
        
        if($request->user_name != '') 
        {$where.=" AND name = '".trim($request->user_name)."'";}

        if($request->email != '') 
        {$where.=" AND email = '".trim($request->email)."'";}
		
        $q = User::whereRaw($where)
        ->leftjoin('ref_role','users.role','=','ref_role.id')
        ->select('users.name AS name','users.email AS email','users.id AS id','ref_role.name AS role')
        ->get();
		
		$result["total"] = $q->count();
		
		if ($q->count() > 0){        
			$result["Rows"] = $q;
		} else {
			$result["Rows"] = array();
		}  		
		
	
		
		
		echo "{\"total\":".json_encode($result['total']).",\"data\":".json_encode($result['Rows'])."}";

    }
     public function users_id(){
        $users_id = User::select('id')->orderBy('id','desc')->first();
        echo json_encode($users_id);
    }
     public function user_info(Request $request){
        $user =User::find($request->users_id);
        //print_r($user->role);exit();
        echo json_encode($user);
    }
    public function user_rights(){
        $user_rights=User::select('role')->where('name',Auth::user()->name)->get();
       return view('includes/sidebar',compact('user_rights'));
    }
    public function sidebar_view(){
       return view('sidebar');
    }
    function user_update(Request $req){
        //echo'<pre>';print_r($req->all());exit;
        //User::where('id',$req->users_id)->update($req->all());
        //echo  $req;exit;
        $account =User::find($req->users_id);
        //echo'<pre>';print_r($account);exit;
        $account->name = $req->users_name;
        $account->email = $req->user_email;
        $account->role = $req->role;
        if($req->has('usr_pic'))
        {
            $file=$req->file('usr_pic');
            $destinationPath = public_path('/');
            $file->move($destinationPath,$file->getClientOriginalName());
            $account->usr_pic=$file->getClientOriginalName();
        }
        $account->save();
    }
}