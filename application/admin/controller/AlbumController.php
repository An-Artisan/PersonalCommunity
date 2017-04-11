<?php 
namespace app\admin\controller;
use app\index\model\Album;
use app\index\model\Photos;
use think\Controller;
use think\View;
use think\Request;
class AlbumController extends Controller 
{	
	//显示相册列表视图
	public function albumList(){
		// 实例化模型
		$album = new Album();
		// 查询数据集 标题，描述，封面，创建时间字段
		$album_data = $album->field('a_id,a_title,a_description,a_cover,a_create_time')->paginate(6);
		// 实例化视图类	
		$view = new View();
		// 实例化common类
		$common = new Common();
		// 获取相册总数
		$view->album_count = $common->alubmCount();
		// 获取照片总数
		$view->photos_count = $common->photosCount();
		// 获取留言总数
		$view->message_count = $common->messageCount();
		// 渲染模板输出
		return $view->fetch('admin/webSite/albumList',['album_date'=>$album_data]);

	}
	// 返回添加相册视图
	public function addAlbum(){
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
		// 渲染模板输出
		return $view->fetch('admin/webSite/addAlbum');
		// return redirect('http://www.joker1996.com/admin/index/uploadphotos.html');
	}
	// 返回编辑相册视图
	public function editAlbum(){
		// 获取a_id
		$a_id = Request::instance()->param('id');
		// 获取数据
		$album = Album::get($a_id);
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
		// 打包数组数据
		$data = ["id"=>$album->a_id,"title" => $album->a_title,"desc"=>$album->a_description,"cover"=>$album->a_cover,"encryption"=>$album->a_encryption,"question"=>$album->a_question,"answer"=>$album->a_password,"author"=>$album->a_author];
		// 渲染模板输出
		return $view->fetch('admin/webSite/editAlbum',$data);
	}
	public function deleteAlbumController(){
		// 获取post过来的数据
		$data = input('post.');
		// 把json数据转成对象
		$data = json_decode($data['ajaxData']);
		// 获取a_id
		$a_id = $data->a_id;
		// 实例化相册模型
		$album = Album::get($a_id);
		// 删除封面图
		unlink(ROOT_PATH . 'public' .DS .$album->a_cover);
		// 实例化图片模型
		$photos = new Photos;
		// save方法第二个参数为更新条件
		$photos->save(['p_category'  => 6],['p_category' => $a_id]);
		// 执行删除
		if($album->delete()){
			return json(["message"=>"删除相册成功！","ico" => 1]);
		}
	}
	// 更新相册数据
	public function editAlbumController(){
		/*
			判断error的值
			值：0; 没有错误发生，文件上传成功。 
			UPLOAD_ERR_INI_SIZE 
			值：1; 上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。 
			UPLOAD_ERR_FORM_SIZE 
			值：2; 上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 
			UPLOAD_ERR_PARTIAL 
			值：3; 文件只有部分被上传。 
			UPLOAD_ERR_NO_FILE 
			值：4; 没有文件被上传。 
			值：5; 上传文件大小为0. 
		*/
		if ($_FILES['pic']['error'] === 1) {
			return json(["message"=>"图片文件过大，请不要超过1M","ico"=>5]);
		}
		// 获取POST数据
		$data = input('post.');
		// 加密是否加密，默认不加密
		$encryption = 0;
		// 获取相册id
		$id = $data['id'];
		// 查询该id的数据
		$album = Album::get($id);
		// 用户上传了文件就替换之前的相册封面图，并删除之前的相册封面图
		if ($_FILES['pic']['error'] !== 4) {
			// 返回值的地址赋值给cover
			$cover = $this->uploadImage($_FILES);
			// 删除之前的封面图
			unlink(ROOT_PATH . 'public' .DS .$album->a_cover);
			// 数据库修改封面图地址
			$album->a_cover = $cover;
		}
		// 判断post数组里面是否存在checkbox，存在表示加密
		if(array_key_exists("checkbox",$data)){
			$encryption = 1;
			$album->a_question = $data['album_question'];
			$album->a_password = $data['album_answer'];
		}
		$album->a_title     = $data['album_title'];
		$album->a_description    = $data['album_desc'];
		$album->a_encryption    = $encryption;
		// 修改数据
		if($album->save()){
		// 返回json数据通知
		return json(["message"=>"修改成功！","ico"=>1]);
		}
		return json(["message"=>"你没有修改数据！","ico"=>5]);
	}
	// 添加相册数据到数据库
	public function addAlbumController(){
		// 判断是否有错，如果有给用户提示
		if ($_FILES['pic']['error'] === 1) {
			return json(["message"=>"图片文件过大，请不要超过1M","ico"=>5]);
		}
		// 把当前上传图片的时间精确到秒作为文件名重新赋值给上传文件作为它的新的文件名
		$date = date('Y-m-d H:i:s',time());
		// 获取post过来的数据
		$data = input('post.');
		// 加密是否加密，默认不加密
		$encryption = 0;
		// 实例化模型
		$user = new Album;
		// 判断post数组里面是否存在checkbox，存在表示加密
		if(array_key_exists("checkbox",$data)){
			$encryption = 1;
			$user->a_question = $data['album_question'];
			$user->a_password = $data['album_answer'];
		}
		// 给模型的属性字段赋值
		$user->a_title = $data['album_title'];
		$user->a_description = $data['album_desc'];
		$user->a_cover = $this->uploadImage($_FILES);
		$user->a_author = $data['album_author'];
		$user->a_encryption = $encryption;
		$user->a_create_time = $date;
		// 添加数据
		if($user->save()){
		// 返回json数据通知
		return json(["message"=>"新增相册成功！","ico"=>1]);
		}
		return json(["message"=>"你没有修改数据！","ico"=>5]);

	}
	// 上传单文件 files接受参数 $_FILES
	public function uploadImage($files){
    	// 把当前上传图片的时间精确到秒作为文件名重新赋值给上传文件作为它的新的文件名
    	$date = date('Y-m-dHis',time());
		// 以.来截取文件的后缀名
		$uptype = explode(".", $files["pic"]["name"]);
	    // 然后把当前时间加上后缀名就是该图片的新名称。
	    $album_picture_name = $date.".".$uptype[1];
		// 给上传的头像重新命名
		$files["pic"]["name"] = $album_picture_name;
		//定义上传文件存储位置
		$path = ROOT_PATH .'public'.DS .'static'.DS .'index'.DS .'album'.DS .'cover' .DS . $files["pic"]["name"];
		$cover = DS .'static'.DS .'index'.DS .'album'.DS .'cover'.DS  .$files["pic"]["name"];
		// 移动文件到自己建的文件夹下
		if(move_uploaded_file($files["pic"]["tmp_name"], $path)){
			// 返回cover的地址
			return $cover;
		}
		return false;

    }
}

 ?>