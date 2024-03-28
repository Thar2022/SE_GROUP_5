@extends('layout.repair')
@section('title','edituser')
@section('content')
<body class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-semibold mb-4">Welcome to Our Website, {{ session('user') }}!</h2>
        <h2 class="text-2xl font-semibold mb-4">ฝ่ายซ่อม</h2>
        <p>Repair page, You are now logged in.</p>
        <form action="{{ route('logout') }}" method="POST" id="logout">
            @csrf
            @method('DELETE')
            <p><a href="javascript:{}" onclick="document.getElementById('logout').submit(); return false;" class="text-indigo-500 hover:underline">Logout</a></p>
        </form>
    </div>
</body>
@endsection
