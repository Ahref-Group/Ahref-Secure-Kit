<?php
/**
 * Ahref Anti-CC System 0.1
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvments and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */


//此页面仅为带有引导页的博客服务，若没有请勿使用
    include('conf.php'); //载入配置
    if(empty($_COOKIE['t']) || empty($_COOKIE['v'])){
        $back['code'] = 0;
        $back['info'] = "您的浏览器过长时间未访问<br>可能需要更多时间";
    }else{
        global $key;
        $content = $_COOKIE['t'].$key;
        if(hash('md4', $content) == $_COOKIE['v'])
        {
            if(microtime(1) < $_COOKIE['t']){
                $back['code'] = 1;
                $back['info'] = "访问过快，冷却时间为1.6秒";
            }
            else{
                $back['code'] = 2;
                $back['info'] = "安全检测成功";
            }
        }
        else{
            $back['code'] = 3;
            $back['info'] = "解码失败，请清空本地Cookie以及缓存";
        }
    }
    setAuth();
    echo json_encode($back,JSON_UNESCAPED_UNICODE);
    
  function setAuth()
{
    global $key, $refreshTime;
    $t = microtime(1) + $refreshTime;
    $content = $t.$key;
    setcookie('v', hash('md4', $content), time() + 3600, '/');
    setcookie('t', $t, time() + 3600, '/');
}  
?>