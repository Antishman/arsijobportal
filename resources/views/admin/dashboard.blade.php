<h2>Admin Dashboard</h2>
<nav>
    <a href="{{ route('admin.announcements.index') }}">📢 Manage Announcements</a><br>
    <!-- other admin links -->
</nav>
<h3>📊 Site Analytics</h3>
<ul>
    <li>Total Jobseekers: {{ $jobseekerCount }}</li>
    <li>Total Employers: {{ $employerCount }}</li>
    <li>Total Jobs: {{ $jobCount }}</li>
    <li>Total Applications: {{ $applicationCount }}</li>
</ul>

<hr>

<h3>All Users</h3>
<ul>
@foreach($users as $user)
    <li>
        {{ $user->name }} ({{ $user->email }}) - Role: {{ $user->role }}
        <form action="{{ url('/admin/users/' . $user->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Delete this user?')" type="submit">Delete</button>
        </form>
    </li>
@endforeach
</ul>

<hr>

<h3>All Jobs</h3>
<ul>
@foreach($jobs as $job)
    <li>
        {{ $job->title }} by {{ $job->employer->name }} — Status: <strong>{{ ucfirst($job->status) }}</strong><br>

        @if($job->status === 'pending')
            <form action="{{ url('/admin/jobs/' . $job->id . '/status') }}" method="POST" style="display:inline">
                @csrf
                <input type="hidden" name="status" value="approved">
                <button type="submit">Approve</button>
            </form>

            <form action="{{ url('/admin/jobs/' . $job->id . '/status') }}" method="POST" style="display:inline">
                @csrf
                <input type="hidden" name="status" value="rejected">
                <button type="submit">Reject</button>
            </form>
        @endif

        <form action="{{ url('/admin/jobs/' . $job->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Delete this job?')" type="submit">Delete</button>
        </form>
        <hr>
    </li>
@endforeach
</ul>

<a href="/logout">Logout</a>
