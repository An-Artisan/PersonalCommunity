<?php 
namespace app\admin\controller;
use app\index\model\Album;
use app\index\model\Photos;
use think\Controller;
use think\View;
use think\Request;
use think\Image;
class PhotosController extends Controller
{	
	public function __construct(){
		// 实例化common类
		$common = new Common();
		// 验证是否登录
		$common->middleware();
	}
	public function allPhotos(){
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
		// 实例化照片表模型
		$photos = new Photos();
		// 获取前九张照片
		$photos_data = $photos->paginate(9);
		// 实例化相册表模型
		$album = new Album();
		// 查询数据集 id和标题，
		$album_data = $album->field('a_id,a_title')->select();
		// 渲染模板输出 并赋值模板变量
		return $view->fetch('admin/webSite/allPhotos',['photos_data'=>$photos_data,'album_data'=>$album_data]);
	}
	public function deletePhotos(){
		// 获取post过来的数据
		$data = input('post.');
		// 把json数据转成对象
		$data = json_decode($data['ajaxData']);
		// 获取p_id
		$p_id = $data->a_id;
		// 实例化图片模型
		$photos = Photos::get($p_id);
		// 执行删除
		if($photos->delete()){
			// 删除缩略图及原图
			unlink(ROOT_PATH . 'public' . $photos->p_address);
			unlink(ROOT_PATH . 'public' . $photos->p_thum);
			// 返回提示信息
			return json(["message"=>"删除照片成功！","ico" => 1]);
		}
	}
	public function selectAlbum(Request $request){
			// 获取post过来的数据
			$data = input('post.');
			// 把json数据转成对象
			$data = json_decode($data['ajaxData']);
			// 获取相册id
			$a_id = $data->a_id;
			// 实例化照片表模型
			$photos = new Photos();
			// 获取该相册下所有照片
			$allPhotos = $photos->where('p_category',$a_id)->select();
			// 定义数组
			$arrayName = null;
			// 获取数据
			foreach ($allPhotos as $key => $value) {
				$arrayName[$key] = $value;
			}
			// 如果没有数据返回提示信息
			if(!count($arrayName)){
				return json(["message"=>"该相册没有照片~~","ico"=>5]);
			}
			// 有信息就返回信息
			return json($allPhotos);
	}
	public function uploadPhotosController(Request $request){
		// 获取文件对象
		$files = $request->file('file');
		/**
		 *  这里一定要先把Image裁剪图片的函数写在前面。
		 *  在上传图片，不然在Linux下会有一个莫名其妙的bug。
		 */
		// 获得处理图片句柄
        $image = \think\Image::open($files);
		// 缩略图 thumb(最大宽度,最大高度,裁剪类型) 1代表等比例裁剪
		$image->thumb(300, 300, 1); 
		// 添加水印
		$image->text('By http://www.joker1996.com', 'Basileia.ttf', 10, '#ffffff');
		// 以当前时间命名水印
		$saveName = $request->time() . rand(1000,9999) . '.png';
		// 保存到指定路径
		$thumb = $image->save(ROOT_PATH . 'public' . DS . 'static' . DS . 'index' . DS . 'album' . DS . 'thumb' . DS . $saveName);
		// 获取上传图片的id
		$id = Request::instance()->param('id');
		// 获取相册id
		$a_id = Request::instance()->param('a_id');
        // 移动到框架应用根目录/public/static/index/album/photos 目录下
        $info = $files->rule('date')->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'index' . DS . 'album' . DS . 'photos');
        if($info && $thumb){
            // 实例化photos表模型
            $photos = new Photos;
            // 获取相册分类id
            $photos->p_category = $a_id;
            // 增加新记录
            $photos->p_address = DS . 'static' . DS . 'index' . DS . 'album' . DS . 'photos' . DS . $info->getSaveName();
            $photos->p_title = $info->getSaveName();
            $photos->p_thum = DS . 'static' . DS . 'index' . DS . 'album' . DS . 'thumb' . DS . $saveName;
            $photos->p_time = date('Y-m-d H:i:s',time());
            // 保存
            $photos->save();
            // 返回给ajax
			return json(["id"=>$id,"message"=>"上传成功~","ico"=>1]);
        }else{
            // 上传失败获取错误信息
            return json(["id"=>$id,"message"=>$files->getError(),"ico"=>5]);
        }   
	}
	public function uploadLayer(Request $request){
		// 实例化相册
		$album = new Album();
		// 查询id，标题，封面
		$album_data = $album->field('a_id,a_title,a_cover')->select();
		// 实例化视图
		$view = new View();
		// 输出到视图
		return $view->fetch('admin/webSite/uploadLayer',['album_data'=>$album_data]);
	}
	
}

 ?>