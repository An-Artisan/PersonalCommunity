  /**
 * 与GatewayWorker建立websocket连接，域名和端口改为你实际的域名端口，
 * 其中端口为Gateway端口，即start_gateway.php指定的端口。
 * start_gateway.php 中需要指定websocket协议，像这样
 * $gateway = new Gateway(websocket://0.0.0.0:7272);
 */
ws = new WebSocket("ws://www.joker1996.com:8282");
// 服务端主动推送消息时会触发这里的onmessage
ws.onmessage = function(e){
    // json数据转换成js对象
    var data = eval("("+e.data+")");
    var type = data.type || '';
    switch(type){
        // Events.php中返回的init类型的消息，将client_id发给后台进行uid绑定
        case 'init':
            // 利用jquery发起ajax请求，将client_id发给后端进行uid绑定
            $.post(bind, {client_id: data.client_id}, function(data){}, 'json');
            console.log(data.client_id);
            break;
        case 'logout':
            console.log(e);
            break;
        // 当mvc框架调用GatewayClient发消息时直接alert出来
        default :
           //  var voice = '<div class="btn-audio" name="bo"><audio><source src="'+data.message+'" type="audio/mpeg" /></audio></div>';
           // $('#recordingslist').append(voice);
           var div = document.createElement('div');
           var audio = document.createElement('audio');
           var source = document.createElement('source');
           $(div).addClass('btn-audio');
           $(div).attr('name','bo');
           $(source).attr('src',data.message);
           $(source).attr('type','audio/mpeg');
           audio.appendChild(source);
           div.appendChild(audio);
           $('#recordingslist').append(div);
   
    }
     commonNameEvent('div','bo','click',nameSuccessFunction);

    // console.log(e);
};

  // commonNameEvent('div','bo','click',nameSuccessFunction);
    function nameSuccessFunction(e){
         $($(e).children('audio').get(0)).on('ended', function() {
            console.log("音频已播放完成");
            $(e).css({'background':'url("/static/chat/img/voice_stop.png") no-repeat center bottom','background-size':'cover'});
        })
        voice(e,$(e).children('audio'));
    }
  function voice(element,elementChildren){
        var audio = elementChildren.get(0);
            // event.stopPropagation();//防止冒泡
            if(audio.paused){ //如果当前是暂停状态
                $(element).css({'background':'url("/static/chat/img/voice_play.png") no-repeat center bottom','background-size':'cover'});
                audio.play(); //播放
                return;
            }else
            {     
                //当前是播放状态
                $(element).css({'background':'url("/static/chat/img/voice_stop.png") no-repeat center bottom','background-size':'cover'});
                audio.pause(); //暂停 
            }
    };
        var recorder = new MP3Recorder({
            debug:true,
            funOk: function () {
                btnStart.disabled = false;
                // log('初始化成功');
            },
            funCancel: function (msg) {
                console.log(msg);
                recorder = null;
            }
        });
        var mp3Blob;


        function funStart(button) {
            btnStart.disabled = true;
            // btnStop.disabled = false;
            btnUpload.disabled = false;
            // log('录音开始...');
            recorder.start();
        }
        function funUpload() {
            recorder.stop();
            btnStart.disabled = false;
            btnUpload.disabled = true;
            recorder.getMp3Blob(function (blob) {
                var url = URL.createObjectURL(blob);
                var div = document.createElement('div');
                var audio = document.createElement('audio');
                var source = document.createElement('source');
                $(div).addClass('btn-audio');
                $(div).attr('name','bo');
                $(source).attr('src',url);
                $(source).attr('type','audio/mpeg');
                audio.appendChild(source);
                div.appendChild(audio);
                $('#recordingslist').append(div);
                var reader = new FileReader();
                var fd = new FormData();
                reader.readAsDataURL(blob);
                reader.onload = function () {
                    fd.append('file', reader.result);
                    formDataAjax('post',voiceController,ajaxSuccessFunction,fd,'json');
                };
            });
            commonNameEvent('div','bo','click',nameSuccessFunction);
          
        }
        function ajaxSuccessFunction(json,id){
            // $('#recordingslist').append(json.message);
        }