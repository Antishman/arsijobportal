<h2>{{ $job->title }}</h2>
<p><strong>Location:</strong> {{ $job->location }}</p>
<p><strong>Type:</strong> {{ $job->type }}</p>
<p><strong>Salary:</strong> {{ $job->salary ?? 'Not specified' }}</p>
<p>{{ $job->description }}</p>
