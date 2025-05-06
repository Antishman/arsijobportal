<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Jobs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
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
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-primary text-white px-6 py-4 shadow">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-semibold">Available Jobs</h1>
            <a href="/jobseeker/dashboard" class="text-sm underline hover:text-gray-200">← Back to Dashboard</a>
        </div>
    </header>

    <!-- Filters -->
    <section class="max-w-4xl mx-auto px-6 py-8">
        <form method="GET" action="/jobs" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <input type="text" name="title" value="{{ request('title') }}" placeholder="Job Title"
                   class="px-4 py-2 rounded border border-gray-300 focus:ring-accent focus:border-accent">

            <input type="text" name="location" value="{{ request('location') }}" placeholder="Location"
                   class="px-4 py-2 rounded border border-gray-300 focus:ring-accent focus:border-accent">

            <select name="type"
                    class="px-4 py-2 rounded border border-gray-300 focus:ring-accent focus:border-accent">
                <option value="">-- Select Type --</option>
                <option value="Full-time" {{ request('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="Part-time" {{ request('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="Internship" {{ request('type') == 'Internship' ? 'selected' : '' }}>Internship</option>
            </select>

            <button type="submit"
                    class="bg-accent text-white px-4 py-2 rounded hover:bg-orange-700 transition">
                Search
            </button>
        </form>

        @if($jobs->isEmpty())
            <div class="text-center bg-white p-6 rounded-lg shadow animate-fade-in">
                <p class="text-gray-600">No jobs match your search criteria. Please try again later.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($jobs as $job)
                    <div class="bg-white p-6 rounded-lg shadow animate-fade-in-up hover:shadow-lg transition duration-300 ease-in-out">
                        <div class="flex justify-between items-center">
                            <div>
                                <a href="{{ url('/jobs/' . $job->id) }}" class="text-xl font-semibold text-primary hover:underline">
                                    {{ $job->title }}
                                </a>
                                <p class="text-gray-600 text-sm">{{ $job->location }} — {{ $job->type }}</p>
                                <p class="text-sm text-gray-500 mt-1">Deadline: {{ $job->deadline ?? 'No deadline' }}</p>
                            </div>
                            <div class="mt-2 md:mt-0">
                                @if(in_array($job->id, $savedJobIds))
                                    <span class="text-green-600 font-semibold">✔ Saved</span>
                                @else
                                    <form action="{{ url('/jobs/' . $job->id . '/bookmark') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="bg-accent text-white px-4 py-2 rounded hover:bg-orange-700 transition">
                                            Save
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $jobs->withQueryString()->links('pagination::tailwind') }}
            </div>
        @endif
    </section>

    <!-- Animations -->
    <style>
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.4s ease-out; }
        .animate-fade-in-up { animation: fade-in-up 0.5s ease-out; }
    </style>

</body>
</html>
