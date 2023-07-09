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
        return "unknown";
    }

    $stmt->close();
    return 'unknown';
}

// Get ID from usermane
function getUserIDFromUsername($username)
{
    require("checkconnect.php");
    require("configsql.php");

    // Open a connection to a MySQL Server
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    if ($stmt = $mysqli->prepare("SELECT User_ID FROM user WHERE User_Username = ?")) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userID);
            $stmt->fetch();
            return $userID;
        }
    }

    $stmt->close();
    return 0;
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
            } while ($row = $stmt->fetch());
        } else {
            return "unknown";
        }

        $stmt->close();
        return '';
    }
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
        return "unknown";
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
        return "unknown";
    }

    $stmt->close();
    return '';
}
