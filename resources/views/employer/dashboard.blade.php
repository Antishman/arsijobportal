<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-primary { background-color: #002f66; }
        .text-primary { color: #002f66; }
        .bg-accent { background-color: #FF6600; }
        .text-accent { color: #FF6600; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-primary text-white px-6 py-4 shadow">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-semibold">🏢 Employer Dashboard</h1>
            <a href="/logout" class="text-sm underline hover:text-gray-200">Logout</a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-6 py-10 space-y-8">

        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800">Your Posted Jobs</h2>
            <a href="/employer/jobs"
               class="bg-accent text-white px-4 py-2 rounded-lg shadow hover:bg-orange-700 transition text-sm font-semibold">
                + Post New Job
            </a>
        </div>

        @if(Auth::user()->jobs->isEmpty())
            <p class="text-gray-600">You haven't posted any jobs yet.</p>
        @else
            <div class="grid gap-6">
                @foreach(Auth::user()->jobs as $job)
                    <div class="bg-white p-6 rounded-lg shadow flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-primary">{{ $job->title }}</h3>
                            <a href="{{ url('/employer/jobs/' . $job->id . '/applications') }}"
                               class="text-sm text-accent hover:underline">📄 View Applications</a>
                        </div>
                        <form action="{{ url('/employer/jobs/' . $job->id) }}" method="POST" onsubmit="return confirm('Delete this job?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-sm bg-red-500 text-white px-3 py-1.5 rounded hover:bg-red-600 transition">
                                🗑 Delete
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

    </main>
</body>
</html>
