@extends('layout.' . session('role_name'))

@section('title')
    เพิ่มการปิดห้อง
@endsection



@section('content')
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
                            <input type="hidden" name="id_room" value="{{ $close_room->id_room }}" >
                            <strong>วันที่เปิด </strong>
                            <input type="date" name="date_open" value="{{ $close_room->date_open }}" class=""
                                placeholder="Company Name" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="mt-3 btn btn-primary"
                            onClick="return confirm('ยืนยันการเพิ่มการปิดห้องหรือไม่?')">ยืนยัน </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
