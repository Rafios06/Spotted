<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Register</title>
</head>

<body>

    <form action="adduser.php" method="POST">
        <div>
            <label for="uusername">Username</label>
            <input type="text" name="uusername" id="uusername" required>
        </div>

        <div>
            <label for="uemail">Email</label>
            <input type="email" name="uemail" id="uemail" required>
        </div>

        <div>
            <label for="upassword">Password</label>
            <input type="password" name="upassword" id="upassword" required>
        </div>
        <input type="submit" value="Subscribe!">
    </form>

</body>

</html>