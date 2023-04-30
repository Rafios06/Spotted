
<?php

require("../configsql.php");

// Open a connection to a MySQL Server
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password);

// Check connection MySQL
if (!$mysqli) {
    error_log('Connection error: ' . mysqli_connect_error());
	die();
}

// Create db
$result = $mysqli->query("CREATE DATABASE `spotteddb` /*!40100 COLLATE 'latin1_swedish_ci' */");

$mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

// Create user table
$result = $mysqli->query("CREATE TABLE `user` (
	`User_ID` INT NOT NULL AUTO_INCREMENT,
	`User_Type` INT NOT NULL DEFAULT '0',
	`User_Username` TEXT NOT NULL,
	`User_Password` TEXT NOT NULL,
	`User_Email` TEXT NOT NULL,
	`User_LastSeen` TEXT NOT NULL,
	PRIMARY KEY (`User_ID`))");

// Create signal table
$result = $mysqli->query("CREATE TABLE `signal` (
	`Signal_ID` INT NOT NULL AUTO_INCREMENT,
	`Signal_Visibility` INT NULL DEFAULT '0',
	`Signal_Sample_Link` TEXT NULL,
	`Signal_Description` LONGTEXT NULL,
	`Signal_AutoReport` LONGTEXT NULL,
	PRIMARY KEY (`Signal_ID`))");

// Send info to createadmin.php
header("Location: createadmin.php");
die();
?>
