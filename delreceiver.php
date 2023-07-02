<?php

require("checkconnect.php");
require("configsql.php");

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

// Get info from POST
$rID = $_GET["id"];

$rowner = intval($_SESSION["login"]);

// Check if not empty
if ("" == trim($rID)) {
    // Go to newreceiver.php with an error
    header("Location: newreceiver.php?e=1");
    exit();
}

// Prepare & execute request
$stmt = $mysqli->prepare("DELETE FROM `receiver` WHERE Receiver_ID=? AND Receiver_Owner_ID=?");
$stmt->bind_param("ii", $rID, $rowner);
$stmt->execute();

// Go to newreceiver.php with Success
header("Location: newreceiver.php?e=0");
die();
?>