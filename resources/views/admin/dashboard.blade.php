<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-primary { background-color: #002f66; }
        .text-accent { color: #FF6600; }
        .bg-accent { background-color: #FF6600; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

    <!-- Header -->
    <header class="bg-primary text-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold">🎓 Arsi University - Admin Dashboard</h1>
            <a href="/logout" class="text-sm hover:underline hover:text-accent transition">Logout</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-10 space-y-10">

        <!-- Navigation -->
        <nav class="flex gap-4">
            <a href="{{ route('admin.announcements.index') }}"
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-accent hover:text-white transition">
                📢 Manage Announcements
            </a>
            <!-- Add more nav items here -->
        </nav>

        <!-- Site Analytics -->
        <section>
            <h2 class="text-xl font-semibold text-gray-700 mb-4">📊 Site Analytics</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['label' => 'Jobseekers', 'count' => $jobseekerCount, 'icon' => '👤'],
                    ['label' => 'Employers', 'count' => $employerCount, 'icon' => '🏢'],
                    ['label' => 'Jobs', 'count' => $jobCount, 'icon' => '📄'],
                    ['label' => 'Applications', 'count' => $applicationCount, 'icon' => '📥'],
                ] as $item)
                <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
                    <div class="text-3xl">{{ $item['icon'] }}</div>
                    <div class="text-sm text-gray-500 mt-1">{{ $item['label'] }}</div>
                    <div class="text-2xl font-bold text-primary mt-2">{{ $item['count'] }}</div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- All Users -->
        <section>
            <h2 class="text-xl font-semibold text-gray-700 mb-4">👥 All Users</h2>
            <div class="bg-white rounded-2xl shadow divide-y">
                @foreach($users as $user)
                    <div class="flex items-center justify-between px-5 py-4">
                        <div>
                            <p class="font-medium">{{ $user->name }} ({{ $user->email }})</p>
                            <p class="text-sm text-gray-500">Role: {{ ucfirst($user->role) }}</p>
                        </div>
                        <form action="{{ url('/admin/users/' . $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline text-sm">🗑 Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- All Jobs -->
        <section>
            <h2 class="text-xl font-semibold text-gray-700 mb-4">📌 All Jobs</h2>
            <div class="space-y-4">
                @foreach($jobs as $job)
                    <div class="bg-white rounded-2xl shadow p-5">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-primary">{{ $job->title }}</h3>
                                <p class="text-sm text-gray-500">By {{ $job->employer->name }} • 
                                    Status: <span class="font-semibold text-accent">{{ ucfirst($job->status) }}</span>
                                </p>
                            </div>

                            <div class="flex gap-2 mt-4 sm:mt-0">
                                @if($job->status === 'pending')
                                    <form action="{{ url('/admin/jobs/' . $job->id . '/status') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-sm">✅ Approve</button>
                                    </form>
                                    <form action="{{ url('/admin/jobs/' . $job->id . '/status') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-sm">❌ Reject</button>
                                    </form>
                                @endif
                                <form action="{{ url('/admin/jobs/' . $job->id) }}" method="POST" onsubmit="return confirm('Delete this job?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline text-sm">🗑 Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </main>

</body>
</html>
