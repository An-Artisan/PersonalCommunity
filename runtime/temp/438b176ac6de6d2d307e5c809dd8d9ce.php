<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"E:\WebRoot\PersonalCommunity\public/../application/blog\view\index\article.html";i:1492496356;}*/ ?>
<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title><?php echo $articleDetails['art_title']; ?></title>
  <meta name="keywords" content="<?php echo $articleDetails['art_keywords']; ?>">
  <meta name="description" content="<?php echo $articleDetails['art_description']; ?>">
  <meta name="author" content='刘强,1090035743@qq.com'>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <link rel="stylesheet" href="/static/common/layui/css/layui.css">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="刘强个人博客"/>
  <meta name="msapplication-TileColor" content="#0e90d2">
  <link rel="stylesheet" href="/static/blog/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="/static/blog/assets/css/app.css">
  <script src="/static/common/jquery-3.1.1.js"></script>
  <script src="/static/common/layer/layer.js"></script>
  <script src="/static/common/layui/layui.js"></script>
  <script>
  $(document).ready(function(){
    url = window.location.href;
    var shareqq = "http://connect.qq.com/widget/shareqq/index.html?title=<?php echo $articleDetails['art_title']; ?>&url="+url+"&desc=<?php echo $articleDetails['art_description']; ?>&pics=&site=<?php echo $articleDetails['art_title']; ?>";
    var shareweibo = "http://v.t.sina.com.cn/share/share.php?url="+url+"&title=<?php echo $articleDetails['art_title']; ?>";
    $('#shareqq').attr('href',shareqq);
    $('#shareweibo').attr('href',shareweibo);
   });
  </script>
</head>
<body id="blog-article-sidebar">
<!-- nav start -->
<nav class="am-g am-g-fixed blog-fixed blog-nav">
  <div class="am-collapse am-topbar-collapse" id="blog-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li><a href="/blog.html">博客首页</a></li>
      <?php if(is_array($allCategory) || $allCategory instanceof \think\Collection || $allCategory instanceof \think\Paginator): $i = 0; $__LIST__ = $allCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
      <li>
      <a href="/category-<?php echo $data['cate_id']; ?>.html" target="_blank"><?php echo $data['cate_name']; ?></a>
      </li>
      <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
</nav>
<hr>
<!-- nav end -->
<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed blog-content">
    <div class="am-u-sm-12">
      <article class="am-article blog-article-p">
        <div class="am-article-hd">
          <h1 class="am-article-title blog-text-center"><?php echo $articleDetails['art_title']; ?></h1>
          <br>
          <p class="am-article-meta blog-text-center">
               <span><a href="" class="blog-color"><?php echo $articleDetails['art_editor']; ?> &nbsp;</a></span>
                <span>时间：<?php echo $articleDetails['art_time']; ?></span>
                <span>点击：<?php echo $articleDetails['art_view']; ?></span>
          </p>
        </div>        
        <div class="am-article-bd">
        <?php echo $articleDetails['art_content']; ?>
        </div>
      </article>
        
        <div class="am-g blog-article-widget blog-article-margin">
          <div class="am-u-lg-4 am-u-md-5 am-u-sm-7 am-u-sm-centered blog-text-center">
            <span class="am-icon-tags"> &nbsp;</span>
            <?php echo $articleDetails['art_tag']; ?>
            <hr>
            <!-- 分享给QQ好友 -->
            <a id="shareqq" target="_blank"><span class="am-icon-qq am-icon-fw am-primary blog-icon"></span></a>
            <!-- 分享到微信 -->
            <a class="jiathis_button_weixin"><span class="am-icon-wechat am-icon-fw blog-icon"></span></a>
            <!-- 分享到微信JS -->
            <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1" charset="utf-8"></script>
            <!-- 分享到微博 -->
            <a id="shareweibo"  target="_blank"><span class="am-icon-weibo am-icon-fw blog-icon" ></span></a>
          </div>
        </div>

        <hr>
        <div class="am-g blog-author blog-article-margin">
          <div class="am-u-sm-3 am-u-md-3 am-u-lg-2">
            <img src="<?php echo $photo; ?>" alt="" class="blog-author-img am-circle">
          </div>
          <div class="am-u-sm-9 am-u-md-9 am-u-lg-10">
          <h3><span>作者 &nbsp;: &nbsp;</span><span class="blog-color"><?php echo $articleDetails['art_editor']; ?></span></h3>
            <p><?php echo $introduce; ?></p>
          </div>
        </div>
        <hr>
        <ul class="am-pagination blog-article-margin">
          <?php if(empty($prev) || (($prev instanceof \think\Collection || $prev instanceof \think\Paginator ) && $prev->isEmpty())): ?>
          <li class="am-pagination-prev"><a>没有上一篇了</a></li>
          <?php else: ?>
          <li  class="am-pagination-prev" ><a href="/readarticle-<?php echo $prev[0]['art_id']; ?>.html" target="_blank"><?php echo $prev[0]['art_title']; ?></a></li>
          <?php endif; if(empty($next) || (($next instanceof \think\Collection || $next instanceof \think\Paginator ) && $next->isEmpty())): ?>
          <li class="am-pagination-next"> <a>没有下一篇了</a></li>
          <?php else: ?>
          <li class="am-pagination-next" ><a href="/readarticle-<?php echo $next[0]['art_id']; ?>.html" target="_blank"><?php echo $next[0]['art_title']; ?></a></li>
          <?php endif; ?>
          
        </ul>
        
        <hr>

    </div>

   
   
</div>

<!-- content end -->
  
  <footer class="blog-footer">
    <div class="blog-text-center"><?php echo $copyright; ?></div>    
  </footer>



<!--[if (gte IE 9)|!(IE)]><!-->
<!-- <script src="/static/blog/assets/js/jquery.min.js"></script> -->
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="/static/blog/assets/js/amazeui.min.js"></script>
<!-- <script src="assets/js/app.js"></script> -->
<script src="/static/blog/js/article.js"></script>
</body>
</html>