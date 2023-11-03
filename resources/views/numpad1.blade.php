<!DOCTYPE html>
<html>
<head>
    <title>Numpad Calculator</title>
    <!-- Include Bootstrap and your custom numpad CSS here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #333; /* Dark grey background */
            color: #fff; /* White font color */
        }
        .numpad-container {
            text-align: center;
            padding: 20px;
        }
        .numpad-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 10px;
        }
        .btn-numpad {
            font-size: 24px;
            padding: 20px;
            text-align: center;
            background-color: #555; /* Darker grey button background */
            cursor: pointer;
        }
        .btn-numpad:hover {
            background-color: #777; /* Lighter grey button background on hover */
        }
        #result {
            font-size: 24px;
            margin-top: 20px;
        }
        #history {
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="numpad-container">
                    <form method="POST" action="/calculate">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="entered_value" placeholder="Original Number" aria-label="Original Number" aria-describedby="basic-addon2">
                        </div>
                
                        <div class="numpad-grid">
                            <button type="button" class="btn btn-numpad" onclick="appendNumber(1)">1</button>
                            <button type="button" class="btn btn-numpad" onclick="appendNumber(2)">2</button>
                            <button type="button" class="btn btn-numpad" onclick="appendNumber(3)">3</button>
                            <button type="button" class="btn btn-numpad" onclick="appendNumber(4)">4</button>
                            <button type="button" class="btn btn-numpad" onclick="appendNumber(5)">5</button>
                            <button type="button" class="btn btn-numpad" onclick="appendNumber(6)">6</button>
                            <button type="button" class="btn btn-numpad" onclick="appendNumber(7)">7</button>
                            <button type="button" class="btn btn-numpad" onclick="appendNumber(8)">8</button>
                            <button type="button" class="btn btn-numpad" onclick="appendNumber(9)">9</button>
                            <button type="button" class="btn btn-numpad" onclick="clearDisplay()">C</button>
                            <button type="button" class="btn btn-numpad" onclick="appendNumber(0)">0</button>
                            <button type="submit" class="btn btn-numpad btn-success">Submit</button>
                        </div>
                    </form>
                    <div id="result">New Number: <span id="calculatedValue">{{ $calculatedValue ?? 'Calculating...' }}</span></div>
                    <div id="history">Previous History:</div>
                    @if($previousData)
                        <ul>
                            @foreach($previousData as $data)
                                <li>{{ $data->original_number }} => {{ $data->altered_number }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>Loading...</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function appendNumber(number) {
            const originalNumberField = document.querySelector('input[name="entered_value"]');
            originalNumberField.value += number;
        }
    
        function clearDisplay() {
            const originalNumberField = document.querySelector('input[name="entered_value"]');
            originalNumberField.value = '';
        }
    </script>
</body>
</html>
