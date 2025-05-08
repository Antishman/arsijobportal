<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Arsi University Job Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { inter: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: '#002f66',
                        accent: '#FF6600',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        @keyframes fade-in { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fade-in 0.4s ease-out; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md fade-in">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-primary">🎓 Arsi University</h1>
            <p class="text-gray-600">Job Portal Login</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" placeholder="username"
                       class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" placeholder="Password"
                       class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            <button type="submit"
                    class="w-full bg-primary text-white py-2 rounded hover:bg-blue-800 transition">
                🔐 Login
            </button>
        </form>
        
        <p class="text-center text-sm text-gray-500 mt-4">
            don't have an account? <a href="/register" class="text-accent hover:underline">Register here</a>
        </p>
        <p class="text-center text-sm text-gray-500 mt-4">
            Having trouble? Contact IT support at <a href="mailto:support@arsiuniversity.edu.et" class="text-accent hover:underline">support@arsiuniversity.edu.et</a>
        </p>
    </div>

</body>
</html>
