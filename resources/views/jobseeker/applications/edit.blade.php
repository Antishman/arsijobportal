<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Application</title>
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
        <div class="max-w-3xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-semibold">Edit Application</h1>
            <a href="/applications" class="text-sm underline hover:text-gray-200">← Back to My Applications</a>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-6 py-10">
        <div class="bg-white p-8 rounded-lg shadow">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">For: {{ $application->job->title }}</h2>

            <form method="POST" action="{{ url('/applications/' . $application->id . '/update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cover Letter</label>
                    <textarea name="cover_letter" rows="6" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary">{{ $application->cover_letter }}</textarea>
                </div>

                @if($application->resume)
                    <div class="text-sm text-gray-600">
                        Existing Resume: 
                        <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" class="text-accent hover:underline">Download</a>
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Resume (PDF only)</label>
                    <input type="file" name="resume" accept="application/pdf" class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent file:text-white hover:file:bg-orange-700"/>
                </div>

                <div class="pt-4">
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition font-semibold">
                        Update Application
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
