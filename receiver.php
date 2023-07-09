<?php

require("checkconnect.php");
require("configsql.php");
require("getlists.php");
require("getreceiver.php");
require("getuser.php");

// Récupérer les informations du receiver à afficher (par exemple à partir d'une base de données)
$receiverId = $_GET['id']; // Supposons que l'ID du receiver est passé dans l'URL comme paramètre 'id'

// Check if not empty
if ("" == trim($receiverId)) {
    // Goto to index.php with Error
    header("Location: myreceivers.php");
    exit();
}

$userId = $_SESSION['login'];
$receiverDetails = getReceiverDetails($_SESSION['login'], $receiverId);

// Extraire les coordonnées de la location
$location = $receiverDetails['location'];
$coordinates = [];

// url encode the address
$address = urlencode($location);

$url = "https://nominatim.openstreetmap.org/?format=json&addressdetails=1&q={$address}&format=json&limit=1";

$options  = array('http' => array('user_agent' => 'Spotted Bot (tortillum.com)'));
$context  = stream_context_create($options);
$resp_json = file_get_contents($url, false, $context);

// decode the json
$resp = json_decode($resp_json, true);

if (!empty($resp)) {
    $latitude = $resp[0]['lat'];
    $longitude = $resp[0]['lon'];
} else {
    // Gestion de l'adresse non trouvée
    // Vous pouvez afficher un message d'erreur ou utiliser des valeurs par défaut pour les coordonnées
    $latitude = 0;
    $longitude = 0;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Receiver Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>

    <style>
        .navbar-item .field:not(.is-expanded):hover {
            width: 18rem;
        }
    </style>
</head>

<body>

<nav class="navbar is-light has-shadow" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
                <img src="res/svg/icon.svg" width="28" height="28" alt="Spotted">
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="mysignals.php">
                    My signals
                </a>
                <a class="navbar-item" href="receiver.php">
                    My receivers
                </a>
                <a class="navbar-item" href="account.php">
                    Account
                </a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <form action="search.php" method="GET">
                        <div class="field has-addons">
                            <div class="control">
                                <input class="input is-rounded" type="text" placeholder="Search" id="s" name="s">
                            </div>
                            <div class="control">
                                <button class="button is-info">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="navbar-item">
                    <a class="button is-danger" href="logout.php">
                        <span class="icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        <span>Log out</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="card" style="margin: 2em;">
        <div class="card-content">
            <h1 class="title is-4">Receiver Details</h1>
            <hr>
            <div class="content">
                <p><strong>Title:</strong> <?= $receiverDetails['title'] ?></p>
                <p><strong>Location:</strong> <?= $receiverDetails['location'] ?></p>
                <p><strong>Device:</strong> <?= $receiverDetails['device'] ?></p>
                <p><strong>Antenna:</strong> <?= $receiverDetails['antenna'] ?></p>
                <p><strong>Owner:</strong> <?= getUsernameFromUserID($receiverDetails['owner']) ?></p>

                <?php
                if ($receiverDetails['location'] != "unknown") {
                    echo '<div id="map" style="height: 400px;"></div>';
                }

                if ($receiverDetails['owner'] === intval($userId) || getTypeFromUserID($_SESSION['login']) === 1) {
                    echo '<footer class="card-footer"><form action="newreceiver.php" method="get" class="card-footer-item"><input class="button" type="submit" value="Edit" /><input type="hidden" id="id" name="id" value="' . $receiverId . '" /></form>';
                    echo '<form action="delreceiver.php" method="get" class="card-footer-item"><input class="button is-danger is-light" type="submit" value="Delete" /><input type="hidden" id="id" name="id" value="' . $receiverId . '" /></form></footer>';
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        // Définir l'icône personnalisée
        var customIcon = L.icon({
            iconUrl: 'res/svg/iconmonstr-radio-tower-5.svg', // Spécifiez le chemin vers votre image d'icône
            iconSize: [28, 28], // Spécifiez la taille de l'icône
            iconAnchor: [19, 28], // Spécifiez l'ancre de l'icône (le point de l'icône qui sera positionné sur les coordonnées)
        });

        // Créez le marqueur avec l'icône personnalisée
        var latitude = <?= $latitude ?>;
        var longitude = <?= $longitude ?>;

        // Vérification des coordonnées
        if (isNaN(latitude) || isNaN(longitude)) {
            console.error('Invalid coordinates:', latitude, longitude);
        } else {
            var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                maxZoom: 18
            }).addTo(map);

            var marker = L.marker([latitude, longitude], {
                icon: customIcon
            }).addTo(map);
        }

        $(document).ready(function() {
            $(".navbar-burger").click(function() {
                $(".navbar-burger").toggleClass("is-active");
                $(".navbar-menu").toggleClass("is-active");
            });
        });
    </script>

</body>

</html>