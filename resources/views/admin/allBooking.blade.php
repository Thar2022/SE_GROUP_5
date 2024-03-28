@extends('layout.adminLayout')

@section('title')
    การจองทั้งหมด    
@endsection



@section('content')
    การจองทั้งหมด<br />

    <table class="table table-bordered">
        <tr>
            <th>ลำดับ</th>
            <th>เรื่อง</th>
            <th>ห้อง</th>
            <th>ชื่อ - สกุล</th>
            <th>จำนวนคน</th>
            <th>วันที่จอง</th>
            <th>เวลาเริ่ม</th>
            <th>เวลาสิ้นสุด</th>
            <th>สถานะ</th>
            
        </tr>
        <?php $i=1 ?>
        @foreach ($data as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->topic }}</td>
            <td>{{ $item->name_room }}</td>
            <td>{{ $item->fname . $item->lname }}</td>
            <td>{{ $item->amount }}</td>
            <td>{{ $item->date }}</td>
            <td>{{ $item->time_start }}</td>
            <td>{{ $item->time_end }}</td>
            <td>{{ $item->status }}</td>
        </tr>

            
        @endforeach
    </table>
@endsection