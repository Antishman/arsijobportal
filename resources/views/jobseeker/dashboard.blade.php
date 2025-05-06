<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jobseeker Dashboard - Arsi University</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { inter: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: '#002f66',
                        accent: '#FF6600',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: 0, transform: 'translateY(10px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' },
                        }
                    },
                    animation: {
                        fadeIn: 'fadeIn 0.5s ease-out both',
                    }
                }
            }
        };
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-primary text-white py-4 shadow-md">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-lg sm:text-xl font-semibold">🎓 Arsi University Job Portal</h1>
            <span class="text-sm sm:text-base">Welcome, {{ Auth::user()->name }}</span>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow py-10 px-4 animate-fadeIn">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 space-y-8">

            <h2 class="text-2xl font-bold text-primary">🎯 Jobseeker Dashboard</h2>

            @if($announcements->count())
                <section class="bg-blue-50 border border-blue-200 rounded-lg p-5">
                    <h3 class="text-lg font-semibold text-blue-700 mb-3">📢 Announcements</h3>
                    <ul class="space-y-4 text-sm">
                        @foreach($announcements as $announcement)
                            <li>
                                <strong class="text-gray-900">{{ $announcement->title }}</strong><br>
                                <span class="text-gray-700">{{ $announcement->message }}</span>
                                @if($announcement->link)
                                    <div>
                                        <a href="{{ $announcement->link }}" target="_blank"
                                           class="text-accent hover:underline mt-1 inline-block">🔗 View Resource</a>
                                    </div>
                                @endif
                                <hr class="mt-3">
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif

            <!-- Navigation -->
            <nav class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="/jobs" class="bg-primary text-white p-4 rounded-lg hover:bg-blue-800 transition shadow">
                    📂 Browse Jobs
                </a>
                <a href="/jobs/saved" class="bg-accent text-white p-4 rounded-lg hover:bg-orange-700 transition shadow">
                    💾 Saved Jobs
                </a>
                <a href="/applications" class="bg-primary text-white p-4 rounded-lg hover:bg-blue-800 transition shadow">
                    📨 My Applications
                </a>
                <a href="{{ url('/resume/create') }}" class="bg-accent text-white p-4 rounded-lg hover:bg-orange-700 transition shadow">
                    📝 Build or Update Your Resume
                </a>
                <a href="/logout"
                   class="col-span-1 sm:col-span-2 text-center border border-gray-300 text-gray-700 p-3 rounded-lg hover:bg-gray-50 transition">
                    🚪 Logout
                </a>
            </nav>

            <!-- Notifications -->
            @if(auth()->user()->unreadNotifications->count())
                <section class="bg-yellow-50 border border-yellow-300 p-5 rounded-lg">
                    <p class="text-yellow-800 font-medium mb-2">
                        🔔 You have {{ auth()->user()->unreadNotifications->count() }} new notification(s)
                    </p>
                    <ul class="list-disc ml-6 text-sm text-gray-800 mb-4">
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
                </section>
            @endif

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-4">
        <p class="text-sm">© {{ date('Y') }} Arsi University | Career Development & Job Portal</p>
    </footer>

</body>
</html>
