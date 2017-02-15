<?php
/**
 * Ahref Secure Kit 0.7
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvements and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */
require_once('protect.php');
if ($forceProtogenesis == 1) $pass1 = forceProtogenesis(); else $pass1 = true;
if ($browserBlock == 1) $pass2 = browserBlock(); else $pass2 = true;
if ($locationBlock == 1) $pass3 = locationBlock(); else $pass3 = true;
if ($pass1 == true && $pass2 == true && $pass3 == true)
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
