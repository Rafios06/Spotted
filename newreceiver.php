<?php

require("checkconnect.php");
require("configsql.php");
require("getlists.php");
require("getreceiver.php");

$userId = $_SESSION['login'];
$receiverId = "";

$editorMode = false;

if (!empty($_GET['id'])) {
    $receiverId = $_GET['id']; // Supposons que l'ID du receiver est passé dans l'URL comme paramètre 'id'
    $receiverDetails = getReceiverDetails($userId, $receiverId);

    if ($receiverDetails['owner'] == intval($userId)) {
        $editorMode = true;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <?php

    if ($editorMode) {
        echo '<title>Spotted - Edit receiver</title>';
    } else {
        echo '<title>Spotted - Add receiver</title>';
    }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
</head>

<body>

    <nav class="navbar is-light has-shadow">
        <div class="navbar-brand">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link is-arrowless">
                    <img src="res/svg/icon.svg" width="28" height="28" style="margin: 0.5em;">
                </a>

                <div class="navbar-dropdown">
                    <aside class="menu" style="margin: 0.5em;">
                        <ul class="menu-list">
                            <li><a href="index.php">Home</a></li>
                        </ul>
                        <ul class="menu-list">
                            <li><a href="signal.php">Signal</a></li>
                        </ul>
                        <ul class="menu-list">
                            <li><a href="receiver.php">Receiver</a></li>
                        </ul>
                        <ul class="menu-list">
                            <li><a href="account.php">Account</a></li>
                        </ul>
                        <ul class="menu-list">
                            <li><a href="logout.php">Log out</a></li>
                        </ul>
                    </aside>
                </div>

            </div>

            <div id="navMenuColorlight-example" class="navbar-menu">
                <div class="navbar-start">
                    <div class="navbar-item">
                        <input class="input is-rounded" type="text" style="margin: 0.5em;" placeholder="Search">
                    </div>
                </div>
            </div>
    </nav>

    <div class="card" style="margin: 2em;">
        <div class="card-content">

            <form action="<?php if ($editorMode) {
                                echo 'editreceiver.php';
                            } else {
                                echo 'addreceiver.php';
                            } ?>" method="POST">
                <?php if ($editorMode) {
                    echo '<input type="hidden" id="rID" name="rID" value="' . $receiverId . '" />';
                } ?>

                <div>
                    <label class="label" style="margin-top: 0.5em;" for="rtitle">Title</label>
                    <input class="input" type="text" name="rtitle" id="rtitle" value="<?php if ($editorMode) {
                                                                                            echo $receiverDetails['title'];
                                                                                        } ?>" required>
                </div>

                <div>
                    <label class="label" style="margin-top: 0.5em;" for="rlocation">Location</label>
                    <div class="field has-addons">
                        <p class="control">
                            <input class="input" type="text" name="rlocation" id="rlocation" value="<?php if ($editorMode) {
                                                                                                        echo $receiverDetails['location'];
                                                                                                    } ?>" required>
                        </p>
                        <p class="control">
                            <button type="button" class="button" name="checkmap" id="checkmap">Check in map</button>
                        </p>
                    </div>
                </div>

                <div>
                    <label class="label" style="margin-top: 0.5em;" for="rdevice">Device</label>
                    <input class="input" type="text" name="rdevice" id="rdevice" value="<?php if ($editorMode) {
                                                                                            echo $receiverDetails['device'];
                                                                                        } ?>" required>
                </div>

                <div>
                    <label class="label" style="margin-top: 0.5em;" for="rantenna">Antenna</label>
                    <input class="input" type="text" name="rantenna" id="rantenna" value="<?php if ($editorMode) {
                                                                                                echo $receiverDetails['antenna'];
                                                                                            } ?>" required>
                </div>

                <input style="margin-top: 1em;" class="button" type="submit" <?php if ($editorMode) {
                                                                                    echo 'value="Change"';
                                                                                } else {
                                                                                    echo 'value="Add"';
                                                                                } ?>>
            </form>

        </div>
    </div>

</body>

<script>
    document.getElementById('checkmap').onclick = function() {
        const locationreceiver = document.getElementById("rlocation").value;
        const url = 'https://nominatim.openstreetmap.org/?q=' + locationreceiver + '&limit=1';
        const encoded = encodeURI(url);
        window.open(
            encoded,
            '_blank'
        );
    };
</script>

</html>