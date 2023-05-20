<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - New receiver</title>
</head>

<body>

    <form action="addreceiver.php" method="POST">
        <div>
            <label for="rtitle">Title</label>
            <input type="text" name="rtitle" id="rtitle" required>
        </div>

        <div>
            <label for="rlocation">Location</label>
            <input type="text" name="rlocation" id="rlocation" required>
        </div>

        <div>
            <label for="rdevice">Device</label>
            <input type="text" name="rdevice" id="rdevice" required>
        </div>

        <div>
            <label for="rantenna">Antenna</label>
            <input type="text" name="rantenna" id="rantenna" required>
        </div>

        <input type="submit" value="Add">
    </form>

</body>

</html>