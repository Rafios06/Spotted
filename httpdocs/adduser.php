<?php

require("configsql.php");

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

// Get username, password and email from POST
$profil = 0;
$username = $_POST["uusername"];
$email = $_POST["uemail"];
$password = $_POST["upassword"];

// Generate hash from password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Check if not empty
if("" == trim($username) || "" == trim($password_hash) || "" == trim($email)){
    printf("exit");
    exit();
}

// Check if username not existing
$result = $mysqli->query("SELECT User_ID FROM user WHERE User_Username = '" . $username . "'");
if ($result->num_rows == 0) {

    // Check if email not existing
    $result = $mysqli->query("SELECT User_ID FROM user WHERE User_Email = '" . $email . "'");
    if ($result->num_rows == 0) {
        // row not found, do stuff...
        printf("row not found %i", $result->num_rows);

        // Get time
        date_default_timezone_set('UTC');
        $time = date("Y-m-d H:i:s") . " UTC";

        // Prepare & execute request
        $stmt = $mysqli->prepare("INSERT INTO user (User_Type, User_Username, User_Password, User_Email, User_LastSeen) VALUES (?,?,?,?,?)");
        $stmt->bind_param("issss", $profil, $username, $password_hash, $email, $time);
        $stmt->execute();

        // Goto to register.php with Success
        header("Location: register.php?e=0");
    }
} else {
    // Goto to register.php with Error
    header("Location: register.php?e=1");
}

die();
