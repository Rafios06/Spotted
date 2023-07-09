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
                <button class="button is-danger" style="margin: 0.5em;">Confirm</a>
            </form>
        </footer>
    </div>

    <script>
        $(document).ready(function() {
            $(".navbar-burger").click(function() {
                $(".navbar-burger").toggleClass("is-active");
                $(".navbar-menu").toggleClass("is-active");
            });
        });
    </script>

</body>

</html>