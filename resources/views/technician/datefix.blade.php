@extends('layout.' . session('role_name'))
@section('title','repair')
@section('content')

    <h1>แก้ไขวันที่</h1>
    <form method="POST" action="{{route('updatedate',$datefix->id_BEList,$datefix->id_checkroom)}}">
        @csrf
        <div class="form-group">
            <label for="date_finish">เลือกวันที่ซ่อมเสร็จ</label>
            <input type="date" name="date_finish">
        </div>
        @error('date_finish')
            <div class="my-2">
                <span class="text-danger">{{$message}}</span>
            </div>
        @enderror
        <input type="submit" value="บันทึก" class="btn btn-primary">
        <a href= "{{route('back',$datefix->id_checkroom)}}" class= "btn btn-primary">Back</a>
    </form>
@endsection