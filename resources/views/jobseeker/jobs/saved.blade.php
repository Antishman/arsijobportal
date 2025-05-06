<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saved Jobs</title>
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
            <h1 class="text-xl font-semibold">Saved Jobs</h1>
            <a href="/jobseeker/dashboard" class="text-sm underline hover:text-gray-200">← Back</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-6 py-8">
        @if($bookmarks->isEmpty())
            <div class="text-center bg-white p-6 rounded-lg shadow animate-fade-in">
                <p class="text-gray-600">You have not saved any jobs yet.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($bookmarks as $bookmark)
                    <div class="bg-white p-6 rounded-lg shadow animate-fade-in-up hover:shadow-lg transition duration-300 ease-in-out">
                        <div class="flex justify-between items-center">
                            <div>
                                <a href="{{ url('/jobs/' . $bookmark->job->id) }}" class="text-xl font-semibold text-primary hover:underline">
                                    {{ $bookmark->job->title }}
                                </a>
                                <p class="text-gray-600 text-sm">{{ $bookmark->job->location }} — {{ $bookmark->job->type }}</p>
                            </div>
                            <form action="{{ url('/jobs/' . $bookmark->job->id . '/unbookmark') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-sm bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $bookmarks->links('pagination::tailwind') }}
            </div>
        @endif
    </main>

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
