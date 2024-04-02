@extends('layout.' . session('role_name'))
@section('content')
    {{-- แบบย่อ  --}}
    @if (count($equipments) == 0 && $note->note == '')
        <h2 class="text-center mb-4">ห้องปกติดีทุกอย่าง</h2>
    @elseif(count($equipments) != 0)
        <h2 class="text-center mb-4">อุปกรณ์ที่เสียทั้งหมด</h2>
        <div  >
            <form method="POST" action="/savebroken">
                @csrf
                <div class="form-group">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่ออุปกรณ์</th>
                                <th scope="col" hidden>หมายเลขอุปกรณ์</th>
                                {{-- <th scope="col">จำนวนที่มี</th> --}}
                                <th scope="col">จำนวนที่เสีย</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipments as $i => $equipment)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $equipment->name }}</td>
                                    <td hidden><input type="text" name="id_equipment[]"
                                            value="{{ $equipment->id_equipment }}"></td>
                                    {{-- <td>{{ $equipment->amount }} <input type="text" name="max_amount[]"
                                        value="{{ $equipment->amount }}" hidden></td> --}}
                                    <td>
                                        {{ $equipment->amount }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </form>
        </div>
    @else
        <h2 class="text-center mb-4">อุปกรณ์ไม่ได้ชำรุด</h2>
    @endif

    @if (count($equipments) != 0 || $note->note != '')
        <div class="">
            <label class="ms-2 mt-3 mb-2">รายละเอียดเพิ่มเติม</label>
            <textarea class="form-control" rows="3" name="note">{{ $note->note }}</textarea>

        </div>
        <div class="d-flex justify-content-end">
            <a href="/checkroom/history_check" class="btn btn-success m-1 mt-5">กลับ</a>
        </div>
    @endif
@endsection
