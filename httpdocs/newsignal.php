<?php

require("checkconnect.php");
require("configsql.php");
require("getlists.php");

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
        <div class="card-content">
            <form action="addsignal.php" method="POST">

                <label class="label" for="sfrequency">Frequency</label>
                <div class="field has-addons">
                    <p class="control">
                        <input class="input" type="text" placeholder="Frequency" name="sfrequency" id="sfrequency" required>
                    </p>
                    <p class="control">
                        <span class="select">
                            <select name="sfrequencyunit" id="sfrequencyunit">
                                <option value="GHz">GHz</option>
                                <option value="MHz" selected>MHz</option>
                                <option value="kHz">kHz</option>
                                <option value="Hz">Hz</option>
                            </select>
                        </span>
                    </p>
                </div>

                <div>
                    <label class="label" for="stime">Time (UTC)</label>
                    <input class="input" type="datetime-local" name="stime" id="stime" value="<?= date('Y-m-d H:i') ?>" required>
                </div>

                <label class="label" for="sreceiver" style="margin-top: 0.5em;">Receiver</label>
                <div class="field has-addons">
                    <p class="control">
                        <?php generateSelectReceivers(); ?>
                        <span class="select">
                            <select name="sreceiver" id="sreceiver">
                                <option value="----" selected>Create new receiver</option>
                                <option value="MHz">Home (SDRPLAY)</option>
                                <option value="kHz">WEBSDR - University</option>
                            </select>
                        </span>
                    </p>
                    <p class="control">
                        <button class="button">Create</button>
                    </p>
                </div>

                <div>
                    <label class="label" for="snoise">S/N</label>
                    <input class="input" type="text" name="snoise" id="snoise" required>
                </div>

                <div>
                    <label class="label" for="scomment">Comment</label>
                    <input class="input" type="text" name="scomment" id="scomment" required>
                </div>

                <div>
                    <label class="label" for="slink">Link sample</label>
                    <input class="input" type="text" name="slink" id="slink" required>
                </div>

                <div>
                    <label class="label" for="sprivate">Private</label>
                    <input type="checkbox" name="sprivate" id="sprivate">
                </div>

                <input type="submit" value="Add">
            </form>

        </div>
    </div>

</body>

</html>