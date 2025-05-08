<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Tags - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#002f66',
                        accent: '#FF6600',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        };
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans text-gray-800">
      <a href="/admin/dashboard" class="text-white bg-[#002f66] rounded px-4 py-2 text-sm hover:bg-[#001f4d] transition">
        ← Back to Dashboard
      </a>

    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-primary">🔖 Tags Management</h2>
            <a href="{{ route('admin.tags.create') }}" class="bg-accent text-white px-4 py-2 rounded hover:bg-orange-700">+ Add Tag</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="divide-y">
            @foreach($tags as $tag)
                <div class="flex justify-between py-3 items-center">
                    <span>{{ $tag->name }}</span>
                    <div class="space-x-3">
                        <a href="{{ route('admin.tags.edit', $tag->id) }}" class="text-blue-600 hover:underline">✏️ Edit</a>
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this tag?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">🗑 Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
