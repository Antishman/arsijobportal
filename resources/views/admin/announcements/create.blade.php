<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Announcement - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        :root {
            --primary: #002f66;
            --accent: #FF6600;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg border border-gray-200">
        <h2 class="text-2xl font-bold text-[#002f66] mb-4">📢 Create Announcement</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.announcements.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" required class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#002f66]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" rows="4" required class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#002f66]"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Optional Link (PDF, Event, etc.)</label>
                <input type="url" name="link" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#002f66]">
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" class="bg-[#FF6600] text-white px-6 py-2 rounded hover:bg-orange-600 transition">
                    🚀 Post Announcement
                </button>

                <a href="{{ route('admin.announcements.index') }}" class="text-[#002f66] underline hover:text-blue-900">
                    ← Back to All Announcements
                </a>
            </div>
        </form>
    </div>

</body>
</html>
