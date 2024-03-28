<?php

namespace App\Http\Controllers;

use App\Models\booking_room;
use App\Models\booking_roomfail;
use App\Models\close_room;
use App\Models\employee;
use App\Models\meeting_room;
use App\Models\time;
use App\Models\time_book;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\Console\Logger\ConsoleLogger;

use function PHPUnit\Framework\isEmpty;

class BookingController extends Controller
{
    function booking()
    {
        $room = meeting_room::orderByDesc('id_room')->get();

        return view('booking/book', compact('room'));
    }
    function accept_booking(Request $request)
    {
        //echo "sss=".$request->id;
        //return view('booking/book_status');
        $data = [
            'status' => 'กำลังตวรจสอบ'
        ];
        booking_roomfail::where('id', $request->id_fail)->update($data);


        $id_emp = session('id_emp'); //หาวิธีgetให้ได้
        $book_emp = booking_room::select('id_booking', 'topic', 'date', 'amount', 'id_emp', 'booking_room.id_room', 'status', 'time_start', 'time_end')
            ->where('id_emp', $id_emp)
            ->union(function ($query) {
                $query->select('b.id_booking', 'b.topic', 'bf.date', 'b.amount', 'b.id_emp', 'bf.id_room', 'bf.status', 'bf.time_start', 'bf.time_end')
                    ->from('booking_roomfail as bf')
                    ->join('booking_room as b', 'bf.id_booking', '=', 'b.id_booking')
                    ->where('bf.status', '!=', 'ห้องไม่พร้อม');
            })
            ->orderBy('time_start', 'asc')
            ->get();
        return view('booking/book_status', compact('book_emp'));
    }
    public function delete_accept($id)
    {
        //echo $id;
        booking_roomfail::where('id', $id)->delete();
        return redirect()->back();
    }
    function guide()
    {
        $id_emp = session('id_emp');
        $booking_fail = booking_roomfail::join('booking_room as b', 'b.id_booking', '=', 'booking_roomfail.id_booking')
            ->where('booking_roomfail.status', 'กำลังส่งเรื่อง')
            ->where('b.id_emp', $id_emp) //อย่าลืมเปลี่ยน
            ->first();
        if ($booking_fail != null) {
            $fail = booking_roomfail::join('meeting_room as m', 'm.id_room', '=', 'booking_roomfail.id_room')
                ->where('id_booking', $booking_fail->id_booking)
                ->where('status', 'กำลังส่งเรื่อง')->first();
            $book = booking_room::join('meeting_room as m', 'm.id_room', '=', 'booking_room.id_room')
                ->where('id_booking', $booking_fail->id_booking)->first();
            
        }
        else{
            $fail = null;
            $book = null;
        }
        return view('booking/guide', compact('booking_fail', 'fail', 'book'));
    }
    function bookinguser()
    {
        $$id_emp = session('id_emp');
        $book_emp = booking_room::all();

        return view('booking/bookuser', compact('book_emp'));
    }
    function bookingadmin()
    {
        $id_emp = session('id_emp');
        $book_emp = booking_roomfail::all();
        return view('booking/bookadmin', compact('book_emp'));
    }
    function book_from($id)
    {
        $close_room = null;
        $close_room = close_room::join('meeting_room', 'close_room.id_room', '=', 'meeting_room.id_room')
            ->where('meeting_room.name_room', $id)
            ->where('close_room.id_closeroom', close_room::max('id_closeroom'))
            ->first();
        //echo $id;
        //$id = $sql->id;

            return view('booking/book_from', compact('close_room','id'));
    }

    function book_insert(Request $request)
    {
        $request->validate(
            [
                'topic' => 'required|max:50',
                'amount' => 'required|int'
            ],
            [
                'topic.required' => 'กรุณาใส่ข้อมูล',
                'topic.max' => 'ชื่อหัวข้อไม่ครวเกิน 50 ตัวอักษร',
                'amount.required' => 'กรุณาใส่ตัวเลข',
                'amount.integer' => 'กรุณาใส่ตัวเลขเท่านั้น'
            ]
        ); //ยังไม่ได้แก้


        $id_emp = session('id_emp');
        $time_start = $request->hour_strat . ':' . $request->minute_start;
        $time_end = $request->hour_end . ':' . $request->minute_end;
        $timeb_start = explode("|", $request->t_s);
        $timeb_end = explode("|", $request->tend);
        foreach ($timeb_start as $key => $start) {
            $end = $timeb_end[$key];
            if (($time_start >= $start && $time_start < $end) ||
                ($time_end > $start && $time_end <= $end) ||
                ($time_start <= $start && $time_end >= $end)
                && $start != null
            ) {
                return redirect()->back()->withErrors(['time' => 'เวลาเริ่มหรือเวลาจบอยู่ในช่วงของเวลาจอง']);
            }
        }
        if ($time_start > $time_end) {
            return redirect()->back()->withErrors(['time' => 'เวลาเริ่มมากกว่าเวลาจบ']);
        }
        $data = [
            'topic' => $request->topic,
            'date' => $request->date,
            'amount' => $request->amount,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'id_emp' => $id_emp, //หาวิธีหา id ให้ได้
            'id_room' => $request->id_room,
            'status' => "กำลังส่งเรื่อง",
        ];
        echo $request->id_room;
        echo $time_start, $time_end;
        booking_room::insert($data);
        // return redirect()->route('book_status');
    }
    function book_status()
    {

        $id_emp = session('id_emp');
        $book_emp = booking_room::select('id_booking', 'topic', 'date', 'amount', 'id_emp', 'booking_room.id_room', 'status', 'time_start', 'time_end')
            ->where('id_emp', $id_emp)
            ->union(function ($query) {
                $query->select('b.id_booking', 'b.topic', 'bf.date', 'b.amount', 'b.id_emp', 'bf.id_room', 'bf.status', 'bf.time_start', 'bf.time_end')
                    ->from('booking_roomfail as bf')
                    ->join('booking_room as b', 'bf.id_booking', '=', 'b.id_booking')
                    ->where('bf.status', '!=', 'กำลังส่งเรื่อง');
            })
            ->orderBy('time_start', 'asc')
            ->get();
        return view('booking/book_status', compact('book_emp'));
    }

    function book_edit($id)
    {
        $check = booking_roomfail::where('id_booking', $id)
            ->orderBy('id', 'asc')
            ->first();
        if ($check != null) {
            echo "แก้ที่booking_roomfail id = " . $check->id;
            $booking = booking_room::join('booking_roomfail as bf', 'bf.id_booking', '=', 'booking_room.id_booking')
                ->join('meeting_room', 'bf.id_room', '=', 'meeting_room.id_room')
                ->where('id', $check->id)
                ->first();
        } elseif ($check == null) {
            echo 'แก้ที่booking_room';
            $booking = booking_room::join('meeting_room', 'booking_room.id_room', '=', 'meeting_room.id_room')
                ->where('id_booking', $id)->first();
        }
        $id_emp = session('id_emp');
        $close_room = close_room::join('meeting_room', 'close_room.id_room', '=', 'meeting_room.id_room')
            ->where('meeting_room.id_room', $booking->id_room)
            ->where('close_room.id_closeroom', close_room::max('id_closeroom'))
            ->first();
        $room = meeting_room::all();
        $book = booking_room::select('id_booking', 'topic', 'date', 'amount', 'id_emp', 'id_room', 'status', 'time_start', 'time_end')
            ->where('status', '!=', 'ห้องไม่พร้อม')
            ->where('id_emp', $id_emp)
            ->where('date', $booking->date)
            ->union(function ($query) use ($booking) {
                $query->select('b.id_booking', 'b.topic', 'bf.date', 'b.amount', 'b.id_emp', 'bf.id_room', 'bf.status', 'bf.time_start', 'bf.time_end')
                    ->from('booking_roomfail as bf')
                    ->join('booking_room as b', 'bf.id_booking', '=', 'b.id_booking')
                    ->where('bf.date', $booking->date)
                    ->where('bf.status', '!=', 'ห้องไม่พร้อม');
            })
            ->orderBy('time_start', 'asc')
            ->get();
        $book_time_s = "";
        $book_time_e = "";
        $book_id_c = "";
        $date_close = null;
        $date_open = null;
        foreach ($book as $b) {
            $book_time_s = $book_time_s . $b->time_start . "|";
            $book_time_e = $book_time_e . $b->time_end . "|";
            $book_id_c = $book_id_c . $b->id_booking . "|";
        }
        if ($close_room != null) {
            $date_open = $close_room->date_open;
            $date_close = $close_room->date_close;
        }

        return view('booking/book_edit', compact('booking', 'book', 'date_open', 'date_close', 'id', 'room', 'book_time_s', 'book_time_e', 'book_id_c'));
    }
    function book_update(Request $request)
    {
        $request->validate(
            [
                'topic' => 'required|max:50',
                'amount' => 'required|int'
            ],
            [
                'topic.required' => 'กรุณาใส่ข้อมูล',
                'topic.max' => 'ชื่อหัวข้อไม่ครวเกิน 50 ตัวอักษร',
                'amount.required' => 'กรุณาใส่ตัวเลข',
                'amount.integer' => 'กรุณาใส่ตัวเลขเท่านั้น'
            ]
        ); //ยังไม่ได้แก้
        $time_start = $request->hour_strat . ':' . $request->minute_start;
        $time_end = $request->hour_end . ':' . $request->minute_end;
        $timeb_start = explode("|", $request->t_s);
        $timeb_end = explode("|", $request->tend);
        $book_id = explode("|", $request->book_id);
        //print_r($book_id);
        //echo "id=",$request->book_id;
        //echo '</br>',$request->id,'</br>';
        foreach ($timeb_start as $key => $start) {
            $end = $timeb_end[$key];
            $current_book_id = $book_id[$key];
            if (($start != null) && ($request->id != $current_book_id) &&
                (($time_start >= $start && $time_start < $end) ||
                    ($time_end > $start && $time_end <= $end) ||
                    ($time_start <= $start && $time_end >= $end))
            ) {
                return redirect()->back()->withErrors(['time' => 'เวลาเริ่มหรือเวลาจบอยู่ในช่วงของเวลาจอง']);
            }
        }
        if ($time_start > $time_end) {
            return redirect()->back()->withErrors(['time' => 'เวลาเริ่มมากกว่าเวลาจบ']);
        }
        //echo $time_start,$time_end;
        $check = booking_roomfail::where('id_booking', $request->id)
            ->orderBy('id', 'asc')
            ->first();
        if ($check != null) {
            echo "แก้ที่booking_roomfail id = " . $check->id;
            $data = [
                'topic' => $request->topic,
                'amount' => $request->amount,
            ];
            $data_fail = [
                'date' => $request->date,
                'time_start' => $time_start,
                'time_end' => $time_end,
                'id_room' => $request->room,
            ];
            booking_room::where('id_booking', $request->id)->update($data);
            booking_roomfail::where('id', $check->id)->update($data_fail);
            
        } elseif ($check == null) {
            echo 'แก้ที่booking_room';
            $id_emp = session('id_emp');
            $data = [
                'topic' => $request->topic,
                'date' => $request->date,
                'amount' => $request->amount,
                'time_start' => $time_start,
                'time_end' => $time_end,
                'id_emp' => $id_emp, //หาวิธีหา id ให้ได้
                'id_room' => $request->room,
                'status' => "กำลังส่งเรื่อง",
            ];
            booking_room::where('id_booking', $request->id)->update($data);
        }
    }
    public function delete($id)
    {
        $check = booking_roomfail::where('id_booking', $id)
            ->orderBy('id', 'asc')
            ->first();

        if ($check != null) {
            echo $id . $check->id;
        } elseif ($check == null) {
            echo $id;
        }

        //booking_room::where('id_booking', $id)->delete();
        //return redirect()->back();
    }
    public function update2($id)
    {
        $data = [
            'status' => "กำลังตรวจสอบ",
        ];
        booking_room::where('id_booking', $id)->update($data);
        return redirect()->back();
    }
    public function ajaxRequest_time(Request $request)
    {
        // ดำเนินการที่ต้องการด้วยข้อมูลที่รับผ่าน AJAX

        $hour = $request->input('hour');
        echo $hour;
        // ตอบกลับด้วยข้อมูลที่คุณต้องการ 
        if ($hour == 18) {
            echo '<option  value="00" >00</option>';
        } else {

            echo "<option selected disabled>เลือกเวลา</option>";
            echo '<option  value="00" >00</option>';
            echo '<option  value="30" >30</option>';
        }
    }
    public function ajaxRequest_table(Request $request)
    {
        $id_emp = session('id_emp');
        $date = $request->input('date');
        $room = $request->input('room');
        $book = booking_room::select('id_booking', 'topic', 'date', 'amount', 'id_emp', 'id_room', 'status', 'time_start', 'time_end')
            ->where('status', '!=', 'ห้องไม่พร้อม')
            ->where('id_emp', $id_emp)
            ->where('date', $date)
            ->where('id_room', $room)
            ->union(function ($query) use ($date, $room) {
                $query->select('b.id_booking', 'b.topic', 'bf.date', 'b.amount', 'b.id_emp', 'bf.id_room', 'bf.status', 'bf.time_start', 'bf.time_end')
                    ->from('booking_roomfail as bf')
                    ->join('booking_room as b', 'bf.id_booking', '=', 'b.id_booking')
                    ->where('bf.date', $date)
                    ->where('bf.id_room', $room)
                    ->where('bf.status', '!=', 'ห้องไม่พร้อม');
            })
            ->orderBy('time_start', 'asc')
            ->get();
        $book_time_s = "";
        $book_time_e = "";
        $book_id_c = "";
        $i = 1;
        foreach ($book as $b) {
            echo "<tr>";
            echo '<th scope="row">' . $i . '</th>';
            echo '<td>' . $b->topic . '</td>';
            echo '<td>' . $b->time_start . '</td>';
            echo '<td>' . $b->time_end . '</td>';
            echo "</tr>";
            $i++;
            $book_time_s = $book_time_s . $b->time_start . "|";
            $book_time_e = $book_time_e . $b->time_end . "|";
            $book_id_c = $book_id_c . $b->id_booking . "|";
        }
        echo '<input type="hidden" name="t_s" id="t_s" value="' . $book_time_s . '"/>';
        echo '<input type="hidden" name="tend" id="tend" value="' . $book_time_e . '"/  >';
        echo '<input type="hidden" name="book_id" id="book_id" value="' . $book_id_c . '"/  >';
    }
    public function ajaxRequest_date(Request $request)
    {
        // ดำเนินการที่ต้องการด้วยข้อมูลที่รับผ่าน AJAX

        $room = $request->input('room');
        $close_room = close_room::where('id_room', $room)
            ->orderBy('id_closeroom', 'DESC')
            ->first();

        // กำหนดค่าตัวแปร JavaScript โดยตรง
        return response()->json([
            'date_close' => $close_room ? $close_room->date_close : null,
            'date_open' => $close_room ? $close_room->date_open : null
        ]);
    }
}
