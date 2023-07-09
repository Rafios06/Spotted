<?php

require("checkconnect.php");
require("configsql.php");
require("getlists.php");
require("getreceiver.php");
require("getuser.php");

$userId = $_SESSION['login'];
$receiverId = "";

$editorMode = false;

if (!empty($_GET['id'])) {
    $receiverId = $_GET['id']; // Supposons que l'ID du receiver est passé dans l'URL comme paramètre 'id'
    $receiverDetails = getReceiverDetails($userId, $receiverId);

    if ($receiverDetails['owner'] == intval($userId) || getTypeFromUserID($userId) === 1) {
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        .navbar-item .field:not(.is-expanded):hover {
            width: 18rem;
        }
    </style>
</head>

<body>

    <nav class="navbar is-light has-shadow" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
                <img src="res/svg/icon.svg" width="28" height="28" alt="Spotted">
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="mysignals.php">
                    My signals
                </a>
                <a class="navbar-item" href="receiver.php">
                    My receivers
                </a>
                <a class="navbar-item" href="account.php">
                    Account
                </a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <form action="search.php" method="GET">
                        <div class="field has-addons">
                            <div class="control">
                                <input class="input is-rounded" type="text" placeholder="Search" id="s" name="s">
                            </div>
                            <div class="control">
                                <button class="button is-info">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="navbar-item">
                    <a class="button is-danger" href="logout.php">
                        <span class="icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        <span>Log out</span>
                    </a>
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

                <div style="margin-top: 0.5em; margin-bottom: 0.5em;">
                    <label class="checkbox">
                        <input type="checkbox" name="rprivate" id="rprivate" <?php if ($editorMode && $receiverDetails['private'] === 1) {
                                                                                    echo " checked";
                                                                                } ?>>
                        Private
                    </label>
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

    $(document).ready(function() {
        $(".navbar-burger").click(function() {
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");
        });
    });
</script>

</html>