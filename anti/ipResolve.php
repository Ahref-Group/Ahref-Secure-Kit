<?php
/**
 * Ahref Secure Kit 0.7
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvements and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */
function getUserIP()
{
    $user_IP = '';  
    $unknown = 'unknown';  
    if (isset($_SERVER)){  
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){  
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);  
            foreach($arr as $realip){  
                $realip = trim($realip);  
                if ($realip != 'unknown'){  
                    $user_IP = $realip;  
                    break;  
                }  
            }  
        }else if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)){  
            $user_IP = $_SERVER['HTTP_CLIENT_IP'];  
        }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)){  
            $user_IP = $_SERVER['REMOTE_ADDR'];  
        }else{  
            $user_IP = $unknown;  
        }  
    }else{  
        if(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)){  
            $user_IP = getenv("HTTP_X_FORWARDED_FOR");  
        }else if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)){  
            $user_IP = getenv("HTTP_CLIENT_IP");  
        }else if(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)){  
            $user_IP = getenv("REMOTE_ADDR");  
        }else{  
            $user_IP = $unknown;  
        }  
    }  
    $user_IP = preg_match("/[\d\.]{7,15}/", $user_IP, $matches) ? $matches[0] : $unknown;  
    return $user_IP;  
}

function resolveIP($ip)
{
    $result = json_decode(file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=".$ip), true);
    if($result['code'] == 0){
        return $result['data']['country'].' '.$result['data']['region'].
            ' '.$result['data']['city'].' '.$result['data']['isp'];
    }
    
    else 
        return '查询失败';
    
    //下方是ipip.net付费数据库查询链接，如果使用，请注释或删除掉上面taobao的API代码。
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ipapi.ipip.net/find?addr=".$ip);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,  CURLOPT_HTTPHEADER, array('Token:your key here'));
    $output = json_decode(curl_exec($ch), true);
    if($output['ret'] == 'ok'){
        $info = $output['data'][0].$output['data'][1].$output['data'][2].$output['data'][3].' '.$output['data'][4];
    }
    else{
        $info = '查询失败'.$output['msg'];
    }
    return $info;
}