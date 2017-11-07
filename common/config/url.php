<?php
/* 
 * url组件
 * 配置文件中开启是否启用此组件
 * 启用后只有配置在此组件中的路由才可访问
 */
return array(
    'Index'=>array(
        array('path'=>"/index/index"),  
        array('path'=>"/index/add"),  
        array('path'=>"/index/aee"),  
    ),
    'Admin'=>array(
      array('path'=>"/index/add"),   
    ),
    'Api'=>array(
       array('path'=>"/index/add"),     
    ),
);


