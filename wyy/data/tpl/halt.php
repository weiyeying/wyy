
<html>
    <head>
        <title>ERROR-DEBUG</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            *{padding: 0px;margin: 0px;font-family: "微软雅黑"}
            .headers{background: #ccc;height: 250px;width: 100%;}
            .title{font-size: 30px;color: #E57373;padding: 50px;}
            .title2{font-size: 24px;margin: 0 auto;padding-left: 50px;}
            .title3{font-size: 20px;color: #E57373;padding: 20px;}
            .bodd{background: #EDF9FF;line-height: 40px;height: 50%;padding-left: 1em;padding-top: 1em;}
        </style>
    </head>
    <body>
        <div class="headers">
        <div class="title"><?php echo $arr['msg']." &nbsp;"?></div>
        <div class="title2">
           <?php echo  "文件：".$arr['file']." &nbsp; ".$arr['function']." &nbsp;行号 ".$arr['line'];?> 
        </div>
        </div>
        <div class="bodd">
                <?php echo nl2br($arr['trace']) ;?> 
        </div>
        <div class="title3">@WYY框架 &nbsp; &nbsp; &nbsp;<?php echo date("Y-m-d h:i:s",time());?></div>
    </body>
</html>
