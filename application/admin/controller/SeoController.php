<?php
namespace app\admin\controller;
use app\admin\model\Seo;
use app\index\model\Administrator;
use think\Controller;
use think\View;
use think\Request;
use think\Url;
use think\Session;
use think\Image;
class SeoController extends Controller
{	
	public function seo(){
		// 实例化视图类   
        $view = new View();
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
		// 实例化模型
		$seo = new Seo();
		// 获取seo数据
		$seo_data = $seo->select();
        // 返回视图
        return $view->fetch('admin/backStage/seo',["seo_data"=>$seo_data]);
    }
    public function editSeo(){
    	// 获取a_id
		$a_id = Request::instance()->param('id');
		// 获取数据
		$seo = Seo::get($a_id);
		// 实例化视图类	
		$view = new View();
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
		// 渲染模板输出
		return $view->fetch('admin/backStage/editSeo',["seo"=>$seo]);
    }
    public function eidtSeoController(){
    	// 获取所有post数据
		$data = input('post.');
		// 查询该id的数据
		$id = $data['id'];
		// 获取id为$id的数据模型
		$seo = Seo::get($id);	
		// 更新数据模型
		$seo->a_title = $data['seo_title'];
		$seo->a_keywords = $data['seo_keywords'];
		$seo->a_desc = $data['seo_desc'];
		// 修改数据
		if($seo->save()){
		// 返回json数据通知
		return json(["message"=>"修改成功！","ico"=>1]);
		}
		return json(["message"=>"你没有修改数据！","ico"=>5]);
    }
    public function personal(){
    	// 实例化视图类   
        $view = new View();
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
		// 实例化模型
		$admin = new Administrator();
		// 获取个人数据
		$admin_data = $admin->select();
        // 返回视图
        return $view->fetch('admin/backStage/admin',["admin_data"=>$admin_data]);
    }
    public function editPersonalController(Request $request){
    	if ($_FILES['pic']['error'] === 1) {
			return json(["message"=>"图片文件过大，请不要超过1M","ico"=>5]);
		}
		// 获取POST数据
		$data = input('post.');
		// 获取个人资料id
		$id = $data['id'];
		// 查询该id的数据
		$admin = Administrator::get($id);
		// 用户上传了文件就替换之前的相册封面图，并删除之前的相册封面图
		if ($_FILES['pic']['error'] !== 4) {
			// 获取文件对象
			$files = $request->file('pic');
			// 获得处理图片句柄
	        $image = \think\Image::open($files);
			// 缩略图 thumb(最大宽度,最大高度,裁剪类型) 1代表等比例裁剪
			$image->thumb(300, 300, 1); 
			// 以当前时间命名
			$saveName = $request->time() . rand(1000,9999) . '.png';
			// 保存到指定路径
			$thumb = $image->save(ROOT_PATH . 'public' . DS . 'static' . DS . 'index' . DS . 'head' . DS . $saveName);
			// 返回值的地址赋值给cover
			$cover = DS . 'static' . DS . 'index' . DS . 'head' . DS . $saveName;
			// 删除之前的个人头像图
			unlink(ROOT_PATH . 'public' .$admin->a_photo);
			// 数据库修改封面图地址
			$admin->a_photo = $cover;
		}
		$admin->a_author = $data['author'];
		$admin->a_username = $data['username'];
		$admin->a_password     = $data['password'];
		$admin->a_introduce    = $data['introduce'];
		$admin->a_copyright    = $data['copyright'];
		// 修改数据
		if($admin->save()){
		// 返回json数据通知
		return json(["message"=>"修改成功！","ico"=>1]);
		}
		return json(["message"=>"你没有修改数据！","ico"=>5]);
    }
    
}
