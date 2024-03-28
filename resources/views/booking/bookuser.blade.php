@extends('layout.' . session('role_name'))
@section('title','booking')
@section('content')
<h2>การจองของuser</h2>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-1-tab" data-bs-toggle="pill" type="button" role="tab" data-bs-target="#pills-1" aria-controls="pills-1" aria-selected="true">กำลังส่งเรื่อง</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-2-tab" data-bs-toggle="pill" data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2" aria-selected="false">กำลังตรวจสอบ</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-3-tab" data-bs-toggle="pill" data-bs-target="#pills-3" type="button" role="tab" aria-controls="pills-3" aria-selected="false">ผ่าน</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-4-tab" data-bs-toggle="pill" data-bs-target="#pills-4" type="button" role="tab" aria-controls="pills-4" aria-selected="false">ไม่ผ่าน</button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">id_emp</th>
                    <th scope="col">id_booking</th>
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
                <?php if ($item->status == 'กำลังส่งเรื่อง') : ?>
                    <tr>
                        <?php
                        $room = meeting_room::where('id_room', $item->id_room)->first();
                        ?>
                        <th scope="row"><?php echo $i ?></th>
                        <td>{{$item->id_emp}}</td>
                        <td>{{$item->id_booking}}</td>
                        <td>{{$item->topic}}</td>
                        <?php $Date = date("d/m/y", strtotime($item->date)); ?>
                        <td><?php echo $Date; ?></td>
                        <td><?php echo $room->name_room; ?></td>
                        <td>{{$item->time_start}}</td>
                        <td>{{$item->time_end}}</td>
                        <td>{{$item->status}}</td>
                        <td>
                            <a href="{{route('update2',$item->id_booking)}}">
                                <button type="button" class="btn btn-danger">ส่งเรื่อง</button>
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php $i++; ?>
            @endforeach
        </table>
    </div>
    <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
    <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">id_emp</th>
                    <th scope="col">id_booking</th>
                    <th scope="col">หัวข้อประชุม</th>
                    <th scope="col">วัน</th>
                    <th scope="col">ห้อง</th>
                    <th scope="col">เวลาเริ่ม</th>
                    <th scope="col">เวลาจบ</th>
                    <th scope="col">สถานะ</th>

                </tr>
            </thead>
            <?php $i = 1; ?>
            @foreach ($book_emp as $item)
            <tbody>
                <?php if ($item->status == 'กำลังตรวจสอบ') : ?>
                    <tr>
                        <?php
                        $room = meeting_room::where('id_room', $item->id_room)->first();
                        ?>
                        <th scope="row"><?php echo $i ?></th>
                        <td>{{$item->id_emp}}</td>
                        <td>{{$item->id_booking}}</td>
                        <td>{{$item->topic}}</td>
                        <?php $Date = date("d/m/y", strtotime($item->date)); ?>
                        <td><?php echo $Date; ?></td>
                        <td><?php echo $room->name_room; ?></td>
                        <td>{{$item->time_start}}</td>
                        <td>{{$item->time_end}}</td>
                        <td>{{$item->status}}</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php $i++; ?>
            @endforeach
        </table>
    </div>
    <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
    <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">id_emp</th>
                    <th scope="col">id_booking</th>
                    <th scope="col">หัวข้อประชุม</th>
                    <th scope="col">วัน</th>
                    <th scope="col">ห้อง</th>
                    <th scope="col">เวลาเริ่ม</th>
                    <th scope="col">เวลาจบ</th>
                    <th scope="col">สถานะ</th>

                </tr>
            </thead>
            <?php $i = 1; ?>
            @foreach ($book_emp as $item)
            <tbody>
                <?php if ($item->status == 'จองสำเร็จ') : ?>
                    <tr>
                        <?php
                        $room = meeting_room::where('id_room', $item->id_room)->first();
                        ?>
                        <th scope="row"><?php echo $i ?></th>
                        <td>{{$item->id_emp}}</td>
                        <td>{{$item->id_booking}}</td>
                        <td>{{$item->topic}}</td>
                        <?php $Date = date("d/m/y", strtotime($item->date)); ?>
                        <td><?php echo $Date; ?></td>
                        <td><?php echo $room->name_room; ?></td>
                        <td>{{$item->time_start}}</td>
                        <td>{{$item->time_end}}</td>
                        <td>{{$item->status}}</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php $i++; ?>
            @endforeach
        </table>
    </div>
    <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab">
    <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">id_emp</th>
                    <th scope="col">id_booking</th>
                    <th scope="col">หัวข้อประชุม</th>
                    <th scope="col">วัน</th>
                    <th scope="col">ห้อง</th>
                    <th scope="col">เวลาเริ่ม</th>
                    <th scope="col">เวลาจบ</th>
                    <th scope="col">สถานะ</th>

                </tr>
            </thead>
            <?php $i = 1; ?>
            @foreach ($book_emp as $item)
            <tbody>
                <?php if ($item->status == 'จองไม่สำเร็จ') : ?>
                    <tr>
                        <?php
                        $room = meeting_room::where('id_room', $item->id_room)->first();
                        ?>
                        <th scope="row"><?php echo $i ?></th>
                        <td>{{$item->id_emp}}</td>
                        <td>{{$item->id_booking}}</td>
                        <td>{{$item->topic}}</td>
                        <?php $Date = date("d/m/y", strtotime($item->date)); ?>
                        <td><?php echo $Date; ?></td>
                        <td><?php echo $room->name_room; ?></td>
                        <td>{{$item->time_start}}</td>
                        <td>{{$item->time_end}}</td>
                        <td>{{$item->status}}</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php $i++; ?>
            @endforeach
        </table>
    </div>
</div>
@endsection