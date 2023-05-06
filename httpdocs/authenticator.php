<?php

require("configsql.php");

// Check if already connected
session_start();
if (isset($_SESSION["login"])) {
    // Goto to hello.php
    header("Location: hello.php");
    //exit();
}

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

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
$result = $mysqli->query("SELECT User_Password FROM user WHERE User_Username = '" . $username . "'");
if ($result->num_rows > 0) {
    $hash = $result->fetch_assoc()["User_Password"];

    if (password_verify($password, $hash)) {
        echo 'Password is valid!';

        // Creation SESSION
        $_SESSION['login'] = '1';

        // Update LastSeen
        date_default_timezone_set('UTC');
        $time = date("Y-m-d H:i:s") . " UTC";
        $stmt = $mysqli->query("UPDATE user SET User_LastSeen='" . $time . "' WHERE User_Username='" . $username . "'");

        // Goto to hello.php
        header("Location: hello.php");
    } else {
        echo 'Invalid password.';
    }
}

// Goto to register.php with Error (user not found)
header("Location: login.php?e=1");
die();
