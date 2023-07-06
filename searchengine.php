<?php

function getSignalByUser($userID, $perPage, $currentPage)
{
    require("checkconnect.php");
    require("configsql.php");
    require("getreceiver.php");
    require("getsignal.php");
    require("getuser.php");

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    // Calculer l'offset en fonction du numéro de page
    $offset = (intval($currentPage) - 1) * intval($perPage);

    if ($stmt = $mysqli->prepare("SELECT Signal_ID FROM `signal` WHERE Signal_Owner_ID = ? ORDER BY Signal_ID DESC LIMIT ?, ?")) {
        $stmt->bind_param("iii", $userID, $offset, $perPage);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // If there are results, display them
            $stmt->bind_result($Signal_ID);
            while ($stmt->fetch()) {
                $infoSignal = getSignalDetails($userID, $Signal_ID);

                echo '<div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                        <a href="signal.php?id='.$Signal_ID.'">' . $infoSignal['title'] . '</a><span class="tag" style="margin-left: 1em;">'.$infoSignal['frequency'].'</span>' . '<span class="tag" style="margin-left: 1em;">'.$infoSignal['time'].'</span>' . '<span class="tag" style="margin-left: 1em;">'.getUsernameFromUserID($infoSignal['owner']).'</span> 
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            '.$infoSignal['lcomment'].'
                        </div>
                    </div>
                </div>
                <br>';
            }
        } else {
            echo "";
        }

        $stmt->close();
    } else {
        echo '';
    }

    // Afficher les liens de pagination
    $totalSignals = getTotalUserSignal($userID);
    $totalPages = ceil($totalSignals / $perPage);

    echo '<div class="pagination">';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="mysignals.php?page=' . $i . '">' . $i . '</a>';
    }
    echo '</div>';

    return '';
}

function getPublicSignal($userID, $limit, $currentPage)
{
    require("checkconnect.php");
    require("configsql.php");
    require("getreceiver.php");
    require("getsignal.php");
    require("getuser.php");

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    // Calculer l'offset en fonction du numéro de page
    $offset = (intval($currentPage) - 1) * intval($limit);

    if ($stmt = $mysqli->prepare("SELECT Signal_ID FROM `signal` ORDER BY Signal_ID DESC LIMIT ?, ?")) {
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // If there are results, display them
            $stmt->bind_result($Signal_ID);

            while ($stmt->fetch()) {
                $infoSignal = getSignalDetails($userID, $Signal_ID);

                if ($infoSignal['private'] != "N/A") {
                    echo '<div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                        <a href="signal.php?id=' . $Signal_ID . '">' . $infoSignal['title'] . '</a><span class="tag" style="margin-left: 1em;">' . $infoSignal['frequency'] . '</span>' . '<span class="tag" style="margin-left: 1em;">' . $infoSignal['time'] . '</span>' . '<span class="tag" style="margin-left: 1em;">' . getUsernameFromUserID($infoSignal['owner']) . '</span> 
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            ' . $infoSignal['lcomment'] . '
                        </div>
                    </div>
                </div>
                <br>';
                }
            }
        } else {
            echo "";
        }

        $stmt->close();
    } else {
        echo '';
    }

    // Afficher les liens de pagination
    $totalSignals = getTotalSignal();
    $totalPages = ceil($totalSignals / $limit);

    echo '<div class="pagination">';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="index.php?page=' . $i . '">' . $i . '</a>';
    }
    echo '</div>';

    return '';
}

?>