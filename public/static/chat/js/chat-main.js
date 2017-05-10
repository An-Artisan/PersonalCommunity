var ws,layedit,index,current_id,user_list = [],voice_flag = 1;
// 打开页面建立WebSocket链接
connect();
$(".right-bottom").click(function () {
    if(!voice_flag){
      // 提示用户
      layer.msg("当前浏览器不支持语音功能，只能接受语音。请更换Firefox浏览器。或者不使用语音功能");
      // 结束函数
      return false;
    }
    // 开始录音
    recorder.start();
    // 显示正在录音
    $("#noticeVoice").html("<b style='color: #00A000;'>●</b>正在录音...");
    // 发送和取消按钮可用
    $("#cancel").removeAttr("disabled");
    $("#sendVoice").removeAttr("disabled");
    // 隐藏语音按钮
    $(".right-bottom").addClass("dn");
});
$("#cancel").click(function () {
    // 显示录音关闭
    $("#noticeVoice").html("<b style='color: #00A000;'>●</b>录音已关闭");
    // 发送和取消按钮不可用
    $("#cancel").attr("disabled","disabled");
    $("#sendVoice").attr("disabled","disabled");
    // 显示语音按钮
    $(".right-bottom").removeClass("dn");
    // 结束录音
    recorder.stop();
})
//进度条置于最下方
$(document).ready(function(){
  document.getElementById('main_content').scrollTop = document.getElementById('main_content').scrollHeight;
});
layui.use('layedit', function(){
 // 获取编辑器
  layedit = layui.layedit;
  // 设置图片上传的接口 
  layedit.set({
      uploadImage: {
        url: upload_photo //接口url
        ,type: 'post' //默认post
      }
    });
  // 获取编辑器
  layedit = layui.layedit;
  //建立编辑器
  index = layedit.build('demo', {
  height:100,
  tool: [
      'strong' //加粗
      ,'italic' //斜体
      ,'underline' //下划线
      ,'del' //删除线
      ,'|' //分割线
      ,'left' //左对齐
      ,'center' //居中对齐
      ,'right' //右对齐
      ,'link' //超链接
      ,'face' //表情
      ,'image'
    ]
}); 
}); 
//  获取当前url
var str = document.URL;
// 正则匹配当前房间
str = str.match(/home-(\S*).html/)[1];
// 把当前房间的导航设置为active
$("#" + str).addClass('active');
  /**
 * 与GatewayWorker建立websocket连接，域名和端口改为你实际的域名端口，
 * 其中端口为Gateway端口，即start_gateway.php指定的端口。
 * start_gateway.php 中需要指定websocket协议，像这样
 * $gateway = new Gateway(websocket://0.0.0.0:7272);
 */
// 连接服务端
function connect() {
   // 创建websocket
   ws = new WebSocket("ws://www.joker1996.com:8282");
   // 当socket连接打开时，输入用户名
   ws.onopen = onopen;
   // 当有消息时根据消息类型显示不同信息
   ws.onmessage = onmessage;
   // 连接关闭，定时重连 
   ws.onclose = function() {
      console.log("连接关闭，定时重连");
      connect();
   };
   // 连接失败，出现错误
   ws.onerror = function() {
      console.log("出现错误，请稍后再试");
   };
}
// 连接成功
function onopen(){
    console.log("websocket握手成功");
}
// 服务端主动推送消息时会触发这里的onmessage
function onmessage(e){
    // json数据转换成js对象
    var data = eval("("+e.data+")");
    var type = data.type || '';
    switch(type){
        // Events.php中返回的init类型的消息，将client_id发给后台进行uid绑定
        case 'init':
            // 当前的连接id保存。
            current_id = data.client_id;
            // 利用jquery发起ajax请求，将client_id发给后端进行uid绑定
            $.post(bind, {client_id: data.client_id,client_group: str,client_name: $('#username').text(),client_head: $('#user_head').attr("src")}, function(data){}, 'json');
            break;
        case 'receive':
            // 接收远程消息，添加到当前聊天窗口
            receive_message(data);
            break;
        case 'receive_voice':
            // 接受远程语音消息，添加到当前聊天窗口
            receive_voice_message(data);
            break;
        case 'logout':
            // 提示用户有人下线
            layer.msg(data.message);
            // 删除user_list的下线用户
            for (var i = 0; i <= user_list.length; i++) {
            if($.inArray(data.client_id, user_list[i]) != -1){
                    user_list.splice(i,1);
                }
            }
            // 刷新用户列表和选择用户列表
            flush_user_list();
            break;
        case 'other_login':
            // 其他用户登录提示
            layer.msg(data.message);
            // 添加其他登录用户信息到数组
            user_list[user_list.length] = [data.user_info.client_id,data.user_info.nickname,data.user_info.user_head]; 
            // 刷新用户列表
            flush_user_list();
            break;
        case 'login':
            // 提示当前用户
            layer.msg(data.message);
            // 循环获取该房间的所有用户信息
            var i = 0;
            for(var key in data.user_info) { 
                user_list[i++] = [key,data.user_info[key]['nickname'],data.user_info[key]['user_head']];
            }
            // 刷新用户列表
            flush_user_list(); 
            break;
        // 当mvc框架调用GatewayClient发消息时直接alert出来
        default :
       
   
    }
    // 播放音频
    commonNameEvent('div','bo','click',nameSuccessFunction);
    // console.log(e);
};
// 点击发送按钮
$('#send_message').click(function(){
    send_message_local();
    send_message_remote();
});
// 添加本地消息
function send_message_local(){
    // 拼接聊天主区域内容
    var chat_content = '<div class="tal bg-success"><span><img style="border-radius: 50%;"  width="33" src="' + $('#user_head').attr('src')+'" >'+$('#username').text()+'&nbsp;To&nbsp;'+$('#send_list option:selected').text()+'</span><br><br>' + layedit.getContent(index) +'</div>';
    // 添加内容
    $('#main_content').append(chat_content);
    // 内容的滚动条置于最底端
    document.getElementById('main_content').scrollTop = document.getElementById('main_content').scrollHeight;

}   
// 接受远程语音消息
function receive_voice_message(content){
   // 如果当前的client_id相等的话，就不用显示了，因为在本地已经显示过一次
    if(content.sender_id != current_id){
        // 拼接聊天主区域内容
        var chat_content = '<div class="tar bg-info">'+content.sender_name+'&nbsp;To&nbsp;'+content.getter_name+'<span><img style="border-radius: 50%;"  width="33" src="'+ content.sender_head+'"></span><br><br><p style="text-align: left;"><div class="btn-audio" name="bo"><audio id="mp3Btn" ><source src="'+content.message+'" type="audio/mpeg" /></audio></div></p></div>';
        // 添加内容
        $('#main_content').append(chat_content);
        // 内容的滚动条置于最底端
        document.getElementById('main_content').scrollTop = document.getElementById('main_content').scrollHeight;
    }
   
}
// 接收远程消息
function receive_message(content){
    // 如果当前的client_id相等的话，就不用显示了，因为在本地已经显示过一次
    if(content.sender_id != current_id){
        // 拼接聊天主区域内容
        var chat_content = '<div class="tar bg-info">'+content.sender_name+'&nbsp;To&nbsp;'+content.getter_name+'<span><img style="border-radius: 50%;"  width="33" src="'+ content.sender_head+'"></span><br><br><p style="text-align: left;">'+content.message+'</p></div>'
        // 添加内容
        $('#main_content').append(chat_content);
        // 内容的滚动条置于最底端
        document.getElementById('main_content').scrollTop = document.getElementById('main_content').scrollHeight;
    }
}
// 发送远程消息
function send_message_remote(){
    // 实例化formData对象
    var formData = new FormData();
    // 追加数据到formData中
    formData.append('to_client_id',$('#send_list option:selected').val());
    formData.append('to_client_name',$('#send_list option:selected').text());
    formData.append('client_name',$('#username').text());
    formData.append('user_head',$('#user_head').attr("src"));
    formData.append('content',layedit.getContent(index));
    formData.append('group',str);
    formData.append('current_id',current_id);
    // 发起ajax请求
    formDataAjax('post',send_message,ajaxSuccessFunction,formData,'json');
    // 重新绑定编辑器
    index = layedit.build('demo', {
      height:100,
      tool: [
          'strong' //加粗
          ,'italic' //斜体
          ,'underline' //下划线
          ,'del' //删除线
          ,'|' //分割线
          ,'left' //左对齐
          ,'center' //居中对齐
          ,'right' //右对齐
          ,'link' //超链接
          ,'face' //表情
          ,'image'
        ]
    }); 
    }
// ajax回调函数
function ajaxSuccessFunction(json,id){
  
}
// 刷新用户列表
function flush_user_list(){
    // 获取用户列表节点
    var userlist_window = $("#user_list");
    // 用户用户选择列表节点
    var client_list_slelect = $("#send_list");
    // 清空左边用户列表
    userlist_window.empty();
    // 清空选择用户列表
    client_list_slelect.empty();
    // 添加选择用户列表 “所有人”
    client_list_slelect.append('<option value="all" id="cli_all">所有人</option>');
    // 添加左边用户列表和用户选择列表
    for (var i = 0; i < user_list.length; i++) {
         userlist_window.append('<li role="presentation"><a aria-controls="home" role="tab" data-toggle="tab"><img width="40" style="border-radius: 50%;" src="'+user_list[i][2]+'" />&nbsp;&nbsp;'+user_list[i][1]+'</a></li>');
         client_list_slelect.append('<option value="'+user_list[i][0]+'">'+user_list[i][1]+'</option>');
    }
    
}
// =====语音发送=====
// 语音播放
commonNameEvent('div','bo','click',nameSuccessFunction);
// 切换音频的图标，停止图标
function nameSuccessFunction(e){
    // 当音频停止后执行
    $($(e).children('audio').get(0)).on('ended', function() {
    console.log("音频已播放完成");
    // 切换停止图标
    $(e).css({'background':'url("/static/chat/img/voice_stop.png") no-repeat center bottom','background-size':'cover'});
    })
    // 播放音频
    voice(e,$(e).children('audio'));
}
function voice(element,elementChildren){
    // 获取音频节点
    var audio = elementChildren.get(0);
    // event.stopPropagation();//防止冒泡
    if(audio.paused){ //如果当前是暂停状态
        // 切换播放图标
        $(element).css({'background':'url("/static/chat/img/voice_play.png") no-repeat center bottom','background-size':'cover'});
        audio.play(); //播放
        return;
    }else
    {     
        //当前是播放状态 切换停止图标
        $(element).css({'background':'url("/static/chat/img/voice_stop.png") no-repeat center bottom','background-size':'cover'});
        audio.pause(); //暂停 
    }
};
// 实例化录音类
var recorder = new MP3Recorder({
    debug:true,
    funOk: function () {
        // btnStart.disabled = false;
        // log('初始化成功');
    },
    funCancel: function (msg) {
        // 打印console
        console.log(msg);
        // 置于空
        recorder = null;
        // 设置录音不可用
        voice_flag = 0;
    }
});

$('#sendVoice').on('click',funUpload);
function funUpload() {
    // 发送的时候录音停止
    recorder.stop();
    // 发送按钮和取消按钮置于不可用
    $("#sendVoice").attr("disabled","disabled");
    $("#cancel").attr("disabled","disabled");
    // 显示录音图标
    $(".right-bottom").removeClass("dn");
    // 获取录音信息
    recorder.getMp3Blob(function (blob) {
        // 创建播放的url
        var url = URL.createObjectURL(blob);
        // 拼接音频的聊天记录样式
        var chat_content = '<div class="tal bg-success"><span><img style="border-radius: 50%;"  width="33" src="' + $('#user_head').attr('src')+'" >'+$('#username').text()+'&nbsp;To&nbsp;'+$('#send_list option:selected').text()+'</span><br><br><div class="btn-audio" name="bo"><audio id="mp3Btn" ><source src="'+url+'" type="audio/mpeg" /></audio></div></div>';
        // 添加至聊天主区域
        $('#main_content').append(chat_content);
        // 实例化FileReader
        var reader = new FileReader();
        // 实例化formdata
        var fd = new FormData();
        // 编码语音为base64
        reader.readAsDataURL(blob);
        // 当编码完成后上传ajax
        reader.onload = function () {
            // 追加数据到formData中
            fd.append('to_client_id',$('#send_list option:selected').val());
            fd.append('to_client_name',$('#send_list option:selected').text());
            fd.append('client_name',$('#username').text());
            fd.append('user_head',$('#user_head').attr("src"));
            fd.append('content',reader.result);
            fd.append('group',str);
            fd.append('current_id',current_id);
            // 提交ajax
            formDataAjax('post',voiceController,voiceAjaxSuccessFunction,fd,'json');
           
        };
       
    });
}
function voiceAjaxSuccessFunction(json,id){
   
}
