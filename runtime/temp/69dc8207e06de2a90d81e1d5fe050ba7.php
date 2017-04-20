<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"E:\WebRoot\PersonalCommunity\thinkphp\tpl\dispatch_jump.tpl";i:1492268298;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>跳转提示</title>
  <!--jquery-->
  <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js";></script>
  <!--Bootstrap-->
  <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"; rel="stylesheet">
  <!--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries-->
  <!--WARNING:Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js";></script>
  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js";></script>
  <![endif]-->
  <style type="text/css">
 *{ padding: 0; margin: 0; }
 body{ background: #fff; font-family: '微软雅黑'; color: #CCC; font-size: 16px; }
 .system-message{ padding: 24px 48px; margin:auto; border: #CCC 3px solid; top:50%; width:500px; border-radius:10px;
     -moz-border-radius:10px; /* Old Firefox */}
 .system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 5px; }
 .system-message .jump{ padding-top: 10px; color: #999;}
 .system-message .success,.system-message .error{ line-height: 1.8em;  color: #999; font-size: 36px; font-family: '黑体'; }
 .system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
 </style>
 <script type="text/javascript">
 $(function(){
     var height2=$('.system-message').height();
     var height1=$(window).height();
     $('.system-message').css('margin-top',((height1-height2)/2)-30);
 });
 </script>
</head>
<body role="document">
  <!-- 正文内容 -->
 <div class="system-message">
<?php switch ($code) {case 1:?>
 <h1 class="glyphicon glyphicon-ok-circle" style="color:#09F"></h1>
 <p class="success"><?php echo(strip_tags($msg));?></p>
<?php break;case 0:?>
 <h1 class="glyphicon glyphicon-exclamation-sign" style="color:#F33"></h1>
 <p class="error"><?php echo(strip_tags($msg));?></p>
<?php break;} ?>
 <p class="detail"></p>
 <p class="jump">
页面自动 <a id="href" class="text-primary" href="<?php echo($url);?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait);?></b>
 </p>
 </div>
 <script type="text/javascript">
 (function(){
 var wait = document.getElementById('wait'),href = document.getElementById('href').href;
 var interval = setInterval(function(){
     var time = --wait.innerHTML;
     if(time <= 0) {
         location.href = href;
         clearInterval(interval);
     };
 }, 1000);
 })();
 </script>
  <!-- 正文内容 -->
</body>
</html>