@extends('layout.' . session('role_name'))
@section('title','repair')
@section('content')


    <h1 class = "text text-center">ประวัติการซ่อม</h1>
    <br>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">ลำดับ</th>
                <th scope="col">ชื่อห้อง</th>
                <th scope="col">ประเภทห้อง</th>
                <th scope="col">วันที่ซ่อมเสร็จ</th>
                <th scope="col">สถานะของห้อง</th>
                <th scope="col">รายละเอียด</th>
                <th scope="col">ลบ</th>
            </tr>
        </thead>
        @php
            $x = 0;
        @endphp
        <tbody>
            @foreach ($historyrepairs as $item)
                <tr>
                    <td>{{ $x += 1 }}</td>
                    <td>
                        {{ $item->name_room }}
                    </td>
                    <td>
                        {{ $item->type }}
                    </td>
                    <td>
                        {{ $item->date }}
                    </td>
                    <td>
                        {{ $item->status_repair }}
                    </td>
                    <td>
                        <a href= "{{route('detail',$item->id_checkroom)}}" class= "btn btn-primary">รายละเอียดเพิ่มเติม</a>
                     </td>
                    <td>
                        <a href = "{{route('deletehistoryrepair',$item->id_CBRoom)}}" class = "btn btn-danger" onclick="return confirm('คุณต้องการลบประวัติการซ่อมหรือไม่')">ลบ</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection