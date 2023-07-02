<?php

require("checkconnect.php");
require("configsql.php");

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

// Get info from POST
$sID = $_GET["id"];

$sowner = intval($_SESSION["login"]);

// Check if not empty
if ("" == trim($sID)) {
    // Go to newsignal.php with an error
    header("Location: newsignal.php?e=1");
    exit();
}

// Prepare & execute request
$stmt = $mysqli->prepare("DELETE FROM `signal` WHERE Signal_ID=? AND Signal_Owner_ID=?");
$stmt->bind_param("ii", $sID, $sowner);
$stmt->execute();

// Go to newsignal.php with Success
header("Location: newsignal.php?e=0");
die();
?>