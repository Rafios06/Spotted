<?php

// Start session
session_start();

// Check if already connected
if (!isset($_SESSION["login"]) || empty($_SESSION["login"])) {
    header("Location: login.php?e=1"); // Goto to login.php
    exit();
}