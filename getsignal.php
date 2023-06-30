<?php

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
            $obj_Signal_AutoReport = json_decode($Signal_AutoReport);

            if ($Signal_Owner_ID === intval($userId) || $obj_Signal_AutoReport->{'prv'} === "0") {

                // Get receiver details
                $receiverID = $obj_Signal_AutoReport->{'rcv'};
                $detailsReceiver = getReceiverDetails($userId, $receiverID);
                $infoReceiver = '<a href="receiver.php?id=' . $receiverID . '">' . $detailsReceiver['title'] . ' (' . $detailsReceiver['location'] . ' | ' . $detailsReceiver['device'] . ' | ' . $detailsReceiver['antenna'] . ')' . '</a>';

                return array(
                    'owner' => $Signal_Owner_ID,
                    'private' => $obj_Signal_AutoReport->{'prv'},
                    'frequency' => $obj_Signal_AutoReport->{'fq'},
                    'time' => $obj_Signal_AutoReport->{'time'},
                    'receiver' => $infoReceiver,
                    'sn' => $obj_Signal_AutoReport->{'sn'},
                    'comment' => base64_decode($Signal_Description),
                    'link' => $Signal_Sample_Link
                );
            }
        }
    }

    $stmt->close();

    return array(
        'owner' => 'N/A',
        'private' => 'N/A',
        'frequency' => 'N/A',
        'time' => 'N/A',
        'receiver' => 'N/A',
        'sn' => 'N/A',
        'comment' => 'N/A',
        'link' => 'N/A'
    );
}
