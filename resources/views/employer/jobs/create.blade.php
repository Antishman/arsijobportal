<h2>Post a Job</h2>
<form method="POST" action="{{ url('/employer/jobs') }}">
    @csrf
    <input type="text" name="title" placeholder="Job Title" required><br>
    <textarea name="description" placeholder="Job Description" required></textarea><br>
    <input type="text" name="location" placeholder="Location" required><br>
    <input type="text" name="type" placeholder="Type (Full-time, Part-time)" required><br>
    <input type="text" name="salary" placeholder="Salary (optional)"><br>
    <button type="submit">Post Job</button>
</form>
