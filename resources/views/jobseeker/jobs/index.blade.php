<h2>Available Jobs</h2>
<ul>
    @foreach($jobs as $job)
        <li>
            <a href="{{ url('/jobs/' . $job->id) }}">{{ $job->title }}</a>
            ({{ $job->location }}, {{ $job->type }})
        </li>
    @endforeach
</ul>
