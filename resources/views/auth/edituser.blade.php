@extends('layout.adminLayout')
@section('title','edituser')
@section('content')
<div class="p-4 sm:ml-64">
	<br>
	@if (Session::has('success'))
		<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
			<p class="font-bold">Success!</p>
			<p>{{ Session::get('success') }}</p>
		</div>
	@endif
	<h3 class="text-2xl font-semibold mb-4 sm:text-center">จัดการผู้ใช้ทั้งหมด</h3>
	<br>
	<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    	<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
			<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
				<tr>
					<th scope="col" class="px-6 py-3">
						ชื่อ-นามสกุล
					</th>
					<th scope="col" class="px-6 py-3">
						เบอร์โทรศัพท์
					</th>
					<th scope="col" class="px-6 py-3">
						ตำแหน่ง
					</th>
					<th scope="col" class="px-6 py-3">
						อีเมล
					</th>
					<th scope="col" class="px-6 py-3">
						จัดการ
					</th>
					<th scope="col" class="px-6 py-3">
						ลบ
					</th>
				</tr>
			</thead>
			<tbody>
				<!-- <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
					<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
						Apple MacBook Pro 17"
					</th>
					<td class="px-6 py-4">
						Silver
					</td>
					<td class="px-6 py-4">
						Laptop
					</td>
					<td class="px-6 py-4">
						$2999
					</td>
					<td class="px-6 py-4">
						<a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">แก้ไข</a>
					</td>
					<td class="px-6 py-4">
						<a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">ลบผู้ใช้</a>
					</td>
				</tr> -->
				<!-- get data from /getalluser and map data to table -->
				@foreach($userData as $user)
					<tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
						<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
							{{ $user->fname }} {{ $user->lname}}
						</th>
						<td class="px-6 py-4">
							{{ $user->phone }}
						</td>
						<td class="px-6 py-4">
							{{ $user->role_name }}
						</td>
						<td class="px-6 py-4">
							{{ $user->email }}
						</td>
						<td class="px-6 py-4">
							<a href="/editUser?id={{ $user->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">แก้ไข</a>
						</td>
						<td class="px-6 py-4">
							<a href="#" onclick="deleteUser(<?php echo $user->id;  ?>)" class="font-medium text-red-600 dark:text-red-500 hover:underline">ลบผู้ใช้</a>
						</td>

					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<script>
	function deleteUser(id){
		if(confirm('คุณต้องการลบผู้ใช้นี้ใช่หรือไม่?')){
			window.location.href = '/deleteUser?id='+id;
		}
	}
</script>
@endsection
