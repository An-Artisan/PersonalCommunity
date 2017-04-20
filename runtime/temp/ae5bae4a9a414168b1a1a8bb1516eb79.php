<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"E:\WebRoot\PersonalCommunity\public/../application/blog\view\index\category.html";i:1492496158;}*/ ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title><?php if(is_array($allCategory) || $allCategory instanceof \think\Collection || $allCategory instanceof \think\Paginator): $i = 0; $__LIST__ = $allCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;if($id == $data['cate_id']): ?><?php echo $data['cate_name']; endif; endforeach; endif; else: echo "" ;endif; ?></title>
  <meta name="keywords" content='<?php if(is_array($allCategory) || $allCategory instanceof \think\Collection || $allCategory instanceof \think\Paginator): $i = 0; $__LIST__ = $allCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;if($id == $data['cate_id']): ?><?php echo $data['cate_tags']; endif; endforeach; endif; else: echo "" ;endif; ?>'>
  <meta name="description" content='<?php if(is_array($allCategory) || $allCategory instanceof \think\Collection || $allCategory instanceof \think\Paginator): $i = 0; $__LIST__ = $allCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;if($id == $data['cate_id']): ?><?php echo $data['cate_description']; endif; endforeach; endif; else: echo "" ;endif; ?>'>
  <meta name="author" content="刘强,1090035743@qq.com">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="刘强个人博客"/>
  <meta name="msapplication-TileColor" content="#0e90d2">
  <link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
  <link rel="stylesheet" href="/static/blog/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="/static/blog/assets/css/app.css">
</head>
 
<body id="blog">
<nav class="am-g am-g-fixed blog-fixed blog-nav">
  <div class="am-collapse am-topbar-collapse" id="blog-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li><a href="/blog.html">博客首页</a></li>
      <?php if(is_array($allCategory) || $allCategory instanceof \think\Collection || $allCategory instanceof \think\Paginator): $i = 0; $__LIST__ = $allCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;if($id == $data['cate_id']): ?>
      <li class="am-active">
      <a><?php echo $data['cate_name']; ?></a>
      </li>
      <?php else: ?>
      <li>
      <a href="/category-<?php echo $data['cate_id']; ?>.html" target="_blank"><?php echo $data['cate_name']; ?></a>
      </li>
      <?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
</nav>
<hr>
<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed">
    <div class="am-u-md-12 am-u-sm-12">
        <?php if(empty($categoryArticle) || (($categoryArticle instanceof \think\Collection || $categoryArticle instanceof \think\Paginator ) && $categoryArticle->isEmpty())): ?>
        <div style="font-size: 30px;">
          <center>当前分类没有文章</center>
        </div>
        <?php else: if(is_array($categoryArticle) || $categoryArticle instanceof \think\Collection || $categoryArticle instanceof \think\Paginator): $i = 0; $__LIST__ = $categoryArticle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
            <article class="am-g blog-entry-article">
              <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-img">
                  <a href="/readarticle-<?php echo $data['art_id']; ?>.html" target="_blank"><img style="height: 400px;" src="<?php echo $data['art_cover']; ?>" class="am-u-sm-12"></a>
              </div>
              <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-text">
                  <span><a class="blog-color"><?php echo $data['art_editor']; ?> &nbsp;</a></span>
                  <span>时间：<?php echo $data['art_time']; ?> &nbsp;</span>
                  <span>浏览：<?php echo $data['art_view']; ?> &nbsp;</span>
                  <h1><a href="/readarticle-<?php echo $data['art_id']; ?>.html" target="_blank"><?php echo $data['art_title']; ?></a></h1>
                  <div style="font-size: 26px;">
                    <a href="/readarticle-<?php echo $data['art_id']; ?>.html" target="_blank"><?php echo $data['art_show']; ?></a>
                  </div>
              </div>
            </article>
           <?php endforeach; endif; else: echo "" ;endif; ?>
           <?php echo $categoryArticle->render(); endif; ?>
    
    
    </div>

</div>
<!-- content end -->




<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/static/blog/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="/static/blog/assets/js/amazeui.min.js"></script>
<!-- <script src="assets/js/app.js"></script> -->
</body>
</html>