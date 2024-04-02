@extends('layout.' . session('role_name'))

@section('title')
    จัดการการซ่อมห้อง
@endsection



@section('content')
    จัดการการซ่อมห้อง<br />

    <table class="table table-bordered">
        <tr>
            <th>ลำดับ</th>
            <th>ห้อง</th>
            <th>ชื่อ - นามสกุล</th>
            <th>เบอร์</th>
            <th>วันที่ซ่อมคาดว่าซ่อมเสร็จ</th>
            <th>หมายเหตุ</th>
            <th>อุปกรณ์ที่เสีย</th>
            <th>ปิดห้อง</th>

        </tr>
        <?php $i = 1; ?>
        @foreach ($data as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->name_room }}</td>
                <td>{{ $item->fname ." ". $item->lname }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->note }}</td>
                @if ($item->id_ch)
                    <td><a href="{{ route('admin.brokeEquipment', $item->id_checkroom) }}"
                            class='btn btn-outline-primary me-2'>ดูอุปกรณที่เสีย</a></td>
                @else
                    <td>ไม่มีอุปกรณ์เสีย</td>
                @endif
                <td><a href="{{ route('admin.createCloseRoom', $item->id_checkroom) }}"
                        class='btn btn-outline-primary me-2'>ปิดห้อง</a></td>
            </tr>
        @endforeach
    </table>
@endsection
