<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:90:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\admin\backStage\editSeo.html";i:1492439953;s:73:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\layout.html";i:1491802852;s:80:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\common\header.html";i:1492501070;s:80:"E:\WebRoot\PersonalCommunity\public/../application/admin\view\common\footer.html";i:1492419437;}*/ ?>
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
        // 定义获取添加博客分类控制器地址
        var blogController = '<?php echo url('SeoController/eidtSeoController'); ?>';
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
                        <ul class="tpl-left-nav-sub-menu" style="display: none;">
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
                        

                                <a href="/messagelist.html" >
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
                        <ul class="tpl-left-nav-sub-menu" style="display: block;">
                            <li>
                                <a href="/seo.html" class="active">
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
                <li><a href="#">个人博客</a></li>
                <li class="am-active">修改分类</li>
            </ol>
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 修改分类
                    </div>
                </div>
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="tpl-form-body tpl-form-line">
                            <form class="am-form tpl-form-line-form" id="submitForm">
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">分类标题 <span class="tpl-form-line-small-title">Title</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" id="category_title" name="seo_title" class="tpl-form-input" value="<?php echo $seo->a_title; ?>"  placeholder="请输入分类标题">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">分类描述 <span class="tpl-form-line-small-title">Description</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" id="category_desc" value="<?php echo $seo->a_desc; ?>" name="seo_desc" placeholder="输入分类描述">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">分类关键字 <span class="tpl-form-line-small-title">Keywords</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" id="category_tag" value="<?php echo $seo->a_keywords; ?>" name="seo_keywords" placeholder="输入分类关键字，以英文半角逗号分隔(,)">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="button" id="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">修改SEO</button>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $seo->a_id; ?>">
                            </form>

                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>

    <script src="/static/admin/js/addCategory.js"></script>

	<script src="/static/admin/js/clearPhotos.js"></script>
    <script src="/static/admin/assets/js/amazeui.min.js"></script>
    <!-- <script src="/static/admin/assets/js/iscroll.js"></script> -->
    <script src="/static/admin/assets/js/app.js"></script>
</body>

</html>
