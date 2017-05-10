<?php 
namespace app\chat\controller;
use app\chat\model\User;
use app\chat\model\Group;
use think\Controller;
use think\View;
use think\Validate;
use think\Image;
use think\Request;
use think\Db;
use think\Session;
use org\util\Gateway;
class SendVoiceMessage extends Controller
{
    public function sendVoiceMessage(){
        // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值
        Gateway::$registerAddress = '127.0.0.1:1236';
        // 获取消息
        $data = input('post.');
        // 不等于all代表是发送单聊信息
        if($data['to_client_id'] != 'all'){
            // 发送消息，[内容，昵称，头像，时间]
            Gateway::sendToClient($data['to_client_id'],json_encode(array(
                    'type' => 'receive_voice',
                    'message' => $data['content'],
                    'sender_name' => $data['client_name'],
                    'getter_name' => $data['to_client_name'],
                    'sender_head' => $data['user_head'],
                    'send_time' => date('Y-m-d H:i:s')
                    
                )));
        }else{
            // 发送给当前分组的所有用户
            Gateway::sendToGroup($data['group'],json_encode(array(
                    'type' => 'receive_voice',
                    'message' => $data['content'],
                    'sender_name' => $data['client_name'],
                    'getter_name' => $data['to_client_name'],
                    'sender_head' => $data['user_head'],
                    'send_time' => date('Y-m-d H:i:s'),
                    'sender_id' => $data['current_id']
                )));
        }
    }

}

 ?>