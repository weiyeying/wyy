<?php
/* 
 * 日志类
 */
class  Log {
  //日志
   public static  function wyy_log($msg,$type=3,$dir=NULL){
      if(is_null($dir)){
          $dir=LOG_PATH."/".date("Y-m-d",time()).".log";
      }
      
      $msg=date("Y-m-d",time())." : ".$msg."\n";
      error_log($msg,$type,$dir);
  }

}

