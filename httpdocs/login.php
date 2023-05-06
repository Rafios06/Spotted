<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Login</title>
</head>

<body>

    <form action="authenticator.php" method="POST">
        <div>
            <label for="uusername">Username</label>
            <input type="text" name="uusername" id="uusername" required>
        </div>

        <div>
            <label for="upassword">Password</label>
            <input type="password" name="upassword" id="upassword" required>
        </div>
        <input type="submit" value="Login">
    </form>

</body>

</html>