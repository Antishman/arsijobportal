<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Employer Dashboard - Arsi University</title>
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
                },
            },
        };
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-primary text-white py-5 shadow">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">🏢 Employer Dashboard</h1>
            <a href="/logout" class="text-sm underline hover:text-gray-200">Logout</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow py-10 px-4">
        <div class="max-w-6xl mx-auto space-y-10">

            <!-- Title + Action -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h2 class="text-2xl font-bold text-primary">📋 Your Posted Jobs</h2>
                <a href="/employer/jobs"
                   class="bg-accent text-white px-5 py-2 rounded-lg shadow hover:bg-orange-700 transition text-sm font-semibold">
                    + Post New Job
                </a>
            </div>

            <!-- Posted Jobs List -->
            @if(Auth::user()->jobs->isEmpty())
                <p class="text-gray-600">You haven’t posted any jobs yet.</p>
            @else
                <div class="space-y-6">
                    @foreach(Auth::user()->jobs as $job)
                    <div class="bg-white rounded-xl shadow p-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-primary">{{ $job->title }}</h3>
                            <a href="{{ url('/employer/jobs/' . $job->id . '/applications') }}"
                               class="text-sm text-accent hover:underline mt-1 inline-block">📄 View Applications</a>
                        </div>
                        <form method="POST"
                              action="{{ url('/employer/jobs/' . $job->id) }}"
                              onsubmit="return confirm('Are you sure you want to delete this job?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 text-white text-sm px-4 py-2 rounded hover:bg-red-600 transition">
                                🗑 Delete
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            @endif

        </div>
    </main>

    <!-- Footer (optional for symmetry) -->
    <footer class="bg-primary text-white text-center py-4">
        <p class="text-sm">© {{ date('Y') }} Arsi University | Employer Dashboard</p>
    </footer>

</body>
</html>
