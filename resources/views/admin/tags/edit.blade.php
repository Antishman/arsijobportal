<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Tag - Admin</title>
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
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold text-primary mb-6">✏️ Edit Tag</h2>

        <form method="POST" action="{{ route('admin.tags.update', $tag->id) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700">Tag Name</label>
                <input type="text" name="name" value="{{ old('name', $tag->name) }}" class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring-accent">
            </div>
            <div class="text-right">
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-900">Update</button>
            </div>
        </form>
    </div>

</body>
</html>
