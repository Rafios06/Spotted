<?php

require("checkconnect.php");
require("configsql.php");
require("getuser.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Account</title>
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
        <header class="card-header">
            <p class="card-header-title">
                Account
            </p>
        </header>
        <div class="card-content">
            <div class="content">
                Username: <?php echo getUsernameFromUserID($_SESSION['login']); ?><br>
                Email: <?php echo getEmailFromUserID($_SESSION['login']); ?><br>
                Last connection: <?php echo getLastSeenFromUserID($_SESSION['login']); ?><br><br>

                <div class="content is-small">
                    ID: <?php echo $_SESSION['login'] . "/" . getTypeFromUserID($_SESSION['login']); ?><br>
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <a href="editaccount.php" class="card-footer-item">Edit account</a>
            <a href="deleteaccount.php" class="card-footer-item">Delete account</a>
        </footer>
    </div>

</body>

</html>