<?php
/**
 * Ahref Anti-CC System 0.1
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvements and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */

require_once('protect.php');
if ($antiCC = 1){
	if ($forceProtogenesis = 1){
		forceProtogenesis();
	}
	if ($browserBlock = 1){
		browserBlock();
	}
	antiCC();
}else{
	loadContent();
}