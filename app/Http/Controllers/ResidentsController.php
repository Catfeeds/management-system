<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use Excel;
use App\Exports\ResidentsExport;

class ResidentsController extends Controller
{
    public function index(Request $request)
    {
        $residents=Resident::with('information')->filter($request->all())->paginate(12);
        $select=$request->except('page');
        return view('residents.index',compact('residents','select'));
    }
    
    public function destroy(Resident $resident)
    {
    	$res=$resident->delete();
    	if($res){
    		return response()->json([
    			'status'=>true,
    			'message'=>'删除成功'
    		]);
    	}
    }

    public function export(Request $request)
    {
        
        return Excel::download(new ResidentsExport(),'居民信息.xlsx');
        //return $export->download('居民信息.xlsx');
    }
}
