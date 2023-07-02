<?php
require("checkconnect.php");
require("configsql.php");
require("getuser.php");

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

$profilID = $_SESSION['login'];
$profil = getTypeFromUserID($profilID); // Type of account
$username = getUsernameFromUserID($profilID);

// Get password and email from POST
$email = $_POST["uemail"];
$password = $_POST["upassword"];

// Generate hash from password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Check if not empty
if ("" == trim($username) || "" == trim($password_hash) || "" == trim($email)) {
    // Goto to editaccount.php with Error
    header("Location: editaccount.php?e=1");
    exit();
}

// Check if email not existing or if email already linked to the account
$result = $mysqli->query("SELECT User_ID FROM user WHERE User_Email = '" . $email . "'");
if ($result->num_rows == 0 || getEmailFromUserID($userID) == $email) {
    // Get time
    date_default_timezone_set('UTC');
    $time = date("Y-m-d H:i:s") . " UTC";

    // Prepare & execute request
    $stmt = $mysqli->prepare("UPDATE `user` SET User_Type=?, User_Username=?, User_Password=?, User_Email=?, User_LastSeen=? WHERE User_ID=?");
    $stmt->bind_param("sssssi", $profil, $username, $password_hash, $email, $time, $profilID);
    $stmt->execute();

    // Goto to editaccount.php with Success
    header("Location: editaccount.php?e=0");
    exit();
} else {
    // Goto to register.php with Error
    header("Location: editaccount.php?e=1");
    exit();
}

// Goto to register.php with Error
header("Location: editaccount.php?e=1");
exit();
die();
