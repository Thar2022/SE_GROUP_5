<?php

namespace App\Http\Controllers;

use App\Models\booking_room;
use App\Models\check_room;
use App\Models\close_room;
use App\Models\meeting_room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function ShowCheckRoom()
    {
        $data = check_room::join('meeting_room', 'check_room.id_room', '=', 'meeting_room.id_room')
            ->join('employee', 'check_room.id_emp', '=', 'employee.id_employee')
            ->join('check_brokenroom', 'check_room.id_checkroom', '=', 'check_brokenroom.id_checkroom')
            ->leftJoinSub(
                function ($query) {
                    $query->select('id_checkroom AS id_ch' )->distinct()
                        ->from('broke_equipmentlist');
                },
                'broke_equipmentlist',
                'broke_equipmentlist.id_ch',
                'check_brokenroom.id_checkroom'
            )->whereNotIn('check_room.id_checkroom',function($query){
                $query->select('id_checkroom')->from('close_room');
            })

            ->get();

        return view('admin.checkRoom', compact('data'));
    }

    public function allBooking()
    {
        $data = booking_room::join('meeting_room', 'booking_room.id_room', '=', 'meeting_room.id_room')
            ->join('employee', 'booking_room.id_emp', '=', 'employee.id_employee')
            ->get();

        return view('admin.allBooking', compact('data'));
    }


    public function createCloseRoom($id_checkroom)
    {
        $data = check_room::join('meeting_room', 'check_room.id_room', '=', 'meeting_room.id_room')
            ->where('check_room.id_checkroom',$id_checkroom)
            ->get();


        return view('admin.createCloseRoom', compact('data'));
    }

    public function addCloseRoom(Request $request,$id_checkroom)
    {
        $request->validate([
            'date_open' => 'required',
            'id_room'=>'required'
        ]);
        
        date_default_timezone_set("Asia/Bangkok");
        $date_close = date('Y-m-d');

        $close_room = new close_room;
        $close_room->id_checkroom = $id_checkroom;
        $close_room->date_close = $date_close;
        $close_room->date_open = $request->date_open;
        $close_room->id_room = $request->id_room;
        $close_room->save();

        return redirect()->route('admin.closeRoom');
    }

    public function closeRoom()
    {
        $data = check_room::join('close_room', 'check_room.id_checkroom', '=', 'close_room.id_checkroom')
            ->join('meeting_room', 'close_room.id_room', '=', 'meeting_room.id_room')
            ->join('check_brokenroom', 'check_room.id_checkroom', '=', 'check_brokenroom.id_checkroom')
            // ->join('broke_equipmentlist', 'check_room.id_checkroom', '=', 'broke_equipmentlist.id_checkroom')
            // ->join('equipment_room', 'broke_equipmentlist.id_equipment', '=', 'equipment_room.id_equipment_room')
            // ->join('equipment', 'equipment_room.id_equipment', '=', 'equipment.id_equipment')
            ->leftJoinSub(
                function ($query) {
                    $query->select('id_checkroom AS id_ch' )->distinct()
                        ->from('broke_equipmentlist');
                },
                'broke_equipmentlist',
                'broke_equipmentlist.id_ch',
                'check_brokenroom.id_checkroom'
            )
            ->get();

        return view('admin.closeRoom', compact('data'));
    }
    public function brokeEquipment($id)
    {
        $data = check_room::join('meeting_room', 'check_room.id_room', '=', 'meeting_room.id_room')
            ->join('broke_equipmentlist', 'check_room.id_checkroom', '=', 'broke_equipmentlist.id_checkroom')
            ->join('equipment_room', 'broke_equipmentlist.id_equipment', '=', 'equipment_room.id_equipment_room')
            ->join('equipment', 'equipment_room.id_equipment', '=', 'equipment.id_equipment')
            ->leftJoin('check_brokenroom', 'check_room.id_checkroom', '=', 'check_brokenroom.id_checkroom')
            ->where('check_room.id_checkroom',$id)
            ->get();

        return view('admin.brokeEquipment', compact('data'));
    }

    public function editCloseRoom($id)
    {
        $data = close_room::join('check_room', 'close_room.id_checkroom', '=', 'check_room.id_checkroom')
        ->join('meeting_room', 'check_room.id_room', '=', 'meeting_room.id_room')
        ->where('id_closeroom', $id)
        ->get();
        return view('admin.editCloseRoom', compact('data'));
    }

    public function updateCloseRoom(Request $request, $id)
    {
        $request->validate([
            'date_open' => 'required',
        ]);
        close_room::where('id_closeroom', $id)
            ->update(['date_open' => $request->date_open]);
        return redirect()->route('admin.closeRoom');
    }



    public function changeRoom()
    {
        $data = booking_room::join('employee', 'employee.id_employee', '=', 'booking_room.id_emp')
            ->join('meeting_room', 'meeting_room.id_room', '=', 'booking_room.id_room')
            ->whereIn('booking_room.id_booking', function ($query) {
                $query->select('booking_room.id_booking')
                    ->from('booking_room')
                    ->join('close_room', function ($join) {
                        $join->on('booking_room.date', '>=', 'close_room.date_close')
                            ->on('booking_room.date', '<', 'close_room.date_open');
                    })
                    ->distinct();
            })
            ->get();

        return view('admin.changeRoom', compact('data'));
    }

    public function editChangeRoom($id)
    {
        $data = booking_room::where('id_booking', $id)->get();
        $room = meeting_room::get();
        return view('admin.editChangeRoom', compact('data','room'));
    }

    public function sentEmail($id)
    {
        $subject = "เปลี่ยนห้องประชุม";
        $message = "ขออนุญาติให้เปลี่ยนห้องประชุม http://127.0.0.1:8000/admin/editChangeRoom/" . $id;
        $data = booking_room::join('employee', 'employee.id_employee', '=', 'booking_room.id_emp')
            ->where('id_booking', $id)
            ->get();
        foreach ($data as $item)
            @mail($item->email, $subject, $message, 'sdaf');

        booking_room::where('id_booking', $id)
            ->update(['status_email' => "ส่งแล้ว"]);


        return redirect()->route('admin.changeRoom');
    }

    public function deleteCloseRoom($id)
    {
        close_room::where('id_closeroom', $id)->delete();

        return redirect()->route('admin.closeRoom');
    }

    public function meetingRoom()
    {
        $data = meeting_room::get();
        return view('admin.meetingRoom', compact('data'));
    }

    public function editRoom($id)
    {
        $data = meeting_room::where('id_room', $id)->get();
        return view('admin.editRoom', compact('data'));
    }

    public function deleteRoom($id)
    {
        meeting_room::where('id_room', $id)->delete();

        return redirect()->route('admin.meetingRoom');
    }

    public function createRoom()
    {
        $data = meeting_room::get();
        return view('admin.createRoom', compact('data'));
    }

    public function addRoom(Request $request)
    {
        $request->validate([
            'name_room' => 'required',
            'type'=>'required',
            'seats'=>'required'
        ]);

        $room = new meeting_room;
        $room->name_room = $request->name_room;
        $room->type = $request->type;
        $room->seats = $request->seats;
        $room->save();

        return redirect()->route('admin.meetingRoom');
    }
    
}
