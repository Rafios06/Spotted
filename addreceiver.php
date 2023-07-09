<?php

require("checkconnect.php");
require("configsql.php");

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

// Get info POST
$rtitle = $_POST["rtitle"];
$rlocation = $_POST["rlocation"];
$rdevice = $_POST["rdevice"];
$rantenna = $_POST["rantenna"];

$rprivate = 1;

if (isset($_POST['rprivate'])) {
    $rprivate = "0"; // Public
} else {
    $rprivate = "1"; // Private
}

$rowner = intval($_SESSION["login"]);

// Check if not empty
if ("" == trim($rtitle) || "" == trim($rlocation) || "" == trim($rdevice) || "" == trim($rantenna)) {
    // Goto to newreceiver.php with Error
    header("Location: newreceiver.php?e=1");
    exit();
}

// Prepare & execute request
$stmt = $mysqli->prepare("INSERT INTO `receiver` (Receiver_Owner_ID, Receiver_Title, Receiver_Location, Receiver_Device, Receiver_Antenna, Receiver_Private) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("issssi", $rowner, $rtitle, $rlocation, $rdevice, $rantenna, $rprivate);
$stmt->execute();

// Goto to newreceiver.php with Success
header("Location: myreceivers.php?e=0");
die();
