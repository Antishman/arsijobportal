<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jobseekers - Employer View</title>
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
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-primary text-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">👥 Jobseeker Directory</h1>
            <a href="/employer/dashboard" class="text-sm underline hover:text-accent transition">← Back to Dashboard</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-2xl font-bold text-accent mb-8">Available Jobseeker Profiles</h2>

        @if($jobseekers->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow text-center text-muted">
                No jobseeker profiles found.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jobseekers as $user)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg p-6 transition-all duration-200">
                        <div class="mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-600">📧 {{ $user->email }}</p>
                        </div>

                        @if($user->profile)
                            <div class="text-sm space-y-1">
                                <p>📞 <span class="text-gray-700">{{ $user->profile->phone ?? 'Not provided' }}</span></p>
                                <p>📍 <span class="text-gray-700">{{ $user->profile->address ?? 'Not provided' }}</span></p>
                                <p>📝 <span class="text-gray-700">{{ $user->profile->bio ?? 'No bio available' }}</span></p>

                                @if($user->profile->linkedin)
                                    <a href="{{ $user->profile->linkedin }}" class="text-accent hover:underline block mt-1" target="_blank">
                                        🔗 LinkedIn
                                    </a>
                                @endif

                                @if($user->profile->website)
                                    <a href="{{ $user->profile->website }}" class="text-accent hover:underline block" target="_blank">
                                        🌐 Personal Website
                                    </a>
                                @endif
                            </div>
                        @else
                            <p class="text-sm text-gray-400 italic mt-2">No profile information available.</p>
                        @endif

                        <!-- Tags -->
                        @if($user->tags && $user->tags->count())
                            <div class="mt-4">
                                <h4 class="text-sm font-semibold text-gray-700 mb-1">🏷️ Tags:</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($user->tags as $tag)
                                        <span class="text-xs bg-accent text-white px-2 py-1 rounded-full">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-4">
        <p class="text-sm">© {{ date('Y') }} Arsi University | Career Development & Job Portal</p>
    </footer>

</body>
</html>
