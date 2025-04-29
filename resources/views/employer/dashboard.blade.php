<h2>Your Posted Jobs</h2>
<ul>
@foreach(Auth::user()->jobs as $job)
    <li>
        {{ $job->title }}
        <a href="{{ url('/employer/jobs/' . $job->id . '/applications') }}">View Applications</a>

        <form action="{{ url('/employer/jobs/' . $job->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </li>
@endforeach
</ul>

<a href="/employer/jobs">Post a New Job</a><br>
<a href="/logout">Logout</a>
