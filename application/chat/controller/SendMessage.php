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
class SendMessage extends Controller
{
 public function sendMessage(){
        // 添加注册中心地址
        Gateway::$registerAddress = '127.0.0.1:1236';
        // 获取消息
        $data = input('post.');
        // 不等于all代表是发送单聊信息
        if($data['to_client_id'] != 'all'){
            // 发送消息，[内容，昵称，头像，时间]
            Gateway::sendToClient($data['to_client_id'],json_encode(array(
                    'type' => 'receive',
                    'message' => $data['content'],
                    'sender_name' => $data['client_name'],
                    'getter_name' => $data['to_client_name'],
                    'sender_head' => $data['user_head'],
                    'send_time' => date('Y-m-d H:i:s')
                    
                )));
        }else{
            // 发送给当前分组的所有用户
            Gateway::sendToGroup($data['group'],json_encode(array(
                    'type' => 'receive',
                    'message' => $data['content'],
                    'sender_name' => $data['client_name'],
                    'getter_name' => $data['to_client_name'],
                    'sender_head' => $data['user_head'],
                    'send_time' => date('Y-m-d H:i:s'),
                    'sender_id' => $data['current_id']
                )));
        }
        
    }
    public function uploadPhoto(Request $request){
        // 获取文件信息
        $files = $request->file('file');
        // 获取处理图片类
        $image = \think\Image::open($files);
        // 缩略图 thumb(最大宽度,最大高度,裁剪类型) 1代表等比例裁剪
        $image->thumb(2000, 2000, 1); 
        // 以当前时间命名水印
        $saveName = $request->time() . '.png';
        // 定义聊天图片地址
        $chatImages = ROOT_PATH . 'public' . DS . 'static' . DS . 'chat' . DS . 'chatImages' . DS;
        // 判断是否存在当前日期的文件夹，不存在则创建
        if (!is_dir( $chatImages.date('Y-m-d',time()))){ 
            // 创建以当前日期命名的文件夹，并且给0777 可读可执行可修改权限
            mkdir($chatImages.date('Y-m-d',time()), 0777); // 使用最大权限0777创建文件
            chmod($chatImages.date('Y-m-d',time()),0777); // 使用最大权限0777创建文件
        }
        // 保存到指定路径
        $thumb = $image->save($chatImages.date('Y-m-d',time()). DS .$saveName);
        // 返回图片路径
        $path = DS . 'static' . DS . 'chat' . DS . 'chatImages' . DS . date('Y-m-d',time()).DS .$saveName;
        // 转义反斜线
        $path = addslashes($path);
        // 保存成功就返回图片地址
        if($thumb){
            /*
                返回图片的json格式为
                {
                  "code": 0 //0表示成功，其它失败
                  ,"msg": "" //提示信息 //一般上传失败后返回
                  ,"data": {
                    "src": "图片路径"
                    ,"title": "图片名称" //可选
                  }
                }
            */
            return '{  "code": 0 ,"msg": "上传成功","data": {    "src": "' . $path. '","title": "'.$saveName.'"}}';
        }
        return '{  "code": 1 ,"msg": "上传失败"}';
    }

}

 ?>