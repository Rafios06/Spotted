<?php

require("../configsql.php");

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

// Get username, password and email from POST
$profil = 1;
$username = $_POST["user"];
$password = $_POST["password"];
$email = $_POST["email"];

// Generate hash from password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Check if not empty
if("" == trim($username) || "" == trim($password_hash) || "" == trim($email)){
    printf("exit");
    exit();
}

// Get time
date_default_timezone_set('UTC');
$time = date("Y-m-d H:i:s") . " UTC";

// Prepare & execute request
$stmt = $mysqli->prepare("INSERT INTO user (User_Type, User_Username, User_Password, User_Email, User_LastSeen) VALUES (?,?,?,?,?)");
$stmt->bind_param("issss", $profil, $username, $password_hash, $email, $time);
$stmt->execute();

printf("Success... %s\n", mysqli_get_host_info($mysqli));

// Goto to deleteinstallfiles.php
header("Location: deleteinstallfiles.php");
die();
?>