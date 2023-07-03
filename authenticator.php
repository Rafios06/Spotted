<?php

require("configsql.php");

// Start session
session_start();
session_regenerate_id();

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

// Check if already connected
if (isset($_SESSION["login"]) && !empty($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}

// Get username, password and email from POST
$username = $_POST["uusername"];
$password = $_POST["upassword"];

// Check if not empty
if ("" == trim($username) || "" == trim($password)) {
    // Goto to login.php with Error
    header("Location: login.php?e=1");
    exit();
}

// Compare password hash
$result = $mysqli->query("SELECT User_ID, User_Password FROM user WHERE User_Username = '" . $username . "'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userid = $row["User_ID"];
    $hash = $row["User_Password"];

    if (password_verify($password, $hash)) {
        echo 'Password is valid!';

        // Creation SESSION
        $_SESSION['login'] = strval($userid);

        // Update LastSeen
        date_default_timezone_set('UTC');
        $time = date("Y-m-d H:i:s") . " UTC";
        $stmt = $mysqli->query("UPDATE user SET User_LastSeen='" . $time . "' WHERE User_Username='" . $username . "'");

        // Goto to index.php
        header("Location: index.php");
        exit();
    } else {
        echo 'Invalid password.';
    }
}

// Goto to login.php with Error (user not found)
header("Location: login.php?e=1");
die();
