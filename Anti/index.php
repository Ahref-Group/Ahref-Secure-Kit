<?php
/**
 * Ahref Anti-CC System 0.1
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvments and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */

<<<<<<< HEAD
require('conf.php');
require('protect.php');
if ($forceProtogenesis == 1) forceProtogensis();
=======
require_once('conf.php');
require_once('protect.php');
if ($forceProtogensis == 1) forceProtogensis();
if ($AntiCC == 1) Anti();
>>>>>>> origin/early-release
if ($browserBlock == 1) browserBlock();
if (forceProtogensis() == true && browserBlock() == true)
    if ($AntiCC == 1) Anti();
