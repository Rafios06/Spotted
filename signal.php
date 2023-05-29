<?php

require("checkconnect.php");
require("configsql.php");
require("getlists.php");

// Récupérer les informations du signal à afficher (par exemple à partir d'une base de données)
$signalId = $_GET['id']; // Supposons que l'ID du signal est passé dans l'URL comme paramètre 'id'

// Fonction factice pour récupérer les détails du signal à partir de la base de données
function getSignalDetails($signalId)
{
    // Vous devez implémenter la logique pour récupérer les détails du signal à partir de la base de données
    // Retournez les détails du signal (par exemple, un tableau associatif contenant les informations)
    // Ici, je retourne un tableau factice pour la démonstration
    return array(
        'frequency' => '100 MHz',
        'time' => '2023-05-29 10:00:00',
        'receiver' => 'Receiver Name',
        'sn' => 'Fair',
        'comment' => '# This is a sample signal.\n\nYou can write **Markdown** here!',
        'link' => 'https://example.com/sample-signal',
        'private' => false
    );
}

$signalDetails = getSignalDetails($signalId);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Signal Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
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
                <div>
                    <strong>Comment:</strong>
                    <div id="comment-preview" style="margin: 0.2em; margin-bottom: 1em;"></div>
                </div>
                <p><strong>Private:</strong> <?= $signalDetails['private'] ? 'Yes' : 'No' ?></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/markdown-it/dist/markdown-it.min.js"></script>
    <script>
        const commentTextarea = `<?= $signalDetails['comment'] ?>`;

        const md = new markdownit();
        const commentPreview = document.getElementById('comment-preview');
        commentPreview.innerHTML = md.render(commentTextarea);

        const easyMDE = new EasyMDE({
            element: document.getElementById('scomment'),
            initialValue: commentTextarea,
            readOnly: true,
            spellChecker: false,
            renderingConfig: {
                singleLineBreaks: false,
                codeSyntaxHighlighting: true,
            }
        });
    </script>

</body>

</html>