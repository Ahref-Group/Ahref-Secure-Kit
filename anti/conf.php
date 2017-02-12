<?php
/**
 * Ahref Anti-CC System 0.5
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvements and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */


 /**以下为选项开关*/
 $antiCC = 1; //总开关
 $record = 1; //是否记录拦截／放行次数
 $forceProtogenesis = 1; //强制QQ，微信访问时要求使用系统浏览器
 $browserBlock = 1; //指定浏览器屏蔽
 
 /**以下为CC防护系统配置*/
 $refreshTime = 1; //刷新间隔，单位为秒
 $key = "c0lacan"; //自己的密钥

 /**以下为浏览器屏蔽配置*/
 $browserList = array("MSIE", "Mozilla/4.0", "MQQBrowser");
 
 /**以下为强制系统浏览器屏蔽配置*/
 $blockList = array("QQ", "MicroMessenger", "tieba"); 
 /**配置列表：
  * 微信：MicroMessenger
  * QQ：QQ
  * 贴吧：tieba
  * 知乎：zhihu
  * 更多待补充... */