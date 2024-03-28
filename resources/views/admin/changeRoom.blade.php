@extends('layout.adminLayout')

@section('title')
    การจองที่รอเปลี่ยนห้อง    
@endsection



@section('content')
    การจองที่รอเปลี่ยนห้อง<br />

    <table class="table table-bordered">
        <tr>
            <th>ลำดับ</th>
            <th>ห้อง</th>
            <th>วันที่จอง</th>
            <th>จำนวนคน</th>
            <th>เวลาเริ่ม</th>
            <th>เวลาสิ้นสุด</th>
            <th>ชื่อ-สกุล ผู้จอง</th>
            <th>เบอร์</th>
            <th>เปลี่ยนห้อง</th>
            
        </tr>
        <?php $i=1 ?>
        @foreach ($data as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->name_room }}</td>
            <td>{{ $item->date }}</td>
            <td>{{ $item->amount }}</td>
            <td>{{ $item->time_start }}</td>
            <td>{{ $item->time_end }}</td>
            <td>{{ $item->fname . ' ' . $item->lname }}</td>
            <td>{{ $item->phone}}</td>
            {{-- @if (!$item->status_email)
                <td><a href="{{ route('admin.sentEmail', $item->id_booking) }}" onClick="return confirm('ยืนยันการส่ง E-mail หรือไม่?')" class='btn btn-outline-primary me-2' >ส่ง E-mail</a></td>
            @else
                <td>ส่งแล้ว</td>
            @endif --}}
            
            <td><a href="{{ route('admin.editChangeRoom', $item->id_booking) }}" class='btn btn-outline-primary me-2' >เปลี่ยนห้อง</a></td>
            {{-- <td>{{ $item->date_open }} <a href="{{ route('admin.editCloseRoom', $item->id_closeroom) }}" class="btn btn-warning">แก้ไข</a></td> --}}
            

            
            {{-- <a href="{{ route('admin.brokeEquipment', $item->id_checkroom) }}" class='btn btn-outline-primary me-2' >ดูอุปกรณที่เสีย</a> --}}
        </tr>

            
        @endforeach
    </table>
@endsection