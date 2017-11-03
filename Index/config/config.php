<?php
 return array(
    "CODE_LEN"=>4, //验证码
    "DEFAULT_TIME_ZONE"=>"PRC",//字符集
    "SESSION_START"=>true, //是否开启session
    "SET_CONTROLLER"=>"c", //默认控制器
    "SET_ACTION"=>"a",//默认方法
    "URL"=>1,//0:默认规则  1:PATHINFO模式
    "DEFAULT_CONTROLLER"=>"index", //默认控制器
    "DEFAULT_FUNCTION"=>"index", //默认方法
    "ERROR_URL"=>"/index/index", //报错404
     "USER_LIB_FUNCTION"=>['img'],
   );   
?>