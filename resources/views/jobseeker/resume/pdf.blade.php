<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $resume->full_name }} - Resume</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            line-height: 1.6;
            margin: 30px;
        }

        h1, h2 {
            margin: 0;
            padding: 5px 0;
        }

        h1 {
            font-size: 24px;
            border-bottom: 2px solid #333;
        }

        h2 {
            font-size: 18px;
            margin-top: 20px;
            color: #444;
        }

        .section {
            margin-bottom: 15px;
        }

        .bold-label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>{{ $resume->full_name }}</h1>

    @if($resume->summary)
    <div class="section">
        <h2>Summary</h2>
        <p>{{ $resume->summary }}</p>
    </div>
    @endif

    @if($resume->education)
    <div class="section">
        <h2>Education</h2>
        <p>{!! nl2br(e($resume->education)) !!}</p>
    </div>
    @endif

    @if($resume->experience)
    <div class="section">
        <h2>Experience</h2>
        <p>{!! nl2br(e($resume->experience)) !!}</p>
    </div>
    @endif

    @if($resume->skills)
    <div class="section">
        <h2>Skills</h2>
        <p>{!! nl2br(e($resume->skills)) !!}</p>
    </div>
    @endif

</body>
</html>
