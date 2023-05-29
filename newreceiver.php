<?php

require("checkconnect.php");
require("configsql.php");
require("getlists.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Add receiver</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    </style>
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
            <form action="addreceiver.php" method="POST">
                <div>
                    <label class="label" for="rtitle">Title</label>
                    <input class="input" type="text" name="rtitle" id="rtitle" required>
                </div>

                <div>
                    <label class="label" for="rlocation">Location</label>
                    <input class="input" type="text" name="rlocation" id="rlocation" required>
                </div>

                <div>
                    <label class="label" for="rdevice">Device</label>
                    <input class="input" type="text" name="rdevice" id="rdevice" required>
                </div>

                <div>
                    <label class="label" for="rantenna">Antenna</label>
                    <input class="input" type="text" name="rantenna" id="rantenna" required>
                </div>

                <input style="margin-top: 1em;" class="button" type="submit" value="Add">
            </form>

        </div>
    </div>

</body>

</html>