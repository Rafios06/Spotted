<?php

// Get receiver details from ID
function getReceiverDetails($userId, $receiverId)
{
    require("checkconnect.php");
    require("configsql.php");

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    if ($stmt = $mysqli->prepare("SELECT Receiver_ID, Receiver_Owner_ID, Receiver_Title, Receiver_Location, Receiver_Device, Receiver_Antenna, Receiver_Private FROM `receiver` WHERE Receiver_ID = ?")) {
        $stmt->bind_param("s", $receiverId);
        $stmt->execute();
        $stmt->bind_result($Receiver_ID, $Receiver_Owner_ID, $Receiver_Title, $Receiver_Location, $Receiver_Device, $Receiver_Antenna, $Receiver_Private);

        if ($stmt->fetch()) {
            if ($Receiver_Owner_ID === intval($userId) || getTypeFromUserID($userId) === 1 || $Receiver_Private === 0) {

                return array(
                    'owner' => $Receiver_Owner_ID,
                    'title' => $Receiver_Title,
                    'location' => $Receiver_Location,
                    'device' => $Receiver_Device,
                    'antenna' => $Receiver_Antenna,
                    'private' => $Receiver_Private
                );
            }
        }
    }

    $stmt->close();

    return array(
        'owner' => 'unknown',
        'title' => 'unknown',
        'location' => 'unknown',
        'device' => 'unknown',
        'antenna' => 'unknown',
        'private' => '1',
    );
}

?>
