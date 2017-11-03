<?php

/**
 * 父类
 * @author    <weiyeying@163.com> 
 * @since        1.0 
 */
class Controller {

    /**
     * some_func  
     * 函数的含义说明 
     * @access public 
     * @param mixed $arg1 参数一的说明 
     * @since 1.0 
     * @return array 
     */
    //重新定义构造函数
    public function __construct() {
      if(method_exists($this, 'init')){
            $this->init();
        }
    }
    /**渲染视图**/
    public function render($view,$data){
        $path=APP_VIEW."/".$view.".php";
        if(!is_file($path)){
            halt($path."模板文件不存在");
        }
        is_array($data)|| halt($data."..请传个数组好吗");
        include $path;
        
    }



    public function success($title,$msg,$url) {
     echo   include APP_PUBLIC."/success.php";
     die;
    }
    
    public function error($title,$msg,$url){
       echo   include APP_PUBLIC."/error.php";
     die;
    }

}

?>