<?php

require("checkconnect.php");
require("configsql.php");
require("getuser.php");

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

// Get info from POST
$rID = $_POST["rID"];
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
    // Go to newreceiver.php with an error
    header("Location: newreceiver.php?e=1");
    exit();
}

if (getTypeFromUserID($_SESSION['login']) === 1) {
    // Prepare & execute request
    $stmt = $mysqli->prepare("UPDATE `receiver` SET Receiver_Title=?, Receiver_Location=?, Receiver_Device=?, Receiver_Antenna=?, Receiver_Private=? WHERE Receiver_ID=?");
    $stmt->bind_param("ssssii", $rtitle, $rlocation, $rdevice, $rantenna, $rprivate, $rID);
    $stmt->execute();
} else {
    // Prepare & execute request
    $stmt = $mysqli->prepare("UPDATE `receiver` SET Receiver_Title=?, Receiver_Location=?, Receiver_Device=?, Receiver_Antenna=?, Receiver_Private=? WHERE Receiver_ID=? AND Receiver_Owner_ID=?");
    $stmt->bind_param("ssssiii", $rtitle, $rlocation, $rdevice, $rantenna, $rprivate, $rID, $rowner);
    $stmt->execute();
}

// Go to newreceiver.php with Success
header("Location: receiver.php?id=".$rID);
die();
?>