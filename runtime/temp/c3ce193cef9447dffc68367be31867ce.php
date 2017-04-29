<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"E:\WebRoot\PersonalCommunity\public/../application/chat\view\index\tencentCallback.html";i:1493450794;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>发送access_token</title>
</head>
<body>
  <script> 
      //获取access token
      var accessToken = window.location.hash.substring(1);
      // 跳转到tp5控制器
      window.location.href='http://www.joker1996.com/getTencentAppId.html?'+accessToken;  
   </script>
</body>
</html>