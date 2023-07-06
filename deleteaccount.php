<?php

require("checkconnect.php");
require("configsql.php");
require("getuser.php");

$userId = $_SESSION['login'];

if (!empty($_POST['bye'])) {
    // delete account

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');
    if ($stmt = $mysqli->prepare("DELETE FROM user WHERE User_ID = '" . $userId . "'")) {
        $stmt->execute();
    }

    $stmt->close();

    // Goto to logout.php
    header("Location: logout.php");
    die();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Delete account</title>
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
                Delete your account ?
            </p>
        </header>
        <div class="card-content">
            <div class="content">
                To delete your account (<?php echo getUsernameFromUserID($_SESSION['login']) . "/" . getEmailFromUserID($_SESSION['login']) ?>), please confirm your decision.<br>
                Please note that once your account has been deleted, all your information associated with the account will be permanently deleted. This action is irreversible.<br>
                To confirm the deletion of your account, please click on "Confirm".<br>
            </div>
        </div>
        <footer class="card-footer columns is-centered">
            <form action="deleteaccount.php" method="POST">
                <input type="hidden" id="bye" name="bye" value="42" />
                <button class="button" style="margin: 0.5em;">Confirm</a>
            </form>
        </footer>
    </div>

</body>

</html>