@extends('layout.adminLayout')
@section('title','guide')
@section('content')
<h2>คู่มือ</h2>
<?php if ($booking_fail != null) : ?>
    <form method="POST" action="/accept_booking">
        @csrf
        <input type="hidden" id="accept" name="accept"></input>
        <input type="submit" style="display:none;" id="submitButton"></input>
        <a href="{{route('delete_accept',$booking_fail->id)}}" type="hidden" id='black'></a>
        <input type="hidden" id="id_fail" name="id_fail" value="<?php echo $booking_fail->id; ?>">
        <!-- book-->
        <input type="hidden" id="room" name="room" value="<?php echo $book->name_room; ?>">
        <input type="hidden" id="date" name="date" value="<?php echo $book->date; ?>">
        <input type="hidden" id="time_start" name="time_start" value="<?php echo $book->time_start; ?>">
        <input type="hidden" id="time_end" name="time_end" value="<?php echo $book->time_end; ?>">
        <!-- fail-->
        <input type="hidden" id="room_fail" name="room_fail" value="<?php echo $fail->name_room; ?>">
        <input type="hidden" id="date_fail" name="date_fail" value="<?php echo $fail->date; ?>">
        <input type="hidden" id="time_start_fail" name="time_start_fail" value="<?php echo $fail->time_start; ?>">
        <input type="hidden" id="time_end_fail" name="time_end_fail" value="<?php echo $fail->time_end; ?>">
    </form>
<?php endif; ?>
<script>
    var acceptElement = document.getElementById("accept");
    if (acceptElement != null) {
        var room = document.getElementById('room').value;
        var a = document.getElementById('date').value;
        var time_start = document.getElementById('time_start').value;
        var time_end = document.getElementById('time_end').value;

        var room_fail = document.getElementById('room_fail').value;
        var b = document.getElementById('date_fail').value;
        var time_start_fail = document.getElementById('time_start_fail').value;
        var time_end_fail = document.getElementById('time_end_fail').value;

        //เปลี่ยนรูปแบบวัน
        const dates = new Date(a); // ตั้งค่าวันที่
        const date = dates.toLocaleDateString("th-TH", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric"
        });
        const date_fails = new Date(b); // ตั้งค่าวันที่
        const date_fail = date_fails.toLocaleDateString("th-TH", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric"
        });
        showAlert();
    }
    function showAlert() {
        var result = confirm('เปลี่ยนห้องจาก ห้อง:' + room + ' วันที่:' + date + ' เวลา:' + time_start + '-' + time_end + ' เป็น\n' +
            'ห้อง:' + room_fail + ' วันที่:' + date_fail + ' เวลา:' + time_start_fail + '-' + time_end_fail);
        if (result) {
            document.getElementById("submitButton").click(); // คลิกปุ่ม submit โดยอัตโนมัติ
        } else {
            document.getElementById("black").click();
        }
    }
</script>
@endsection