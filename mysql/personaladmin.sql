/*
Navicat MySQL Data Transfer

Source Server         : 腾讯云
Source Server Version : 50552
Source Host           : 123.206.26.175:3306
Source Database       : personaladmin

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2017-05-10 21:40:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for lq_seo
-- ----------------------------
DROP TABLE IF EXISTS `lq_seo`;
CREATE TABLE `lq_seo` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'seo id',
  `a_title` char(20) NOT NULL COMMENT 'seo 的导航名称',
  `a_desc` varchar(255) NOT NULL COMMENT 'seo描述',
  `a_keywords` char(80) NOT NULL COMMENT 'seo关键字',
  `a_author` char(10) NOT NULL COMMENT 'seo作者',
  `a_alias` char(20) NOT NULL COMMENT 'seo别名',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='//项目seo表';

-- ----------------------------
-- Records of lq_seo
-- ----------------------------
INSERT INTO `lq_seo` VALUES ('3', '刘强个人网站', '这是刘强自己的个人网站，主要从事计算机web方向，HTML，CSS，DIV，PHP，mysql，Laravel，框架，博客，电影等', '刘强，强哥，自讽，不敢为天下，PHP，个人网站，计算机，编程，代码，游戏，朋友 ，旅游，电影，音乐，PUA，撩妹', '刘强', 'website');
INSERT INTO `lq_seo` VALUES ('4', '刘强个人博客', '刘强的个人博客，博客系统，刘强，强哥，学习，交流，laravel博客系统。框架系统。QQ：1090035743', '刘强的个人博客，刘强的博客，刘强，编程博客系统', '刘强', 'blog');
