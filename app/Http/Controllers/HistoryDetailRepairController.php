<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use PDO;
use function Laravel\Prompts\table;

class HistoryDetailRepairController extends Controller
{
    function Report(){
        $report=DB::table('report')->get();
        return view('technician/historydetailrepair',compact('report'));
    }
    function Wait(){
        $waitrepair=DB::table('waitrepair')->get();
        return view('technician/waitrepair',compact('waitrepair'));
    }

    function Detail($id){       
        $item=DB::table('historydetail')->where('id_checkroom',$id)->first();
        $detail=DB::table('waitequ')->where('id_checkroom',$id)->get();
        dd($item->all());
        return view('technician/historydetailrepair',compact('detail','item'));
    }
}
