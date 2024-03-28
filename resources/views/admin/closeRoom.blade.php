@extends('layout.' . session('role_name'))

@section('title')
    จัดการการปิดห้อง    
@endsection



@section('content')
    จัดการการปิดห้อง<br />

    <table class="table table-bordered">
        <tr>
            <th>ลำดับ</th>
            <th>ห้อง</th>
            <th>วันที่ปิด</th>
            <th>วันที่เปิด</th>
            <th>อุปกรณที่เสีย</th>
            <th>หมายเหตุ</th>
            <th>สถานะการซ่อม</th>
            
        </tr>
        <?php $i=1 ?>
        @foreach ($data as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->name_room }}</td>
            <td>{{ $item->date_close }}</td>
            <td>
                {{ $item->date_open }} 
                <a href="{{ route('admin.editCloseRoom', $item->id_closeroom) }}" class="btn btn-warning">แก้ไข</a>
                <a href="{{ route('admin.deleteCloseRoom', $item->id_closeroom) }}" onClick="return confirm('ยืนยันการลบหรือไม่?')" class="btn btn-danger">ลบ</a>
            </td>
            
            @if ($item->id_ch)
            <td><a href="{{ route('admin.brokeEquipment', $item->id_checkroom) }}" class='btn btn-outline-primary me-2' >ดูอุปกรณที่เสีย</a></td>
            @else
                <td>ไม่มีอุปกรณ์เสีย</td>
            @endif

            
            {{-- <a href="{{ route('admin.brokeEquipment', $item->id_checkroom) }}" class='btn btn-outline-primary me-2' >ดูอุปกรณที่เสีย</a> --}}
            <td>{{ $item->note }}</td>
            
            @if ($item->status_repair)
                <td>{{ $item->status_repair }}</td>
            @else
                <td>รอซ่อม</td>
            @endif
        </tr>

            
        @endforeach
    </table>
@endsection