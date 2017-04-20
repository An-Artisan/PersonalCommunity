<?php 
namespace app\admin\controller;
use app\index\model\Album;
use app\index\model\Photos;
use app\index\model\Message;
use app\blog\model\Article;
use app\blog\model\Category;
use think\Controller;
use think\View;
use think\Request;
use think\Session;
class Common extends Controller
{	
	/**
	 * 获取相册总数
	 * @Author   不敢为天下
	 * @DateTime 2017-04-09T16:02:04+0800
	 * @return   int                   返回相册总数
	 */
	public function alubmCount(){
		// 实例化模型
		$album = new Album();
		// 获取有多少相册
		return  $album->count('a_id');
	}
	/**
	 * 获取照片总数
	 * @Author   不敢为天下
	 * @DateTime 2017-04-09T16:05:00+0800
	 * @return   int                   返回照片总数
	 */
	public function photosCount(){
		// 实例化模型
		$photos = new Photos();
		// 获取有多少照片
		return  $photos->count('p_id');
	}
	/**
	 * 获取留言总数
	 * @Author   不敢为天下
	 * @DateTime 2017-04-09T16:05:28+0800
	 * @return   int                    返回留言总数
	 */
	public function messageCount(){
		// 实例化模型
		$message = new Message();
		// 获取留言总数
		return $message->count('m_id');
	}
	/**
	 * 获取文章的总数
	 * @Author   不敢为天下
	 * @DateTime 2017-04-12T22:21:40+0800
	 * @return   int                   返回博客文章总数
	 */
	public function articleCount(){
		// 实例化模型
		$article = new Article();
		// 获取博客文章总数
		return $article->count('art_id');
	}
	/**
	 * 获取博客分类总数
	 * @Author   不敢为天下
	 * @DateTime 2017-04-12T22:22:32+0800
	 * @return   int                   获取博客分类总数
	 */
	public function categoryCount(){
		// 实例化模型
		$category = new Category();
		// 获取博客分类总数
		return $category->count('cate_id');
	}
	public function middleware(){
    	// 如果不存在session就跳转
		if(!Session::has('username')){
			$this->error("请先登录！",'/login.html');
		}
	}
	



}
 ?>