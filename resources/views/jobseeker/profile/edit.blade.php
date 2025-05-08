<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - Arsi University</title>
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
                    },
                }
            }
        };
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-primary text-white py-5 shadow-md">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="text-xl font-bold">🎓 Arsi University Job Portal</div>
            <a href="/jobseeker/dashboard" class="text-sm hover:underline">← Back to Dashboard</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-6">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow space-y-6">

            <h2 class="text-2xl font-bold text-primary">👤 Edit Your Profile</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('jobseeker.profile.update') }}" method="POST" class="grid grid-cols-1 gap-6">
                @csrf

                <div>
                    <label class="block font-medium text-gray-700 mb-1">📞 Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">📍 Address</label>
                    <input type="text" name="address" value="{{ old('address', $profile->address) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">📝 Bio</label>
                    <textarea name="bio" rows="4"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-accent">{{ old('bio', $profile->bio) }}</textarea>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">🔗 LinkedIn URL</label>
                    <input type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">🌐 Website</label>
                    <input type="url" name="website" value="{{ old('website', $profile->website) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>
                <!-- Tags Field -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Your Skills / Tags</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach($tags as $tag)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    {{ in_array($tag->id, $selectedTagIds) ? 'checked' : '' }}>
                                <span class="text-sm">{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>


                <div class="text-right">
                    <button type="submit"
                            class="bg-accent hover:bg-orange-700 text-white px-6 py-2 rounded-lg font-medium transition">
                        💾 Save Profile
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-4 mt-10">
        <p class="text-sm">© {{ date('Y') }} Arsi University | Career Development & Job Portal</p>
    </footer>

</body>
</html>
