<?php

function getTotalSignal()
{
    require("checkconnect.php");
    require("configsql.php");

    // Connexion à la base de données MySQL
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    // Requête pour compter le nombre d'entrées dans la table
    $query = "SELECT COUNT(*) AS total FROM `signal`";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalEntries = $row['total'];

        if ($totalEntries > 0) {
            return $totalEntries;
        } else {
            return 0;
        }
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($mysqli);

    return 0;
}

function getTotalReceiver()
{
    require("checkconnect.php");
    require("configsql.php");

    // Connexion à la base de données MySQL
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    // Requête pour compter le nombre d'entrées dans la table
    $query = "SELECT COUNT(*) AS total FROM `receiver`";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalEntries = $row['total'];

        if ($totalEntries > 0) {
            return $totalEntries;
        } else {
            return 0;
        }
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($mysqli);

    return 0;
}

function getTotalUserSignal($userID)
{
    require("checkconnect.php");
    require("configsql.php");

    // Connexion à la base de données MySQL
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    // Requête pour compter le nombre d'entrées dans la table
    $query = "SELECT COUNT(*) AS total FROM `signal` WHERE Signal_Owner_ID = " . $userID;
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalEntries = $row['total'];

        if ($totalEntries > 0) {
            return $totalEntries;
        } else {
            return 0;
        }
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($mysqli);

    return 0;
}

function getTotalUser()
{
    require("checkconnect.php");
    require("configsql.php");

    // Connexion à la base de données MySQL
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    // Requête pour compter le nombre d'entrées dans la table
    $query = "SELECT COUNT(*) AS total FROM `user`";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalEntries = $row['total'];

        if ($totalEntries > 0) {
            return $totalEntries;
        } else {
            return 0;
        }
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($mysqli);

    return 0;
}

function getTotalUserReceiver($userID)
{
    require("checkconnect.php");
    require("configsql.php");

    // Connexion à la base de données MySQL
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $mysqli = mysqli_connect($SQL_hostname, $SQL_username, $SQL_password, 'spotteddb');

    // Requête pour compter le nombre d'entrées dans la table
    $query = "SELECT COUNT(*) AS total FROM `receiver` WHERE Receiver_Owner_ID = " . $userID;

    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalEntries = $row['total'];

        if ($totalEntries > 0) {
            return $totalEntries;
        } else {
            return 0;
        }
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($mysqli);

    return 0;
}