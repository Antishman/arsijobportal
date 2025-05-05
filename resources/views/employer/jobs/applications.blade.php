<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Applications - {{ $job->title }}</title>
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
<body class="bg-gray-50 text-gray-800 min-h-screen">

    <!-- Header -->
    <header class="bg-primary text-white px-6 py-4 shadow">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-lg font-semibold">📄 Applications for: {{ $job->title }}</h1>
            <a href="/employer/dashboard" class="text-sm hover:underline">← Back to Dashboard</a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 py-8 space-y-6">

        @if($job->applications->isEmpty())
            <div class="bg-white p-6 rounded-xl shadow text-center text-gray-500">
                No applications have been submitted yet.
            </div>
        @else
            <div class="space-y-6">
                @foreach($job->applications as $application)
                    <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                            <div>
                                <h2 class="text-lg font-semibold text-primary">{{ $application->user->name }}</h2>
                                <p class="text-sm text-gray-500">{{ $application->user->email }}</p>

                                @if($application->resume)
                                    <a href="{{ asset('storage/' . $application->resume) }}" target="_blank"
                                       class="inline-block mt-2 text-sm text-accent hover:underline">
                                        📎 Download Resume
                                    </a>
                                @endif

                                <div class="mt-4">
                                    <p class="text-sm font-medium text-gray-700 mb-1">💬 Cover Letter:</p>
                                    <p class="bg-gray-100 p-3 rounded text-sm">{{ $application->cover_letter }}</p>
                                </div>

                                <p class="mt-3 text-sm">
                                    Status: <span class="font-semibold text-accent">{{ ucfirst($application->status) }}</span>
                                </p>
                            </div>

                            @if($application->status === 'pending')
                                <div class="flex flex-col gap-2 mt-4 sm:mt-0">
                                    <form action="{{ url('/applications/' . $application->id . '/status') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-lg">
                                            ✅ Accept
                                        </button>
                                    </form>

                                    <form action="{{ url('/applications/' . $application->id . '/status') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-2 rounded-lg">
                                            ❌ Reject
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </main>
</body>
</html>
