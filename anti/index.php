<?php
/**
 * Ahref Anti-CC System 0.1
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvments and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */
require_once('conf.php');
require_once('protect.php');
if ($forceProtogenesis == 1) $pass1 = forceProtogensis(); else $pass1 = true;
if ($browserBlock == 1) $pass2 = browserBlock(); else $pass2 = true;
if ($pass1 == true && $pass2 == true)
    {
        if ($antiCC == 1){
            if (antiCC() == true)
            loadContent();
        }
        else{
            record('safe');
            loadContent();
        } 
    }
