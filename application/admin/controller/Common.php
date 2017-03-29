<?php 
namespace app\admin\controller;
use app\index\model\Album;
use app\index\model\Photos;
use think\Controller;
use think\View;
use think\Request;
class Common extends Controller
{	
	// 获取相册总数
	public function alubmCount(){
		// 实例化模型
		$album = new Album();
		// 获取有多少相册
		return  $album->count('a_id');
	}
	// 获取照片总数
	public function photosCount(){
		// 实例化模型
		$photos = new Photos();
		// 获取有多少相册
		return  $photos->count('p_id');
	}
}
 ?>