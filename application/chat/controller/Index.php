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
class Index extends Controller
{
	public function index (){
    	// 实例化视图
		$view = new View();
        // 返回视图
		return $view->fetch('index');

    }
    public function chatRoom (){
        // 如果不存在session就跳转
        if(!Session::has('username')){
            $this->error("请先登录！",'chat/index/login');
        }
        // 实例化视图
        $view = new View();
        // 返回视图
        return $view->fetch('home');
    }
    
    public function login(){
        // 实例化视图
        $view = new View();
        // 返回视图
        return $view->fetch('login');
    }
    public function voice (){
        // 实例化视图
        $view = new View();
        return $view->fetch('voice',['root'=>ROOT_PATH,'ds' => DS]);
        
    }
    
    public function uploadVoice(){
        // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值
        Gateway::$registerAddress = '127.0.0.1:1236';
        // 向任意uid的网站页面发送数据
        $uid = Session::get('uid');
        // 给当前客户端发送消息
        Gateway::sendToClient($uid, json_encode(array(
                    'type'      => 'send',
                    'message' => $_POST['file']
                )));
  
    }
    public function bind(){
        // 获取所有post内容
        $data = input('post.');
        // 添加注册中心地址
        Gateway::$registerAddress = '127.0.0.1:1236';
        // 实例化分组模型表
        $group = new Group;
        // 添加分组到数据库
        $group->g_name  = $data['client_group'];
        // 添加uid到数据库
        $group->g_uid  = $data['client_id'];
        // 添加昵称到数据库
        $group->g_nickname = $data['client_name'];
        // 新增数据
        $group->save();
        // 当前用户信息
        $current_info = array('client_id'=>$data['client_id'],'nickname' => $data['client_name'], 'user_head' => $data['client_head']);
        // 通知该房间所有用户，当前用户加入房间，并传值该用户信息
        Gateway::sendToGroup($data['client_group'],json_encode(array(
                    'type'      => 'other_login',
                    'message' => $data['client_name'] . "加入该房间",
                    'user_info' => $current_info
                )));
        // 添加当前用户到指定分组
        Gateway::joinGroup($data['client_id'], $data['client_group']);
        // 添加该client_id的信息，用于前端显示所有用户
        Gateway::setSession($data['client_id'], array('nickname'=>$data['client_name'], 'user_head'=>$data['client_head']));
        // 获取该分组的所有用户信息
        $group_info = Gateway::getClientSessionsByGroup($data['client_group']);
        // 通知当前用户刷新该房间的用户信息
        Gateway::sendToClient($data['client_id'], json_encode(array(
                    'type'      => 'login',
                    'message' => "你已经加入" .$data['client_group']."该房间",
                    'user_info' => $group_info
                )));

      
        
    }
   
}