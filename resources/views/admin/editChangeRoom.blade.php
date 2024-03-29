@extends('layout.' . session('role_name'))

@section('title')
    แก้ไขการจองห้อง  
@endsection



@section('content')
<link rel="stylesheet" href="{{ asset('css/datepick.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">
            <h2>แก้ไขการจองห้อง</h2>
        </div>
        <div>
            
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        </div><br><br><br>
        @foreach ($data as $item)
            
        @endforeach
        
        <form action="{{ route('admin.updateChangeRoom', $item->id_booking) }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group my-3">
                        <strong>ห้อง</strong>
                        
                        <select name="room_id" >
                            @foreach ($room as $al)
                                <option value={{ $al->id_room }} > {{ $al->name_room }}</option>;
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <strong>วันที่จอง</strong>
                        <input type="text" name="date" class="date" id="date" value="" />
                    </div>
                    <div class="form-group my-3">
                        <strong>เวลาเริ่ม</strong>
                        <input type="text" name="time_start" value="{{ $item->time_start }}" class="" required>
                    </div>
                    <div class="form-group my-3">
                        <strong>เวลาสิ้นสุด</strong>
                        <input type="text" name="time_end" value="{{ $item->time_end }}" class="" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="mt-3 btn btn-primary" onClick="return confirm('ยืนยันการแก้ไขหรือไม่?')">ยืนยัน </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script>
    $(document).ready(function() {
        $("#date").datepicker({
            format: "yyyy-mm-dd", // Customize date format if needed
            todayHighlight: false,
            autoclose: true, // Automatically close the datepicker when date is selected
            // Highlight today's date
            beforeShowDay: function(date) {
                //var startDate = new Date(date_close); // Convert date_close string to Date object
                //var endDate = new Date(date_open);
                var currentDate = new Date();

                currentDate.setDate(currentDate.getDate()+2);
                if (date.setHours(0, 0, 0, 0) < currentDate.setHours(0, 0, 0, 0) &&
                    currentDate.setHours(0, 0, 0, 0) != date.setHours(0, 0, 0, 0)) {

                    return {
                        classes: "highlight-range",
                        enabled: false,
                    };
                } else {
                    return true; // Enable all other dates
                }
            },
        });
    });
</script>
@endsection