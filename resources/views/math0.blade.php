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
        .numpad-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 10px;
        }
        .numpad-button {
            font-size: 24px;
            text-align: center;
            background-color: #555; /* Darker grey button background */
            cursor: pointer;
        }
        .numpad-button:hover {
            background-color: #777; /* Lighter grey button background on hover */
        }
        #number-input {
            display: none; /* Hide the numeric input field initially */
        }
        #number-display {
            font-size: 24px;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="numpad-container">
            <!-- Numpad buttons for digits -->
            <div class="numpad-button" onclick="appendNumber(1)">1</div>
            <div class="numpad-button" onclick="appendNumber(2)">2</div>
            <div class="numpad-button" onclick="appendNumber(3)">3</div>
            <div class="numpad-button" onclick="appendNumber(4)">4</div>
            <div class="numpad-button" onclick="appendNumber(5)">5</div>
            <div class="numpad-button" onclick="appendNumber(6)">6</div>
            <div class="numpad-button" onclick="appendNumber(7)">7</div>
            <div class="numpad-button" onclick="appendNumber(8)">8</div>
            <div class="numpad-button" onclick="appendNumber(9)">9</div>
            <!-- Button to clear input -->
            <div class="numpad-button" onclick="clearInput()">C</div>
        </div>
        <!-- Numeric input field for hidden input -->
        <input id="number-input" type="number" class="form-control" name="number" required>
        <!-- Display the entered number -->
        <div id="number-display">Entered Number: <span id="entered-number"></span></div>
        <button type="submit" class="btn btn-primary">Calculate</button>
    </div>
    <div class="fixed-button">
        <div id="bottom-button-container">
            <a href="{{ route('previous_data') }}" class="btn btn-primary">View Previous Data</a>
        </div>
    </div>

    <script>
        // Initialize the entered number
        let enteredNumber = '';

        // Function to append a digit to the entered number
        function appendNumber(digit) {
            enteredNumber += digit;
            updateDisplay();
        }

        // Function to clear the entered number
        function clearInput() {
            enteredNumber = '';
            updateDisplay();
        }

        // Function to update the display with the entered number
        function updateDisplay() {
            const enteredNumberElement = document.getElementById('entered-number');
            enteredNumberElement.textContent = enteredNumber;

            // Update the hidden input field for form submission
            const numberInput = document.getElementById('number-input');
            numberInput.value = enteredNumber;
        }
    </script>
</body>
</html>
