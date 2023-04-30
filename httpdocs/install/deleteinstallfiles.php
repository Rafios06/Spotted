<?php

function delTree($dir) {

   $files = array_diff(scandir($dir), array('.','..'));

    foreach ($files as $file) {

      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");

    }

    return rmdir($dir);
  }

delTree("../install");
printf("Success!");

// Goto to deleteinstallfiles.php
header("Location: ../index.php");
die();
?>

