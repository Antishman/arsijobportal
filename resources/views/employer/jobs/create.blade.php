<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post a Job</title>
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
<body class="bg-gray-50 min-h-screen text-gray-800">

    <!-- Header -->
    <header class="bg-primary text-white px-6 py-4 shadow">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-lg font-semibold">📝 Post a New Job</h1>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-10">
        <div class="bg-white p-8 rounded-xl shadow space-y-6">

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/employer/jobs') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">Job Title<span class="text-red-500">*</span></label>
                    <input type="text" name="title" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Job Description<span class="text-red-500">*</span></label>
                    <textarea name="description" rows="5" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent px-4 py-2 resize-none"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium mb-1">Location<span class="text-red-500">*</span></label>
                        <input type="text" name="location" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Type (Full-time, Part-time)<span class="text-red-500">*</span></label>
                        <input type="text" name="type" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Salary (Optional)</label>
                        <input type="text" name="salary"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Application Deadline</label>
                        <input type="date" name="deadline" value="{{ old('deadline') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent px-4 py-2">
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit"
                        class="bg-accent text-white px-6 py-2 rounded-lg shadow hover:bg-orange-700 transition font-semibold">
                        🚀 Post Job
                    </button>
                </div>
            </form>
            <a href="/employer/dashboard" class="text-sm hover:underline">← Back to Dashboard</a>
        </div>
    </main>
</body>
</html>
