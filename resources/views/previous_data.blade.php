<!DOCTYPE html>
<html>
<head>
    <title>Previous Data</title>
    <!-- Include Bootstrap and custom CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #333; /* Dark grey background */
            color: #fff; /* White font color */
        }
        .container {
            margin-top: 20px;
        }
        table {
            width: 100%;
        }
        table, th, td {
            border: 1px solid white;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .fixed-button {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
        #bottom-button-container {
            position: fixed;
            bottom: 20px; /* Adjust this value to control the distance from the bottom */
            right: 20px; /* You can also adjust this value for horizontal positioning */
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Previous Data</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Original Number</th>
                    <th>Altered Number</th>
                    <th>Position</th>
                    <th>Alteration Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach($previousData as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->original_number }}</td>
                        <td>{{ $data->altered_number }}</td>
                        <td>{{ $data->position + 1 }}</td>
                        <td>{{ $data->alteration_value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="bottom-button-container">
        <a href="{{ route('home') }}" class="btn btn-primary">Return to Home Page</a>

    </div>
</body>
</html>
