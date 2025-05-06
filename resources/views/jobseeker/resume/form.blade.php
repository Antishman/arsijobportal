<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Build Your Resume</title>
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
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fade-in-up 0.5s ease-out; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow animate-fade-in-up">
        <h2 class="text-2xl font-bold text-primary mb-6">Build Your Resume</h2>

        @if(session('success'))
            <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif

        @if($resume->exists)
            <p class="mb-4">
                <a href="{{ url('/resume/preview') }}" target="_blank" class="text-accent hover:underline">
                    👁️ Preview Resume (PDF)
                </a>
            </p>
        @endif

        <form method="POST" action="/resume" class="space-y-6">
            @csrf

            <div>
                <label class="block mb-1 font-medium text-gray-700">Full Name:</label>
                <input type="text" name="full_name"
                       value="{{ old('full_name', $resume->full_name) }}"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Summary:</label>
                <textarea name="summary" rows="3"
                          class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary">{{ old('summary', $resume->summary) }}</textarea>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Education:</label>
                <textarea name="education" rows="3"
                          class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary">{{ old('education', $resume->education) }}</textarea>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Experience:</label>
                <textarea name="experience" rows="3"
                          class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary">{{ old('experience', $resume->experience) }}</textarea>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Skills:</label>
                <textarea name="skills" rows="3"
                          class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary">{{ old('skills', $resume->skills) }}</textarea>
            </div>

            <div>
                <button type="submit"
                        class="bg-accent text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                    Save Resume
                </button>
            </div>
        </form>

        <div class="mt-6">
            <a href="/jobseeker/dashboard" class="text-sm text-primary hover:underline">← Back to Dashboard</a>
        </div>
    </div>

</body>
</html>
