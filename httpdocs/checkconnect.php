<?php

// Check if already connected
session_start();
if (isset($_SESSION["login"])) {
    exit();
}

// Goto to login.php
header("Location: login.php");
die();
