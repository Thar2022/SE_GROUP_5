@extends('layout.adminLayout')

@section('title')
    แก้ไขการจองห้อง  
@endsection



@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">
            <h2>แก้ไขการจองห้อง</h2>
        </div>
        <div>
            
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        </div><br><br><br>
        @foreach ($data as $item)
            
        @endforeach
        
        {{-- <form action="{{ route('admin.updateChangeRoom', $close_room->id_closeroom) }}" method="GET"> --}}
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group my-3">
                        <strong>ห้อง</strong>
                        
                        <select name="ห้อง" >
                            @foreach ($room as $al)
                                <option value={{ $al->id_room }} > {{ $al->name_room }}</option>;
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <strong>วันที่จอง</strong>
                        <input type="date" name="date_open" value="{{ $item->date_start }}" class="" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="mt-3 btn btn-primary" onClick="return confirm('ยืนยันการแก้ไขหรือไม่?')">ยืนยัน </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection