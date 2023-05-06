<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - New signal</title>
</head>

<body>

    <form action="addsignal.php" method="POST">
        <div>
            <label for="sfrequency">Frequency</label>
            <input type="text" name="sfrequency" id="sfrequency" required>
            <select name="sfrequencyunit" id="sfrequencyunit">
                <option value="GHz">GHz</option>
                <option value="MHz" selected>MHz</option>
                <option value="kHz">kHz</option>
                <option value="Hz">Hz</option>
            </select>

        </div>

        <div>
            <label for="stime">Time (UTC)</label>
            <input type="text" name="stime" id="stime" required>
        </div>

        <div>
            <label for="sreceiver">Receiver</label>
            <input type="text" name="sreceiver" id="sreceiver" required>
        </div>

        <div>
            <label for="snoise">S/N</label>
            <input type="text" name="snoise" id="snoise" required>
        </div>

        <div>
            <label for="scomment">Comment</label>
            <input type="text" name="scomment" id="scomment" required>
        </div>

        <div>
            <label for="slink">Link sample</label>
            <input type="text" name="slink" id="slink" required>
        </div>

        <div>
            <label for="sprivate">Private</label>
            <input type="checkbox" name="sprivate" id="sprivate">
        </div>

        <input type="submit" value="Add">
    </form>

</body>

</html>