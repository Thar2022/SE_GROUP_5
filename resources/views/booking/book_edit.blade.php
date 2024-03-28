@extends('layout.' . session('role_name'))
@section('title', 'edit')
@section('content')
<link rel="stylesheet" href="{{ asset('css/datepick.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<?php
$time_start = explode(":", $booking->time_start);
$time_end = explode(":", $booking->time_end);
$hour_s =  $time_start[0];
$m_s = $time_start[1];
$hour_e =  $time_end[0];
$m_e = $time_end[1];
?>

<h2 class="text text-center py-2">จองห้องประชุม</h2>
<form method="POST" action="/update">
    @csrf
    <div class="form-group">
        <label for="title">ชื่อหัวข้อประชุม</label>
        <input type="text" name="topic" class="form-control" value="{{$booking->topic}}">
    </div>
    @error('topic')
    <div class="my-2">
        <span class="text-danger">{{$message}}</span>
    </div>
    @enderror

    <div class="form-group">
        <label for="content">จำนวนคนที่เข้าร่วมประชุม</label>
        <input type="text" name="amount" class="form-control" value="<?php echo $booking->amount; ?>">
    </div>
    @error('amount')
    <div class="my-2">
        <span class="text-danger">{{$message}}</span>
    </div>
    @enderror
    <div class="form-group">
        <label for="content">ห้อง</label>
        <select name="room" id="room">
            <?php
            echo "<option selected disabled>กรุณาเลือกห้อง</option>";
            foreach ($room as $r) {
                echo "<option value =$r->id_room ";
                if ($r->id_room == $booking->id_room) {
                    echo 'selected="selected" ';
                }
                echo ">$r->name_room</option> ";
            }

            ?>
        </select>
    </div>
    @error('room')
    <div class="my-2">
        <span class="text-danger">{{$message}}</span>
    </div>
    @enderror
    <div class="form-group">
        <label for="date">วันเวลา</label>
        <input type="text" class="form" id="date" name="date" value="<?php echo $booking->date; ?>" />
    </div>
    @error('date')
    <div class="my-2">
        <span class="text-danger">{{$message}}</span>
    </div>
    @enderror
    <div class="form-group">
        <label for="content">เวลาเริ่ม</label>
        <select id="hour_strat" name="hour_strat">
            <option value="<?php echo $time_start[0] ?>" selected><?php echo $time_start[0]; ?></option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
        </select>
        :
        <select id="minute_start" name="minute_start">
            <option value="<?php echo $time_start[1]; ?>" selected="selected"><?php echo $time_start[1]; ?></option>
        </select>
    </div>
    <div class="form-group">
        <label for="content">เวลาจบ</label>
        <select id="hour_end" name="hour_end">
            <option value="<?php echo $time_end[0]; ?>" selected="selected"><?php echo $time_end[0]; ?></option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
        </select>
        :
        <select id="minute_end" name="minute_end">
            <option value="<?php echo $time_end[1]; ?>" selected="selected"><?php echo $time_end[1]; ?></option>
        </select>
    </div>
    @error('time')
    <div class="my-2">
        <span class="text-danger">{{$message}}</span>
    </div>
    @enderror
    <input type="hidden" name="time" id="time" value="">
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
    <a href="#">
        <input type="submit" value="บันทึก" class="btn btn-primary my-3">
    </a>
    <a href="{{route('book_status')}}" class="btn btn-success">กลับ</a>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">หัวข้อ</th>
                <th scope="col">เวลาเริ่ม</th>
                <th scope="col">เวลาจบ</th>

            </tr>
        </thead>
        <tbody id="table_book">
            <?php $i = 1; ?>
            @foreach($book as $b)
            <tr>
            <th scope="row"><?php echo $i ?></th>
            <td>{{$b->topic}}</td>
            <td>{{$b->time_start}}</td>
            <td>{{$b->time_end}}</td>
            </tr>
            <?php $i++; ?>
            @endforeach
            <input type="hidden" name="t_s" id="t_s" value="<?php echo $book_time_s; ?>" />
            <input type="hidden" name="tend" id="tend" value="<?php echo $book_time_e; ?>" />
            <input type="hidden" name="book_id" id="book_id" value="<?php echo $book_id_c; ?>" />
        </tbody>

    </table>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="{{asset('js/datepick.js') }}"></script>
<script type="text/javascript">
    <?php if ($date_close != null && $date_open != null) : ?>
        var date_close = "<?php echo $date_close; ?>";
        var date_open = "<?php echo $date_open; ?>";
    <?php else : ?>
        var date_close = null;
        var date_open = null;
    <?php endif; ?>
    $(document).ready(function() {
        $('#room').change(function() {

            var room = $(this).val();
            $.ajax({
                type: "GET",
                url: "/ajax/date",
                data: {
                    room: room,
                },
                success: function(data) {
                    // อัปเดตค่า date_close และ date_open
                    date_close = data.date_close;
                    date_open = data.date_open;
                    // เรียกฟังก์ชันเพื่ออัปเดต Datepicker
                    updateDatepicker();

                }
            });
        });
    });
    $('#hour_strat').change(function() {
        var hour = $('#hour_strat').val();
        console.log(hour)
        $.ajax({
            type: "GET",
            url: "/ajax/time",
            data: {
                hour: hour,
            },
            success: function(data) {
                console.log(data)
                $('#minute_start').html(data);
            }
        });
    });
    $('#hour_end').change(function() {
        var hour = $('#hour_end').val();
        console.log(hour)
        $.ajax({
            type: "GET",
            url: "/ajax/time",
            data: {
                hour: hour,
            },
            success: function(data) {
                console.log(data)
                $('#minute_end').html(data);
            }
        });
    });
    $('#date').change(function() {
        var date = $('#date').val();
        var room = $('#room').val();
        console.log(date, room)
        $.ajax({
            type: "GET",
            url: "/ajax/table",
            data: {
                date: date,
                room: room
            },
            success: function(data) {
                console.log(data)
                $('#table_book').html(data);
            }
        });
    });
    // ฟังก์ชันสำหรับอัปเดต Datepicker
    function updateDatepicker() {
        $('#date').val(''); // ล้างค่าวันที่
        var startDate = new Date(date_close);
        var endDate = new Date(date_open);
        $('#date').datepicker("destroy"); // ทำลาย Datepicker เดิม
        $("#date").datepicker({
        format: "yyyy-mm-dd", // Customize date format if needed
        todayHighlight: false,
        autoclose: true, // Automatically close the datepicker when date is selected
        // Highlight today's date
        beforeShowDay: function (date) {
            var startDate = new Date(date_close); // Convert date_close string to Date object
            var endDate = new Date(date_open);
            var currentDate = new Date();
            
            // Convert date_open string to Date object
            if( currentDate.setHours(0,0,0,0) == date.setHours(0,0,0,0)){
                return{
                    class: "current",
                    enabled: false,
                }
            }
            currentDate.setDate(currentDate.getDate() + 2);
            if (
                (date_close != null &&
                date_open != null &&
                date.setHours(0,0,0,0) >= startDate.setHours(0,0,0,0) &&
                date.setHours(0,0,0,0) <= endDate.setHours(0,0,0,0)&& date.setHours(0,0,0,0))||
                date.setHours(0,0,0,0) < currentDate.setHours(0,0,0,0) && 
                currentDate.setHours(0,0,0,0) != date.setHours(0,0,0,0)
            ) {
              
                return {
                    classes: "highlight-range",
                    enabled: false,
                };
            } else {
                return true; // Enable all other dates
            }
        },
    });
    }
</script>


@endsection