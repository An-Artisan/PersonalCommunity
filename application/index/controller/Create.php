<?php
namespace app\index\controller;
use think\Controller;
use think\View;
class Create extends Controller
{	
	public function database(){
		// 实例化视图
		$view = new View();
		// 返回视图
		return $view->fetch('index/database');
	}
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
		// 设置字符集
		mysqli_query($conn, "set names utf8");
		// 定义图片
		$photo = addslashes('\static\index\head\14924956137173.png');
		$hight_school = addslashes('\static\index\album\cover\2017-04-18143949.jpg');
		$my_family = addslashes('\static\index\album\cover\2017-04-18144126.jpg');
		$my_friends = addslashes('\static\index\album\cover\2017-04-18144219.jpg');
		$others = addslashes('\static\index\album\cover\2017-04-18144336.jpg');
		$remember = addslashes('\static\index\album\cover\2017-04-18144415.jpg');
		$myself = addslashes('\static\index\album\cover\2017-04-18144511.jpg');
		// 出错提示
		if (!$conn)
		{
		die('Could not connect: ' . mysqli_error());
		}
		if(mysqli_query($conn,"CREATE DATABASE personaladmin") && mysqli_query($conn,"CREATE DATABASE personalblog") && mysqli_query($conn,"CREATE DATABASE personalwebsite") && mysqli_query($conn,"CREATE DATABASE personalchat")){
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
			$insert_seo = "INSERT INTO personaladmin.lq_seo (`a_title`,`a_desc`,`a_keywords`,`a_author`,`a_alias`) VALUES ('刘强个人网站','这是刘强自己的个人网站，主要从事计算机web方向，HTML，CSS，DIV，PHP，mysql，Laravel，框架，博客，电影等','刘强，强哥，自讽，不敢为天下，PHP，个人网站，计算机，编程，代码，游戏，朋友 ，旅游，电影，音乐，PUA，撩妹','刘强','website'),('刘强个人博客','刘强的个人博客，博客系统，刘强，强哥，学习，交流，laravel博客系统。框架系统。QQ：1090035743','刘强的个人博客，刘强的博客，刘强，编程博客系统','刘强','blog')";
			// 执行插入数据操作
		  	mysqli_query($conn,$insert_seo);
		  	// 切换数据库 在此数据库下建立表	
			mysqli_select_db($conn,'personalchat');
			// 建立聊天分组数据表
			mysqli_query($conn,"CREATE TABLE `lq_group` (
			  `g_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分组id',
			  `g_name` varchar(255) NOT NULL COMMENT '分组名称',
			  `g_uid` char(50) NOT NULL COMMENT 'socket连接id',
			  `g_nickname` char(30) NOT NULL COMMENT '用户昵称',
			  PRIMARY KEY (`g_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;");
			// 建立聊天用户表
			mysqli_query($conn,"CREATE TABLE `CREATE TABLE `lq_user` (
			  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user表自增id',
			  `username` char(30) NOT NULL COMMENT '用户登录名',
			  `third_id` char(20) NOT NULL COMMENT '第三方client_id',
			  `password` char(65) NOT NULL COMMENT '用户登录密码',
			  `nickname` char(25) NOT NULL COMMENT '用户昵称',
			  `user_head` varchar(255) NOT NULL COMMENT '用户头像url地址',
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;");
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
			$insert_blog_category = "INSERT INTO personalblog.lq_category (`cate_name`,`cate_tags`,`cate_description`) VALUES ('心情随笔','刘强个人博客,杂项,心情,随笔','刘强个人博客的一些随笔~'),('程序人生','php,python,java,javascript,mysql,thinkphp,laravel,wokerman','关于编程的一些的文章，php，Python，java，JavaScript，mysql，thinkphp，laravel，wokerman'),('心血来潮','生活,感悟,体会,感情,恋爱,把妹','关于生活那些事儿~'),('旅途见闻','旅游,穷游,见闻','关于一个人的旅行那些事~')";
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
			$insert_admin = "INSERT INTO personalwebsite.lq_administrator (`a_author`,`a_photo`,`a_username`,`a_password`,`a_introduce`,`a_copyright`) VALUES ('刘强','" .$photo."','joker','HelloWorld','毫无权势，一些知识，一些智慧，以及尽可能多的趣味。','Copyright © 2014-2017 <a href=\'http://www.joker1996.com\'>http://www.joker1996.com</a>. All rights reserved.')";
			// 执行插入数据操作
		  	mysqli_query($conn,$insert_admin);
		  	// 插入相册数据
			$insert_album = "INSERT INTO personalwebsite.lq_album (`a_title`,`a_description`,`a_cover`,`a_encryption`,`a_question`,`a_password`,`a_create_time`,`a_author`) VALUES ('我的高中','那时候我还是一枚小鲜肉！','". $hight_school ."',0,'','','2017-04-18 14:39:49','不敢为天下'),('我的家人','不能随便看啊~','" .$my_family."',1,'我的外号？','liuhao','2017-04-18 14:41:26','不敢为天下'),('我和朋友','各种浪啊浪~~','".$my_friends."',0,'','','2017-04-18 14:42:19','不敢为天下'),('随手乱拍','瞎几把乱拍的图片~','".$others."',0,'','','2017-04-18 14:43:36','不敢为天下'),('一些回忆','恩，你懂得~','".$remember."',1,'My Love？','null','2017-04-18 14:44:15','不敢为天下'),('一些自拍','总有些自拍用来镇场子~~','".$myself."',0,'','','2017-04-18 14:45:11','不敢为天下')";
			// 执行插入数据操作
		  	mysqli_query($conn,$insert_album);
		  	// 提示
		  	echo "建立数据库及表成功，请前往数据库查看!";
		    echo "<br>";
		    echo "请牢记后台管理账号和密码！";
		    echo "<br>";
		    echo "后台管理员账号：joker 后台管理员密码：HelloWorld";
	 	}else
		{
		echo "creating database fail!";
		}
		mysqli_close($conn);
	}
}
