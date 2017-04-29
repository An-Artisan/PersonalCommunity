<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"E:\WebRoot\PersonalCommunity\public/../application/chat\view\index\voice.html";i:1493111882;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>HTML5录制语音并编码base64上传到Apache</title>
    <script src="/static/common/jquery-3.1.1.js"></script>
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
      // // var woker_js = "<?php echo $root; ?>"+'public' + ' <?php echo $ds; ?> ' + 'static' + ' <?php echo $ds; ?>' + 'chat' + ' <?php echo $ds; ?> ' + 'js' + ' <?php echo $ds; ?> ' + 'woker-realtime.js';
      // console.log(woker_js);
    </script>
</head>
<body>
    <h1>HTML5录制语音并编码base64上传到Apache</h1>
    <button onclick="funStart(this);" id="btnStart" disabled>录制</button>
    <button onclick="funUpload(this);" id="btnUpload" disabled>上传</button>
    <h4>调试信息：</h4>
    <div id="recordingslist">
    <!-- <div class="btn-audio" name='bo'><audio id="mp3Btn" ><source src="2017-04-24T10-47-03.508Z.mp3" type="audio/mpeg" /></audio></div>
    <div class="btn-audio" name='bo'><audio><source src="2017-04-24T10-47-03.508Z.mp3" type="audio/mpeg" /></audio></div> -->
    </div>
    <script src="/static/chat/js/recordmp3.js"></script>
    <script src="/static/common/common.js"></script>
    <!-- <script src="/static/chat/js/lame.min.js"></script> -->
    <!-- <script src="/static/chat/js/worker-realtime.js"></script> -->
    <script>
    var voiceController = "<?php echo url('chat/Index/uploadVoice'); ?>";
    console.log(voiceController);
    </script>
    <script src="/static/chat/js/voice.js"></script>
</body>
</html>

