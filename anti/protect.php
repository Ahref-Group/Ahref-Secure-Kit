<?php
/**
 * Ahref Anti-CC System 0.1
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvments and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */


require_once('conf.php'); //载入配置

//forceProtogenesis 模块
function forceProtogensis()
{
	global $blockList;
	foreach($blockList as $item){
	    if (strpos($_SERVER['HTTP_USER_AGENT'], $item)){
	        include('page/forceProtogenesis.html');
	        record('forceProtogensis-'.$item);
	        return false;
	    }
	}
	return true;
}

	
//Anti-CC 模块
function antiCC()
{
	if(empty($_COOKIE['t']) || empty($_COOKIE['v'])){ //如果检测不到cookie，则说明首次访问，进入引导页。
		if ($_SERVER['PHP_SELF'] != ""){ //如果检测到访问文章页，则进入快速检查通道
			include('page/quickAuth.html');
			record('directPage');
			setAuth();
		}
		else{
			global $haveGuidePage;
			if ($haveGuidePage == 1)
			{
			    include('main.html');
			    record('jumpYindao');
			}
			else 
			{
			    setAuth();
			    record('safe');
			    return true;
			}
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
    ini_set('display_errors', '1');error_reporting(-1);
    require_once('ipResolve.php');
    $IP = getUserIP();
    $log = fopen("anti/record/log.txt", "a") or die('Fail to write log!');
    $data = "\n" . microtime(1) . "|" . $IP . "|" . resolveIP($IP) . "|" . $_SERVER['REQUEST_URI'] . "|" .$_SERVER['HTTP_USER_AGENT']. "|" .$code;
    fwrite($log, $data);
    fclose($log);
}
?>