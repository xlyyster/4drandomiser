<!DOCTYPE html>
<html>
<head>
    <title>4D Randomiser</title>
</head>
<body>
    <form action="/calculate" method="POST">
        @csrf
        <label for="number">Enter a 4-digit number:</label>
        <input type="number" name="number" required>
        <button type="submit">Calculate</button>
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
