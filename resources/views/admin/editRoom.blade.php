@extends('layout.adminLayout')

@section('title')
    แก้ไขห้อง
@endsection



@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12">
                <h2>แก้ไขห้อง</h2>
            </div>
            <div>

                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            </div><br><br><br>
            @foreach ($data as $room)
            @endforeach
            <form action="{{ route('admin.addRoom', $room->id_room) }}" method="GET">
                @csrf
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group my-3">
                            <strong>ห้อง </strong>
                            <input type="text" name="name_room" value="{{ $room->name_room }}" class=""
                                placeholder="Company Name">
                        </div>
                        <div class="form-group my-3">
                            <strong>รูปแบบห้อง </strong>
                            <input type="text" name="type" value="{{ $room->type }}" class=""
                                placeholder="Company Name">
                        </div>
                        <div class="form-group my-3">
                            <strong>ความจุ </strong>
                            <input type="integer" name="seats" value="{{ $room->seats }}" class=""
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
