<?php

require("checkconnect.php");
require("configsql.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Add signal</title>
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
        <div class="card-content has-text-centered">
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

        </div>
    </div>

</body>

</html>