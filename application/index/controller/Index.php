<?php
namespace app\index\controller;
use app\index\model\Album;
use app\index\model\Photos;
use app\index\model\Message;
use app\index\model\Administrator;
use app\admin\model\Seo;
use think\Controller;
use think\View;
use think\Validate;
class Index extends Controller
{	
	
    public function index (){	
    	// 实例化模型
    	$album = new Album();
		// 查询数据集 标题，描述，封面字段，是否加密
		$album_date = $album->field('a_id,a_title,a_description,a_cover,a_encryption,a_question')->select();
		// 实例化模型
    	$message = new Message();
		// 查询数据集 标题，描述，封面字段，是否加密
		$message_data = $message->field('m_name,m_time,m_content,m_email')->order('m_id','desc')->paginate(5);
		// 实例化模型
        $admin = new Administrator();
        // 查询管理员数据
        $joker = $admin->select();
        // 实例化模型
        $seo = new Seo();
        // 查询个人博客的seo数据
        $seoData = $seo->where('a_alias','website')->select();
    	// 实例化视图
		$view = new View();
        // 赋值seo信息
        $view->title = $seoData[0]->a_title;
        $view->keywords = $seoData[0]->a_keywords;
        $view->desc = $seoData[0]->a_desc;
        $view->author = $seoData[0]->a_author;
		 // 渲染模板输出 并赋值模板变量
		return $view->fetch('index',['album_date'=>$album_date,'message_data'=>$message_data,'joker'=>$joker],['__JS__'    =>  '/controller']);
    }
    public function message(){
    	// 获取数据
    	$data = input('post.');
    	// 获取输入的验证码
    	$captcha = $data['captcha'];
    	// 验证验证码
    	if(!captcha_check($captcha)){
		 	return json(["message"=>"验证码错入错误，点击验证码可更换验证码！","ico"=>5]);
		}
    	// 实例化模型
    	$message = new Message;
		// 给模型的属性字段赋值 并过滤script和html标签
		$message->m_name = filterTag($data['name']);
		// $message->m_name = ($data['name']);
		$message->m_email = $data['email'];
		$message->m_content = $data['content'];
		$message->m_time = date('Y-m-d H:i:s',time());
		// 添加数据
		if($message->save()){
		// 返回json数据通知
		return json(["message"=>"留言成功！","ico"=>1]);
		}
		return json(["message"=>"留言失败，请稍后再试~","ico"=>5]);
    }
    public function test(){
    	// var_dump($_FILES);
    	// return '{  "code": 0 ,"msg": "呵呵","data": {    "src": "/static/index/album/cover/1.jpg","title": "图片名称"}}';
    	
    }
    public function albumEncryption(){
    		// 获取post过来的数据
			$data = input('post.');
			// 把json数据转成对象
			$data = json_decode($data['ajaxData']);
			// 验证相册id是否为数字，以防别人篡改html a_id的值，导致程序出错
			$checkAlbumId = Validate::is($data->a_id,'number');
			// thinkphp5文档中没有提到token验证，只有规则验证，没有单一验证，这里是用来单一验证token
			$checkToken = Validate::token('__token__','',['__token__'=>$data->__token__]);
			// 如果验证不通过则返回失败信息给前端
			if (false === $checkAlbumId || false === $checkToken) {
	           return json(["flag"=>"0","message"=>"验证失败！请稍后再试！"]);
	        }
	        // 去查询该相册id的加密密码
			$album = Album::get($data->a_id);
			$password = $album->a_password;
			// 如果用户输入的密码和后台密码一致则返回标记为1，代表验证密码成功
			if($password == $data->password){
    			return json(["flag"=>"1"]);
			}
			// 否则就返回标记为0，代表验证密码失败
			return json(["flag"=>"0","message"=>"答案错误！"]);
    }
    public function photos(){
    	// 获取post数据
    	$data  = input('post.');
    	// 把json数据转成对象
		$data = json_decode($data['ajaxData']);
    	$albumId = $data->a_id;
    	// 实例化模型
    	$album = new Photos();
		// 查询分类id为albumId的相册里的所有图片
		$photos = $album->where("p_category",$albumId)->field('p_id,p_title,p_address,p_thum')->select();
		// 没有数据就返回提示信息
		if(!count($photos)){
			return json(["flag"=>"0","message"=>"当前相册没有照片，等主人上传后再来喔~"]);
		}
		// 重新赋值变量
		$data = '';
		// 获取当前域名
		$domain = input('server.SERVER_NAME');
		// 循环数据
		foreach ($photos as $key => $value) {
			/*
				给反斜线转义 例：20170327\4b4b9c431341dcc0649ba84e9732b1dd.JPG
				转成20170327\\4b4b9c431341dcc0649ba84e9732b1dd.JPG
				只有这样返回的json格式才能被识别
			*/
			$alt = addslashes($value->p_title);
			$src= addslashes($value->p_address);
			$thumb= addslashes($value->p_thum);
			/*
				打包layer的相册json格式，而返回的json需严格按照如下格式：
				{
				"title": "", //相册标题
				"id": 123, //相册id
				"start": 0, //初始显示的图片序号，默认0
				"data": [   //相册包含的图片，数组格式
				{
					"alt": "图片名",
					"pid": 666, //图片id
					"src": "", //原图地址
					"thumb": "" //缩略图地址
				}
				]
				}
			*/ 
			$data .= '{"alt":"' . $alt .'",'. '"pid":' . $value->p_id . ",".'"src":"' . 'http://' . $domain .  $src . '",' . '"thumb":"' . 'http://' .$domain . $thumb . '"},'; 
		}
		// 删除最后一个字符逗号
		$data = deleteStringLastChar($data);
		// 追加title和id以及start
		$data = '{"title": "你好","id": '.$albumId.',"start": 0,"data": [' . $data . ']}';
		// 返回数据给前端
		echo $data;
    }
}