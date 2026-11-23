
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | ChikondiCare</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#DDF4F2] min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-3xl shadow-lg p-10 max-w-xl w-full text-center">
        <div class="bg-[#209F9B] w-16 h-16 rounded-2xl mx-auto flex items-center justify-center mb-5">
            <span class="text-white text-3xl font-bold">C</span>
        </div>

        <h1 class="text-2xl font-bold text-slate-800">
            Welcome to ChikondiCare
        </h1>

        <p class="text-slate-500 mt-2">
            You have successfully logged in.
        </p>

        <form action="{{ route('logout') }}" method="POST" class="mt-7">
            @csrf
            <button class="bg-[#209F9B] hover:bg-[#176F6C] text-white px-8 py-3 rounded-xl">
                Logout
            </button>
        </form>
    </div>

</body>
</html>
