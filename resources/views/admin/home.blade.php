@extends('layout.' . session('role_name'))

@section('title')
    หน้าแรก    
@endsection



@section('content')
<h2 class="text-2xl font-semibold mb-4">Welcome to Our Website, {{ session('user') }}!</h2>
        <h2 class="text-2xl font-semibold mb-4">{{session('role_name')}}</h2>
@endsection