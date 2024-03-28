@extends('layout.' . session('role_name'))

@section('title')
    อุปกรณ์ที่เสีย    
@endsection



@section('content')
    อุปกรณ์ที่เสีย<br />
    @foreach ($data as $detail)
        
    @endforeach
    ห้อง : {{ $detail->name_room}} &nbsp;&nbsp;
    วันที่ปิด : {{ $detail->date_close}}&nbsp;&nbsp;
    วันที่เปิด : {{ $detail->date_open}}
    <br/><br/>
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div><br/>

    <table class="table table-bordered table-striped ">
        <tr>
            <th>ลำดับ</th>
            <th>อุปกรณ์</th>
            <th>วันที่เสร็จ</th>
            <th>จำนวน</th>           
        </tr>
        <?php $i=1 ?>
        @foreach ($data as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->name }}</td>
            @if ($item->date_finish)
                <td>{{ $item->date_finish }}</td>
            @else
                <td>รอช่างประเมิน</td>
            @endif
            
            {{-- <a href="{{ route('admin.brokeEquipment', $item->id_checkroom) }}" class='btn btn-outline-primary me-2' >ดูอุปกรณที่เสีย</a> --}}
            <td>{{ $item->amount }}</td>
            
        </tr>

            
        @endforeach
    </table>
@endsection