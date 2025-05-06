<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jobseeker Dashboard - Arsi University</title>
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
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fade-in 0.4s ease-out; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="bg-primary text-white py-5 shadow-md">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="text-xl font-bold">🎓 Arsi University Job Portal</div>
            <div class="text-sm">Welcome, {{ Auth::user()->name }}</div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-grow p-6 fade-in">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow p-8 space-y-6">

            <h2 class="text-2xl font-bold text-primary">🎯 Jobseeker Dashboard</h2>

            @if($announcements->count())
                <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-blue-700 mb-2">📢 Announcements</h3>
                    <ul class="space-y-3">
                        @foreach($announcements as $announcement)
                            <li>
                                <strong class="text-gray-800">{{ $announcement->title }}</strong><br>
                                <span class="text-gray-600">{{ $announcement->message }}</span><br>
                                @if($announcement->link)
                                    <a href="{{ $announcement->link }}" target="_blank" class="text-accent hover:underline">
                                        🔗 View Resource
                                    </a>
                                @endif
                                <hr class="mt-2">
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <nav class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <a href="/jobs" class="bg-primary text-white p-4 rounded-lg hover:bg-blue-800 transition">📂 Browse Jobs</a>
                <a href="/jobs/saved" class="bg-accent text-white p-4 rounded-lg hover:bg-orange-700 transition">💾 Saved Jobs</a>
                <a href="/applications" class="bg-primary text-white p-4 rounded-lg hover:bg-blue-800 transition">📨 My Applications</a>
                <a href="{{ url('/resume/create') }}" class="bg-accent text-white p-4 rounded-lg hover:bg-orange-700 transition">📝 Build or Update Your Resume</a>
                <a href="/logout" class="col-span-1 sm:col-span-2 text-center border border-gray-300 text-gray-700 p-3 rounded-lg hover:bg-gray-100 transition">🚪 Logout</a>
            </nav>

            @if(auth()->user()->unreadNotifications->count())
                <div class="bg-yellow-50 border border-yellow-300 p-4 rounded-lg">
                    <p class="text-yellow-800 mb-2">
                        🔔 You have {{ auth()->user()->unreadNotifications->count() }} new notification(s)
                    </p>

                    <ul class="list-disc ml-6 mb-4 text-sm text-gray-700">
                        @foreach(auth()->user()->unreadNotifications as $notification)
                            <li>{{ $notification->data['message'] }}</li>
                        @endforeach
                    </ul>

                    <form method="POST" action="{{ url('/notifications/read-all') }}">
                        @csrf
                        <button type="submit"
                                class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition">
                            Mark all as read
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-primary text-white text-center py-4 mt-10">
        <p class="text-sm">© {{ date('Y') }} Arsi University | Career Development & Job Portal</p>
    </footer>

</body>
</html>
