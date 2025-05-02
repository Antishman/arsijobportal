@if($announcements->count())
    <h3>📢 Announcements</h3>
    <ul>
        @foreach($announcements as $announcement)
            <li>
                <strong>{{ $announcement->title }}</strong><br>
                {{ $announcement->message }}<br>
                @if($announcement->link)
                    <a href="{{ $announcement->link }}" target="_blank">🔗 View Resource</a>
                @endif
                <hr>
            </li>
        @endforeach
    </ul>
@endif

<h2>Jobseeker Dashboard</h2>

<nav>
    <a href="/jobs">📂 Browse Jobs</a><br>
    <a href="/jobs/saved">💾 Saved Jobs</a><br>
    <a href="/applications">📨 My Applications</a><br>
    <a href="{{ url('/resume/create') }}">📝 Build or Update Your Resume</a><br>
    <a href="/logout">🚪 Logout</a>
</nav>

<hr>

@if(auth()->user()->unreadNotifications->count())
    <p style="color: #e67e22;">
        🔔 You have {{ auth()->user()->unreadNotifications->count() }} new notification(s)
    </p>

    <ul>
        @foreach(auth()->user()->unreadNotifications as $notification)
            <li>{{ $notification->data['message'] }}</li>
        @endforeach
    </ul>

    <form method="POST" action="{{ url('/notifications/read-all') }}">
        @csrf
        <button type="submit">Mark all as read</button>
    </form>
@endif
