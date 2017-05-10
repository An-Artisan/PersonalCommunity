<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"E:\WebRoot\PersonalCommunity\public/../application/chat\view\index\index.html";i:1494409144;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <script src="/static/common/jquery-3.1.1.js"></script>
    <script src="/static/chat/js/recordmp3.js"></script>
    <script src="/static/common/common.js"></script>
    <meta charset="utf-8" />
    <style>
   .btn-audio{
    /*margin: 90px auto;*/
    width: 50px;
    height: 50px;
    background:url('/static/chat/img/voice_stop.png') no-repeat center bottom;
    background-size:cover;
}
    </style>
    <script>

  </script>
</head>
<body>
    <h1>Chat</h1>
    <button onclick="funStart(this);" id="btnStart" disabled>录制</button>
    <button onclick="funUpload(this);" id="btnUpload" disabled>上传</button>
    <h4>调试信息：</h4>
    <div id="recordingslist">
    <!-- <div class="btn-audio" name='bo'><audio id="mp3Btn" ><source src="2017-04-24T10-47-03.508Z.mp3" type="audio/mpeg" /></audio></div>
    <div class="btn-audio" name='bo'><audio><source src="2017-04-24T10-47-03.508Z.mp3" type="audio/mpeg" /></audio></div> -->
    </div>
   
    <!-- <script src="/static/chat/js/lame.min.js"></script> -->
    <!-- <script src="/static/chat/js/worker-realtime.js"></script> -->
    <script>

    var bind = "<?php echo url('chat/Index/bind'); ?>";
    </script>
    <script src="/static/chat/js/chat-voice.js"></script>
</body>
</html>

