
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Admin page</title>
</head>


<body class="bg-gray-100">
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
            <span href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap"></span>
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
							<a href="#" onclick="deleteUser({{ $user->id }})" class="font-medium text-red-600 dark:text-red-500 hover:underline">ลบผู้ใช้</a>
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

</html>
