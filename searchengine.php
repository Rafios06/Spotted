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
                        <a href="signal.php?id=' . $Signal_ID . '">' . $infoSignal['title'] . '</a><a href=search.php?s=' . urlencode($infoSignal['frequency']) .'><span class="tag" style="margin-left: 1em;">' . $infoSignal['frequency'] . '</span></a>' . '<a href=search.php?s=' . urlencode($infoSignal['time']) .'><span class="tag" style="margin-left: 1em;">' . $infoSignal['time'] . '</span></a>' . '<a href=search.php?s=' . urlencode(getUsernameFromUserID($infoSignal['owner'])) . '><span class="tag" style="margin-left: 1em;">' . getUsernameFromUserID($infoSignal['owner']) . '</span></a> 
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

    $startPage = max(1, $currentPage - 3);
    $endPage = min($totalPages, $currentPage + 3);

    echo '<div class="has-text-centered is-centered">';
    echo '<nav class="pagination is-rounded" role="navigation" aria-label="pagination">';
    echo '<ul class="pagination-list">';

    // Bouton "Précédent"
    if ($currentPage > 1) {
        echo '<li><a class="pagination-link" href="mysignals.php?page=' . ($currentPage - 1) . '">Back</a></li>';
    } else {
        echo '<li><a class="pagination-link" disabled>Back</a></li>';
    }

    // Affichage des numéros de page
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $currentPage) {
            echo '<li><a class="pagination-link is-current" aria-current="page">' . $i . '</a></li>';
        } else {
            echo '<li><a class="pagination-link" href="mysignals.php?page=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Bouton "Suivant"
    if ($currentPage < $totalPages) {
        echo '<li><a class="pagination-link" href="mysignals.php?page=' . ($currentPage + 1) . '">Next</a></li>';
    } else {
        echo '<li><a class="pagination-link" disabled>Next</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
    echo '</div>';

    return '';
}

function getReceiverByUser($userID, $perPage, $currentPage)
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

    if ($stmt = $mysqli->prepare("SELECT Receiver_ID FROM `receiver` WHERE Receiver_Owner_ID = ? ORDER BY Receiver_ID DESC LIMIT ?, ?")) {
        $stmt->bind_param("iii", $userID, $offset, $perPage);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // If there are results, display them
            $stmt->bind_result($Receiver_ID);
            while ($stmt->fetch()) {
                $infoReceiver = getReceiverDetails($userID, $Receiver_ID);

                echo '<div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                        <a href="receiver.php?id=' . $Receiver_ID . '">' . $infoReceiver['title'] .'</a>
                        <a class="button is-primary navbar-end is-small" href="newreceiver.php?id=' . $Receiver_ID . '">Edit</a>
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            Location : '.$infoReceiver['location'].'<br>
                            Device : '.$infoReceiver['device'].'<br>
                            Antenna : '.$infoReceiver['antenna'].'
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
    $totalReceivers = getTotalUserSignal($userID);
    $totalPages = ceil($totalReceivers / $perPage);

    $startPage = max(1, $currentPage - 3);
    $endPage = min($totalPages, $currentPage + 3);

    echo '<div class="has-text-centered is-centered">';
    echo '<nav class="pagination is-rounded" role="navigation" aria-label="pagination">';
    echo '<ul class="pagination-list">';

    // Bouton "Précédent"
    if ($currentPage > 1) {
        echo '<li><a class="pagination-link" href="myreceivers.php?page=' . ($currentPage - 1) . '">Back</a></li>';
    } else {
        echo '<li><a class="pagination-link" disabled>Back</a></li>';
    }

    // Affichage des numéros de page
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $currentPage) {
            echo '<li><a class="pagination-link is-current" aria-current="page">' . $i . '</a></li>';
        } else {
            echo '<li><a class="pagination-link" href="myreceivers.php?page=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Bouton "Suivant"
    if ($currentPage < $totalPages) {
        echo '<li><a class="pagination-link" href="myreceivers.php?page=' . ($currentPage + 1) . '">Next</a></li>';
    } else {
        echo '<li><a class="pagination-link" disabled>Next</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
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

                if ($infoSignal['private'] != "unknown") {
                    echo '<div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                        <a href="signal.php?id=' . $Signal_ID . '">' . $infoSignal['title'] . '</a><a href=search.php?s=' . urlencode($infoSignal['frequency']) .'><span class="tag" style="margin-left: 1em;">' . $infoSignal['frequency'] . '</span></a>' . '<a href=search.php?s=' . urlencode($infoSignal['time']) .'><span class="tag" style="margin-left: 1em;">' . $infoSignal['time'] . '</span></a>' . '<a href=search.php?s=' . urlencode(getUsernameFromUserID($infoSignal['owner'])) . '><span class="tag" style="margin-left: 1em;">' . getUsernameFromUserID($infoSignal['owner']) . '</span></a> 
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
    
    $startPage = max(1, $currentPage - 3);
    $endPage = min($totalPages, $currentPage + 3);

    echo '<div class="has-text-centered is-centered">';
    echo '<nav class="pagination is-rounded" role="navigation" aria-label="pagination">';
    echo '<ul class="pagination-list">';

    // Bouton "Précédent"
    if ($currentPage > 1) {
        echo '<li><a class="pagination-link" href="index.php?page=' . ($currentPage - 1) . '">Back</a></li>';
    } else {
        echo '<li><a class="pagination-link" disabled>Back</a></li>';
    }

    // Affichage des numéros de page
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $currentPage) {
            echo '<li><a class="pagination-link is-current" aria-current="page">' . $i . '</a></li>';
        } else {
            echo '<li><a class="pagination-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Bouton "Suivant"
    if ($currentPage < $totalPages) {
        echo '<li><a class="pagination-link" href="index.php?page=' . ($currentPage + 1) . '">Next</a></li>';
    } else {
        echo '<li><a class="pagination-link" disabled>Next</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
    echo '</div>';

    return '';
}

function getSignalByKeyword($userID, $limit, $currentPage, $keyword = '')
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

    // Préparer la requête en fonction de la présence ou non d'un mot-clé
    if (!empty($keyword)) {
        $keywordComment = "%".$keyword."%";
        $stmt = $mysqli->prepare("SELECT Signal_ID FROM `signal` WHERE Signal_Owner_ID LIKE ? OR Signal_Description LIKE ? OR Signal_AutoReport LIKE ? ORDER BY Signal_ID DESC LIMIT ?, ?");
        $stmt->bind_param("sssii", getUserIDFromUsername($keyword), $keywordComment, $keywordComment, $offset, $limit);
    } else {
        $stmt = $mysqli->prepare("SELECT Signal_ID FROM `signal` ORDER BY Signal_ID DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $offset, $limit);
    }

    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // If there are results, display them
        $stmt->bind_result($Signal_ID);

        while ($stmt->fetch()) {
            $infoSignal = getSignalDetails($userID, $Signal_ID);

            if ($infoSignal['private'] != "unknown") {
                echo '<div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                    <a href="signal.php?id=' . $Signal_ID . '">' . $infoSignal['title'] . '</a><a href=search.php?s=' . urlencode($infoSignal['frequency']) .'><span class="tag" style="margin-left: 1em;">' . $infoSignal['frequency'] . '</span></a>' . '<a href=search.php?s=' . urlencode($infoSignal['time']) .'><span class="tag" style="margin-left: 1em;">' . $infoSignal['time'] . '</span></a>' . '<a href=search.php?s=' . urlencode(getUsernameFromUserID($infoSignal['owner'])) . '><span class="tag" style="margin-left: 1em;">' . getUsernameFromUserID($infoSignal['owner']) . '</span></a> 
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

    // Afficher les liens de pagination
    $totalSignals = getTotalSignal();
    $totalPages = ceil($totalSignals / $limit);

    $startPage = max(1, $currentPage - 3);
    $endPage = min($totalPages, $currentPage + 3);

    echo '<div class="has-text-centered is-centered">';
    echo '<nav class="pagination is-rounded" role="navigation" aria-label="pagination">';
    echo '<ul class="pagination-list">';

    // Bouton "Précédent"
    if ($currentPage > 1) {
        echo '<li><a class="pagination-link" href="search.php?page=' . ($currentPage - 1) . "&s=" . $keyword . '">Back</a></li>';
    } else {
        echo '<li><a class="pagination-link" disabled>Back</a></li>';
    }

    // Affichage des numéros de page
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $currentPage) {
            echo '<li><a class="pagination-link is-current" aria-current="page" href="search.php?page=' . $i . "&s=" . $keyword . '">' . $i . '</a></li>';
        } else {
            echo '<li><a class="pagination-link" href="search.php?page=' . $i . "&s=" . $keyword . '">' . $i .'</a></li>';
        }
    }

    // Bouton "Suivant"
    if ($currentPage < $totalPages) {
        echo '<li><a class="pagination-link" href="search.php?page=' . ($currentPage + 1) . "&s=" . $keyword . '">Next</a></li>';
    } else {
        echo '<li><a class="pagination-link" disabled>Next</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
    echo '</div>';

    return '';
}

function getUsers($userID, $perPage, $currentPage)
{
    require("checkconnect.php");
    require("configsql.php");
    require("getuser.php");

    // Check if admin
    if (getTypeFromUserID($_SESSION["login"]) != 1) {
        header("Location: index.php");
        exit();
    }

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    // Calculer l'offset en fonction du numéro de page
    $offset = (intval($currentPage) - 1) * intval($perPage);

    if ($stmt = $mysqli->prepare("SELECT User_ID FROM `user` ORDER BY User_ID DESC LIMIT ?, ?")) {
        $stmt->bind_param("ii", $offset, $perPage);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // If there are results, display them
            $stmt->bind_result($User_ID);
            while ($stmt->fetch()) {

                echo '<div class="card">
                    <header class="card-header">
                        <p class="card-header-title">'
                        . getUsernameFromUserID($User_ID) . ' (' . $User_ID . ')' .
                        '</p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            ID : '.$User_ID.'<br>
                            Type : '.getTypeFromUserID($User_ID).'<br>
                            Email : '.getEmailFromUserID($User_ID).'<br>
                            Last seen : '.getLastSeenFromUserID($User_ID).'<br>
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
    $totalReceivers = getTotalUserSignal($userID);
    $totalPages = ceil($totalReceivers / $perPage);

    $startPage = max(1, $currentPage - 3);
    $endPage = min($totalPages, $currentPage + 3);

    echo '<div class="has-text-centered is-centered">';
    echo '<nav class="pagination is-rounded" role="navigation" aria-label="pagination">';
    echo '<ul class="pagination-list">';

    // Bouton "Précédent"
    if ($currentPage > 1) {
        echo '<li><a class="pagination-link" href="myreceivers.php?page=' . ($currentPage - 1) . '">Back</a></li>';
    } else {
        echo '<li><a class="pagination-link" disabled>Back</a></li>';
    }

    // Affichage des numéros de page
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $currentPage) {
            echo '<li><a class="pagination-link is-current" aria-current="page">' . $i . '</a></li>';
        } else {
            echo '<li><a class="pagination-link" href="myreceivers.php?page=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Bouton "Suivant"
    if ($currentPage < $totalPages) {
        echo '<li><a class="pagination-link" href="myreceivers.php?page=' . ($currentPage + 1) . '">Next</a></li>';
    } else {
        echo '<li><a class="pagination-link" disabled>Next</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
    echo '</div>';

    return '';
}

// Get type from ID
if (!function_exists('getTypeFromUserID')) {
    function getTypeFromUserID($userID)
    {
        require("checkconnect.php");
        require("configsql.php");

        // Open a connection to a MySQL Server
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

        if ($stmt = $mysqli->prepare("SELECT User_Type FROM user WHERE User_ID = '" . $userID . "'")) {
            $stmt->execute();
            $stmt->store_result();

            do {
                $stmt->bind_result($type);
                if ($type !== null) {
                    return $type;
                }
            } while ($row = $stmt->fetch()
            );
        } else {
            return "unknown";
        }

        $stmt->close();
        return '';
    }
}

?>