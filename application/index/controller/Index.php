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
	public function createDatabase(){
		// 获取请求信息
		$data = input('post.');
		// 获取数据库地址
		$address = $data['address'];
		// 获取端口号
		$port = $data['port'];
		// 获取数据库用户名
		$username = $data['username'];
		// 获取数据库密码
		$password = $data['password'];
		// 建立连接
		$conn = mysqli_connect($address,$username,$password,'',$port);
		// 出错提示
		if (!$conn)
		{
		die('Could not connect: ' . mysqli_error());
		}
		if(mysqli_query($conn,"CREATE DATABASE personaladmin") && mysqli_query($conn,"CREATE DATABASE personalblog") && mysqli_query($conn,"CREATE DATABASE personalwebsite")){
			// 切换数据库 在此数据库下建立表	
			mysqli_select_db($conn,'personaladmin');
			// 建立seo数据表
			mysqli_query($conn,"CREATE TABLE `lq_seo` (
			  `a_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'seo id',
			  `a_title` char(20) NOT NULL COMMENT 'seo 的导航名称',
			  `a_desc` varchar(255) NOT NULL COMMENT 'seo描述',
			  `a_keywords` char(80) NOT NULL COMMENT 'seo关键字',
			  `a_author` char(10) NOT NULL COMMENT 'seo作者',
			  `a_alias` char(20) NOT NULL COMMENT 'seo别名',
			  PRIMARY KEY (`a_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='//项目seo表';");
			// 插入seo数据
			$insert_seo = "INSERT INTO `personaladmin.lq_seo` (`a_title`,`a_desc`,`a_keywords`,`a_author`,`a_alias`) VALUES ('刘强个人网站','这是刘强自己的个人网站，主要从事计算机web方向，HTML，CSS，DIV，PHP，mysql，Laravel，框架，博客，电影等','刘强，强哥，自讽，不敢为天下，PHP，个人网站，计算机，编程，代码，游戏，朋友 ，旅游，电影，音乐，PUA，撩妹','刘强','website'),('刘强个人博客','刘强的个人博客，博客系统，刘强，强哥，学习，交流，laravel博客系统。框架系统。QQ：1090035743','刘强的个人博客，刘强的博客，刘强，编程博客系统','刘强','blog')";
			// 执行插入数据操作
		  	mysqli_query($conn,$insert_seo);
	        // 切换数据库 在此数据库下建立表
		    mysqli_select_db($conn,'personalblog');
		    // 建立博客文章表
		    mysqli_query($conn,"CREATE TABLE `lq_article` (
			  `art_id` int(11) NOT NULL AUTO_INCREMENT,
			  `art_title` varchar(100) NOT NULL DEFAULT '' COMMENT '//文章标题',
			  `art_tag` varchar(100) NOT NULL DEFAULT '' COMMENT '//关键词',
			  `art_keywords` varchar(100) NOT NULL COMMENT '//文章关键字',
			  `art_description` varchar(100) NOT NULL DEFAULT '' COMMENT '//描述',
			  `art_cover` varchar(100) NOT NULL DEFAULT 'uploads/20160726104008518.jpg' COMMENT '//文章封面图',
			  `art_show` text NOT NULL COMMENT '文章展示前缀描述',
			  `art_content` text NOT NULL COMMENT '//文章内容',
			  `art_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '//发布时间',
			  `art_editor` varchar(50) NOT NULL DEFAULT '' COMMENT '//作者',
			  `art_view` int(11) NOT NULL DEFAULT '0' COMMENT '//查看次数',
			  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '//分类id',
			  PRIMARY KEY (`art_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='//文章';");
			// 建立文章分类表
			mysqli_query($conn,"CREATE TABLE `lq_category` (
			  `cate_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '//分类id',
			  `cate_name` varchar(50) NOT NULL DEFAULT '' COMMENT '//分类名称',
			  `cate_tags` varchar(255) NOT NULL DEFAULT '' COMMENT '//Tag标签',
			  `cate_description` varchar(255) NOT NULL DEFAULT '' COMMENT '//标题描述',
			  PRIMARY KEY (`cate_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='//文章分类';");
			// 建立文章图片表
			mysqli_query($conn,"CREATE TABLE `lq_photos` (
			  `pho_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '//文章照片id',
			  `art_id` int(11) NOT NULL,
			  `pho_address` varchar(255) NOT NULL COMMENT '//照片地址',
			  `pho_filename` char(30) NOT NULL COMMENT '//照片名',
			  PRIMARY KEY (`pho_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='//文章图片表';");
			// 插入博客分类数据
			$insert_blog_category = "INSERT INTO `personalblog.lq_category` (`cate_name`,`cate_tags`,`cate_description`) VALUES ('心情随笔','刘强个人博客,杂项,心情,随笔','刘强个人博客的一些随笔~'),('程序人生','php,python,java,javascript,mysql,thinkphp,laravel,wokerman','关于编程的一些的文章，php，Python，java，JavaScript，mysql，thinkphp，laravel，wokerman'),('心血来潮','生活,感悟,体会,感情,恋爱,把妹','关于生活那些事儿~'),('旅途见闻','旅游,穷游,见闻','关于一个人的旅行那些事~')";
			// 执行插入数据操作
		  	mysqli_query($conn,$insert_blog_category);
			// 切换数据库 在此数据库下建立表
		    mysqli_select_db($conn,'personalwebsite');
		    // 建立管理员数据表
		    mysqli_query($conn,"CREATE TABLE `lq_administrator` (
			  `a_id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'id值',
			  `a_author` char(20) NOT NULL COMMENT '网站作者',
			  `a_photo` char(50) NOT NULL,
			  `a_username` char(20) NOT NULL,
			  `a_password` char(20) NOT NULL,
			  `a_introduce` varchar(255) NOT NULL,
			  `a_copyright` varchar(255) NOT NULL COMMENT '版权信息',
			  PRIMARY KEY (`a_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='//管理员数据表';");
			// 建立个人相册表
			mysqli_query($conn,"CREATE TABLE `lq_album` (
			  `a_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '相册分类id',
			  `a_title` char(20) NOT NULL COMMENT '相册标题',
			  `a_description` varchar(255) NOT NULL COMMENT '相册描述',
			  `a_cover` char(60) NOT NULL COMMENT '相册封面图',
			  `a_encryption` tinyint(2) NOT NULL COMMENT '是否加密',
			  `a_question` varchar(255) DEFAULT NULL COMMENT '相册问题',
			  `a_password` char(30) DEFAULT NULL COMMENT '相册密码',
			  `a_create_time` datetime NOT NULL COMMENT '创建相册时间',
			  `a_author` char(20) NOT NULL COMMENT '相册作者',
			  PRIMARY KEY (`a_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='//个人网站相册表';");
			// 建立个人网站留言表
			mysqli_query($conn,"CREATE TABLE `lq_message` (
			  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '留言自增ID',
			  `m_name` char(50) NOT NULL COMMENT '留言昵称',
			  `m_email` varchar(20) NOT NULL COMMENT '留言邮箱',
			  `m_content` varchar(255) NOT NULL COMMENT '留言内容',
			  `m_time` datetime NOT NULL COMMENT '留言时间',
			  PRIMARY KEY (`m_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='//建立个人网站留言表';");
			// 建立个人网站图片表
			mysqli_query($conn,"CREATE TABLE `lq_photos` (
			  `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '//照片id',
			  `p_category` tinyint(4) NOT NULL COMMENT '相册分类，对应lq_album的a_id',
			  `p_title` char(60) NOT NULL COMMENT '图片标题',
			  `p_address` char(75) NOT NULL COMMENT '图片地址',
			  `p_thum` char(60) NOT NULL COMMENT '图片缩略图',
			  `p_time` datetime NOT NULL COMMENT '上传时间',
			  PRIMARY KEY (`p_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=287 DEFAULT CHARSET=utf8 COMMENT='// 个人网站图片表';");
			// 插入管理员数据
			$insert_admin = "INSERT INTO `personalblog.lq_category` (`a_author`,`a_photo`,`a_username`,`a_password`,`a_introduce`,`a_copyright`) VALUES ('刘强','\\static\\index\\head\\14924956137173.png','joker','HelloWorld','毫无权势，一些知识，一些智慧，以及尽可能多的趣味。','Copyright © 2014-2017 <a href=\'http://www.joker1996.com\'>http://www.joker1996.com</a>. All rights reserved.')";
			// 执行插入数据操作
		  	mysqli_query($conn,$insert_admin);
	 }
	}
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
    	// 实例化模型
    	$message = new Message;
		// 给模型的属性字段赋值
		$message->m_name = $data['name'];
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