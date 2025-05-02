<h2>All Announcements</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.announcements.create') }}">+ New Announcement</a>

<ul>
@foreach($announcements as $announcement)
    <li>
        <strong>{{ $announcement->title }}</strong><br>
        {{ $announcement->message }}<br>
        @if($announcement->link)
            <a href="{{ $announcement->link }}" target="_blank">🔗 Link</a><br>
        @endif

        <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button onclick="return confirm('Delete this announcement?')" type="submit">Delete</button>
        </form>
        <hr>
    </li>
@endforeach
</ul>

{{ $announcements->links() }}
