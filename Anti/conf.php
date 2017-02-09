<?php
/**
 * Ahref Anti-CC System 0.1
 * @copyright  Copyright (c) 2017 Ahref_Group (http://ahref.me)
 * System core by yangwang (https://yangwang.hk)
 * System core improvments and structure by c0lacan (http://c0lacan.net)
 * Including pages by metheno (https://metheno.net)
 */


 /**以下为选项开关*/
 $AntiCC = 1; //CC防护系统开关
 $record = 1; //是否记录拦截／放行次数
 $forceProtogenesis = 1; //强制QQ，微信访问时要求使用系统浏览器
 $browserBlock = 1; //指定浏览器屏蔽
 
 /**以下为CC防护系统配置*/
 $refreshTime = 1; //刷新间隔
 $key = "Your Key"; //自己的密钥
 $haveGuidePage = 1; //是否带有引导页

 /**以下为浏览器屏蔽配置*/
 $browserList = array("MSIE 8.0", "MSIE 7.0", "MSIE 6.0", "360", "SouGou");
 
 /**以下为强制系统浏览器屏蔽配置*/
 $blockList = array("QQ", "MicroMessenger", "tieba"); 
 /**配置列表：
  * 微信：MicroMessenger
  * QQ：QQ
  * 贴吧：tieba
  * 知乎：zhihu
  * 更多暂时未发现... */