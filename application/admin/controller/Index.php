<?php
namespace app\admin\controller;
use app\index\model\Album;
use think\Controller;
use think\View;
use think\Request;
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
		return $view->fetch('admin/login');
    }
    // 返回后台主页视图
    public function index (){	
    	// 实例化视图类	
		$view = new View();
		// $view->title = '牛逼！！！';
		// $view->desc = "我是描述";
		// 实例化common类
		$common = new Common();
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
    
}
