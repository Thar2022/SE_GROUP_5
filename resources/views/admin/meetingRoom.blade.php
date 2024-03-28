@extends('layout.' . session('role_name'))

@section('title')
    จัดการห้องและอุปกรณ์
@endsection



@section('content')
    จัดการห้อง<br />
    <a href="{{ route('admin.createRoom') }}"
        class='btn btn-outline-primary me-2'>เพิ่มห้อง</a><br><br>

    <table class="table table-bordered">
        <tr>
            <th>ลำดับ</th>
            <th>ห้อง</th>
            <th>ชนิด</th>
            <th>ความจุ</th>
            <th>แก้ไข</th>
            <th>ลบ</th>

        </tr>
        <?php $i = 1; ?>
        @foreach ($data as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->name_room }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->seats }}</td>
                <td><a href="{{ route('admin.editRoom', $item->id_room) }}" class="btn btn-warning">แก้ไข</a></td>
                <td><a href="{{ route('admin.deleteRoom', $item->id_room) }}"
                    onClick="return confirm('ยืนยันการลบหรือไม่?')" class="btn btn-danger">ลบ</a></td>

            </tr>
        @endforeach
    </table>
@endsection
