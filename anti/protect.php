<?php
/**
 * Ahref Anti-CC System 0.1
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvements and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */


require_once('conf.php'); //载入配置

//forceProtogenesis 模块
function forceProtogenesis()
{
	global $forceProtogenesis;
	if (strpos($_SERVER['HTTP_USER_AGENT'], "QQ") || strpos($_SERVER['HTTP_USER_AGENT'], "MicroMessenger")) {
		include_once('/page/forceProtogenesis.html');
}

	
//antiCC 模块
function antiCC()
{
	global $antiCC;
	if(empty($_COOKIE['t']) || empty($_COOKIE['v'])){ //如果检测不到cookie，则说明首次访问，进入引导页。
		if ($_SERVER['PHP_SELF'] != ""){ //如果检测到访问文章页，则进入快速检查通道
			include_once('page/quickAuth.html');
			setAuth();
		}
		else{
			setAuth();
			loadContent();
			}
		}
	}else{
		global $key;
	    $content = $_COOKIE['t'].$key;
		if(hash('md4',$content) == $_COOKIE['v']) // 检测是否被破坏
		{
			if(microtime(1) < $_COOKIE['t']){ //访问过快
				setAuth();
				include_once('page/ban1.html');
			}else{//没有则进入正常，跳出
				loadContent();
				setAuth();
			}
		}else{ //被破坏
		    setAuth();
		    include_once('page/ban2.html');
		}
	}
}

function browserBlock()
{
    
}
function setAuth()
{
    global $key, $refreshTime;
	$t = microtime(1) + $refreshTime;
	$content = $t.$key;
	setcookie('v', hash('md4',$content), time() + 3600, '/');
	setcookie('t', $t, time()+3600, '/');
}

function pass()
{
	$times = file_get_contents('pass.txt');
	$times ++;
	file_put_contents('pass.txt',$times);
}

function stop()
{
	$times = file_get_contents('stop.txt');
	$times++;
	file_put_contents('stop.txt',$times);
}

?>