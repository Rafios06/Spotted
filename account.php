<?php
require("checkconnect.php");
require("configsql.php");
require("getuser.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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

    <section class="section">
        <div class="container">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Account
                        <?php if(getTypeFromUserID($_SESSION["login"]) === 1){echo '<a class="button is-danger navbar-end" href="admin.php">Admin</a>';} ?>
                    </p>
                    </p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div class="columns is-multiline is-mobile">
                            <div class="column is-half-tablet is-full-mobile">
                                <div class="box has-text-centered">
                                    <p class="heading">Username</p>
                                    <p class="title is-size-4"><?php echo getUsernameFromUserID($_SESSION['login']); ?></p>
                                </div>
                            </div>
                            <div class="column is-half-tablet is-full-mobile">
                                <div class="box has-text-centered">
                                    <p class="heading">Email</p>
                                    <p class="title is-size-4"><?php echo getEmailFromUserID($_SESSION['login']); ?></p>
                                </div>
                            </div>
                            <div class="column is-half-tablet is-full-mobile">
                                <div class="box has-text-centered">
                                    <p class="heading">Last connection</p>
                                    <p class="title is-size-4"><?php echo getLastSeenFromUserID($_SESSION['login']); ?></p>
                                </div>
                            </div>
                            <div class="column is-half-tablet is-full-mobile">
                                <div class="box has-text-centered">
                                    <p class="heading">ID</p>
                                    <p class="title is-size-4"><?php echo $_SESSION['login'] . "/" . getTypeFromUserID($_SESSION['login']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="card-footer">
                    <a href="editaccount.php" class="card-footer-item">Edit account</a>
                    <a href="deleteaccount.php" class="card-footer-item">Delete account</a>
                </footer>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $(".navbar-burger").click(function() {
                $(".navbar-burger").toggleClass("is-active");
                $(".navbar-menu").toggleClass("is-active");
            });
        });
    </script>

</body>

</html>
