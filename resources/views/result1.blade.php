<!DOCTYPE html>
<html>
<head>
    <title>Math App Result</title>
    <!-- Include Bootstrap and custom CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #333; /* Dark grey background */
            color: #fff; /* White font color */
            padding: 20px;
        }
        .container {
            background-color: #444; /* Slightly lighter grey background */
            padding: 20px;
            border-radius: 10px;
        }
        .underline {
            text-decoration: underline;
        }
        .error {
            color: red;
        }
        .flex-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .flex-item {
            flex-basis: 48%; /* Adjust as needed for different screen sizes */
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
        <h1>Original Number:
            @php
                $numberArray = str_split($originalNumber);
                $numberArray[$position] = '<span class="underline">' . $numberArray[$position] . '</span>';
                echo implode('', $numberArray);
            @endphp
        </h1>
        <h1>Calculation:
            @if($isAddition)
                {{ $originalNumber[$position] }} + {{ $alterationValue }}
            @else
                {{ $originalNumber[$position] }} - {{ abs($alterationValue) }}
            @endif
            = {{ $newNumber }}
        </h1>
        <h1>New Number: {{ $newNumber }}</h1>

        <form method="POST" action="/calculate">
            @csrf
            <label for="number">Enter a 4-digit number:</label>
            <input type="number" name="number" value="{{ $originalNumber }}" required>
            <button type="submit">Calculate</button>
        </form>
        <form method="POST" action="/calculate">
            @csrf
            <input type="hidden" name="number" value="{{ $originalNumber }}">
            <button type="submit">Redo with the Same Number</button>
        </form>
        
        <!-- Add a button to view previous data -->
        {{-- <a href="{{ route('previous_data') }}" class="btn btn-primary">View Previous Data</a> --}}
    </div>
    <div class="fixed-button">
        <div id="bottom-button-container">
            <a href="{{ route('previous_data') }}" class="btn btn-primary">View Previous Data</a>
        </div>
    </div>
</body>
</html>
