<?php
require("checkconnect.php");
require("configsql.php");
require("getstats.php");
require("searchengine.php");

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Check if not empty
if ("" == trim($currentPage) || $currentPage <= 0) {
    $currentPage = 1;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/octicons@4.4.0/build/font/octicons.css">
    <link rel="stylesheet" href="https://unpkg.com/github-activity-feed@latest/dist/github-activity.min.css">

    <script type="text/javascript" src="https://unpkg.com/mustache@4.2.0/mustache.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/github-activity-feed@latest/dist/github-activity.min.js"></script>

    <style>
        .navbar-item .field:not(.is-expanded):hover {
            width: 18rem;
        }

        .gha-footer {
            display: none;
        }

        .gha-header {
            width: calc(100%);
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

    <br>

    <div class="columns is-3">
        <div class="column is-three-quarters" style="margin-left: 1em;">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        <span>Last signals</span>
                        <a class="button is-primary navbar-end" href="addsignal.php">Add</a>
                    </p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <?php getPublicSignal($_SESSION['login'], 16, $currentPage); ?>
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
                        <div class="columns is-multiline is-mobile">
                            <div class="column is-half-tablet is-full-mobile">
                                <div class="box has-text-centered">
                                    <p class="heading">Signals added (You)</p>
                                    <p class="title is-size-4"><?php echo getTotalUserSignal($_SESSION['login']); ?></p>
                                </div>
                            </div>
                            <div class="column is-half-tablet is-full-mobile">
                                <div class="box has-text-centered">
                                    <p class="heading">Receivers added (You)</p>
                                    <p class="title is-size-4"><?php echo getTotalUserReceiver($_SESSION['login']); ?></p>
                                </div>
                            </div>
                            <div class="column is-half-tablet is-full-mobile">
                                <div class="box has-text-centered">
                                    <p class="heading">Signals added (Total)</p>
                                    <p class="title is-size-4"><?php echo getTotalSignal(); ?></p>
                                </div>
                            </div>
                            <div class="column is-half-tablet is-full-mobile">
                                <div class="box has-text-centered">
                                    <p class="heading">Receivers added (Total)</p>
                                    <p class="title is-size-4"><?php echo getTotalReceiver(); ?></p>
                                </div>
                            </div>
                        </div>

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

        $(document).ready(function() {
            $(".navbar-burger").click(function() {
                $(".navbar-burger").toggleClass("is-active");
                $(".navbar-menu").toggleClass("is-active");
            });
        });
    </script>

</body>

</html>