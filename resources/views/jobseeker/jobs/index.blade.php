<h2>Available Jobs</h2>

<form method="GET" action="/jobs">
    <input type="text" name="title" placeholder="Job Title" value="{{ request('title') }}">
    <input type="text" name="location" placeholder="Location" value="{{ request('location') }}">
    <select name="type">
        <option value="">-- Select Type --</option>
        <option value="Full-time" {{ request('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
        <option value="Part-time" {{ request('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
        <option value="Internship" {{ request('type') == 'Internship' ? 'selected' : '' }}>Internship</option>
    </select>
    <button type="submit">Search</button>
</form>
<hr>

@if($jobs->isEmpty())
    <p>No jobs match your search criteria. Please try again later.</p>
@else
    <ul>
        @foreach($jobs as $job)
            <li>
                <a href="{{ url('/jobs/' . $job->id) }}">{{ $job->title }}</a>
                ({{ $job->location }}, {{ $job->type }})

                @if(in_array($job->id, $savedJobIds))
                    <span style="color: green;">✔ Saved</span>
                @else
                    <form action="{{ url('/jobs/' . $job->id . '/bookmark') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Save</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>

    {{-- Pagination --}}
    {{ $jobs->withQueryString()->links() }}
@endif
