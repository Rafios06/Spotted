<?php

require("checkconnect.php");
require("configsql.php");
require("getlists.php");
require("getuser.php");
require("getsignal.php");
require("getreceiver.php");
require("showPlayerVideo.php");

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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/12.1.0/markdown-it.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        .comment-preview-container {
            margin-top: 1em;
            padding: 1em;
            border: 1px solid #dbdbdb;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        .comment-preview-container h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5em;
        }

        .comment-preview-container p {
            margin-bottom: 0.5em;
        }

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
            <h1 class="title is-4">Signal Details</h1>
            <hr>
            <div class="content">
                <p><strong>Frequency:</strong> <?= $signalDetails['frequency'] ?></p>
                <p><strong>Time:</strong> <?= $signalDetails['time'] ?></p>
                <p><strong>Receiver:</strong> <?= $signalDetails['receiver'] ?></p>
                <p><strong>S/N:</strong> <?= $signalDetails['sn'] ?></p>
                <p><strong>Owner:</strong> <?= getUsernameFromUserID($signalDetails['owner']) ?></p>
                <p>
                    <?php if($signalDetails['link'] != "unknown"){echo '<strong>Link:</strong> <a href="'. $signalDetails['link'] .'" target="_blank">'. $signalDetails['link'] .'</a>';}?>
                </p>
                <p>
                    <?php echo generateVideoEmbedCode($signalDetails['link']); ?>
                    </iframe>
                </p>
                <div class="comment-preview-container">
                    <div id="comment-preview"><?php echo $signalDetails['comment']; ?></div>
                </div>
            </div>

            <?php
            if ($signalDetails['owner'] === intval($_SESSION['login']) || getTypeFromUserID($_SESSION['login']) === 1) {
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
            var commentPreviewContainer = document.getElementById('comment-preview');
            if (commentPreviewContainer) {
                commentPreviewContainer.innerHTML = mdp.render(commentPreviewContainer.innerHTML);
            }
        }

        $(document).ready(function() {
            render(); //render data as MarkDown
        });

        $(document).ready(function() {
            $(".navbar-burger").click(function() {
                $(".navbar-burger").toggleClass("is-active");
                $(".navbar-menu").toggleClass("is-active");
            });
        });
    </script>

</body>

</html>
