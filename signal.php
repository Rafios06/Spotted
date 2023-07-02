<?php

require("checkconnect.php");
require("configsql.php");
require("getlists.php");
require("getuser.php");
require("getsignal.php");
require("getreceiver.php");

// Récupérer les informations du signal à afficher (par exemple à partir d'une base de données)
$signalId = $_GET['id']; // Supposons que l'ID du signal est passé dans l'URL comme paramètre 'id'

// Check if not empty
if ("" == trim($signalId)) {
    // Goto to index.php with Error
    header("Location: index.php");
    exit();
}

$signalDetails = getSignalDetails($_SESSION['login'], $signalId);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Signal Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/markdown-it@13.0.1/dist/markdown-it.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            <h1 class="title is-4">Signal Details</h1>
            <hr>
            <div class="content">
                <p><strong>Frequency:</strong> <?= $signalDetails['frequency'] ?></p>
                <p><strong>Time:</strong> <?= $signalDetails['time'] ?></p>
                <p><strong>Receiver:</strong> <?= $signalDetails['receiver'] ?></p>
                <p><strong>S/N:</strong> <?= $signalDetails['sn'] ?></p>
                <p><strong>Link:</strong> <a href="<?= $signalDetails['link'] ?>" target="_blank"><?= $signalDetails['link'] ?></a></p>
                <p><strong>Owner:</strong> <?= getUsernameFromUserID($signalDetails['owner']) ?></p>
                <div>
                    <strong>Comment:</strong>
                    <div id="comment-preview" style="margin: 0.2em; margin-bottom: 1em;"><?php echo $signalDetails['comment']; ?></div>
                </div>
            </div>

            <?php
            if ($signalDetails['owner'] === intval($_SESSION['login'])) {
                echo '<footer class="card-footer"><form action="newsignal.php" method="get" class="card-footer-item"><input class="button" type="submit" value="Edit" /><input type="hidden" id="id" name="id" value="' . $signalId . '" /></form>';
                echo '<form action="delsignal.php" method="get" class="card-footer-item"><input class="button is-danger is-light" type="submit" value="Delete" /><input type="hidden" id="id" name="id" value="' . $signalId . '" /></form></footer>';

            }
            ?>

        </div>
    </div>

    <script type="text/javascript">
        var mdp = window.markdownit({
            breaks: true,
            typographer: true
        });

        function render() {
            $("#comment-preview").html(mdp.render($("#comment-preview").html()));
        }

        $(document).ready(function() {
            render(); //render data as MarkDown
        });
    </script>

</body>

</html>