<?php

require("checkconnect.php");
require("configsql.php");
require("getlists.php");
require("getreceiver.php");

// Récupérer les informations du receiver à afficher (par exemple à partir d'une base de données)
$receiverId = $_GET['id']; // Supposons que l'ID du receiver est passé dans l'URL comme paramètre 'id'

// Check if not empty
if ("" == trim($receiverId)) {
    // Goto to index.php with Error
    header("Location: index.php");
    exit();
}

$userId = $_SESSION['login'];
$receiverDetails = getReceiverDetails($_SESSION['login'], $receiverId);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Receiver Details</title>
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
            <h1 class="title is-4">Receiver Details</h1>
            <hr>
            <div class="content">
                <p><strong>Title:</strong> <?= $receiverDetails['title'] ?></p>
                <p><strong>Location:</strong> <?= $receiverDetails['location'] ?></p>
                <p><strong>Device:</strong> <?= $receiverDetails['device'] ?></p>
                <p><strong>Antenna:</strong> <?= $receiverDetails['antenna'] ?></p>

                <?php
                    if ($receiverDetails['owner'] === intval($userId)) {
                        echo '<form action="addreceiver.php?id='.$receiverId.'"><input type="submit" value="Edit" /></form>';
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>