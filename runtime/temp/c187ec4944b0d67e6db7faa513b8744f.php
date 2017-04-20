<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"E:\WebRoot\PersonalCommunity\public/../application/index\view\index\database.html";i:1492505778;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>生成远程数据库</title>
	<link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="/static/common/jquery-3.1.1.js"></script>
</head>
<body>
	<form action="<?php echo url('index/Create/createDatabase'); ?>" method="post">
	<label for="">主机名或者IP地址</label>
	<input type="text"  class="form-control" name="address" placeholder="Username" aria-describedby="basic-addon1" value="localhost">
	<label for="">端口</label>
	<input type="text" class="form-control" name="port" placeholder="Username" aria-describedby="basic-addon1" value="3306">
	<label for="">用户名</label>
	<input type="text" class="form-control" name="username" placeholder="Username" aria-describedby="basic-addon1" value="root">
	<label for="">密码</label>
	<input type="password" class="form-control" name="password" placeholder="Password" aria-describedby="basic-addon1" >
	<input type="submit" value="生成数据库及表" name="subtmi" class="btn btn-default">
	<label for="">PS:如果是远程服务器的数据库(代表填写是是IP地址)，可能生成数据库和表以及数据速度较慢，请耐心等待！</label>
</body>
</html>