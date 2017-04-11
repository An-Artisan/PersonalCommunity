<?php 
namespace app\admin\controller;
use app\index\model\Album;
use app\index\model\Photos;
use app\index\model\Message;
use think\Controller;
use think\View;
use think\Request;
use think\Image;
class MessageController extends Controller{
	public function messageList(){
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
		// 实例化留言表模型
		$message = new Message();
		// 获取留言信息
		$message_data = $message->paginate(9);
		// 渲染模板输出 并赋值模板变量
		return $view->fetch('admin/webSite/messageList',['message_data'=>$message_data]);
	}
	public function deleteMessage(){
		// 获取post过来的数据
		$data = input('post.');
		// 把json数据转成对象
		$data = json_decode($data['ajaxData']);
		// 获取m_id
		$m_id = $data->m_id;
		// 实例化图片模型
		$message = Message::get($m_id);
		// 执行删除
		if($message->delete()){
			// 返回提示信息
			return json(["message"=>"删除留言成功！","ico" => 1]);
		}
	}

}