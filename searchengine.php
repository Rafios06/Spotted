<?php

function getLastSignalsAddeds($userID, $limit)
{
    require("checkconnect.php");
    require("configsql.php");
    require("getreceiver.php");
    require("getsignal.php");
    require("getuser.php");

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    if ($stmt = $mysqli->prepare("SELECT Signal_ID FROM `signal` WHERE Signal_Owner_ID = '-1' OR Signal_Owner_ID = '" . $userID . "'")) {
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // If there are results, display them
            do {
                $stmt->bind_result($Signal_ID);
                if ($Signal_ID !== null) {
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
            } while ($row = $stmt->fetch());
        } else {
            echo "";
        }

        $stmt->close();
    } else {
        echo '';
    }

    return '';
}


?>