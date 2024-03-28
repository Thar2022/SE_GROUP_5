
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>After Login - Landing Page</title>
</head>

{{
    //redirect
    (session('role') == 1) {
        return redirect('/admin')->with('success', 'Login Success');
    } else {
        return redirect('/home')->with('success', 'Login Success');
    }
}}

<body class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-semibold mb-4">Welcome to Our Website, {{ session('user') }}!</h2>
        <p>You are now logged in.</p>
        <form action="{{ route('logout') }}" method="POST" id="logout">
            @csrf
            @method('DELETE')
            <p><a href="javascript:{}" onclick="document.getElementById('logout').submit(); return false;" class="text-indigo-500 hover:underline">Logout</a></p>
        </form>
    </div>
</body>


</html>
