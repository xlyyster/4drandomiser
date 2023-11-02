<!DOCTYPE html>
<html>
<head>
    <title>Latest Data</title>
</head>
<body>
    <h1>Latest 10 Data Entries</h1>
    <ul>
        @foreach($latestData as $data)
            <li>{{ $data->original_number }} => {{ $data->altered_number }}</li>
        @endforeach
    </ul>
</body>
</html>