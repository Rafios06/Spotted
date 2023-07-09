<?php

require("checkconnect.php");
require("configsql.php");

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

// Get info POST & escape special characters in the comment
$sfrequency = mysqli_real_escape_string($mysqli,$_POST["sfrequency"]);
$sfrequencyunit = mysqli_real_escape_string($mysqli,$_POST["sfrequencyunit"]);
$stime = mysqli_real_escape_string($mysqli,$_POST["stime"]);
$sreceiver = mysqli_real_escape_string($mysqli,$_POST["sreceiver"]);
$snoise = mysqli_real_escape_string($mysqli,$_POST["snoise"]);
$scomment = $_POST["scomment"];
$slink = mysqli_real_escape_string($mysqli,$_POST["slink"]);
$suser = intval($_SESSION['login']);
$sprivate = 1;

if (isset($_POST['sprivate'])) {
    $sprivate = "0"; // Public
} else {
    $sprivate = "1"; // Private
}

// Check if not empty
if ("" == trim($sfrequency) || "" == trim($sfrequencyunit) || "" == trim($stime) || "" == trim($sreceiver) || "" == trim($snoise) || "" == trim($scomment)) {
    // Goto to newsignal.php with Error
    header("Location: newsignal.php?e=1");
    exit();
}

// Encode Signal_AutoReport
$fq = $sfrequency . " " . $sfrequencyunit;

$arr_autoreport = array('fq' => $fq, 'time' => $stime, 'rcv' => $sreceiver, 'sn' => $snoise, 'prv' => $sprivate);
$arr_Signal_AutoReport = json_encode($arr_autoreport);

// Prepare & execute request
$stmt = $mysqli->prepare("INSERT INTO `signal` (Signal_Owner_ID, Signal_Sample_Link, Signal_Description, Signal_AutoReport) VALUES (?,?,?,?)");
$stmt->bind_param("isss", $suser, $slink, $scomment, $arr_Signal_AutoReport);
$stmt->execute();

// Goto to newsignal.php with Success
header("Location: mysignals.php?e=0");
die();
