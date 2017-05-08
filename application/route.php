<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
Route::rule([

    // 个人网站路由
    '/'  =>  'index/Index/index',
    // 生成远程数据库路由
    'database' =>  ['index/Create/database',['ext'=>'html']],
    // 个人博客主页路由，后缀必选html
    'blog' =>  ['blog/Index/index',['ext'=>'html']],
    // 聊天室路由，后缀必选html
    'chat' =>  ['chat/Index/index',['ext'=>'html']],
    // 聊天室主页，group必选，正则匹配字母，后缀必选html。
    'home/:group' =>  ['chat/Index/chatRoom',['ext'=>'html'],['group'=>'^[A-Za-z]+$']],
    // 发送消息路由，后缀必选html
    'send' =>  ['chat/Index/sendMessage',['ext'=>'html']],
    // 博客分类文章路由，id必选，正则匹配数字，后缀必选html
    'category/:id' =>  ['blog/Index/categoryArticle',['ext'=>'html'],['id'=>'\d+']],
    // 博客文章路由，id必选，正则匹配数字，后缀必选html
    'readarticle/:id' =>  ['blog/Index/readArticle',['ext'=>'html'],['id'=>'\d+']],
    // 后台管理主页路由，后缀必选html
    'admin' =>  ['admin/Index/index',['ext'=>'html']],
    // 后台相册列表路由，后缀必选html
    'albumlist' =>  ['admin/AlbumController/albumList',['ext'=>'html']],
    // 后台添加相册路由，后缀必选html
    'addalbum' =>  ['admin/AlbumController/addAlbum',['ext'=>'html']],
    // 后台相片列表路由，后缀必选html
    'allphotos' =>  ['admin/PhotosController/allPhotos',['ext'=>'html']],
    // 后台留言列表路由，后缀必选html
    'messagelist' =>  ['admin/MessageController/messageList',['ext'=>'html']],
    // 后台文章列表编辑路由，id可选，正则匹配数字，因为涉及到更换分类文章。后缀必选html
    'articlelist/[:id]' =>  ['admin/BlogController/articleList',['ext'=>'html'],['id'=>'\d+']],
    // 后台添加文章路由，后缀必选html
    'addarticle' =>  ['admin/BlogController/addArticle',['ext'=>'html']],
    // 后台编辑文章路由，id必选，正则匹配数字，后缀必选html
    'editarticle/:id' =>  ['admin/BlogController/editArticle',['ext'=>'html'],['id'=>'\d+']],
    // 后台添加分类路由，后缀必选html
    'addcategory' =>  ['admin/BlogController/addCategory',['ext'=>'html']],
    // 后台编辑分类路由，id必选，正则匹配数字，后缀必选html
    'editcategory/:id' =>  ['admin/BlogController/editCategory',['ext'=>'html'],['id'=>'\d+']],
    // 后台分类列表路由，后缀必选html
    'categorylist' =>  ['admin/BlogController/categoryList',['ext'=>'html']],
    // 后台编辑相册路由，id必选，正则匹配数字，后缀必选html
    'editalbum/:id' =>  ['admin/AlbumController/editAlbum',['ext'=>'html'],['id'=>'\d+']],
    // SEO列表路由，后缀必选html
    'seo' =>  ['admin/SeoController/seo',['ext'=>'html']],
    // 编辑SEO路由，id必选，正则匹配数字，后缀必选html
    'editseo/[:id]' =>  ['admin/SeoController/editSeo',['ext'=>'html']],
    // 后台个人资料修改路由，后缀必选html
    'personal' =>  ['admin/SeoController/personal',['ext'=>'html']],
    // 上传图片层路由，后缀必选html
    'uploadlayer' =>  ['admin/PhotosController/uploadLayer',['ext'=>'html']],
    // 后台登录路由，后缀必选html
    'login' =>  ['admin/Index/login',['ext'=>'html']],
    // 'verify' =>  ['admin/Index/verify',['ext'=>'html']],
    'voice' =>  ['chat/Index/voice',['ext'=>'html']],
    // 聊天室登录界面
    'login_chat' =>  ['chat/Index/login',['ext'=>'html']],
    // 聊天室注册界面
    'register' =>  ['chat/Register/register',['ext'=>'html']],
    // 聊天室用户登录验证用户控制器
    'verifyUserInfo' =>  ['chat/Register/verifyUserInfo',['ext'=>'html']],
    // 聊天室注册控制器
    'registerController' =>  ['chat/Register/registerController',['ext'=>'html']],
    // 第三方百度登录控制器
    'baidu_login' =>  ['chat/ThirdPartyLogin/baiduLogin',['ext'=>'html']],
    // 第三方新浪登录控制器
    'sina_login' =>  ['chat/ThirdPartyLogin/sinaLogin',['ext'=>'html']],
    // 第三方腾讯登录控制器
    'tencent_login' =>  ['chat/ThirdPartyLogin/tencentLogin',['ext'=>'html']],

],'','GET|POST');