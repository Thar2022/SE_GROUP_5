<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HistoryRepairController extends Controller
{
    function historyrepair(){
        
        $historyrepairs=DB::table('historyrepair')->get();        
        return view('technician/historyrepair',compact('historyrepairs'));
    }
    function delete($id){
        DB::table('check_brokenroom')->where('id_CBRoom',$id)->delete();
        return redirect()->back();
    }
}
