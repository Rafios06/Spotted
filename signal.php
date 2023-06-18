<?php

require("checkconnect.php");
require("configsql.php");
require("getlists.php");
require("getreceiver.php");

// Récupérer les informations du signal à afficher (par exemple à partir d'une base de données)
$signalId = $_GET['id']; // Supposons que l'ID du signal est passé dans l'URL comme paramètre 'id'

// Check if not empty
if ("" == trim($signalId)) {
    // Goto to index.php with Error
    header("Location: index.php");
    exit();
}

// Get signal details from ID
function getSignalDetails($userId, $signalId)
{
    require("checkconnect.php");
    require("configsql.php");

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    if ($stmt = $mysqli->prepare("SELECT Signal_Owner_ID, Signal_Sample_Link, Signal_Description, Signal_AutoReport FROM `signal` WHERE Signal_ID = ?")) {
        $stmt->bind_param("s", $signalId);
        $stmt->execute();
        $stmt->bind_result($Signal_Owner_ID, $Signal_Sample_Link, $Signal_Description, $Signal_AutoReport);

        if ($stmt->fetch()) {
            if ($Signal_Owner_ID === intval($userId) || $Signal_Owner_ID === -1) {
                $obj_Signal_AutoReport = json_decode($Signal_AutoReport);

                // Get receiver details
                $receiverID = $obj_Signal_AutoReport->{'rcv'};
                $detailsReceiver = getReceiverDetails($userId, $receiverID);
                $infoReceiver = '<a href="receiver.php?id='.$receiverID.'">'.$detailsReceiver['title'] . ' (' . $detailsReceiver['location'] . ' | ' . $detailsReceiver['device'] . ' | ' . $detailsReceiver['antenna'] . ')'.'</a>';
                
                return array(
                    'frequency' => $obj_Signal_AutoReport->{'fq'},
                    'time' => $obj_Signal_AutoReport->{'time'},
                    'receiver' => $infoReceiver,
                    'sn' => $obj_Signal_AutoReport->{'sn'},
                    'comment' =>$Signal_Description,
                    'link' => $Signal_Sample_Link
                );
            }
        }
    }

    $stmt->close();

    return array(
        'frequency' => 'N/A',
        'time' => 'N/A',
        'receiver' => 'N/A',
        'sn' => 'N/A',
        'comment' => 'N/A',
        'link' => 'N/A'
    );
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
                <div>
                    <strong>Comment:</strong>
                    <div id="comment-preview" style="margin: 0.2em; margin-bottom: 1em;"><?php echo $signalDetails['comment']; ?></div>
                </div>
            </div>
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