<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Announcements - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen text-gray-800">
    <a href="/admin/dashboard" class="text-white bg-[#002f66] rounded px-4 py-2 text-sm hover:bg-[#001f4d] transition">
        ← Back to Dashboard
      </a>
      

    <div class="max-w-5xl mx-auto py-10 px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-[#002f66]">📋 All Announcements</h2>
            <a href="{{ route('admin.announcements.create') }}" class="bg-[#FF6600] text-white px-4 py-2 rounded hover:bg-orange-600 transition">
                ➕ New Announcement
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            @foreach($announcements as $announcement)
                <div class="bg-white shadow-md rounded-lg p-5 border border-gray-200">
                    <h3 class="text-xl font-semibold text-[#002f66]">{{ $announcement->title }}</h3>
                    <p class="mt-2 text-gray-700">{{ $announcement->message }}</p>

                    @if($announcement->link)
                        <a href="{{ $announcement->link }}" target="_blank" class="text-[#FF6600] underline inline-block mt-2">
                            🔗 View Resource
                        </a>
                    @endif

                    <div class="mt-4">
                        <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Delete this announcement?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline hover:text-red-800">🗑 Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $announcements->links() }}
        </div>
    </div>
</body>
</html>
