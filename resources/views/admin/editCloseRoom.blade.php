@extends('layout.' . session('role_name'))

@section('title')
    แก้ไขวันที่เปิด
@endsection



@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12">
                <h2>แก้ไขวันที่เปิด</h2>
            </div>
            <div>

                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            </div><br><br><br>
            @foreach ($data as $close_room)
            @endforeach
            ห้อง : {{ $close_room->name_room }} &nbsp;&nbsp;
            วันที่ปิด : {{ $close_room->date_close }}&nbsp;&nbsp;
            วันที่เปิด : {{ $close_room->date_open }}
            <form action="{{ route('admin.updateCloseRoom', $close_room->id_closeroom) }}" method="GET">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group my-3">
                            <strong>วันที่เปิด </strong>
                            <input type="date" name="date_open" value="{{ $close_room->date_open }}" class=""
                                placeholder="Company Name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="mt-3 btn btn-primary"
                            onClick="return confirm('ยืนยันการแก้ไขหรือไม่?')">ยืนยัน </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
