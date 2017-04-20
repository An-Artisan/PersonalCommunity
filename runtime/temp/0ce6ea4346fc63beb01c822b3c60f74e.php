<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"E:\WebRoot\PersonalCommunity\public/../application/index\view\index\index.html";i:1492241923;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<!-- 低版本浏览器兼容显示 -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content="<?php echo $desc; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="author" content="<?php echo $author; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/static/index/css/normalize.css">
    <link rel="stylesheet" href="/static/index/css/font-awesome.css">
    <link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/index/css/templatemo-style.css">
    <link rel="stylesheet" href="/static/common/layui/css/layui.css">
    <script src="/static/index/js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="/static/common/jquery-3.1.1.js"></script>
    <script src="/static/common/layer/layer.js"></script>
    <script src="/static/common/layui/layui.js"></script>
    <script>
        // 定义获取验证控制器地址
        var albumEncryptionController = '<?php echo url('albumEncryption'); ?>';
        // 定义获取照片控制器地址
        var photosController='<?php echo url('photos'); ?>';
        // 定义留言上传图片控制器
        var message = '<?php echo url('message'); ?>';
    </script>
    <script src="/static/common/common.js"></script>
    
</head>
<script>
    window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"2","bdPos":"right","bdTop":"100"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
</script>
<!-- 百度分享按钮结束 -->
<body>
        <!--[if lt IE 7]>
            <p class="browsehappy">您的浏览器<strong>版本过低</strong>. 请<a href="https://www.baidu.com/link?url=xETfqpJObUOgPSrr172JkabcH_igz4bDE2Y-gT45H6nwGboy29ughUXkZtAuASzSftWzbh2QOFOaRwcBl_IHsQ1gNMkd53apYX_8DXwTMnS&wd=&eqid=c2a92ccd0000d4610000000558ca9927">点击我下载最新浏览器</a>来提高您的上网体验~~</p>
        <![endif]-->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">刘强个人社区</a>
    </div>
   
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown active"><a href="#">个人网站</a></li>
        <li><a href="<?php echo url('blog/Index/index'); ?>" target="_blank">个人博客</a></li>
        <li><a href="#">心情笔记</a></li>
        <li><a href="#">在线聊天</a></li>
        
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://www.github.com/g1090035743" target="_blank"><i class="fa fa-github"></i></a></li>
        <li><a href="https://zh-cn.facebook.com/people/Liu-Qiang/100009193469772" target="_blank"><i class="fa fa-facebook"></i></a></li>
        <li><a href="tencent://AddContact/?fromId=45&fromSubId=1&subcmd=all&uin=1090035743&website=www.joker1996.com" target="_blank"><i class="fa fa-qq"></i></a></li>
        <li><a href="http://www.weibo.com/u/5230817298" target="_blank" ><i class="fa fa-weibo"></i></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <!-- 小屏幕侧边栏显示到顶部 -->
        <div class="responsive-header visible-xs visible-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top-section">
                            <div class="profile-image">
                                <img src="<?php echo $joker[0]->a_photo; ?>" alt="Volton">
                            </div>
                            <div class="profile-content">
                                <h3 class="profile-title"><?php echo $joker[0]->a_author; ?></h3>
                                <p class="profile-description"><?php echo $joker[0]->a_introduce; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="toggle-menu"><i class="fa fa-bars"></i></a>
                <div class="main-navigation responsive-menu">
                    <ul class="navigation">
                        <li><a href="#top"><i class="fa fa-home"></i>&nbsp;我的主页</a></li>
                        <li><a href="#about"><i class="fa fa-user"></i>&nbsp;&nbsp;快速了解</a></li>
                        <li><a href="#projects"><i class="fa fa-picture-o"></i>我的相册</a></li>
                        <li><a href="#contact"><i class="fa fa-envelope"></i>给我留言</a></li>
                    </ul>
                </div>
            </div>
        </div>
		
        <!-- 侧边栏菜单开始 -->
        <div class="sidebar-menu hidden-xs hidden-sm">
            <div class="top-section">
                <div class="profile-image">
                    <img src="<?php echo $joker[0]->a_photo; ?>" alt="Volton">
                </div>
                <h3 class="profile-title"><?php echo $joker[0]->a_author; ?></h3>
                <p class="profile-description"><?php echo $joker[0]->a_introduce; ?></p>
            </div> 
            <div class="main-navigation">
                <ul class="navigation">
                    <li><a href="#top"><i class="fa fa-home"></i>&nbsp;我的主页</a></li>
                    <li><a href="#about"><i class="fa fa-user"></i>&nbsp;&nbsp;快速了解</a></li>
                    <li><a href="#projects"><i class="fa fa fa-picture-o"></i>我的相册</a></li>
                    <li><a href="#contact"><i class="fa fa-envelope"></i>给我留言</a></li>
                </ul>
            </div> <!-- 首页导航 -->
            <div class="social-icons">
                <ul>
                    <li><a href="http://www.github.com/g1090035743" target="_blank"><i class="fa fa-github"></i></a></li>
                    <li><a href="https://zh-cn.facebook.com/people/Liu-Qiang/100009193469772" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="tencent://AddContact/?fromId=45&fromSubId=1&subcmd=all&uin=1090035743&website=www.joker1996.com" target="_blank"><i class="fa fa-qq"></i></a></li>
                    <li><a href="http://www.weibo.com/u/5230817298" target="_blank" ><i class="fa fa-weibo"></i></a></li>
                </ul>
            </div> <!-- 社交账号链接 -->
        </div> <!-- 侧边栏菜单结束 -->
        <!-- 首页显示内容 -->
        <div class="banner-bg" id="top">
            <div class="banner-overlay"></div>
            <div class="welcome-text">
                <h2>HelloWorld | 我是刘强</h2>
                <h5>如你所见，我是一个网站开发程序员~ 不管你怎么点进来的，都欢迎和我交流学习~</h5>
            </div>
        </div>
        
        <!-- 主要内容 -->
        <div class="main-content">
            <div class="fluid-container">

                <div class="content-wrapper">
                
                    <!-- 快速了解 -->
                    <div class="page-section" id="about">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="widget-title">快速了解</h4>
                            <div class="about-image">
                                <img src="/static/index/img/9.jpg" alt="about me">
                            </div>
                            <p>我是刘强，文刀刘~，恩，名字比较普通~ 当然不太喜欢别人叫我的名字，我还是比较喜欢你们叫我刘昊，为什么是昊？恩，你把昊字分开读...... 恩，我是一个phper， 要问我性别？请移眼左上角，如果你要问我喜欢什么？那我告诉你吧~ <s>书籍：文学、哲学、经济、政治。。。业余爱好：赋诗、书法、音乐、作画。。。服饰：运动、正式、休闲。。。</s>&nbsp;妹子等~~ 什么？你只看清楚了妹子？没文化了吧~~我不喜欢的东西也很多，比如：@#￥%#￥%&%￥&%￥，汉子~ 怎么样大家已经对我有了一个大概的了解了吧，接下来我们谈谈人生和理想未来吧，嗯？没有联系方式？QQ:1090035743 微信：m1090035743。或者睁大眼睛看看左下角~~ 嗯？喜欢直接的？好~ 我电话：13330295142 欢迎小姑娘和我聊人生理想。汉子？参照上面我不喜欢的东西~</p>
                            <hr>
                        </div>
                    </div> <!-- #快速了解结束 -->
                    </div>
                    
                    <!-- 我的相册 -->
                    <div class="page-section" id="projects">
                    <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="widget-title">我的相册</h4>
                        </div>
                    </div>
                    <div class="row projects-holder">
                        <!-- 循环输出相册，并且判断该相册是加密，给该a加上id="1"，反之为"0 " -->
                        <?php if(is_array($album_date) || $album_date instanceof \think\Collection || $album_date instanceof \think\Paginator): $i = 0; $__LIST__ = $album_date;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <div class="col-md-4 col-sm-6">
                            <div class="project-item">
                                <img src="<?php echo $vo['a_cover']; ?>" height="300px;" alt="">
                                <div class="project-hover">
                                    <div class="inside">
                                        <?php if($vo['a_encryption'] == '1'): ?>
                                        <h5>
                                        <a title="该相册已加密" question="<?php echo $vo['a_question']; ?>" style="cursor: pointer;" a_id="<?php echo $vo['a_id']; ?>" name="album" id="1" ><?php echo $vo['a_title']; ?>
                                        </a>
                                        </h5>
                                        <?php else: ?>
                                        <h5>
                                        <a title="点击进入相册" style="cursor: pointer;" a_id="<?php echo $vo['a_id']; ?>" name="album" id="0" ><?php echo $vo['a_title']; ?>
                                        </a>
                                        </h5>
                                        <?php endif; ?>
                                        <p ><?php echo $vo['a_description']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div> 
                    </div>
                    <hr>

                    <!-- 给我留言 -->
                    <div class="page-section" id="contact">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="widget-title">给我留言</h4>
                        </div>
                    </div>
                    <div class="row">
                        <form  class="contact-form">
                            <fieldset class="col-md-6 col-sm-6">
                                <input type="text" id="your-name" required="required" placeholder="Your Name...">
                            </fieldset>
                            <fieldset class="col-md-6 col-sm-6">
                                <input type="email" id="email" placeholder="Your Email...">
                            </fieldset>
                            <fieldset class="col-md-12 col-sm-12">
                                 <textarea id="demo" style="display: none;"></textarea>
                            </fieldset>
                            <fieldset class="col-md-12 col-sm-12">
                                <input type="button" id="submit"   class="button big default" value="提交留言">
                            </fieldset>
                        </form>
                    </div> 
                    </div>
                    <hr>
                    <!-- 显示留言数据 -->
                    <?php if(is_array($message_data) || $message_data instanceof \think\Collection || $message_data instanceof \think\Paginator): $i = 0; $__LIST__ = $message_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12"><p class="lead"><?php echo $vo['m_name']; ?><span style="float: right;"><?php echo $vo['m_time']; ?></span></p></div>
                      <div class="col-xs-12 col-sm-12 col-md-12"><p class="lead" ><?php echo $vo['m_content']; ?><span style="float: right;"><?php echo $vo['m_email']; ?></span></p></div>
                    </div>
                    <hr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <!-- 分页数据 -->
                    <?php echo $message_data->render(); ?>
                    </div>
                    <div class="row" id="footer">
                        <div class="col-md-12 text-center">
                            <p class=""><?php echo $joker[0]->a_copyright; ?></a>
                            <br>
                            <img src="/static/index/img/icp.jpg" alt=""  ><a  href="http://www.beianbeian.com/beianxinxi/565ec5c4-fc40-4060-ba09-93bb6239c0e8.html">备案/许可证号：渝ICP备16007281号</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/static/index/js/min/plugins.min.js"></script>
        <script src="/static/index/js/min/main.min.js"></script>
        <script src="/static/index/js/myAlbum.js"></script>  
        <script src="/static/index/js/message.js"></script>  
        <script src="/static/common/common.js"></script>  
    </body>
</html>