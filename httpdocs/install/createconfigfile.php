<?php

// Get hostname, username and password SQL server from POST
$hostname = $_POST["sqlhost"];
$username = $_POST["sqluser"];
$password = $_POST["sqlpass"];

// Check if not empty
if("" == trim($hostname) || "" == trim($username) || "" == trim($password)){
    printf("exit");
    exit();
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