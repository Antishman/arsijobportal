<h2>Post a Job</h2>

<form method="POST" action="{{ url('/employer/jobs') }}">
    @csrf

    <input type="text" name="title" placeholder="Job Title" required><br><br>

    <textarea name="description" placeholder="Job Description" required></textarea><br><br>

    <input type="text" name="location" placeholder="Location" required><br><br>

    <input type="text" name="type" placeholder="Type (Full-time, Part-time)" required><br><br>

    <input type="text" name="salary" placeholder="Salary (optional)"><br><br>

    <input type="date" name="deadline" value="{{ old('deadline') }}" placeholder="deadline"><br><br>

    <button type="submit">Post Job</button>
</form>
