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
    </style>
</head>

<script>
    function check_pass() {
        if (document.getElementById('upassword').value ==
            document.getElementById('upasswordb').value) {
            document.getElementById('submit').disabled = false;
        } else {
            document.getElementById('submit').disabled = true;
        }
    }
</script>

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

</body>

</html>