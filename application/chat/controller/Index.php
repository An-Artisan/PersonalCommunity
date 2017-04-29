<?php
namespace app\chat\controller;
use app\chat\model\User;
use think\Controller;
use think\View;
use think\Validate;
use think\Image;
use think\Request;
use think\Db;
use think\Session;
use org\util\Gateway;
// use GatewayClient\Gateway;
// require_once 'Gateway.php';
class Index extends Controller
{
	public function index (){
    	// 实例化视图
		$view = new View();
        // 返回视图
		return $view->fetch('index');

    }
    public function register(){
        // 实例化视图
        $view = new View();
        // 返回视图
        return $view->fetch('register');
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
    public function verifyUserInfo(){
        // 获取所有post内容
        $data = input('post.');
        // 实例化模型
        $user = new User();
        // 查询用户名数据
        $username = $user->where('username', $data['username'])
            ->find();
        // 如果不存在用户名则跳转到登录页面
        if(is_null($username)){
            // 验证失败提示，返回前一个页面
            $this->error("用户名不存在，请重新登录！");
        }
        if(password_verify($data['password'],$username->password)){
            echo "登录成功";
        }else{
            // 验证失败提示，返回前一个页面
            $this->error("密码错误，请重新登录！");
        }

    }
    public function registerVerifyUserName(){
        // 获取用户输入的用户名
        $username = Request::instance()->param('username');
        // 实例化User表模型
        $user = new User();
        // 查询用户名是否存在
        $verify = $user->where('username', $username)->find();
        // 存在数据表示用户名已经被注册
        if(!is_null($verify)){
            return json(["flag"=>0,"message"=>"用户名已存在，请重新输入！"]);
        }
        // 返回没有注册的标记
        return json(["flag"=>1]);
    }   
    public function registerController(Request $request){
        // 获取所有post内容
        $data = input('post.');
        // 用户没有上传头像就用默认的头像
        if ($_FILES['pic']['error'] !== 4) {
            // 获取文件对象
            $files = $request->file('pic');
            // 获得处理图片句柄
            $image = \think\Image::open($files);
            // 缩略图 thumb(最大宽度,最大高度,裁剪类型) 1代表等比例裁剪
            $image->thumb(50, 50, 1); 
            // 以当前时间命名
            $saveName = $request->time() . rand(1000,9999) . '.png';
            // 保存到指定路径
            $thumb = $image->save(ROOT_PATH . 'public' . DS . 'static' . DS . 'chat' . DS . 'userImages' . DS . $saveName);
            // 返回值的地址赋值给user_head
            $user_head = DS . 'static' . DS . 'chat' . DS . 'userImages' . DS . $saveName;
        }else{
            $user_head = DS . 'static' . DS . 'chat' . DS . 'userImages' . DS . "default.jpg";
        }
        $user = new User;
        $user->username  = $data['username'];
        /*
            进行密码加密 (60个字符以上的长度)
            这里采用的是Password Hashing API 加密，模式是默认，
            默认的模式是Bcrypt。单独的Bcrypt加密不太好，所以Password Hashing API结合了传统的加密进行改良。传统的MD5加密安全性不是很好，
            已经被大多数人所知。许多框架就是使用这种方法加密比如:laravel
        */
        $user->password  = password_hash($data['password'], PASSWORD_DEFAULT);  
        $user->nickname  = $data['nickname'];
        $user->user_head = $user_head;
        // 成功注册跳转到登录界面
        if($user->save()){
            $this->success("注册成功！正在为你跳转登录界面......",'chat/index/login');
        }

    }
    public function uploadVoice(){
        // require_once 'Gateway.php';
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
        Gateway::$registerAddress = '127.0.0.1:1236';
        $client_id = Request::instance()->param('client_id');
        // Session::set('uid',Request::instance()->param('client_id'));
    	// Session::set(Request::instance()->param('client_id'),'liu');
        Gateway::setSession(Request::instance()->param('client_id'), array('group' => 'liu'));
        // $_SESSION[$client_id] = $client_id;
        // var_dump($_SESSION[$client_id]);
        // echo $_SESSION['haha'];
        Gateway::joinGroup(Request::instance()->param('client_id'), 'liu');
    }
    public function sendMessage(){
        // require_once 'Gateway.php';
        // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值
        Gateway::$registerAddress = '127.0.0.1:1236';
        // 向任意uid的网站页面发送数据
        $uid = Session::get('uid');

        Gateway::sendToClient($uid, json_encode(array(
                    'type'      => 'send',
                    'message' => "hello"
                )));
        // Gateway::sendToAll(json_encode(array(
        //             'message'      => '你好啊'
        //         )));

        echo 'ok';
        }

}