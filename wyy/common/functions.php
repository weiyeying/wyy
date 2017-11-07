<?php

/**
 * debug函数
 * **/
function halt($error){
   log::wyy_log($error); //记录日志
   if(debug){
 $dug=debug_backtrace();
  $arr=array();
  $arr["function"]=$dug[1]['function'];
  $arr['line']=  isset($dug[1]['line'])?$dug[1]['line']:'';
  $arr['file']=  isset($dug[1]['file'])?$dug[1]['file']:'';
  $arr['msg']=$error;
  ob_start();
  debug_print_backtrace();
  $arr['trace']= htmlspecialchars(ob_get_clean());
  include TPL_PATH."/halt.php";
 }else{
     $url=C("ERROR_URL");
     redirect($url);
 }
}


/**
 * 打印函数
 * **/
function P($data){
    echo "<pre>";
   print_r($data);
   echo "</pre>";
}
/**
 * 跳转函数
 * **/

function redirect($url){
    header("Location: $url");
    exit;
}


/**
 * 0 初始化配置项
 * 1:设置 参数
 * 2:读取参数
 * 3:读取所有配置
 * @param type $key
 * @param type $val
 */

function C($key=NULL,$val=NULL){
    static $config=array();
    //合并配置项
    if(is_array($key)){
       $config=array_merge($config,array_change_key_case($key,CASE_UPPER));
    }
    //读取配置项与临时设置配置项
    if(is_string($key)){
        $key=  strtoupper($key);
        if($val!=NULL){
            $config[$key]=$val;
            return ;
        }
        return $config[$key]?$config[$key]:NULL;
    }
    return $config;
}



?>