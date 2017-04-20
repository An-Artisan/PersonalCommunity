<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:78:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\admin\index.html";i:1492492418;s:73:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\layout.html";i:1491802852;s:80:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\common\header.html";i:1492501070;s:80:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\common\footer.html";i:1492419437;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>后台管理界面</title>
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="apple-mobile-web-app-title" content="刘强后台管理" />
    <link rel="stylesheet" href="/static/admin/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/admin.css">
    <link rel="stylesheet" href="/static/admin/assets/css/app.css">
    <link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
    <script src="/static/common/jquery-3.1.1.js"></script>
    <script src="/static/common/jquery.form.js"></script>
    <script src="/static/common/layer/layer.js"></script>
    <script src="/static/admin/assets/js/echarts.min.js"></script>
    <script src="/static/common/common.js"></script>
    <script type="text/javascript">
        var chearPhotos = "<?php echo url('admin/Index/clearPhotos'); ?>";
    </script>
</head>
<body style="overflow-y:scroll;" data-type="index">
    <header class="am-topbar am-topbar-inverse admin-header">
        <div class="am-topbar-brand">
            <a href="javascript:;" class="tpl-logo">
                <img src="/static/index/img/logo.jpg" alt="">
            </a>
        </div>
        <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">
        </div>

        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
                <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen" class="tpl-header-list-link"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>

                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="tpl-header-list-user-ico"> <img src="/static/index/head/14924956137173.png"></span>
                    </a>
                    <ul class="am-dropdown-content">
                        <li><a href="/personal.html"><span class="am-icon-bell-o"></span>查看资料</a></li>
                        <li id="clear"><a><span class="am-icon-cog"></span>清除图片冗余</a></li>
                        <li><a href="<?php echo url('admin/index/logout'); ?>"><span class="am-icon-power-off"></span> 退出登录</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </header>







    
 

<div class="tpl-page-container tpl-page-header-fixed">


        <div class="tpl-left-nav tpl-left-nav-hover">
            
            <div class="tpl-left-nav-list">
                <ul class="tpl-left-nav-menu">
                    <li class="tpl-left-nav-item">
                        <a href="/admin.html" class="nav-link active">
                            <i class="am-icon-home"></i>
                            <span>首页</span>
                        </a>
                    </li>

                    <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-table"></i>
                            <span>个人网站</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu">
                            <li>
                        <a href="/albumlist.html" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>相册管理</span>
                                    <i class="tpl-left-nav-content tpl-badge-success">
                                    <?php echo $album_count; ?>
                                    </i>
                                </a>
                                   <a href="/addalbum.html">
                                    <i class="am-icon-angle-right"></i>
                                    <span>添加相册</span>
                                <a href="/allphotos.html" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>查看照片</span>
                                    <i class="tpl-left-nav-content tpl-badge-success">
                                    <?php echo $photos_count; ?>
                                    </i>
                        

                                        <a href="/messagelist.html">
                                            <i class="am-icon-angle-right"></i>
                                            <span>留言列表</span>
                                            <i class="tpl-left-nav-content tpl-badge-primary">
                                              <?php echo $message_count; ?>
                                             </i>


                                        </a>
                            </li>
                        </ul>
                    </li>

                    <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-wpforms"></i>
                            <span>个人博客</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                         <ul class="tpl-left-nav-sub-menu" style="display: none;">
                             <li>

                               <a href="/articlelist.html" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>博客列表</span>
                                    <i class="tpl-left-nav-content tpl-badge-success">
                                    <?php echo $article_count; ?>
                                    </i>
                                </a>
                            </li>
                            <li>

                               <a href="/addarticle.html" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>添加文章</span>
                                    <i class="tpl-left-nav-content tpl-badge-primary">
                                    </i>
                                </a>
                            </li>
                            <li>

                               <a href="/addcategory.html"   >
                                    <i class="am-icon-angle-right"></i>
                                    <span>新增分类</span>
                                    <i class="tpl-left-nav-content tpl-badge-primary">
                                    </i>
                                </a>
                            </li>
                             <li>

                               <a href="/categorylist.html" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>分类列表</span>
                                    <i class="tpl-left-nav-content tpl-badge-success">
                                    <?php echo $category_count; ?>
                                    </i>
                                </a>
                            </li>
                        </ul>
                    </li>
                     <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-wpforms"></i>
                            <span>后台管理</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" style="display: none;">
                            <li>
                                <a href="/seo.html" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>SEO管理</span>
                                </a>
                            </li>
                            <li>
                                <a href="/personal.html" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>个人资料</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tpl-content-wrapper">
        <ul>        <!-- 获取当前时间，并且每秒实时更新时间 -->
                    <li>
                        <label>北京时间:</label>
                        <span id="time" style="font-weight:bold">
                        <?php 
                        date_default_timezone_set('PRC'); //设置中国时区 
                        echo date('Y-m-d H:i:s',time());
                         ?>
                        </span>
                    </li>
                    <!-- 获取当前访问IP地址 -->
                    <li>
                        <label>当前IP:</label>
                        <span>
                        <?php 
                            if (isset($_SERVER)){
                                if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                                    // 如果设置了代理服务器就获取客户端的真实IP
                                    $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                                } else {
                                    // 没有设置代理服务器就直接获取服务器根据客户端指定的IP
                                    $realip = $_SERVER["REMOTE_ADDR"];
                                }
                            } 
                        echo $realip;
                         ?>
                        </span>
                    </li>
                    <!-- 获取当前的操作系统详细配置信息 -->
                    <li>
                        <label>服务器操作系统:</label>
                        <span> 
                        <?php  echo  php_uname();  ?>
                        </span>
                    </li>
                    <!-- 获取当前Web服务器的运行环境 -->
                    <li>
                        <label>运行环境：</label>
                        <span> 
                        <?php echo $_SERVER ['SERVER_SOFTWARE']; ?>
                        </span>
                    </li>
                    <!-- 获取当前PHP SAPI interface -->
                    <li>
                        <label>SAPI Interface:</label>
                        <span>
                         <?php  echo php_sapi_name();  ?>
                        </span>
                    </li>
                    <!-- 获取当前服务器的PHP版本 -->
                    <li>
                        <label>PHP版本</label>
                        <span>
                        <?php  echo PHP_VERSION;  ?> 
                        </span>
                    </li>
                    <!-- 获取当前图片处理GD图版本 -->
                    <li>
                        <label>GD库版本:</label>
                        <span>
                        <?php  
                        if(function_exists("gd_info")){ 
                            $gd = gd_info();
                            $gdinfo = $gd['GD Version'];
                        }else 
                        {
                            $gdinfo = "未知";
                        } 
                        echo $gdinfo; 
                         ?> 
                        </span>
                    </li>
                    <!-- 获取PHP核心Zend 引擎版本 -->
                    <li>
                        <label>Zend Gngine:</label>
                        <span>
                         <?php echo zend_version();  ?> 
                        </span>
                    </li>
                    <!-- mysqli是否支持 -->
                    <li>
                        <label>Mysql支持:</label>
                        <span>
                        <?php  echo function_exists('mysqli_close')?"是":"否";   ?>
                        </span>
                    </li>
                    <!-- 获取mysql是否持续链接 -->
                    <li>
                        <label>Mysql持续连接:</label>
                        <span>
                        <?php  echo get_cfg_var("mysql.allow_persistent")?"是 ":"否";  ?>
                        </span>
                    </li>
                    <!-- 获取mysql的最大连接数 -->
                    <li>
                        <label>Mysql最大连接数:</label>
                        <span>
                        <?php  echo get_cfg_var("mysql.max_links")==-1 ? "不限" : get_cfg_var("mysql.max_links"); ?>
                        </span>
                    </li>
                    <!-- 获取脚本运行占用最大内存 -->
                    <li>
                        <label>运行占用最大内存:</label>
                        <span>
                        <?php  echo get_cfg_var ("memory_limit")?get_cfg_var("memory_limit"):"无"  ?>
                        </span>
                    </li>
                    <!-- 获取上传附件的最大限制 -->
                    <li>
                        <label>上传单次附件大小限制:</label>
                        <span>
                        <?php  echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件";  ?>
                        </span>
                    </li>
                    <!-- 获取脚本的最大执行时间 -->
                    <li>
                        <label>最大执行时间:</label>
                        <span>
                        <?php  echo get_cfg_var("max_execution_time")."秒 ";  ?>
                        </span>
                    </li>
                    <!-- 获取服务器的域名 -->
                    <li>
                        <label>服务器域名:</label>
                        <span>
                        <?php  echo $_SERVER["HTTP_HOST"];  ?>
                        </span>
                    </li>
                    <!-- 获取服务器的IP -->
                    <li>
                        <label>服务器IP地址:</label><span>
                        <?php 
                            if (isset($_SERVER)) { 
                                if($_SERVER['SERVER_ADDR']) {
                                    $server_ip = $_SERVER['SERVER_ADDR']; 
                                } else { 
                                    $server_ip = $_SERVER['LOCAL_ADDR']; 
                                } 
                            } else { 
                                $server_ip = getenv('SERVER_ADDR');
                            } 
                            echo $server_ip; 
                          ?>
                         </span>
                    </li>
                    <!-- 获取服务器支持的语言 -->
                    <li>
                        <label>服务器语言:</label>
                        <span> 
                        <?php  echo  $_SERVER['HTTP_ACCEPT_LANGUAGE'];  ?>
                        </span>
                    </li>
                    <!-- 获取服务器的Web端口号 -->
                    <li>
                        <label>Web端口号</label>
                        <span>
                         <?php  
                         echo $_SERVER['SERVER_PORT']; 
                          ?>
                        </span>
                    </li>

        </ul>
                       


        </div>

    </div>
<script>
    setInterval(function(){document.getElementById('time').innerHTML = getNowFormatDate();},1000);
</script>


	<script src="/static/admin/js/clearPhotos.js"></script>
    <script src="/static/admin/assets/js/amazeui.min.js"></script>
    <!-- <script src="/static/admin/assets/js/iscroll.js"></script> -->
    <script src="/static/admin/assets/js/app.js"></script>
</body>

</html>
