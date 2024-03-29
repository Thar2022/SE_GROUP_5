@extends('layout.' . session('role_name'))
@section('title','repair')
@section('content')


    <div class="card">
         
        <!--ตารางอุปกรณ์ที่เสีย-->
        <div class="card-body">
            <h1 class = "text text-center">อุปกรณ์ที่ต้องซ่อม</h1>
                <div>
                    <table class="table table-bordered text-center">
                        <tr>
                            <th scope="col">เลข</th>
                            <th scope="col">อุปกรณ์</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">วันที่ซ่อมเสร็จ</th>
                            <th scope="col">แก้ไขวันที่</th>
                        </tr>
                        @php
                            $x = 0;
                        @endphp
                        @foreach ($waitequ as $item)
                            <tr>
                                <td>{{ $x += 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->date_finish }}</td>
                                <td>
                                    <a href= "{{route('datefix',$item->id_BEList)}}" class= "btn btn-primary">แก้ไข</a>
                                 </td>
                            </tr>
                        @endforeach
                    </table>
                    <a href= "/waitrepair" class= "btn btn-primary">Back</a>
                </div>
        </div>
    @endsection