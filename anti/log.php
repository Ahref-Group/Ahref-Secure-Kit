<?php
$log = fopen("record/log.txt", "r") or die('error');
    while(!feof($log)) {
      print_r(explode("|", fgets($log), 6));
    }
fclose($log);
?>