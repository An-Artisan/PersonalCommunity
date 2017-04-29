<?php
namespace app\chat\controller;
use app\chat\model\User;
use think\Controller;
use think\View;
use think\Validate;
use think\Image;
use think\Request;
use think\Db;
use think\Session;
use org\util\Gateway;
class ThirdPartyLogin extends Controller
{	
	// 腾讯QQ第三方登录
	public function getTencentAccessToken(){
		//应用的APPID
		$app_id = "101399466";
		//应用的APPKEY
		$app_secret = "dd69533969da0e0b2db991626863325d";
		//成功授权后的回调地址
		$my_url = "http://www.joker1996.com/getTencentAccessToken.html";
		//Step1：获取Authorization Code
		$code = Request::instance()->param('code');
		//Step2：通过Authorization Code获取Access Token
		$token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
		. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
		. "&client_secret=" . $app_secret . "&code=" . $code;
		// 获取腾讯开放接口内容
		$response = file_get_contents($token_url);
		// 获取access token值，用于验证。getNeedBetween截取指定两个字符串间内容
		$access_token = getNeedBetween($response,'=','&');
		//Step3：使用Access Token来获取用户的OpenID
		$graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" . $access_token; 
		// 获取腾讯开放接口内容
		$str  = file_get_contents($graph_url);
		// 没有找到callback代表授权错误。转到登录界面
		if (strpos($str, "callback") !== false)
		{
			$lpos = strpos($str, "(");
			$rpos = strrpos($str, ")");
			$str  = substr($str, $lpos + 1, $rpos - $lpos -1);
		}else{
			$this->error("授权失败，请稍后再试！",'/LoginChat.html');
		}
		// 返回一个user对象 client_id和openid是属性
		$open_info = json_decode($str);
		// 判断是否有错误，如果有，给提示，跳转到登录页面
		if (isset($open_info->error))
		{
			$this->error("<h3>error:</h3>" . $open_info->error . "<h3>msg  :</h3>" . $open_info->error_description,'/LoginChat.html');
		}
		$getUserInfoUrl = "https://graph.qq.com/user/get_user_info?access_token=$access_token&oauth_consumer_key=$app_id&openid=" . $open_info->openid;
		$user_info = json_decode(file_get_contents($getUserInfoUrl),true);
		// var_dump($user_info);
		// 实例化user表
		$user = new User();
		// 查询单个数据
		$info = $user->where('third_id', "tencent_".$open_info->client_id)->find();
		/* 
		如果client_id不存在，代表第一次用腾讯QQ账号登录，需要添加记录到数据库
		如果存在表示已经用腾讯QQ账号登录过该网站。只需要更新头像和昵称保证拉取
		腾讯最新的用户信息（为防止client_id和其他第三方登录重名，前面加上
		改第三方的前缀，这里是腾讯，加上tencent_）
		*/
		if(is_null($info)){
			// 添加client_id
			$user->third_id = "tencent_" . $open_info->client_id;
			// 添加昵称
			$user->nickname = $user_info['nickname'];
			/* 
				添加头像地址，这里为QQ头像40px*40px
				腾讯API文档提示:不是所有的用户都拥有QQ的100×100的头像，
				但40×40像素则是一定会有
			*/
			$user->user_head = $user_info['figureurl_qq_1'];
			// 保存
			$user->save();
		}else{
			$user->save([
			'nickname'  => $user_info['nickname'],
			'user_head' => $user_info['figureurl_qq_2']
			],['third_id' => "tencent_" . $open_info->client_id]);
		}

	}
	// 百度第三方登录
	public function baiduLogin(){
		// 应用的ApiKey
		$api_key = "XnBrU4vhuxi9K6MWwcQBw6Uq";
		// 应用的SecretKey
		$secret_key = "qXA5QGV2oKOnXtQ3pDRoEogxLEHMFBre";
		// 应用的授权回调地址
		$redirect_uri = "http://www.joker1996.com/baidu_login.html";
		// 获取code值，用于获取Access Token
		$code = Request::instance()->param('code');
		// 拼接获取Access Token URL地址
		$get_access_token_url = "https://openapi.baidu.com/oauth/2.0/token?grant_type=authorization_code&code=".$code."&client_id=".$api_key."&client_secret=".$secret_key."&redirect_uri=" . $redirect_uri;
		// 获取access_token的值
		$access_token = json_decode(file_get_contents($get_access_token_url),true)['access_token'];
		// 拼接获取用户信息URL
		$get_user_info_url = "https://openapi.baidu.com/rest/2.0/passport/users/getLoggedInUser?access_token=" . $access_token;
		/* 
			获取用户信息 转json为数组 该数组有: 
			uid(用户id)，uname(用户昵称)，portrait(用户头像) 键
		*/
		$user_info = json_decode(file_get_contents($get_user_info_url),true);
		// 实例化user表
		$user = new User();
		// 查询单个数据
		$info = $user->where('third_id', "baidu_".$user_info['uid'])->find();
		/* 
		如果uid不存在，代表第一次用百度账号登录，需要添加记录到数据库
		如果存在表示已经用百度账号登录过该网站。只需要更新头像和昵称保证拉取
		百度最新的用户信息（为防止uid和其他第三方登录重名，前面加上
		改第三方的前缀，这里是百度，加上baidu_）
		*/
		if(is_null($info)){
			// 添加client_id
			$user->third_id = "baidu_" . $user_info['uid'];
			// 添加昵称
			$user->nickname = $user_info['uname'];
			/* 
				这里的头像百度返回的是用户头像加密串。
				需要在前面加一个百度的安全连接获取到
				用户的头像
			*/
			$user->user_head = "http://tb.himg.baidu.com/sys/portraitn/item/" . $user_info['portrait'];
			// 保存
			$user->save();
		}else{
			$user->save([
			'nickname'  => $user_info['uname'],
			'user_head' => "http://tb.himg.baidu.com/sys/portraitn/item/" . $user_info['portrait']],['third_id' => "baidu_" . $user_info['uid']]);
		}
	}
	// 新浪微博第三方登录
	public function sinaLogin(){
		// 应用的ApiKey
		$app_key = "2975043359";
		// 应用的SecretKey
		$app_secret = "eb8b690709c3fd09fa238babdc3af479";
		// 应用的授权回调地址
		$redirect_uri = "http://www.joker1996.com/sina_login.html";
		// 获取code值，用于获取Access Token
		$code = Request::instance()->param('code');
		// 拼接获取Access Token URL地址
		$get_access_token_url = "https://api.weibo.com/oauth2/access_token?client_id=".$app_key."&client_secret=".$app_secret."&grant_type=authorization_code&redirect_uri=".$redirect_uri."&code=" . $code;
		// 调用自定义函数getHttpPostData 获取POST请求返回的数据
		$access_token_and_uid = getHttpPostData($get_access_token_url);
		// 获取access_token
		$access_token = $access_token_and_uid['access_token'];
		// 获取uid
		$uid = $access_token_and_uid['uid'];
		// 拼接获取用户信息URL
		$get_user_info_url = "https://api.weibo.com/2/users/show.json?access_token=" . $access_token . "&uid=" . $uid;
		/* 
			获取用户信息 转json为数组 该json有以下信息: 
			{
				"id":5230817298,
				"idstr":"5230817298",
				"class":1,
				"screen_name":"不敢为天下",
				"name":"不敢为天下",
				"province":"50",
				"city":"31",
				"location":"重庆 垫江县",
				"description":"读万卷书，行万里路；欲不敢为天下。夫天下，世幽昧、心朽腐，但求生，且知命。",
				"url":"http://blog.sina.com.cn/u/5230817298",
				"profile_image_url":"http://tva2.sinaimg.cn/crop.5.0.183.183.50/005HZYwWjw8fc33059fkaj305k05kweb.jpg",
				"cover_image_phone":"http://ww1.sinaimg.cn/crop.0.0.640.640.640/549d0121tw1egm1kjly3jj20hs0hsq4f.jpg",
				"profile_url":"u/5230817298",
				"domain":"","weihao":"",
				"gender":"m",
				"followers_count":25,
				"friends_count":64,
				"pagefriends_count":1,
				"statuses_count":24,
				"favourites_count":1,
				"created_at":"Thu Jul 24 17:11:39 +0800 2014",
				"following":false,
				"allow_all_act_msg":false,
				"geo_enabled":true,
				"verified":false,
				"verified_type":-1,
				"remark":"",
				"insecurity":{"sexual_content":false},
				"status":{
					"created_at":"Sat Feb 25 14:53:09 +0800 2017",
					"id":4079053444983308,
					"mid":"4079053444983308",
					"idstr":"4079053444983308",
					"text":"#为你的星座配一首歌# \n初恋时不懂伤心，听这首歌只觉很好，并无感觉。失恋时听，我终于失去了你，会哭。对这个依然没感觉。后来，碰到了求而不得的人，听这首。停不下来，终于明白了情爱里无智者，任我原本横冲直撞为她委婉柔肠、任我为她心思细腻体贴… 分享单曲http://t.cn/Ri2j0YA（@网易云音乐）",
					"textLength":279,
					"source_allowclick":0,
					"source_type":1,
					"source":"网易云音乐",
					"favorited":false,
					"truncated":false,
					"in_reply_to_status_id":"",
					"in_reply_to_user_id":"",
					"in_reply_to_screen_name":"",
					"pic_urls":[],"geo":null,
					"reposts_count":0,
					"comments_count":0,
					"attitudes_count":0,
					"isLongText":false,
					"mlevel":0,
					"visible":{"type":0,"list_id":0
				},
				"biz_ids":[230435],
				"biz_feature":0,
				"page_type":32,
				"hasActionTypeCard":0,
				"darwin_tags":[],
				"hot_weibo_tags":[],
				"text_tag_tips":[],
				"userType":0,
				"positive_recom_flag":0,
				"gif_ids":"",
				"is_show_bulletin":2},
				"ptype":0,
				"allow_all_comment":false,
				"avatar_large":"http://tva2.sinaimg.cn/crop.5.0.183.183.180/005HZYwWjw8fc33059fkaj305k05kweb.jpg",
				"avatar_hd":"http://tva2.sinaimg.cn/crop.5.0.183.183.1024/005HZYwWjw8fc33059fkaj305k05kweb.jpg",
				"verified_reason":"",
				"verified_trade":"",
				"verified_reason_url":"",
				"verified_source":"",
				"verified_source_url":"",
				"follow_me":false,
				"online_status":0,
				"bi_followers_count":12,
				"lang":"zh-cn",
				"star":0,
				"mbtype":0,
				"mbrank":0,
				"block_word":0,
				"block_app":0,
				"credit_score":80,
				"user_ability":1024,
				"urank":9}
			对应的说明为：
				返回值字段	字段类型	字段说明
				id	int64	用户UID
				idstr	string	字符串型的用户UID
				screen_name	string	用户昵称
				name	string	友好显示名称
				province	int	用户所在省级ID
				city	int	用户所在城市ID
				location	string	用户所在地
				description	string	用户个人描述
				url	string	用户博客地址
				profile_image_url	string	用户头像地址（中图），50×50像素
				profile_url	string	用户的微博统一URL地址
				domain	string	用户的个性化域名
				weihao	string	用户的微号
				gender	string	性别，m：男、f：女、n：未知
				followers_count	int	粉丝数
				friends_count	int	关注数
				statuses_count	int	微博数
				favourites_count	int	收藏数
				created_at	string	用户创建（注册）时间
				following	boolean	暂未支持
				allow_all_act_msg	boolean	是否允许所有人给我发私信，true：是，false：否
				geo_enabled	boolean	是否允许标识用户的地理位置，true：是，false：否
				verified	boolean	是否是微博认证用户，即加V用户，true：是，false：否
				verified_type	int	暂未支持
				remark	string	用户备注信息，只有在查询用户关系时才返回此字段
				status	object	用户的最近一条微博信息字段 详细
				allow_all_comment	boolean	是否允许所有人对我的微博进行评论，true：是，false：否
				avatar_large	string	用户头像地址（大图），180×180像素
				avatar_hd	string	用户头像地址（高清），高清头像原图
				verified_reason	string	认证原因
				follow_me	boolean	该用户是否关注当前登录用户，true：是，false：否
				online_status	int	用户的在线状态，0：不在线、1：在线
				bi_followers_count	int	用户的互粉数
				lang	string	用户当前的语言版本，zh-cn：简体中文，zh-tw：繁体中文，en：英语	
		*/
		$user_info = json_decode(file_get_contents($get_user_info_url),true);
		// 实例化user表
		$user = new User();
		// 查询单个数据
		$info = $user->where('third_id', "sina_".$user_info['idstr'])->find();
		/* 
		如果uid不存在，代表第一次用新浪账号登录，需要添加记录到数据库
		如果存在表示已经用新浪账号登录过该网站。只需要更新头像和昵称保证拉取
		新浪最新的用户信息（为防止uid和其他第三方登录重名，前面加上
		改第三方的前缀，这里是新浪，加上sina_）
		*/
		if(is_null($info)){
			// 添加client_id
			$user->third_id = "sina_" . $user_info['idstr'];
			// 添加昵称
			$user->nickname = $user_info['screen_name'];
			// 添加头像地址
			$user->user_head = $user_info['profile_image_url'];
			// 保存
			$user->save();
		}else{
			$user->save([
			'nickname'  => $user_info['screen_name'],
			'user_head' => $user_info['profile_image_url']
			],['third_id' => "sina_" . $user_info['idstr']]);
		}
		
	}	

}