<?php
namespace app\admin\controller;
use app\index\model\Album;
use app\index\model\Administrator;
use app\blog\model\Photos;
use think\Controller;
use think\View;
use think\Request;
use think\Url;
use think\Session;
class Index extends Controller
{	
	// 返回登录视图
    public function login(){
    	// 实例化视图类	
		$view = new View();
		// 渲染模板输出 并赋值SEO的标题，关键字，描述等模板变量
		$view->title = '后台登录界面-刘强个人社区后台登录';
		$view->keywords = '后台登录,后台管理,后管管理登录界面';
		$view->desc = "刘强个人社区后台登录界面，用于管理整个社区";
        // 返回视图
		return $view->fetch('admin/login');
    }
    public function logout(){
    	// 删除session
    	Session::delete('username');
    	// 重定向到登录页面
    	$this->redirect('/login.html');
    }
    public function verify(){
    	// 实例化模型
    	$admin = new Administrator();
    	// 获取信息
    	$info = $admin->select();
    	// 判断是否登录成功
    	if(((Request::instance()->param('username')) == ($info[0]->a_username)) && ((Request::instance()->param('password'))== ($info[0]->a_password))){
            // 用户名和密码相等就设置session标识
    		Session::set('username',$info[0]->a_username);
            // 跳转到后台界面
    		$this->success("登录成功！",'/admin.html');
    	}
    	else{
            // 验证失败提示，返回前一个页面
    		$this->error("登录密码错误，请重新登录！");
    	}
    }
    // 返回后台主页视图
    public function index (){	
    	// 实例化视图类	
		$view = new View();
		// 实例化common类
		$common = new Common();
		// 验证是否登录
		$common->middleware();
		// 获取相册的总数
		$view->album_count = $common->alubmCount();
		// 获取照片总数
		$view->photos_count = $common->photosCount();
		// 获取留言总数
		$view->message_count = $common->messageCount();
		// 获取博客文章总数
		$view->article_count = $common->articleCount();
		// 获取博客分类总数
		$view->category_count = $common->categoryCount();
		// 渲染模板输出 并赋值模板变量
		return $view->fetch('admin/index');
    }
    public function clearPhotos(){
        // 定义文章图片目录
        $path = ROOT_PATH . 'public' . DS . 'static' . DS . 'blog' . DS . 'articleImages';
        // 实例化表模型
        $photos = new Photos();
        // 查询所有的图片
        $allPhotos = $photos->select();
        // 设置一个数组
        $tablePhoto = [];
        // 吧所有的图片放进数组
        foreach ($allPhotos as   $value) {
            $tablePhoto[] = $value->pho_filename;
        }
        // 清楚图片冗余
        if(recursionSeekFiles($tablePhoto,$path))
            return json(["message"=>"清楚冗余图片成功！","ico"=>1]);
        return json(["message"=>"清楚冗余图片失败，请稍后再试！","ico"=>5]);
    }

    
}
