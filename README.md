                                                                
                                                                wyy框架
  
 #简介

wyy框架是一个简单快速小巧的php框架，框架以至简为目标初始不依赖任何组件

框架遵循mvc设计模式自动生成相应目录，项目清晰明了没有那么多乱七八糟的东西

1：创建web应用模块
          创建入口文件并访问这样就成功创建一个web应用
          define("debug",false);
          define("APP_NAME", "Index");
          require './wyy/wyy.php';
          
          

2:框架执行流程:

大道至简 目前框架执行以下文件 简约是我一贯的终止！

 "C:\www\WWW\wyy\git\index.php"
 "C:\www\WWW\wyy\git\wyy\wyy.php"
 "C:\www\WWW\wyy\git\temp\~boot.php"
 "C:\www\WWW\wyy\git\wyy\config\config.php"
 "C:\www\WWW\wyy\git\common\config\config.php"
 "C:\www\WWW\wyy\git\Index\config\config.php"
 "C:\www\WWW\wyy\git\common\config\url.php"
 "C:\www\WWW\wyy\git\Index\controller\IndexController.php"
 
 
3:框架数据模型：

原生sql随意查询




