刘强个人社区
===============
基于thinphp5+ bootstrap + layer + layui + workerman + redis +  js + jq的开发
<br>
这里有图像处理，依赖ThinkPHP5的图像处理类库 composer require topthink/think-image即可
<br>
官方文档：http://www.kancloud.cn/manual/thinkphp5/177530
<br>
后台管理模版：根据 “妹子UI” 模版更改
<br>
妹子UI官网：http://amazeui.org/
<br>
依赖环境： 
<br>
CentOS 7.0
<br>
php 7.0
<br>
redis-3.2.8
<br>
php依赖扩展：event，redis，openssl，gd，openssl，mysqli，mbstring，sockets
<br>
mariadb-5.5.52(CentOS 7.0之后抛弃mysql，用mariadb代替mysql)
<br>
Apache/2.4.6
<br>
Workerman3.4.1 + GatewayWorker3.0.2 
<br>
这里主要用wokerman做一个单项推送，依赖GatewayClient
<br>
GatewayClient下载地址 https://github.com/walkor/GatewayClient 
<br>
官网参考 [WorkerMan](http://www.workerman.net/)
<br>
一、个人网站
<br>
	1：个人相册以及实现第三方链接
	<br>
	2：留言板整合layui编辑器
	<br>
	3：递归ajax+FormData()实现多张图片同时上传
	<br>
	4：个人相册、照片，实现删除，更新。
	<br>
二、个人博客
<br>
	1：博客分类
	<br>
	2：博客分享至第三方网站
	<br>
	3：博客文章自动提取关键字和标签
	<br>
	4：支持图片上传，更改文章图片
	<br>
	5：定期清除图片冗余数据
	<br>
三、聊天室
<br>
	使用websocket协议 官方文档：https://www.w3.org/TR/websockets/
	<br>
	压力相关：
	<br>
		操作系统	CentOS 7.0 64位
		<br>
		CPU	1核
		<br>
		内存	1GB
		<br>
		系统盘	20GB(本地磁盘)
		<br>
		公网带宽	1Mbps
		<br>
	功能的实现：
	<br>
	1：实现群聊
	<br>
	2：实现单聊
	<br>
	3：实现语音发送(chrome浏览器不支持麦克风的打开，请用Firefox浏览器)
	<br>
	4：实现图片发送
	<br>
	5：实现用户退出提示推送
	<br>
	6：实现用户上线提示推送
	<br>
	7：第三方登录的整合(百度，腾讯，新浪)
	<br>
	逻辑实现过程：
	<br>

	1、网站页面建立与GatewayWorker的websocket连接

	2、GatewayWorker发现有页面发起连接时，将对应连接的client_id发给网站页面

	3、网站页面收到client_id后触发一个ajax请求将client_id发到mvc后端

	4、mvc后端bind.php收到client_id后利用GatewayClient调用Gateway::bindUid($client_id, $uid)将client_id与当前uid(用户id或者客户端唯一标识)绑定。利用Gateway::joinGroup($client_id, $group_id)将client_id加入到对应分组

	5、把分组信息存储在mysql数据库，便于客户端下来通知另外的客户端

	6、页面发起的所有请求都直接post/get到mvc框架统一处理，包括发送消息

	7、mvc框架处理业务过程中需要向某个uid或者某个群组发送数据时，用redis存储聊天数据，避免用mysql数据库存储数据，高并发下，会导致mysql服务器的崩溃。直接调用GatewayClient的接口Gateway::sendToUid Gateway::sendToGroup 等发送
	
	8、如果是语音或者图片，用FileReader.readAsDataURL()压缩语音或者图片成base64编码，然后经过GatewayClient接口转发给其他用户，这里语音或者图片没有保存至数据库，原因是base64编码过长，太占用数据库的资源。本还有一种办法，把语音或者图片打包成文件上传至服务器，不过这一种办法不太建议使用，这里的应用场景是即时通讯，如果用户频繁发送图片或者语音会导致磁盘I/O的开销过大(上传图片或者语音文件不得写入磁盘读取磁盘嘛~)。
	
	9、用户刷新页面在获取数据，从redis数据库获取数据，这里redis设置的是100条记录就往mysql数据库写入数据。避免了频繁的访问mysql服务器

	10、用户下线，在GatewayWorker的Event.php中有一个onClose回调函数。有一个$client_id参数，根据$client_id去查询数据库属于哪一个分组，然后通过Gateway::sendToGroup 通知对应的分组，该客户端已经下线。如果是在全体分组里，直接调用Gateway::sendToAll
	详细开发文档参考 [GatewayWorker2.x 3.x 手册](http://www.workerman.net/gatewaydoc/)

    欢迎学习交流。QQ：1090035743