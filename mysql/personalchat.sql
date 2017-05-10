/*
Navicat MySQL Data Transfer

Source Server         : 腾讯云
Source Server Version : 50552
Source Host           : 123.206.26.175:3306
Source Database       : personalchat

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2017-05-10 21:40:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for lq_group
-- ----------------------------
DROP TABLE IF EXISTS `lq_group`;
CREATE TABLE `lq_group` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分组id',
  `g_name` varchar(255) NOT NULL COMMENT '分组名称',
  `g_uid` char(50) NOT NULL COMMENT 'socket连接id',
  `g_nickname` char(30) NOT NULL COMMENT '用户昵称',
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lq_group
-- ----------------------------

-- ----------------------------
-- Table structure for lq_user
-- ----------------------------
DROP TABLE IF EXISTS `lq_user`;
CREATE TABLE `lq_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user表自增id',
  `username` char(30) NOT NULL COMMENT '用户登录名',
  `third_id` char(20) NOT NULL COMMENT '第三方client_id',
  `password` char(65) NOT NULL COMMENT '用户登录密码',
  `nickname` char(25) NOT NULL COMMENT '用户昵称',
  `user_head` varchar(255) NOT NULL COMMENT '用户头像url地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lq_user
-- ----------------------------
INSERT INTO `lq_user` VALUES ('3', '', 'baidu_3576971883', '', '亵渎遮天', 'http://tb.himg.baidu.com/sys/portraitn/item/0cd5e4bab5e6b88ee981aee5a4a9b430');
INSERT INTO `lq_user` VALUES ('4', '', 'tencent_101399466', '', '自讽', 'http://q.qlogo.cn/qqapp/101399466/307404F22BEE1F836036E08DB964F169/100');
INSERT INTO `lq_user` VALUES ('5', '', 'sina_5230817298', '', '不敢为天下', 'http://tva2.sinaimg.cn/crop.5.0.183.183.50/005HZYwWjw8fc33059fkaj305k05kweb.jpg');
INSERT INTO `lq_user` VALUES ('6', 'liuqiang', '', '$2y$10$dM1KaRd27NpyUI7Awmqvu.Cg7OeFvdhFic4JF997wgKXXRzfRHMWe', 'joker', '/static/chat/userImages/14944233763049.png');
