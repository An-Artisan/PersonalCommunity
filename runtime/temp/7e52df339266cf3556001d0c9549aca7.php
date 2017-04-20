<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:89:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\admin\webSite\addAlbum.html";i:1492438637;s:73:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\layout.html";i:1491802852;s:80:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\common\header.html";i:1492501070;s:80:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\common\footer.html";i:1492419437;}*/ ?>
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







    
 
<script>
        // 定义获取添加相册控制器地址
        var albumController = '<?php echo url('AlbumController/addAlbumController'); ?>';
</script>
        <div class="tpl-page-container tpl-page-header-fixed">


        <div class="tpl-left-nav tpl-left-nav-hover">
            <div class="tpl-left-nav-list">
                <ul class="tpl-left-nav-menu">
                    <li class="tpl-left-nav-item">
                        <a href="/admin.html" class="nav-link ">
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
                        <ul class="tpl-left-nav-sub-menu" style="display: block;">
                            <li>
                                <a href="/albumlist.html">
                                    <i class="am-icon-angle-right"></i>
                                    <span>相册管理</span>
                                    <i class="tpl-left-nav-content tpl-badge-success">
                                    <?php echo $album_count; ?>
                                    </i>
                                </a>
                                <a href="/addalbum.html" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>添加相册</span>
                                
                                <a href="/allphotos.html">
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
            
            <ol class="am-breadcrumb">
                <li><a href="#" class="am-icon-home">首页</a></li>
                <li><a href="#">个人网站</a></li>
                <li class="am-active">新增相册</li>
            </ol>
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 新增相册
                    </div>
                </div>
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="tpl-form-body tpl-form-line">
                            <form class="am-form tpl-form-line-form" id="submitForm" enctype="multipart/form-data">
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">相册标题 <span class="tpl-form-line-small-title">Title</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" id="album_title" class="tpl-form-input" name="album_title" placeholder="请输入标题文字">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">相册描述 <span class="tpl-form-line-small-title">Description</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" id="album_desc" name="album_desc" placeholder="输入相册描述">
                                    </div>
                                </div>
                               <!--  <div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label">发布时间 <span class="tpl-form-line-small-title">Time</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="am-form-field tpl-form-no-bg" placeholder="发布时间" data-am-datepicker="" readonly/>
                                        <small>发布时间为必填</small>
                                    </div>
                                </div> -->

                                <!-- <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">分类 <span class="tpl-form-line-small-title">Category</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{searchBox: 1}">
                                      <option value="a">-The.CC</option>
                                      <option value="b">夕风色</option>
                                      <option value="o">Orange</option>
                                    </select>
                                    </div>
                                </div> -->

                                <!-- <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">SEO关键字 <span class="tpl-form-line-small-title">SEO</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" placeholder="输入SEO关键字">
                                    </div>
                                </div>
 -->
                                <div class="am-form-group">
                                    <label for="user-weibo" class="am-u-sm-3 am-form-label">封面图 <span class="tpl-form-line-small-title">Images</span></label>
                                    <div class="am-u-sm-9">
                                        <div class="am-form-group am-form-file">
                                            <div class="tpl-form-file-img" id="append"></div>
                                            <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 添加相册封面图片
                                            </button>
                                            <input id="doc-form-file"  type="file" name="pic" >
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">作者 <span class="tpl-form-line-small-title">Author</span></label>
                                    <div class="am-u-sm-9">
                                    <select id="album_author" name="album_author">
                                    <option value="不敢为天下" selected >不敢为天下</option>
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">加密
                                    <span class="tpl-form-line-small-title">Encryption</span></label>
                                    </label>
                                    <div class="am-u-sm-9">
                                        <div class="tpl-switch">
                                            <input type="checkbox" name="checkbox" class="ios-switch bigswitch tpl-switch-btn" />
                                            <div class="tpl-switch-btn-view">
                                                <div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="encryption" style="display: none;">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">设置问题 <span class="tpl-form-line-small-title">Question</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" id="album_question" name="album_question" placeholder="请输入问题">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">正确答案 <span class="tpl-form-line-small-title">Answer</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" id="album_answer" name="album_answer" placeholder="请输入正确答案">
                                    </div>
                                </div>
                                </div>
                               <!--  <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">文章内容</label>
                                    <div class="am-u-sm-9">
                                        <textarea class="" rows="10" id="user-intro" placeholder="请输入文章内容"></textarea>
                                    </div>
                                </div> -->

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="button" id="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">创建相册</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>

    <script src="/static/admin/js/addAlbum.js"></script>

	<script src="/static/admin/js/clearPhotos.js"></script>
    <script src="/static/admin/assets/js/amazeui.min.js"></script>
    <!-- <script src="/static/admin/assets/js/iscroll.js"></script> -->
    <script src="/static/admin/assets/js/app.js"></script>
</body>

</html>
