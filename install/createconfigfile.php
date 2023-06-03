<?php

// Get hostname, username and password SQL server from POST
$hostname = $_POST["sqlhost"];
$username = $_POST["sqluser"];
$password = $_POST["sqlpass"];

// Check if not empty
if("" == trim($hostname) || "" == trim($username) || "" == trim($password)){
    header("Location: welcome.php?e=1");
    exit();
}

// Check connection MySQL
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($hostname, $username, $password);

// Check connection MySQL
if (!$mysqli) {
    header("Location: welcome.php?e=1");
	die();
}

// Write config server SQL
$file = '../configsql.php';

$content = "<?php\n" .
           '$SQL_hostname = "' . $hostname . '";' . PHP_EOL .
           '$SQL_username = "' . $username . '";' . PHP_EOL .
           '$SQL_password = "' . $password . '";' . PHP_EOL ;

file_put_contents($file, $content, FILE_APPEND | LOCK_EX);

// Send info to createdb.php
header("Location: createdb.php");
die();
?>