<h2>My Applications</h2>

@if($applications->isEmpty())
    <p>You haven't applied to any jobs yet.</p>
@else
    <ul>
        @foreach($applications as $application)
            <li>
                <strong>{{ $application->job->title }}</strong> ({{ $application->job->location }})<br>
                Applied on: {{ $application->created_at->format('Y-m-d') }}<br>

                <p>Status: <strong>{{ ucfirst($application->status) }}</strong></p>

                @if($application->status === 'pending')
                    <a href="{{ url('/applications/' . $application->id . '/edit') }}">Edit</a>

                    <form action="{{ url('/applications/' . $application->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to withdraw this application?')">
                            Withdraw
                        </button>
                    </form>
                @endif

                <em>Cover Letter:</em> {{ $application->cover_letter }}<br>
                <hr>
            </li>
        @endforeach
    </ul>
@endif

<a href="/jobseeker/dashboard">← Back to Dashboard</a>
