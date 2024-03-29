@extends('layout.' . session('role_name'))

@section('title')
    จัดการผู้ใช้แต่ละคน
@endsection



@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Admin page</title>
</head>

<body onload="fillValue({{ $userData->role }})">
<div>
	<br>
	<h3 class="text-2xl font-semibold mb-4 sm:text-center">แก้ไขข้อมูลผู้ใช้</h3>
	<br>
	<div class=" flex justify-center">
	<div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
		@if (Session::has('success'))
			<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
				<p class="font-bold">Success!</p>
				<p>{{ Session::get('success') }}</p>
			</div>
		@endif
		<div class="relative overflow-x-auto sm:rounded-lg">
		<form action="{{ route('saveEditedUser') }}" method="GET" class="space-y-4">
				@csrf
				<input type="hidden" value="{{ $userData->id }}" id="id" name="id">
				<div>
					<label for="fname" class="block text-sm font-medium text-gray-700">ชื่อ</label>
					<input type="text" value="{{ $userData->fname }}" id="fname" required name="fname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
				</div>
				<div>
					<label for="lname" class="block text-sm font-medium text-gray-700">นามสกุล</label>
					<input type="text" value="{{ $userData->lname }}" id="lname" required name="lname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
				</div>
				<div>
					<label for="email" class="block text-sm font-medium text-gray-700">อีเมล</label>
					<input type="email" value="{{ $userData->email }}" id="email" required name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
				</div>
				<div>
					<label for="role" class="block text-sm font-medium text-gray-700">ตำแหน่ง</label>
					<!-- <input type="text" id="role" name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"> -->
					<select id="role" required name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
						<option value="">กรุณาเลือกตำแหน่ง</option>
						<option value="1">ผู้ดูแลระบบ</option>
						<option value="2">ฝ่ายซ่อม</option>
						<option value="3">ฝ่ายตรวจ</option>
						<option value="4">พนักงานบริษัท</option>
					</select>
				</div>
				<div>
					<label for="phone" class="block text-sm font-medium text-gray-700">เบอร์โทร</label>
					<input type="number" value="{{ $userData->phone }}" id="phone" required name="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
				</div>
				<div>
					<button type="submit" class="w-full py-2 px-4 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">บันทึก</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</div>

<script>
	function fillValue(id){
		document.getElementById('role').value = id;
	}
</script>
</body>
</html>

@endsection
