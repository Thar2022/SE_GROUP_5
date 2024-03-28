@extends('layout.' . session('role_name'))

@section('title')
เพิ่มการปิดห้อง
@endsection



@section('content')
<link rel="stylesheet" href="{{ asset('css/datepick.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">
            <h2>เพิ่มการปิดห้อง</h2>
        </div>
        <div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        </div><br><br>
        @foreach ($data as $close_room)
        @endforeach
        ห้อง : {{ $close_room->name_room }} &nbsp;&nbsp;
        <form action="{{ route('admin.addCloseRoom', $close_room->id_checkroom) }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group my-3">
                        <input type="hidden" name="id_room" value="{{ $close_room->id_room }}">
                        <strong>วันที่เปิด</strong>
                        <input type="text" name="date_open" class="date" id="date" value="" />
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
                </div>
                <div class="col-md-12">
                    <button type="submit" class="mt-3 btn btn-primary" onClick="return confirm('ยืนยันการเพิ่มการปิดห้องหรือไม่?')">ยืนยัน </button>
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
                var startDate = new Date(date_close); // Convert date_close string to Date object
                var endDate = new Date(date_open);
                var currentDate = new Date();

                currentDate.setDate(currentDate.getDate());
                if (
                    (date_close != null &&
                        date_open != null &&
                        date.setHours(0, 0, 0, 0) >= startDate.setHours(0, 0, 0, 0) &&
                        date.setHours(0, 0, 0, 0) <= endDate.setHours(0, 0, 0, 0) && date.setHours(0, 0, 0, 0)) ||
                    date.setHours(0, 0, 0, 0) < currentDate.setHours(0, 0, 0, 0) &&
                    currentDate.setHours(0, 0, 0, 0) != date.setHours(0, 0, 0, 0)
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
    });
</script>
@endsection