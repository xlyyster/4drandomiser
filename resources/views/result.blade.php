@php
    use App\PreviousData;
@endphp

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
        .numpad-container {
            text-align: center;
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
        .result-heading {
            background-color: #444; /* Darker grey background for headings */
            padding: 10px; /* Add padding to headings */
            color: #fff; /* White font color for headings */
            text-align: center; /* Center headings */
        }
        .result-box {
            background-color: #666; /* Slightly lighter grey background for boxes */
            padding: 10px; /* Add padding to boxes */
            text-align: center; /* Center headings */
        }
        .red-text {
            color: red; /* Change text color to red */
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
        <div class="result-heading">Original Number:</div>
        <div class="result-box">
            <h1>
                @php
                    if ($originalNumber) {
                        $numberArray = str_split($originalNumber);
                        $numberArray[$position] = '<span class="underline red-text">' . $numberArray[$position] . '</span>';
                        echo implode('', $numberArray);
                    } else {
                        // Fetch and display the latest data from the database
                        $latestData = PreviousData::latest('created_at')->first();
                        $numberArray = str_split($latestData->original_number);
                        $numberArray[$latestData->position] = '<span class="underline red-text">' . $numberArray[$latestData->position] . '</span>';
                        echo implode('', $numberArray);
                    }
                @endphp
            </h1>
        </div>

        <div class="result-heading">Calculation:</div>
        <div class="result-box">
            <h1>
                @if($originalNumber)
                    @if($isAddition)
                        {{ $originalNumber[$position] }} + {{ $alterationValue }}
                    @else
                        {{ $originalNumber[$position] }} - {{ abs($alterationValue) }}
                    @endif
                    = {{ $newNumber }}
                @else
                    @php
                        // Fetch and display the latest data from the database
                        $latestData = PreviousData::latest('created_at')->first();
                        $isAddition = $latestData->alteration_value > 0;
                        $alterationValue = abs($latestData->alteration_value);
                        echo $latestData->original_number[$latestData->position];
                        echo $isAddition ? ' + ' : ' - ';
                        echo $alterationValue;
                        echo ' = ' . $latestData->altered_number;
                    @endphp
                @endif
            </h1>
        </div>

        <div class="result-heading">New Number:</div>
        <div class="result-box">
            <h1>{{ $newNumber }}</h1>
        </div>

        <div class="container">
            <form method="POST" action="{{ route('calculate') }}" onsubmit="return prepareFormForRedo();">
                @csrf
                <input type="hidden" id="redo_number" name="number" value="{{ $originalNumber }}">
                <button type="submit" class="btn btn-primary btn-block" style="margin-top: 10px;">Redo with Same Number</button>
            </form>
        </div>

        <div class="container">
            <form action="{{ route('calculate') }}" method="POST" onsubmit="return validateNumber();">
                @csrf
                <div class="form-group">
                    <label>Enter Another 4-Digit Number</label>
                    <input type="text" id="entered_number" name="entered_number" class="form-control" required readonly>
                </div>
                <input type="hidden" id="hidden_number" name="number" value="">
                <div class="numpad-container">
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
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block" style="margin-top: 10px;">Calculate</button>
            </form>
        </div>
        
        <div class="fixed-button">
            <div id="bottom-button-container">
                <a href="{{ route('previous_data') }}" class="btn btn-primary">View Previous Data</a>
            </div>
        </div>
    </div>
    <script>
        let enteredNumber = '';
    
        function appendNumber(number) {
            if (enteredNumber.length < 4) {
                enteredNumber += number;
                document.getElementById('entered_number').value = enteredNumber;
                document.getElementById('hidden_number').value = enteredNumber; // Store in the hidden input
                updateEnteredDigits();
            }
        }
    
        function clearDisplay() {
            enteredNumber = '';
            document.getElementById('entered_number').value = enteredNumber;
            document.getElementById('hidden_number').value = enteredNumber; // Clear hidden input
            updateEnteredDigits();
        }
    
        function updateEnteredDigits() {
            // No need for this, as the digits are shown in the input field
        }
    
        // Submit the form when the "Calculate" button is clicked
        document.querySelector('.btn-primary').addEventListener('click', function (e) {
            e.preventDefault(); // Prevent the default form submission
            document.forms[0].submit(); // Submit the form
        });

        document.querySelector('.btn-primary').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // If validation passes, submit the form
        document.forms[0].submit();
    });

     // JavaScript function to validate the entered number
     function validateNumber() {
        var enteredNumber = document.getElementById('hidden_number').value;
        if (enteredNumber.length !== 4) {
            // Check if the form is being submitted by the "Redo with Same Number" button
            if (document.activeElement && document.activeElement.name === "redo_same_number") {
                // If the "Redo with Same Number" button was clicked, allow the submission
                return true;
            }

            alert('Please enter a 4-digit number.');
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }

    function prepareFormForRedo() {
        var originalNumber = "{{ $originalNumber }}";
        document.getElementById('redo_number').value = originalNumber;

        // Check if the hidden input field is empty
        var enteredNumber = document.getElementById('hidden_number').value;
        if (enteredNumber.length === 0) {
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }

    </script>
</body>
</html>
