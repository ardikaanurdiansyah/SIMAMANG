<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login SIMAMANG</h2>

<form method="POST" action="/login">
    @csrf

    <input type="email" name="email">

    <br><br>

    <input type="password" name="password">

    <br><br>

    <button type="submit">Login</button>

</form>

</body>
</html>