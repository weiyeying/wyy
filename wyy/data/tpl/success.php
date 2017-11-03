<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title;?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo __ASSETS__; ?>/bootstrap-3.3.7/css/bootstrap.min.css">
       <style>
            *{font-family: "微软雅黑";}
            .center{width: 40%;margin: 0 auto;margin-top: 150px;height: 200px;background: #37A6EC;padding-top: 30px;}
            .center_title{text-align: center;font-size:20px;}
            .center_data{height: 60px;line-height: 60px;text-align: center;}
            .center_boot{text-align: center;}
            .center_boot>a{display: inline-block;margin-left: 20px;}
        </style>
    </head>
    <body>
        <div class="center">
            <div  class="center_title">温馨提示：success</div>
            <div class="center_data"><?php echo $msg;?></div>
            <div  class="center_boot"><a href="###" onclick="history.go(-1)"><div class="btn btn-primary">返回上一页</div></a><a href="<?php echo $url;?>"><div class="btn btn-primary">返回首页</div></a></div>
          
        </div>
        
  
    </body>
</html>
