<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $job->title }}</title>
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
    <style>
        body { font-family: 'Inter', sans-serif; }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fade-in-up 0.5s ease-out; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto px-6 py-10 animate-fade-in-up">
        <!-- Job Details -->
        <div class="bg-white p-8 rounded-xl shadow">
            <h1 class="text-2xl font-bold text-primary mb-4">{{ $job->title }}</h1>

            <p class="mb-2"><strong class="text-gray-700">Location:</strong> {{ $job->location }}</p>
            <p class="mb-2"><strong class="text-gray-700">Type:</strong> {{ $job->type }}</p>
            <p class="mb-4"><strong class="text-gray-700">Salary:</strong> {{ $job->salary ?? 'Not specified' }}</p>

            <p class="text-gray-800 leading-relaxed whitespace-pre-line">{{ $job->description }}</p>
        </div>

        <!-- Application Form -->
        <div class="bg-white mt-8 p-8 rounded-xl shadow animate-fade-in-up">
            <h2 class="text-xl font-semibold text-primary mb-4">Apply to this Job</h2>

            @if(session('success'))
                <p class="text-green-600 mb-4">{{ session('success') }}</p>
            @endif
            @if(session('error'))
                <p class="text-red-600 mb-4">{{ session('error') }}</p>
            @endif

            <form method="POST" action="{{ url('/jobs/' . $job->id . '/apply') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Cover Letter</label>
                    <textarea name="cover_letter" rows="5" required
                              placeholder="Write your cover letter here..."
                              class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary resize-none"></textarea>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Attach Resume (PDF only)</label>
                    <input type="file" name="resume" accept="application/pdf"
                           class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                <div>
                    <button type="submit"
                            class="bg-accent text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
