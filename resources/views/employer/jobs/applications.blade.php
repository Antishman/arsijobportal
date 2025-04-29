<h2>Applications for: {{ $job->title }}</h2>

@if($job->applications->isEmpty())
    <p>No applications yet.</p>
@else
    <ul>
        @foreach($job->applications as $application)
            <li>
                <strong>{{ $application->user->name }}</strong> ({{ $application->user->email }})<br>
                <em>Cover Letter:</em><br>
                <p>{{ $application->cover_letter }}</p>
                <hr>
            </li>
        @endforeach
    </ul>
@endif

<a href="/employer/dashboard">← Back to Dashboard</a>
