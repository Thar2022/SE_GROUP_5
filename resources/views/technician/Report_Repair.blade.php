@extends('layout.' . session('role_name'))
@section('title','repair')
@section('content')
<body>
    <div >
        <h5>รายงานการซ่อม</h5>
    </div>
    @foreach ($report as $item)
        <div class="card text-bg-info mb-3 mx-auto " style="max-width: 880px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="1.jpg" class="img-fluid rounded-start" alt=" ">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a>หมายเลขรายงานการซ่อม : {{ $item->id_checkroom }}</a><br>
                        <a>ชื่อห้อง : {{ $item->name_room }}</a><br>
                        <a>วันที่ตรวจตรวจ : {{ $item->date_check }}</a><br>
                        <a>เวลาที่ตรวจ : {{ $item->time }}</a><br>
                        <a>สถานะของห้อง :{{ $item->status_check }}</a><br>
                        <a>หมายเหตุ : {{ $item->note }}</a><br>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('detail1', $item->id_checkroom) }}"
                                class="btn btn-primary">รายละเอียดเพิ่มเติม</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
</body>
@endsection


