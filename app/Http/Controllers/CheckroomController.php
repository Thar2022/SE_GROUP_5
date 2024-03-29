<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\String_;

class CheckroomController extends Controller
{
    private $late_day_number  = 1;      //ตรวจช้าสุดได้กี่วัน
    private $future_day_number = 5;    //ตรวจล่วงหน้าได้กี่วัน
    //  private $late_day_check;      //ตรวจช้าสุดได้กี่วัน
    private $future_day_check;    //ตรวจล่วงหน้าได้กี่วัน
    private $currentTime;
    function __construct()
    {
        $this->currentTime =    Carbon::now()->setTimezone('Asia/Bangkok')->format('Y-m-d');
        // $this->late_day_check = date('Y-m-d', strtotime('-'.(string)$this->late_day_number.' day', strtotime($this->currentTime ))) ;
        $this->future_day_check = date('Y-m-d', strtotime('+' . (string)$this->future_day_number . ' day', strtotime($this->currentTime)));
    }
    function check()
    {


        $future_day_number = $this->future_day_number;
        $late_day_number = $this->late_day_number;
        $currentTime  = $this->currentTime;
        // echo $currentTime;
        // echo $late_day_number;
        // echo $future_day_number;
        //  echo  $this->future_day_check;
        //  echo  $this->currentTime;/
        $bookings = DB::table('booking_room')->join('meeting_room', 'booking_room.id_room', '=', 'meeting_room.id_room')->groupBy('date', 'meeting_room.id_room')->havingRaw("status = 'กำลังตรวจสอบ' and  date <= '" . $this->future_day_check . "' and date >= '" . $this->currentTime . "'")->orderBy('date')->paginate(2);
        // dd($bookings);
        // $blogs = DB::table('booking_room')->where('status', "กำลังตรวจสอบ")->get();
        // $dateStr = $blogs[2]->date;
        // $new_timestamp = date('Y-m-d', strtotime('-1 day', strtotime($dateStr)));
        // echo "sdf";
        return view('checkroom/checkroom', compact('bookings', 'late_day_number', 'currentTime','future_day_number'));
    }
    function nobroken($id_room)
    {
        // $currentTime = Carbon::now()->toDateString();
        // $id_emp = 2;

        // $title = ["คลาสมวย","คลาสปั่นจักยาน","เทรนนิ่ง"];
        // $deail = ["content 1","content 2","content 3"];
        // $picture = ["รูป1","รูป2","รูป2"];
        // return view('home', compact('title', 'detail','picture'));

        $emp = DB::table('employee')->where('id_employee', 2)->first();
        // $future_day_check = $this->future_day_check;        ถ้าติดบักให้มาแก้ตรงนี้
        $currentTime = $this->currentTime;
        $future_time =  $this->future_day_check;

        DB::table('check_room')->insert([
            'id_room' => $id_room,
            'id_emp' => $emp->id_employee,
            'status_check' => 'ห้องปกติ'
        ]);
        DB::table('booking_room')
            ->where([['id_room', '=', $id_room], ['status', '=', 'กำลังตรวจสอบ'], ['date', '>=', $currentTime], ['date', '<=', $future_time]])->update(['status' => 'ห้องปกติ']);

        return redirect('checkroom/check');
    }
    function broken($id_room)
    {
        $equipments =  DB::table('meeting_room')->join('equipment_room', 'equipment_room.id_room', '=', 'meeting_room.id_room')->join('equipment', 'equipment_room.id_equipment', '=', 'equipment.id_equipment')->where('meeting_room.id_room', $id_room)->get();


        return view('checkroom.checkListBroken', compact('equipments', 'id_room'));
    }
    function savebroken(Request $request)
    {
        $currentTime = $this->currentTime;
        $future_time =  $this->future_day_check;
        $emp = DB::table('employee')->where('id_employee', 2)->first();
        $id_room = $request->id_room;
        $id_equipments = $request->input('id_equipment');
        // $max_amounts = $request->input('max_amount');
        $amounts = $request->input('amount');
        $note = $request->note;
        if ($note == null) {
            $note = "";
        }


        // กำหนดกฏการตรวจสอบสำหรับข้อมูลที่ถูกส่งมาในรูปแบบอาร์เรย์ 
        $rules = [
            'id_equipment.*' => 'required',
            'amount.*' => 'required|numeric|min:0', // ตรวจสอบว่าเป็นตัวเลขและไม่ติดลบ
        ];

        // กำหนดเงื่อนไขสำหรับข้อความของข้อผิดพลาด
        $messages = [
            'id_equipment.*.required' => 'กรุณาเลือกอุปกรณ์',
            'amount.*.required' => 'กรุณาใส่จำนวน',
            'amount.*.numeric' => 'กรุณาใส่เฉพาะตัวเลข',
            'amount.*.min' => 'จำนวนต้องไม่ติดลบ',
        ];

        // นำเข้า Validator
        $validator = Validator::make($request->all(), $rules, $messages);

        // ตรวจสอบว่าทุกค่าใน amount เป็น 0 หรือไม่
        $allZero = true;
        foreach ($request->input('amount') as $amount) {
            if ($amount != 0) {
                $allZero = false;
                break;
            }
        }

        // ถ้าทุก amount เป็น 0 ให้เพิ่มเงื่อนไขให้ระบุ note
        if ($allZero) {
            $rules['note'] = 'required';
            $messages['note.required'] = 'หากห้องเสียและไม่ได้ใส่จำนวนอุปกรณ์ที่เสีย กรุณาระบุรายละเอียดเพิ่มเติมด้วยครับ';
        }

        // นำเข้า Validator ใหม่หลังจากเพิ่มเงื่อนไข
        $validator = Validator::make($request->all(), $rules, $messages);

        // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // ถ้าผ่านการตรวจสอบให้ดำเนินการต่อไป

        $id_checkroom = DB::table('check_room')->insertGetId([
            'id_room' => $id_room,
            'id_emp' => $emp->id_employee,
            'status_check' => 'ห้องเสีย',
            'note' => $note
        ]);

        foreach ($id_equipments as  $i => $id_equipment) {
            if ($amounts[$i] > 0) {
                DB::table('broke_equipmentlist')->insert([
                    'id_checkroom' =>  $id_checkroom,
                    'id_equipment' => $id_equipment,
                    'amount' => $amounts[$i]
                ]);
            }
        }

        DB::table('booking_room')
            ->where([['id_room', '=', $id_room], ['status', '=', 'กำลังตรวจสอบ'], ['date', '>=', $currentTime], ['date', '<=', $future_time]])->update(['status' => 'ห้องเสีย']);



        return redirect('checkroom/check');
    }

    function history_check()
    {

        $check_rooms = DB::table('check_room')->join('meeting_room', 'check_room.id_room', '=', 'meeting_room.id_room')->orderBy('date_check','desc')->get();

        return view('checkroom.history_check', compact('check_rooms'));
    }
    function detail_check($id_checkroom)
    {
        // $equipments = DB::table('check_room')->join('broke_equipmentlist','broke_equipmentlist.id_checkroom','=','check_room.id_checkroom')->join('meeting_room','check_room.id_room','=','meeting_room.id_room')->join('equipment_room', 'equipment_room.id_room', '=', 'meeting_room.id_room')->join('equipment', 'equipment_room.id_equipment', '=', 'equipment.id_equipment')->where('check_room.id_checkroom', $id_checkroom)->get();
        $equipments = DB::table('check_room')->join('broke_equipmentlist', 'broke_equipmentlist.id_checkroom', '=', 'check_room.id_checkroom')->join('equipment', 'broke_equipmentlist.id_equipment', '=', 'equipment.id_equipment')->where('check_room.id_checkroom', $id_checkroom)->get();
        // dd($equipments);
        $note = DB::table('check_room')->where('id_checkroom', $id_checkroom)->first();

        return view('checkroom.detailCheck', compact('equipments', 'note'));
    }
}
