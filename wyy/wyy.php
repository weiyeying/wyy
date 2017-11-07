<?php
/* 
 * wyy初始化
 */
class wyy{

    public static function run(){
        self::_set_defind(); //设置常量
        defined('debug')||define('debug', false);
       if(debug || !is_file(TEMP_PATH."/~boot.php")){
       self::_create_dir();//创建应用目录
        self::_use_class(); //引入类  
       }else{
           error_reporting(0);
           include TEMP_PATH."/~boot.php";
       }
       Applaction::run();
    }
    


        private static function _set_defind(){
        //系统目录
        $path=str_replace("\\","/",__FILE__);
        define('WYY_PATH', dirname($path));
        define('LIB_PATH', WYY_PATH."/lib");
        define('CORE_PATH', LIB_PATH."/core");
        define('CONFIG_PATH', WYY_PATH."/config");
        define('COMMON_PATH', WYY_PATH."/common");
        define('DATA_PATH', WYY_PATH."/data");
        define('TPL_PATH', DATA_PATH."/tpl");
        define('EXTEND', WYY_PATH."/extends");
        //应用目录
        define('ROOT_PATH', dirname(WYY_PATH));//根目录
        define("APP_PATH", ROOT_PATH."/".APP_NAME);
        define('APP_CONTROLLER', APP_PATH."/controller");
        define('APP_MODEL', APP_PATH."/model");
        define('APP_VIEW', APP_PATH."/view");
        define("APP_CONFIG", APP_PATH."/config");
        define('APP_PUBLIC',APP_VIEW."/public");
        //临时目录
        define("TEMP_PATH", ROOT_PATH."/temp");
        //日志目录
        define("LOG_PATH", TEMP_PATH."/log");
        //公共文件
        define("APP_COMMON",ROOT_PATH."/common");
        define("APP_COMMON_CONFIG",APP_COMMON."/config");
        define("APP_COMMON_LIB",APP_COMMON."/lib");
        define("APP_COMMON_MODEL",APP_COMMON."/model");
        
        
    }
    
    //创建常用目录
    private static function _create_dir(){
        $arr=array(
            APP_PATH,APP_CONTROLLER,APP_CONFIG,APP_MODEL,APP_VIEW,APP_PUBLIC,TEMP_PATH,
            APP_COMMON,APP_COMMON_CONFIG,APP_COMMON_LIB,APP_COMMON_MODEL
        );
        for($i=0;$i<count($arr);$i++){
                  is_dir($arr[$i])||mkdir($arr[$i],0777,true);  
        }

    }
    
    //引入类文件
    private static function _use_class(){
        $arr=array(
           CORE_PATH."/Applaction.class.php",
           COMMON_PATH."/functions.php",
           CORE_PATH."/Controller.class.php",
           CORE_PATH."/Log.class.php",
        );
        $str="";
        for($i=0;$i<count($arr);$i++){
            include $arr[$i];
            $str.=trim(substr(file_get_contents($arr[$i]),5,-2));
            
        }
        $str="<?php\r\n".$str;
        file_put_contents(TEMP_PATH."/~boot.php", $str);
    }
    
    
    
    
}


wyy::run();