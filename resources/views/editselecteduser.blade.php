
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Admin page</title>
</head>


<body class="bg-gray-100" onload="fillValue({{ $userData->role }})">
<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="ms-3">หน้าหลัก</span>
            </a>
         </li>
         <li>
            <span href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap"></span>
            </span>
         </li>
         <li>
            <a href="/edit" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">จัดการผู้ใช้ทั้งหมด</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">จัดการการจองห้อง</span>
               <!-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span> -->
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">จัดการการตรวจห้อง</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">จัดการการซ่อมห้อง</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">จัดการห้องและอุปกรณ์</span>
            </a>
         </li>
         <li>
         <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">จัดการห้องและอุปกรณ์</span>
            </span>
         </li>
         <li>
            
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">โปรไฟล์</span>
            </a>
         </li>
         <li>
            <form action="{{ route('logout') }}" method="POST" id="logout">
                @csrf
                @method('DELETE')
                <a href="javascript:{}" onclick="document.getElementById('logout').submit(); return false;" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="flex-1 ms-3 whitespace-nowrap">ออกจากระบบ</span>
                </a>
            </form>
         </li>
      </ul>
   </div>
</aside>

<div class="p-4 sm:ml-64">

	<br>
	<h3 class="text-2xl font-semibold mb-4 sm:text-center">แก้ไขข้อมูลผู้ใช้</h3>
	<br>
	<div class="bg-gray-100 flex justify-center">
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
						<option value="3">ฝ่ายตรวจ</option>
						<option value="2">ฝ่ายซ่อม</option>
						<option value="1">ผู้ดูแลระบบ</option>
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

</html>


