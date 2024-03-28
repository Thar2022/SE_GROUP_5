@extends('layout.' . session('role_name'))
@section('title','repair')
@section('content')

<body>
    <div class="card">
        <div class="card-header">
            รายละเอียดเพิ่มเติม
        </div>
         <!--ข้อมูลของห้อง-->
        <div class="card border-info mb-3" style="max-width: 680px;">
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
                    </div>
                </div>
            </div>
        </div>
        </div>
         
        <!--ตารางอุปกรณ์ที่เสีย-->
        <div class="card-body">
            <h3 class = "text text-center">อุปกรณ์ที่เสีย</h3>
                <div>                   
                    <table class="table table-bordered border-primary text-center">
                        <tr>
                            <th scope="col">เลข</th>
                            <th scope="col">อุปกรณ์</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">วันที่ซ่อมเสร็จ</th>
                        </tr>
                        @php
                            $x = 0;
                        @endphp
                        @foreach ($detail as $item)
                            <tr>
                                <td>{{ $x += 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->date_finish }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
        </div>
        <a href= "/historyrepair" class= "btn btn-primary">Back</a>
</body>

@endsection
