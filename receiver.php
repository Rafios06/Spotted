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
    header("Location: index.php");
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
</head>

<body>

    <nav class="navbar is-light has-shadow">
        <div class="navbar-brand">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link is-arrowless">
                    <img src="res/svg/icon.svg" width="28" height="28" style="margin: 0.5em;">
                </a>

                <div class="navbar-dropdown">
                    <aside class="menu" style="margin: 0.5em;">
                        <ul class="menu-list">
                            <li><a href="index.php">Home</a></li>
                        </ul>
                        <ul class="menu-list">
                            <li><a href="signal.php">Signal</a></li>
                        </ul>
                        <ul class="menu-list">
                            <li><a href="receiver.php">Receiver</a></li>
                        </ul>
                        <ul class="menu-list">
                            <li><a href="account.php">Account</a></li>
                        </ul>
                        <ul class="menu-list">
                            <li><a href="logout.php">Log out</a></li>
                        </ul>
                    </aside>
                </div>

            </div>

            <div id="navMenuColorlight-example" class="navbar-menu">
                <div class="navbar-start">
                    <div class="navbar-item">
                        <input class="input is-rounded" type="text" style="margin: 0.5em;" placeholder="Search">
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

                <?php
                if ($receiverDetails['location'] != "N/A") {
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
    </script>

</body>

</html>