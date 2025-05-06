<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Applications</title>
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
            <h1 class="text-xl font-semibold">My Applications</h1>
            <a href="/jobseeker/dashboard" class="text-sm underline hover:text-gray-200">← Back to Dashboard</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-6 py-10 space-y-6">
        @if($applications->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow text-gray-600 text-center animate-fade-in">
                <p>You haven't applied to any jobs yet.</p>
            </div>
        @else
            @foreach($applications as $application)
                <div class="bg-white p-6 rounded-lg shadow animate-fade-in-up transition duration-300 ease-in-out hover:shadow-lg">
                    <h2 class="text-xl font-semibold text-primary mb-1">{{ $application->job->title }}</h2>
                    <p class="text-gray-600">{{ $application->job->location }}</p>
                    <p class="text-sm text-gray-500">Applied on: {{ $application->created_at->format('Y-m-d') }}</p>

                    <p class="mt-3 text-sm">
                        Status:
                        <span class="font-semibold {{ $application->status === 'accepted' ? 'text-green-600' : ($application->status === 'rejected' ? 'text-red-600' : 'text-yellow-600') }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </p>

                    @if($application->status === 'pending')
                        <div class="mt-3 flex gap-3 flex-wrap">
                            <a href="{{ url('/applications/' . $application->id . '/edit') }}"
                               class="bg-accent text-white px-4 py-2 rounded hover:bg-orange-700 transition">
                                Edit
                            </a>

                            <form action="{{ url('/applications/' . $application->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to withdraw this application?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                    Withdraw
                                </button>
                            </form>
                        </div>
                    @endif

                    <div class="mt-4 text-sm text-gray-700">
                        <p class="font-medium text-gray-800 mb-1">Cover Letter:</p>
                        <p class="whitespace-pre-line">{{ $application->cover_letter }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </main>

    <!-- Animations -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.4s ease-out; }
        .animate-fade-in-up { animation: fade-in 0.5s ease-out both; }
    </style>

</body>
</html>
