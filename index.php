<?php

require("checkconnect.php");
require("configsql.php");
require("getstats.php");
require("searchengine.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">

    <link rel="stylesheet" href="https://unpkg.com/octicons@4.4.0/build/font/octicons.css">
    <link rel="stylesheet" href="https://unpkg.com/github-activity-feed@latest/dist/github-activity.min.css">

    <script type="text/javascript" src="https://unpkg.com/mustache@4.2.0/mustache.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/github-activity-feed@latest/dist/github-activity.min.js"></script>

    <style>
        .gha-footer {
            display: none;
        }

        .gha-header {
            width: calc(100%);
        }
    </style>

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

    <br>

    <div class="columns is-3">
        <div class="column is-three-quarters" style="margin-left: 1em;">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Last signals
                    </p>
                </header>
                <div class="card-content">
                    <div class="content">

                        <?php getLastSignalsAddeds($_SESSION['login'],10); ?>

                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Test
                                </p>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    Lorem ipsum leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras mattis consectetur purus sit amet fermentum.
                                </div>
                            </div>
                        </div>
                        
                        <br>

                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Test
                                </p>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    Lorem ipsum leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras mattis consectetur purus sit amet fermentum.
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Test
                                </p>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    Lorem ipsum leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras mattis consectetur purus sit amet fermentum.
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Test
                                </p>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    Lorem ipsum leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras mattis consectetur purus sit amet fermentum.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="column" style="margin-right: 1em;">

            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Statistics
                    </p>
                </header>
                <div class="card-content">
                    <div class="content">
                        Signals ajoutées (Vous): <br><?php echo getTotalUserSignal($_SESSION['login']); ?><br>
                        Recepteurs ajoutées (Vous) : <br><?php echo getTotalUserReceiver($_SESSION['login']); ?><br>
                        Signals ajoutées (Total): <br><?php echo getTotalSignal(); ?><br>
                        Recepteurs ajoutées (Total) : <br><?php echo getTotalReceiver(); ?><br>
                    </div>
                </div>
            </div>

            <br>

            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        News
                    </p>
                </header>
                <div id="feed"></div>
            </div>

        </div>
    </div>

    <script>
        GitHubActivity.feed({
            username: "Rafios06",
            repository: "Spotted",
            selector: "#feed",
            limit: 5
        });
    </script>

</body>

</html>