@extends('layout.' . session('role_name'))
@section('title','repair')
@section('content')
<link rel="stylesheet" href="{{ asset('css/datepick.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<h1>แก้ไขวันที่</h1>
<form method="POST" action="{{route('updatedate',$datefix->id_BEList,$datefix->id_checkroom)}}">
    @csrf
    <div class="form-group">
        <label for="date_finish">เลือกวันที่ซ่อมเสร็จ</label>
        <input type="text" name="date_finish" class="date" id="date" value="" />
    </div>
    @error('date_finish')
    <div class="my-2">
        <span class="text-danger">{{$message}}</span>
    </div>
    @enderror
    <input type="submit" value="บันทึก" class="btn btn-primary">
    <a href="{{route('back',$datefix->id_checkroom)}}" class="btn btn-primary">Back</a>
</form>

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

                currentDate.setDate(currentDate.getDate());
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