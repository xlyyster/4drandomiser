<!DOCTYPE html>
<html>
<head>
    <title>Math App Result</title>
    <style>
        .underline {
            text-decoration: underline;
        }
        .error {
        color: red;
        }
    </style>
</head>
<body>
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
        
        {{-- @if ($errors->has('number'))
            <span class="error">{{ $errors->first('number') }}</span>
        @endif --}}
    </form>
    <form method="POST" action="/calculate">
        @csrf
        <input type="hidden" name="number" value="{{ $originalNumber }}">
        <button type="submit">Redo with the Same Number</button>
    </form>

<!-- Display previous data on the submit page -->
@if ($previousData)
    <h3>Previous Data:</h3>
    <ul>
        @foreach($previousData as $data)
            <li>{{ $data->original_number }} => {{ $data->altered_number }}</li>
        @endforeach
    </ul>
@endif

</body>
</html>
