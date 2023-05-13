<?php

require("checkconnect.php");
require("configsql.php");

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

// Get info POST
$sfrequency = $_POST["sfrequency"];
$sfrequencyunit = $_POST["sfrequencyunit"];
$stime = $_POST["stime"];
$sreceiver = $_POST["sreceiver"];
$snoise = $_POST["snoise"];
$scomment = $_POST["scomment"];
$slink = $_POST["slink"];
$sprivate = 0;

if (isset($_POST['sprivate'])) {
    $sprivate = 1;
} else {
    $sprivate = 0;
}

// Check if not empty
if ("" == trim($sfrequency) || "" == trim($slink) || "" == trim($sfrequencyunit) || "" == trim($stime) || "" == trim($sreceiver) || "" == trim($snoise) || "" == trim($scomment)) {
    // Goto to newsignal.php with Error
    header("Location: newsignal.php?e=1");
    exit();
}

// Encode Signal_AutoReport
$fq = $sfrequency . " " . $sfrequencyunit;

$arr_autoreport = array('fq' => $fq, 'time' => $stime, 'rcv' => $sreceiver, 'sn' => $snoise);
$arr_Signal_AutoReport = json_encode($arr_autoreport);

// Prepare & execute request
$stmt = $mysqli->prepare("INSERT INTO `signal` (Signal_Visibility, Signal_Sample_Link, Signal_Description, Signal_AutoReport) VALUES (?,?,?,?)");
$stmt->bind_param("isss", $sprivate, $slink, $scomment, $arr_Signal_AutoReport);
$stmt->execute();

// Goto to newsignal.php with Success
header("Location: newsignal.php?e=0");
die();
