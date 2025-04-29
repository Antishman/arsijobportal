<h2>Applications for: {{ $job->title }}</h2>

@if($job->applications->isEmpty())
    <p>No applications yet.</p>
@else
    <ul>
        @foreach($job->applications as $application)
            <li>
                <strong>{{ $application->user->name }}</strong> ({{ $application->user->email }})<br>

                @if($application->resume)
                    <a href="{{ asset('storage/' . $application->resume) }}" target="_blank">Download Resume</a><br>
                @endif

                <em>Cover Letter:</em><br>
                <p>{{ $application->cover_letter }}</p>

                <p>Status: <strong>{{ ucfirst($application->status) }}</strong></p>

                @if($application->status === 'pending')
                    <form action="{{ url('/applications/' . $application->id . '/status') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="status" value="accepted">
                        <button type="submit">Accept</button>
                    </form>
                    <form action="{{ url('/applications/' . $application->id . '/status') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit">Reject</button>
                    </form>
                @endif
                <hr>
            </li>
        @endforeach
    </ul>
@endif

<a href="/employer/dashboard">← Back to Dashboard</a>
