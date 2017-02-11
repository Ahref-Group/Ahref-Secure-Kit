<?php
/**
 * Ahref Anti-CC System 0.1
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvements and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
*/
$back['code'] = 0;
$back['info'] = $_SERVER['HTTP_USER_AGENT']."<br> Unix时间戳：".microtime(1)."<br>Cookie时间戳：".$_COOKIE['t']."<br>hash：".$_COOKIE['v'];
echo json_encode($back,JSON_UNESCAPED_UNICODE);
?>