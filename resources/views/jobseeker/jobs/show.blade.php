<h2>{{ $job->title }}</h2>
<p><strong>Location:</strong> {{ $job->location }}</p>
<p><strong>Type:</strong> {{ $job->type }}</p>
<p><strong>Salary:</strong> {{ $job->salary ?? 'Not specified' }}</p>
<p>{{ $job->description }}</p>

<hr>
<h3>Apply to this Job</h3>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="{{ url('/jobs/' . $job->id . '/apply') }}">
    @csrf
    <textarea name="cover_letter" placeholder="Write your cover letter here..." required></textarea><br>
    <button type="submit">Submit Application</button>
</form>
