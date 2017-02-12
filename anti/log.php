<?php
/**
 * Ahref Anti-CC System 0.5
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvements and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */
$log = fopen("record/log.txt", "r") or die('error');
    while(!feof($log)) {
      print_r(explode("|", fgets($log), 6));
    }
fclose($log);