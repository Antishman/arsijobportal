<h2>Build Your Resume</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if($resume->exists)
    <p>
        <a href="{{ url('/resume/preview') }}" target="_blank">👁️ Preview Resume (PDF)</a>
    </p>
@endif

<form method="POST" action="/resume">
    @csrf
    <label>Full Name:</label><br>
    <input type="text" name="full_name" value="{{ old('full_name', $resume->full_name) }}"><br><br>

    <label>Summary:</label><br>
    <textarea name="summary">{{ old('summary', $resume->summary) }}</textarea><br><br>

    <label>Education:</label><br>
    <textarea name="education">{{ old('education', $resume->education) }}</textarea><br><br>

    <label>Experience:</label><br>
    <textarea name="experience">{{ old('experience', $resume->experience) }}</textarea><br><br>

    <label>Skills:</label><br>
    <textarea name="skills">{{ old('skills', $resume->skills) }}</textarea><br><br>

    <button type="submit">Save Resume</button>
</form>

<a href="/jobseeker/dashboard">← Back to Dashboard</a>
