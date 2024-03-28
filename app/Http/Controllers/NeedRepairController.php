<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PDO;
use Carbon\Carbon;
class NeedRepairController extends Controller
{
    function NeedRepair($id){
        $needRepair=DB::table('report')->where('id_checkroom',$id)->first();   
        $waitequ=DB::table('waitequ')->where('id_checkroom',$id)->get();
        return view('technician/NeedRepair',compact('waitequ'));
    }

    function Datefix($id){
        $datefix=DB::table('broke_equipmentlist')->where('id_BEList',$id)->first();
        return view('technician/datefix',compact('datefix'));
    }
    function Back($id){

        return  redirect()->route('needRepair', ['id_checkroom' => $id]);
    }
    function update(Request $request,$id){
        $request->validate(
            [
                'date_finish'=>'required'
            ],
            [
                'date_finish.required'=>'กรุณากรอกวันที่'
            ]
            );
        $data=[
            'date_finish'=>$request->date_finish
        ];
       
        $waitequ=DB::table('waitequ')->where('id_BEList',$id)->value('id_checkroom');
        DB::table('broke_equipmentlist')->where('id_BEList',$id)->update($data);
        return  redirect()->route('needRepair', ['id_checkroom' => $waitequ]);
    }

    function updatefinish(Request $request,$id){
        $data1=[
            'status_check'=>'เรียบร้อย'
        ];
        $data2=[
            'status_repair'=>'ซ่อมสำเร็จ'
        ];
        $data3=[
            'date_open'=>date('Y-m-d')
        ];
        DB::table('close_room')->where('id_checkroom',$id)->update($data3);
        DB::table('check_room')->where('id_checkroom',$id)->update($data1);
        DB::table('check_brokenroom')->where('id_checkroom',$id)->update($data2);
        return  redirect()->back();
    }
}