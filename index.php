<!DOCTYPE html>
<html>
<head>
    <title> login </title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="login">
    <h3>-=LOGIN=-</h3>

    <form action="authenticate.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="You Are" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Prove It" required>

        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>
