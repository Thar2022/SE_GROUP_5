<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PDO;

use function Laravel\Prompts\table;

class Report_RepairController extends Controller
{
    function Report(){
        $report=DB::table('report')->get();
        return view('technician/Report_Repair',compact('report'));
    }

    function Detail($id){
        $item=DB::table('report')->where('id_checkroom',$id)->first();
        //$reportData=$this->Report(); // เรียกใช้งานฟังก์ชัน Report() เพื่อดึงข้อมูลรายงาน
        //dd($reportData); // ให้ดูค่าของ $reportData ก่อนที่จะส่งไปยัง View
        $detail=DB::table('brokeequ')->where('id_checkroom',$id)->get(); //ชื่อตารางในdb
        //return view('Detail',compact('report'));

        //dd($item);
        return view('technician/Detail',compact('detail','item'));
    }

    function Estimate(Request $request){
        $request->validate(
            [
                'date'=>'required'
            ],
            [
                'date.required'=>'กรุณาป้อนวันที่'
            ]
        );

        $data=[
            'id_checkroom'=>$request->id_checkroom,
            'date'=>$request->date,
            'id_emp'=>'3',
            'status_repair'=>'รอการซ่อม'
        ];
        //dd($data);
        DB::table('check_room')->where('id_checkroom',$request->id_checkroom)->update(['status_check'=>'รอการซ่อม']);

        DB::table('check_brokenroom')->insert($data);
        return redirect('technician/Report_Repair');
        //DB::table('close_room')->where('id_checkroom',$request->id_checkroom)->update(['date_open'=>$request->date_open]);
    }


    
}
