@extends('layout.' . session('role_name'))
@section('title','from')
@section('content')
<link rel="stylesheet" href="{{ asset('css/datepick.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<h2 class="text text-center py-2">จองห้องประชุม</h2>
<form method="POST" action="/insert">
    @csrf
    <div class="form-group">
        <label for="title">ชื่อหัวข้อประชุม</label>
        <input type="text" name="topic" class="form-control">
    </div>
    @error('topic')
    <div class="my-2">
        <span class="text-danger">{{$message}}</span>
    </div>
    @enderror

    <div class="form-group">
        <label for="content">จำนวนคนที่เข้าร่วมประชุม</label>
        <input type="text" name="amount" class="form-control">
    </div>
    @error('amount')
    <div class="my-2">
        <span class="text-danger">{{$message}}</span>
    </div>
    @enderror
    <div class="form-group">
        <label for="date">วันเวลา</label>
        <input type="text" name="date" class="date" id="date" value="" />
        <script>
            <?php if ($close_room != null) : ?>
                var date_close = "<?php echo $close_room->date_close; ?>";
                var date_open = "<?php echo $close_room->date_open; ?>";
            <?php else : ?>
                var date_close = null;
                var date_open = null;
            <?php endif; ?>
        </script>
    </div>
    @error('time')
    <div class="my-2">
        <span class="text-danger"></span>
    </div>
    @enderror
    <div class="form-group">
        <label for="content">เวลาเริ่ม</label>
        <select id="hour_strat" name="hour_strat">
            <option selected disabled>เลือกเวลา</option>
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
        </select>
    </div>
    <div class="form-group">
        <label for="content">เวลาจบ</label>
        <select id="hour_end" name="hour_end">
            <option selected disabled>เลือกเวลา</option>
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
        </select>
    </div>
    @error('time')
    <div class="my-2">
        <span class="text-danger">{{$message}}</span>
    </div>
    @enderror
    <input type="hidden" name="id_room" id="id_room" value="<?php echo $id ?>">
    <a href="#">
        <input type="submit" value="บันทึก" class="btn btn-primary my-3">
    </a>

    <a href="{{route('booking')}}" class="btn btn-success">
        กลับ
    </a>
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
        </tbody>

    </table>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

<script src="{{asset('js/datepick.js') }}"></script>
<script type="text/javascript">
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
        var room = $('#id_room').val();
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
</script>

@endsection