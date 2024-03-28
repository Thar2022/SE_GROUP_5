<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Before Login - Landing Page</title>
</head>

<body class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-semibold mb-4">Welcome to Our Website!</h2>
        <p>Please log in to access the full features.</p>
        <p><a href="{{ route('login') }}" class="text-indigo-500 hover:underline">Login</a></p>
    </div>
</body>

</html>
