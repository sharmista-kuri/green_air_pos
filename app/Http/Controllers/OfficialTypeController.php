<?php

namespace App\Http\Controllers;

use App\OfficialType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OfficialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('official_types_report');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('official_type');
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
        $official_type_id = OfficialType::create($request->all())->id;

        $desc = 'Official Type Added';
        $user_act[]=array(
            'Activities_Id'=>1,
            'Activities_by'=>Auth::user()->id,
            'Activities_dt'=>date('Y-m-d H:i:s'),
            'IP'=>$request->ip(),
            'Operate_Id'=>$official_type_id,
            'table_name'=>"official_types",
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
        $input = $request->except(['_method']);

        OfficialType::where('id','=',$id)->update($input);

        $desc = 'Official Type Updated';
        $user_act[]=array(
            'Activities_Id'=>2,
            'Activities_by'=>Auth::user()->id,
            'Activities_dt'=>date('Y-m-d H:i:s'),
            'IP'=>$request->ip(),
            'Operate_Id'=>$id,
            'table_name'=>"official_types",
            'Description'=>$desc,
            );

        $user_activity = DB::table('usr_activities_histry')->insert($user_act); 
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

    public function grid(Request $request){

        
		$pagenum = $request->pagenum;
		$pagesize = $request->per_pagess;
        $start = $pagenum * $pagesize;


        $filterscount = $request->filterscount;
        $sortdatafield = $request->sortdatafield;
        $sortorder = $request->sortorder;

        
		$where="official_types.id<>0";         
        
        
        if($request->official_name != '') 
        {$where.=" AND name like '%".trim($request->official_name)."%'";}

       

        

		
        $q = OfficialType::whereRaw($where)
        ->get();
	
		
		$result["total"] = $q->count();
		
		if ($q->count() > 0){        
			$result["Rows"] = $q;
		} else {
			$result["Rows"] = array();
		}  		
		
	
		
		
		echo "{\"total\":".json_encode($result['total']).",\"data\":".json_encode($result['Rows'])."}";

    }

    public function official_type_info(Request $request){
        $official = OfficialType::find($request->official_id);
        echo json_encode($official);
    }
}
