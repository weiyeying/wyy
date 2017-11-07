<?php
/* 
 * 框架核心类
 */
class Applaction{
    
    public static function run(){
        self::_init();
        //一般错误处理
        set_error_handler(array(__CLASS__,"error")); 
        //自命错误处理
        //register_shutdown_function(array(__CLASS__,"error"));
        self::_import_file();
        self::_set_url();
        spl_autoload_register(array(__CLASS__,'_auto_load'));
        self::_create_demo();
        self::_run(); //运行类
    }
    
    //初始化
    private static  function _init(){
        //加载系统配置项
        C(include CONFIG_PATH."/config.php");        
$str=<<<str
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
    "USER_LIB_FUNCTION"=>[], //自动加载类或方法
   );   
?>
str;
        //加载公共配置项
        $common=APP_COMMON_CONFIG."/config.php";
        is_file($common)||file_put_contents($common, $str);
        C(include $common);
       //加载用户配置项
        is_file(APP_CONFIG."/config.php")||file_put_contents(APP_CONFIG."/config.php",$str);
        C(include APP_CONFIG."/config.php");
        date_default_timezone_set(C("DEFAULT_TIME_ZONE")) ;
        C("SESSION_START")||session_start();

    }
    //错误处理
    public static function error($errorno,$error,$file,$line){
        halt($error);
   }




    //引入用户类
    private static function _import_file(){
        $arr=C("USER_LIB_FUNCTION");
        if(is_array($arr)&&count($arr)>0){
            foreach ($arr as $v){
              $path=APP_COMMON_LIB."/".$v.".php" ;
              include $path;
            }
          
        }
    }

    private static function _auto_load($class_name){
      switch (true){
        case strlen($class_name)>=10&&substr($class_name,-10)=='Controller':
          
             $file=APP_CONTROLLER."/".$class_name.".php";
            if(!is_file($file)){
               if(debug){
                  halt($file."控制器不存在");  
                }else{
                //引入404
                $exp=  explode('/', C("ERROR_URL"));
                $file=APP_CONTROLLER."/".$exp[0]."Controller.php";
                }
            } 
            include $file;
          break;
        default :
              $file=EXTEND."/".$class_name.".php";
             if(!is_file($file)) halt($file."文件不存在");
            include $file;
        }
       
    }

    //设置外部路径
    private static function _set_url(){
        $path="http://".$_SERVER['SERVER_NAME']."/".$_SERVER['SCRIPT_NAME'];
        $path= str_replace('\\','/',$path);
        define("__APP__", dirname($path));
        define('__ASSETS__', __APP__."/assets");
        define('__ROOT__', dirname(__APP__));
        define('__VIEW__', __ROOT__."/".APP_NAME."/view");
        define('__PUBLIC__', __VIEW__."/public");
        
    }
    
    //创建demo文件
    private static function _create_demo(){
$str=<<<str
<?php
 //默认首页控制器
                
class IndexController extends Controller{
        
   public function index(){
       echo header("Content-type:text/html;charset=utf-8");
        echo "<body style='background:#fff;'>";
        echo '<h2 style="text-align:center;line-height:550px;font-size:30px;color:#DCDCDC">欢迎使用WYY</h2>';
        echo "</body>";
   } 
}    
   
?>
str;


   is_file(APP_CONTROLLER."/IndexController.php")||file_put_contents(APP_CONTROLLER."/IndexController.php", $str);
   
   is_file(APP_PUBLIC."/success.php")||copy(TPL_PATH."/success.php", APP_PUBLIC."/success.php");
   is_file(APP_PUBLIC."/error.php")||copy(TPL_PATH."/error.php", APP_PUBLIC."/error.php");
    }
    
    private static function _run(){
        if(C('URL')==0){
        $c=  isset($_GET[C('SET_CONTROLLER')])?$_GET[C('SET_CONTROLLER')]:C('DEFAULT_CONTROLLER');
        $a=  isset($_GET[C('SET_ACTION')])?$_GET[C('SET_ACTION')]:C('DEFAULT_FUNCTION');
        }else{
            if(!isset($_SERVER['REDIRECT_URL'])){
               $c=C('DEFAULT_CONTROLLER');
               $a=C('DEFAULT_FUNCTION');
            }else{
               $exp=explode('/', $_SERVER['REDIRECT_URL']);
               $c=$exp[1];
               $a=!isset($exp[2])?C('DEFAULT_FUNCTION'):$exp[2];
            }
        }

          //定义控制器与方法
        define('CONTROLLER_URLs',$c);
        define('ACTION_URL',$a);
        !C("CHECK_URL")||self::check_url($c,$a);
        $c.="Controller";
        if(!class_exists($c)){
          if(!debug){
              //引入404
                $exp=  explode('/', C("ERROR_URL"));
                $c=$exp[0]."Controller";
                  $obj=new $c();
                  $obj->$exp[1]();
          }   
        }else{
        $obj=new $c();
        $obj->$a();    
        }
        
  
    }
    
    
    private static function  check_url($c,$a){
       $url=  include APP_COMMON_CONFIG."/url.php";
       $path="/".$c."/".$a;
       $status=false;
       if(is_array($url)){
           foreach ($url[APP_NAME] as $v){
              if($v['path']==$path){
              return true;
               
              }
           }
          halt("chekc_url页面不存在！请检查配置文件是否开启了url验证");
     
      
       }else{
           halt("chekc_url错误不是一个数组");
       }
    
     die;
    }
    
}

?>