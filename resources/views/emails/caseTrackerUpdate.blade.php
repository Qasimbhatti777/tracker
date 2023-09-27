<!DOCTYPE html>
<html>
<head>
    <title>Case Tracker Update</title>
</head>
<body>
    <h1>Case Tracker Update</h1>

    @foreach ($tracker as $updatedTracker)
        <h2>Tracker Details:</h2>
        <ul>
            <li>Case Number: {{ $updatedTracker->case_number }}</li>
            <li>Case Name: {{ $updatedTracker->case_name }}</li>
            <li>Last Update: {{ $updatedTracker->last_update }}</li>
        </ul>
    @endforeach
</body>
</html>
