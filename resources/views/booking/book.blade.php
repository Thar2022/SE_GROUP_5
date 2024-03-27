@extends('layout.adminLayout')
@section('title','booking')
@section('content')
<p class="text-center">การจอง</p>
<div class="album py-5 bg-body-tertiary">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($room as $item)
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-img-top">
                        <img src="room/{{$item->name_room}}.jpg" class="img-fluid" alt="Image">
                    </div>

                    <div class="card-body">
                        <p class="card-text text-left">
                            {{$item->name_room}} <br>
                            อุปกรณ์
                        </p>
                        <div class="mt-auto">
                            <a href="{{route('book_from',$item->name_room)}}">
                                <button type="button" class="btn btn-sm btn-outline-secondary float-end">จอง</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection