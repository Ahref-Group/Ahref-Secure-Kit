<?php
/**
 * Ahref Secure Kit 0.7
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvements and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */
require_once('conf.php'); //载入配置

//forceProtogenesis 模块
function forceProtogenesis()
{
	global $blockList;
	foreach($blockList as $item){
	    if (strpos($_SERVER['HTTP_USER_AGENT'], $item)){
	        include('page/forceProtogenesis.html');
	        record('forceProtogenesis-'.$item);
	        return false;
	    }
	}
	return true;
}

	
//antiCC 模块
function antiCC()
{
	if(empty($_COOKIE['t']) || empty($_COOKIE['v'])){ //如果检测不到cookie，则说明首次访问，进入引导页。
		if ($_SERVER['PHP_SELF'] != ""){ //如果检测到访问文章页，则进入快速检查通道
			include('page/quickAuth.html');
			record('directPage');
			setAuth();
		}else{
			setAuth();
			record('safe');
			return true;
		}
	}else{
		global $key;
	    $content = $_COOKIE['t'].$key;
		if(hash('md4',$content) == $_COOKIE['v']) // 检测是否被破坏
		{
			if(microtime(1) < $_COOKIE['t']){ //访问过快
			    record('too fast');
				setAuth();
				include('page/ban1.html');
			}else{//没有则进入正常，跳出
				setAuth();
				record('safe');
				return true;
			}
		}else{ //被破坏
			setAuth();
		    record('cookie destoried');
		    include('page/ban2.html');
		}
	}
}

function browserBlock()
{
	global $browserList;
	foreach($browserList as $item){
	    if (strpos($_SERVER['HTTP_USER_AGENT'], $item)){
	        include('page/garbageBrowser.html');
	        record('browserBlock-'.$item);
	        return false;
	    }
	}
	return true;
}
function setAuth()
{
    global $key, $refreshTime;
	$t = microtime(1) + $refreshTime;
	$content = $t.$key;
	setcookie('v', hash('md4',$content), time() + 3600, '/');
	setcookie('t', $t, time()+3600, '/');
}

function record($code)
{
    require_once('ipResolve.php');
    $IP = getUserIP();
    $time = date("Y.m.d H:i:s");
    $jumpFrom = $_SERVER['HTTP_REFERER'];
    $goTo = $_SERVER['REQUEST_URI'];
    $browserInfo = $_SERVER['HTTP_USER_AGENT'];
    $log = fopen("anti/record/log.txt", "a") or die('Fail to write log!');
    $data = "\n" . $time . "|" . $IP . "|" . resolveIP($IP) . "|" . $jumpFrom . "|" . $goTo. "|" . $browserInfo . "|" .$code;
    fwrite($log, $data);
    fclose($log);
}

function locationBlock()
{
	require_once('ipResolve.php');
	global $locationMethod, $locationList;
	foreach ($locationList as $item)
	{
		if ($locationMethod == 1){
			if(strpos(resolveIP(getUserIP()), $item))
				return true;
			else{
				record("locationBlcok-" . resolveIP(getUserIP()));
				include('page/locationBlock.html');
				return false;
			}
		}
		if ($locationMethod == 2){
			if (strpos(resolveIP(getUserIP()),$item)){
				record("locationBlcok-" . resolveIP(getUserIP()));
				include('page/locationBlock.html');
				return false;
			}
			else return true;
		}
	}
	return false;
}