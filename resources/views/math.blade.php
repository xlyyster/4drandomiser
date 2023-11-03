<!DOCTYPE html>
<html>
<head>
    <title>4D Randomiser</title>
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
        <form action="/calculate" method="POST">
            @csrf
            <div class="form-group">
                <label for="number">Enter a 4-digit number:</label>
                <input type="number" class="form-control" name="number" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
    </div>
    <div class="fixed-button">
        <div id="bottom-button-container">
            <a href="{{ route('previous_data') }}" class="btn btn-primary">View Previous Data</a>
        </div>
    </div>
</body>
</html>
