<h2>Available Jobs</h2>

@if($jobs->isEmpty())
    <p>No jobs are currently available. Please check back later.</p>
@else
    <ul>
        @foreach($jobs as $job)
            <li>
                <a href="{{ url('/jobs/' . $job->id) }}">{{ $job->title }}</a>
                ({{ $job->location }}, {{ $job->type }})
            </li>
        @endforeach
    </ul>
@endif
