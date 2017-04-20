<?php
namespace app\blog\controller;
use app\blog\model\Article;
use app\blog\model\Category;
use app\blog\model\Photos;
use app\blog\model\Timeline;
use app\index\model\Administrator;
use app\admin\model\Seo;
use think\Controller;
use think\View;
use think\Validate;
use think\Image;
use think\Request;
use think\Db;

class Index extends Controller
{
    public function index (){
    	// 实例化模型
    	$category = new Category(); 
    	// 查询所有分类
    	$allCategory = $category->select();
        // 实例化模型
        $article = new Article();
        // 查询点击率最高的4篇文章
        $maxView = $article->field('art_title,art_id')->order('art_view desc')->limit(4)->select();
        // 查询所有文章
        $allArticle = $article->order('art_id desc')->paginate(5);
        // 实例化模型
        $admin = new Administrator();
        // 查询管理员数据
        $joker = $admin->select();
        // 实例化模型
        $seo = new Seo();
        // 查询个人博客的seo数据
        $seoData = $seo->where('a_alias','blog')->select();
    	// 实例化视图
		$view = new View();
        // 赋值seo信息
        $view->title = $seoData[0]->a_title;
        $view->keywords = $seoData[0]->a_keywords;
        $view->desc = $seoData[0]->a_desc;
        $view->author = $seoData[0]->a_author;
		// 渲染模板输出
		return $view->fetch('index',["allCategory"=>$allCategory,"allArticle"=>$allArticle,"maxView"=>$maxView,"joker"=>$joker]);
    }
    public function categoryArticle(){
        // 获取分类id
        $id = Request::instance()->param('id');
        // 实例化模型
        $article = new Article();
        // 获取分类id下的文章 5条记录
        $categoryArticle = $article->where('cate_id',$id)->paginate(5);
        // 实例化模型
        $category = new Category(); 
        // 查询所有分类
        $allCategory = $category->select();
        // 实例化视图
        $view = new View();
        // 渲染模板输出
        return $view->fetch('category',["categoryArticle"=>$categoryArticle,"allCategory"=>$allCategory,"id"=>$id]);
    }
    public function readArticle(){
        // 获取文章id
        $id = Request::instance()->param('id');
        // 获得该id的文章数据
        $view = Article::get($id);
        // 浏览量加1
        $view->art_view += 1;
        // 保存
        $view->save();
        // 获取该id的文章内容
        $articleDetails = Article::get($id);
        // 实例化模型
        $category = new Category(); 
        // 查询所有分类
        $allCategory = $category->select();
        // 实例化模型
        $article = new Article();
        // 获取下一条文章
        $next = $article->where('art_id','<',$id)->field('art_title,art_id')->limit(1)->select();
        // 获取下一条文章
        $prev = $article->where('art_id','>',$id)->field('art_title,art_id')->limit(1)->select();
        // 实例化模型
        $admin = new Administrator();
        // 查询管理员数据
        $joker = $admin->select();
        // 实例化视图
        $view = new View();
        // 获取介绍信息
        $view->introduce = $joker[0]->a_introduce;
        // 赋值版权信息
        $view->copyright = $joker[0]->a_copyright;
        // 头像信息
        $view->photo = $joker[0]->a_photo;
        // 渲染模板输出
        return $view->fetch('article',["articleDetails"=>$articleDetails,"allCategory"=>$allCategory,"next"=>$next,"prev"=>$prev]);
        
    }
   
}
