<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login</title>
    <style>
        .psw a {
            background-color: #FFFFFF; /* สีพื้นหลังของปุ่ม */
            color: #0066FF; /* สีของตัวอักษร */
            text-align: left; /* จัดข้อความชิดซ้าย */
            text-decoration: underline; /* มีขีดเส้นใต้ */
            display: inline; /* แสดงเป็นอินไลน์ */
            margin-right: 10px; /* ระยะห่างด้านขวา */
        }


        .psw a:hover {
            background-color: #FFFFFF; /* เปลี่ยนสีพื้นหลังเมื่อชี้ */
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-semibold mb-4">เข้าสู่ระบบ</h2>
        @if (Session::has('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p class="font-bold">Error!</p>
                <p>{{ Session::get('error') }}</p>
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">อีเมล</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">รหัสผ่าน</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <button type="submit" class="w-full py-2 px-4 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Sign In</button>
                </div>
        </form>

       
        <br>

        <!-- JavaScript เพื่อจัดการเหตุการณ์เมื่อคลิกที่ลิงก์ -->
        <script>
            document.getElementById("forgot-password").addEventListener("click", function(event) {
                

                alert("Forgot password link clicked!");
            });
        </script>
    </div>
</body>

</html>
