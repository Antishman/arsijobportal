<h2>Edit Application for {{ $application->job->title }}</h2>

<form method="POST" action="{{ url('/applications/' . $application->id . '/update') }}" enctype="multipart/form-data">
    @csrf
    <textarea name="cover_letter" required>{{ $application->cover_letter }}</textarea><br>

    @if($application->resume)
        <p>Existing Resume: <a href="{{ asset('storage/' . $application->resume) }}" target="_blank">Download</a></p>
    @endif

    <label>Upload New Resume (PDF only):</label><br>
    <input type="file" name="resume" accept="application/pdf"><br><br>

    <button type="submit">Update Application</button>
</form>

<a href="/applications">← Back to My Applications</a>
