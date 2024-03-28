@extends('layout.' . session('role_name'))

@section('title')
    เพิ่มห้อง
@endsection



@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12">
                <h2>เพิ่มห้อง</h2>
            </div>
            <div>

                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            </div><br><br>
            <form action="{{ route('admin.addRoom') }}" method="GET">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group my-3">
                            <strong>ชื่อห้อง  </strong>
                            <input type="text" name="name_room" value="" class=""
                                 required>
                        </div>
                        <div class="form-group my-3">
                            <strong>ชนิด  </strong>
                            <input type="text" name="type" value="" class=""
                                 required>
                        </div>
                        <div class="form-group my-3">
                            <strong>ความจุ  </strong>
                            <input type="integer" name="seats" value="" class=""
                                 required>
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
