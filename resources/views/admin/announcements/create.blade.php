<h2>Create Announcement</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('admin.announcements.store') }}" method="POST">
    @csrf

    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Message:</label><br>
    <textarea name="message" required></textarea><br><br>

    <label>Optional Link (PDF, Event, etc.):</label><br>
    <input type="url" name="link"><br><br>

    <button type="submit">Post Announcement</button>
</form>

<a href="{{ route('admin.announcements.index') }}">← Back to All Announcements</a>
