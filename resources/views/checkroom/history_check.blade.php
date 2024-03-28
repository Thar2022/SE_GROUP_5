@extends('layout.checkroomLayout')
@section('content')
    {{-- แบบย่อ  --}}
    @if (count($check_rooms) ==0 )
    
        <h2 class="text-center mb-4">ไม่พบประวัติการตรวจห้อง</h2>
    @else
        <div class="container mt-2">
            <h2 class="text-center mb-4">ประวัติการตรวจห้อง</h2>

            <div class="w-75 mx-auto">

                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ห้องที่ตรวจ</th>
                            <th scope="col" hidden>หมายเลขการตรวจ</th>
                            <th scope="col">วันที่ตรวจ</th>
                            <th scope="col">สถานะการตรวจ</th>
                            <th scope="col">รายละเอียดการตรวจ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($check_rooms as $i => $check_room)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $check_room->name_room }}</td>
                                <td hidden><input type="text" name="id_check_room"
                                        value="{{ $check_room->id_checkroom }}">
                                </td>
                                <td>{{ $check_room->date_check }}</td>
                                <td>
                                    @if ($check_room->status_check == 'ห้องปกติ')
                                        <p class="text-success">{{ $check_room->status_check }}</p>
                                    @else
                                        <p class="text-danger">{{ $check_room->status_check }}</p>
                                    @endif


                                    {{-- $check_room->status_check {{ $check_room->status_check }} --}}
                                </td>
                                <td><a href="{{ route('detail_check', $check_room->id_checkroom) }}"
                                        class="btn btn-success">รายละเอียด</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    @endif
@endsection
