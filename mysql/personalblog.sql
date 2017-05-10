/*
Navicat MySQL Data Transfer

Source Server         : 腾讯云
Source Server Version : 50552
Source Host           : 123.206.26.175:3306
Source Database       : personalblog

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2017-05-10 21:40:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for lq_article
-- ----------------------------
DROP TABLE IF EXISTS `lq_article`;
CREATE TABLE `lq_article` (
  `art_id` int(11) NOT NULL AUTO_INCREMENT,
  `art_title` varchar(100) NOT NULL DEFAULT '' COMMENT '//文章标题',
  `art_tag` varchar(100) NOT NULL DEFAULT '' COMMENT '//关键词',
  `art_keywords` varchar(100) NOT NULL COMMENT '//文章关键字',
  `art_description` varchar(100) NOT NULL DEFAULT '' COMMENT '//描述',
  `art_cover` varchar(100) NOT NULL DEFAULT 'uploads/20160726104008518.jpg' COMMENT '//文章封面图',
  `art_show` text NOT NULL COMMENT '文章展示前缀描述',
  `art_content` text NOT NULL COMMENT '//文章内容',
  `art_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '//发布时间',
  `art_editor` varchar(50) NOT NULL DEFAULT '' COMMENT '//作者',
  `art_view` int(11) NOT NULL DEFAULT '0' COMMENT '//查看次数',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '//分类id',
  PRIMARY KEY (`art_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='//文章';

-- ----------------------------
-- Records of lq_article
-- ----------------------------
INSERT INTO `lq_article` VALUES ('1', '测试文章', '上线,反正,而已,nbsp', '一看,留着,不写,反正,nbsp', '测试文章', '/static/blog/articleImages/2017-05-10/1494420559.png', '嗯。上线了。~~~反正我也不写。留着看一看而已~~…', '<p>嗯。上线了。</p><p><img src=\"/static/blog/articleImages/2017-05-10/1494420559.png\" alt=\"1494420559.png\"><br></p><p>~~~&nbsp;</p><p>反正我也不写。留着看一看而已~~</p><p><img src=\"http://www.joker1996.com/static/common/layui/images/face/1.gif\" alt=\"[嘻嘻]\"><br></p>', '2017-05-10 20:49:49', '不敢为天下', '6', '5');

-- ----------------------------
-- Table structure for lq_category
-- ----------------------------
DROP TABLE IF EXISTS `lq_category`;
CREATE TABLE `lq_category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '//分类id',
  `cate_name` varchar(50) NOT NULL DEFAULT '' COMMENT '//分类名称',
  `cate_tags` varchar(255) NOT NULL DEFAULT '' COMMENT '//Tag标签',
  `cate_description` varchar(255) NOT NULL DEFAULT '' COMMENT '//标题描述',
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='//文章分类';

-- ----------------------------
-- Records of lq_category
-- ----------------------------
INSERT INTO `lq_category` VALUES ('5', '心情随笔', '刘强个人博客,杂项,心情,随笔', '刘强个人博客的一些随笔~');
INSERT INTO `lq_category` VALUES ('6', '程序人生', 'php,python,java,javascript,mysql,thinkphp,laravel,wokerman', '关于编程的一些的文章，php，Python，java，JavaScript，mysql，thinkphp，laravel，wokerman');
INSERT INTO `lq_category` VALUES ('7', '心血来潮', '生活,感悟,体会,感情,恋爱,把妹', '关于生活那些事儿~');
INSERT INTO `lq_category` VALUES ('8', '旅途见闻', '旅游,穷游,见闻', '关于一个人的旅行那些事~');

-- ----------------------------
-- Table structure for lq_photos
-- ----------------------------
DROP TABLE IF EXISTS `lq_photos`;
CREATE TABLE `lq_photos` (
  `pho_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '//文章照片id',
  `art_id` int(11) NOT NULL,
  `pho_address` varchar(255) NOT NULL COMMENT '//照片地址',
  `pho_filename` char(30) NOT NULL COMMENT '//照片名',
  PRIMARY KEY (`pho_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='//文章图片表';

-- ----------------------------
-- Records of lq_photos
-- ----------------------------
INSERT INTO `lq_photos` VALUES ('1', '1', '/static/blog/articleImages/2017-05-10/1494420559.png', '1494420559.png');
