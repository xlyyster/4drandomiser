<!DOCTYPE html>
<html>
<head>
    <title>4D Randomizer</title>
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
        #bottom-button-container {
            position: fixed;
            bottom: 20px; /* Adjust this value to control the distance from the bottom */
            right: 20px; /* You can also adjust this value for horizontal positioning */
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="{{ route('calculate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Enter your 4-Digit Number</label>
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

        // Validate the entered number
        let enteredNumber = document.getElementById('hidden_number').value;
        if (enteredNumber.length !== 4 || isNaN(enteredNumber)) {
            alert('Please enter a 4-digit numeric number.');
            return; // Prevent form submission on validation failure
        }

        // If validation passes, submit the form
        document.forms[0].submit();
    });

    </script>
</body>
</html>
