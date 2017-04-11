<?php 
namespace app\admin\controller;
use app\index\model\Album;
use app\index\model\Photos;
use app\index\model\Message;
use think\Controller;
use think\View;
use think\Request;
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
	 * 回去留言总数
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
	
}
 ?>