<?php
 //默认首页控制器
                
class IndexController extends Controller{
        
   public function index(){
$included_files = get_included_files();
var_dump($included_files);die;
   $sql="select * from  users where id=1 ";  
   $r=  $this->db($sql)->queryAll();
    var_dump($r);die;
   } 
   
   public function add(){
       echo 404;
   }
}    
   
?>