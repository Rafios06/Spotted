<?php

function generateSelectReceivers()
{
    require("checkconnect.php");
    require("configsql.php");

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    if ($stmt = $mysqli->prepare("SELECT * FROM receiver WHERE Receiver_Owner_ID = '-1' OR Receiver_Owner_ID = '" . $_SESSION['login'] . "'")) {
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // If there are results, display them
            do {
                $stmt->bind_result($id_receiver, $id_owner, $title_receiver, $location_receiver, $device_receiver, $antenna_receiver);
                if ($id_receiver !== null) {
                    echo '<option value="'.$id_receiver.'">'.$title_receiver.'</option>';
                }
            } while ($row = $stmt->fetch());
        } else {
            // If there are no results, display "Create new receiver"
            echo '<option value="----" selected>Create new receiver</option>';
        }

        $stmt->close();
    } else {
        // If there's an error with the query, display "Create new receiver"
        echo '<option value="----" selected>Create new receiver</option>';
    }

    return '';
}


?>