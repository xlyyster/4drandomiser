<!DOCTYPE html>
<html>
<head>
    <title>Math App</title>
</head>
<body>
    <form action="/calculate" method="POST">
        @csrf
        <label for="number">Enter a 4-digit number:</label>
        <input type="number" name="number" required>
        <button type="submit">Calculate</button>
    </form>
</body>
</html>