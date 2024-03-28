@extends('layout.checkroomLayout')
@section('content')
    {{-- แบบย่อ  --}}
    <h2 class="text-center mb-4">อุปกรณ์ในห้องทั้งหมด</h2>
    <div >
        <form method="POST" action="/checkroom/savebroken">
            @csrf
            <div class="form-group">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่ออุปกรณ์</th>
                            <th scope="col" hidden>หมายเลขอุปกรณ์</th>
                            <th scope="col">จำนวนที่มี</th>
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
                                <td>{{ $equipment->amount }} <input type="text" name="max_amount[]"
                                        value="{{ $equipment->amount }}" hidden></td>
                                <td>
                                    <input type="number" name="amount[]" min="0" max="{{ $equipment->amount }}"
                                        value="0" class="w-50 text-center" required>
                                    {{-- <input type="number"  name="amount[]" value="0" class="w-50 text-center" required> --}}

                                    @error('amount.' . $i)
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <label class="ms-2 mt-3 mb-2">รายละเอียดเพิ่มเติม</label>
                <textarea class="form-control" rows="3" name="note"></textarea>
                @error('note')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <input type="text" name="id_room" value="{{ $id_room }}" hidden>
                <input type="submit" value="บันทึก" class="btn btn-primary m-1 mt-5">
                <a href="/checkroom/check" class="btn btn-success m-1 mt-5">กลับ</a>
            </div>
        </form>
    </div>
@endsection
