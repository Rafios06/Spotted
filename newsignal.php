<?php

require("checkconnect.php");
require("configsql.php");
require("getlists.php");
require("getreceiver.php");
require("getsignal.php");
require("getuser.php");

$userId = $_SESSION['login'];
$signalId = "";

$editorMode = false;

$sFrequencyUnit = 'MHz';

if (!empty($_GET['id'])) {
    $signalId = $_GET['id']; // Supposons que l'ID du signal est passé dans l'URL comme paramètre 'id'
    $signalDetails = getSignalDetails($userId, $signalId);

    if ($signalDetails['owner'] == intval($userId) || getTypeFromUserID($userId) === 1) {
        $editorMode = true;

        $sFrequencyArray = explode(" ", $signalDetails['frequency']);

        $sFrequency = $sFrequencyArray[0];
        $sFrequencyUnit = $sFrequencyArray[1];

        if ($sFrequencyUnit === 'GHz') {
        } elseif ($sFrequencyUnit === 'MHz') {
        } elseif ($sFrequencyUnit === 'kHz') {
        } elseif ($sFrequencyUnit === 'Hz') {
        } else {
            $sFrequencyUnit = 'MHz';
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <?php

    if ($editorMode) {
        echo '<title>Spotted - Edit signal</title>';
    } else {
        echo '<title>Spotted - Add signal</title>';
    }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
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
        <div class="card-content">
            <form action="<?php if ($editorMode) {
                                echo 'editsignal.php';
                            } else {
                                echo 'addsignal.php';
                            } ?>" method="POST">
                <?php if ($editorMode) {
                    echo '<input type="hidden" id="sID" name="sID" value="' . $signalId . '" />';
                } ?>

                <label class="label" for="sfrequency">Frequency</label>
                <div class="field has-addons">
                    <p class="control">
                        <input class="input" type="text" name="sfrequency" id="sfrequency" value="<?php if ($editorMode) {
                                                                                                        echo intval($sFrequency);
                                                                                                    } ?>" required>
                    </p>
                    <p class="control">
                        <span class="select">
                            <select name="sfrequencyunit" id="sfrequencyunit">
                                <option value="GHz" <?php if ($sFrequencyUnit === 'GHz') {
                                                        echo "selected";
                                                    } ?>>GHz</option>
                                <option value="MHz" <?php if ($sFrequencyUnit === 'MHz') {
                                                        echo "selected";
                                                    } ?>>MHz</option>
                                <option value="kHz" <?php if ($sFrequencyUnit === 'kHz') {
                                                        echo "selected";
                                                    } ?>>kHz</option>
                                <option value="Hz" <?php if ($sFrequencyUnit === 'Hz') {
                                                        echo "selected";
                                                    } ?>>Hz</option>
                            </select>
                        </span>
                    </p>
                </div>

                <div>
                    <label class="label" for="stime">Time (UTC)</label>
                    <?php if ($editorMode) {
                        echo '<input class="input" type="datetime-local" name="stime" id="stime" value="' . $signalDetails['time'] . '" style="max-width: 16em;" required>';
                    } else { {
                            echo '<input class="input" type="datetime-local" name="stime" id="stime" value="' . date('Y-m-d H:i') . '" style="max-width: 16em;" required>';
                        }
                    } ?>
                </div>

                <label class="label" for="sreceiver" style="margin-top: 0.5em;">Receiver</label>
                <div class="field has-addons">
                    <p class="control">
                        <span class="select">
                            <select name="sreceiver" id="sreceiver">
                                <?php generateSelectReceivers(); ?>
                            </select>
                        </span>
                    </p>
                    <p class="control">
                        <button type="button" class="button" onclick="location.href='newreceiver.php'">Create</button>
                    </p>
                </div>

                <label class="label" for="snoise">S/N</label>
                <div class="field has-addons">
                    <p class="control">
                        <input class="input" type="text" name="snoise" id="snoise" value="<?php if ($editorMode) {
                                                                                                echo $signalDetails['sn'];
                                                                                            } ?>" required>
                    </p>
                    <p class="control">
                        <button type="button" class="button" name="bbad" id="bbad">Bad</button>
                    </p>
                    <p class="control">
                        <button type="button" class="button" name="bfair" id="bfair">Fair</button>
                    </p>
                    <p class="control">
                        <button type="button" class="button" name="bexcellent" id="bexcellent">Excellent</button>
                    </p>
                </div>

                <div>
                    <label class="label" for="scomment">Comment</label>
                    <textarea class="input" type="textarea" name="scomment" id="scomment"><?php if ($editorMode) {
                                                                                                echo $signalDetails['comment'];
                                                                                            } ?></textarea>
                </div>

                <div>
                    <label class="label" for="slink">Link sample</label>
                    <input class="input" type="text" name="slink" id="slink" value="<?php if ($editorMode) {
                                                                                        echo $signalDetails['link'];
                                                                                    } ?>">
                </div>

                <div style="margin-top: 0.5em; margin-bottom: 0.5em;">
                    <label class="checkbox">
                        <input type="checkbox" name="sprivate" id="sprivate" <?php if ($editorMode && $signalDetails['private'] === "1") {
                                                                                    echo " checked";
                                                                                } ?>>
                        Private
                    </label>
                </div>

                <input style="margin-top: 1em;" class="button" type="submit" <?php if ($editorMode) {
                                                                                    echo 'value="Change"';
                                                                                } else {
                                                                                    echo 'value="Add"';
                                                                                } ?>>
            </form>

        </div>
    </div>

</body>

<script>
    const easyMDE = new EasyMDE({
        element: document.getElementById('scomment')
    });

    document.getElementById('bbad').onclick = function() {
        document.getElementById("snoise").value = "Bad";
    };

    document.getElementById('bfair').onclick = function() {
        document.getElementById("snoise").value = "Fair";
    };

    document.getElementById('bexcellent').onclick = function() {
        document.getElementById("snoise").value = "Excellent";
    };

    $(document).ready(function() {
        $(".navbar-burger").click(function() {
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");
        });
    });
</script>

</html>