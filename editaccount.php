<?php

require("checkconnect.php");
require("configsql.php");
require("getuser.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Edit account</title>
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

    <div class="card" style="margin: 2em;">
        <header class="card-header">
            <p class="card-header-title">
                Edit account
            </p>
        </header>
        <div class="card-content">
            <div class="content">
                <form action="editprofil.php" method="POST">
                    <div class="field">
                        <label class="label">Username</label>
                        <div class="control">
                            <input class="input" type="text" name="" id="" placeholder="Username" value="<?php echo getUsernameFromUserID($_SESSION['login']); ?>" disabled required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input class="input" type="text" name="uemail" id="uemail" placeholder="Email" value="<?php echo getEmailFromUserID($_SESSION['login']); ?>" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">New password</label>
                        <div class="control">
                            <input class="input" type="password" name="upassword" id="upassword" placeholder="New password" onchange='check_pass();' required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Confirm password</label>
                        <div class="control">
                            <input class="input" type="password" name="upasswordb" id="upasswordb" placeholder="Confirm password" onchange='check_pass();' required>
                        </div>
                    </div>
            </div>
        </div>
        <footer class="card-footer">
            <div class="control card-footer-item">
                <button class="button" type="submit" name="submit" id="submit">
                    Edit
                </button>
            </div>
        </footer>
        </form>
    </div>

    <script>
        function check_pass() {
            if (document.getElementById('upassword').value ==
                document.getElementById('upasswordb').value) {
                document.getElementById('submit').disabled = false;
            } else {
                document.getElementById('submit').disabled = true;
            }
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