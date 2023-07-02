<?php

function getLastSignalsAddeds($userID, $limit)
{
    require("checkconnect.php");
    require("configsql.php");

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
                    echo '<div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            ' . $Signal_ID . '
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            Lorem ipsum leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras mattis consectetur purus sit amet fermentum.
                        </div>
                    </div>
                </div>
                <br>';
                }
            } while ($row = $stmt->fetch());
        } else {
            // If there are no results, display "Create new receiver"
            echo "N/A";
        }

        $stmt->close();
    } else {
        // If there's an error with the query, display "Create new receiver"
        echo 'N/A';
    }

    return '';
}


?>