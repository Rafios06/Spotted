<?php

// Get username from ID
function getUsernameFromUserID($userID)
{
    require("checkconnect.php");
    require("configsql.php");

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    if ($stmt = $mysqli->prepare("SELECT User_Username FROM user WHERE User_ID = '" . $userID . "'")) {
        $stmt->execute();
        $stmt->store_result();

        do {
            $stmt->bind_result($username);
            if ($username !== null) {
                return $username;
            }
        } while ($row = $stmt->fetch());
    } else {
        return "N/A";
    }

    $stmt->close();
    return 'N/A';
}

// Get type from ID
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
        } while ($row = $stmt->fetch());
    } else {
        return "N/A";
    }

    $stmt->close();
    return '';
}

// Get mail from ID
function getEmailFromUserID($userID)
{
    require("checkconnect.php");
    require("configsql.php");

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    if ($stmt = $mysqli->prepare("SELECT User_Email FROM user WHERE User_ID = '" . $userID . "'")) {
        $stmt->execute();
        $stmt->store_result();

        do {
            $stmt->bind_result($email);
            if ($email !== null) {
                return $email;
            }
        } while ($row = $stmt->fetch());
    } else {
        return "N/A";
    }

    $stmt->close();
    return '';
}

// Get Last Seen from ID
function getLastSeenFromUserID($userID)
{
    require("checkconnect.php");
    require("configsql.php");

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    if ($stmt = $mysqli->prepare("SELECT User_LastSeen FROM user WHERE User_ID = '" . $userID . "'")) {
        $stmt->execute();
        $stmt->store_result();

        do {
            $stmt->bind_result($lastseen);
            if ($lastseen !== null) {
                return $lastseen;
            }
        } while ($row = $stmt->fetch());
    } else {
        return "N/A";
    }

    $stmt->close();
    return '';
}

?>