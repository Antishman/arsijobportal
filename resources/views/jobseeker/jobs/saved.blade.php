<h2>Saved Jobs</h2>

@if($bookmarks->isEmpty())
    <p>You have not saved any jobs yet.</p>
@else
    <ul>
        @foreach($bookmarks as $bookmark)
            <li>
                <a href="{{ url('/jobs/' . $bookmark->job->id) }}">{{ $bookmark->job->title }}</a>
                ({{ $bookmark->job->location }}, {{ $bookmark->job->type }})

                <form action="{{ url('/jobs/' . $bookmark->job->id . '/unbookmark') }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Remove</button>
                </form>
            </li>
        @endforeach
    </ul>

    {{ $bookmarks->links() }}
@endif

<a href="/jobseeker/dashboard">← Back</a>
