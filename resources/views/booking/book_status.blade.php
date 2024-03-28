@extends('layout.' . session('role_name'))
@section('title','status')
@section('content')
<h2 class="text text-center py-2">ประวัติการจอง</h2>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">หัวข้อประชุม</th>
            <th scope="col">วัน</th>
            <th scope="col">ห้อง</th>
            <th scope="col">เวลาเริ่ม</th>
            <th scope="col">เวลาจบ</th>
            <th scope="col">สถานะ</th>

        </tr>
    </thead>
    <?php

use App\Models\meeting_room;

 $i = 1; ?>
    @foreach ($book_emp as $item)
    <tbody>
        <tr>
            <?php 
                $room = meeting_room::where('id_room',$item->id_room)->first();
            ?>
            <th scope="row"><?php echo $i ?></th>
            <td>{{$item->topic}}</td>
            <?php $Date = date("d/m/y", strtotime($item->date)); ?>
            <td><?php echo $Date; ?></td>
            <td><?php echo $room->name_room; ?></td>
            <td>{{$item->time_start}}</td>
            <td>{{$item->time_end}}</td>
            <td>{{$item->status}}</td>
            <td>
                <?php if ($item->status == 'กำลังส่งเรื่อง') : ?>
                    <a href="{{route('book_edit',$item->id_booking)}}">
                        <button type="button" class="btn btn-success">แก้ไข</button>
                    </a>
            </td>
        <?php endif; ?>
        <td>
            <?php if ($item->status == 'กำลังส่งเรื่อง') : ?>
                <a href="{{route('delete',$item->id_booking)}}">
                    <button type="button" class="btn btn-danger">ลบ</button>
                </a>
            <?php endif; ?>
        </td>
        </tr>
    </tbody>
    <?php $i++; ?>
    @endforeach
</table>
@endsection