/*
Navicat MySQL Data Transfer

Source Server         : 腾讯云
Source Server Version : 50552
Source Host           : 123.206.26.175:3306
Source Database       : personalwebsite

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2017-05-10 21:41:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for lq_administrator
-- ----------------------------
DROP TABLE IF EXISTS `lq_administrator`;
CREATE TABLE `lq_administrator` (
  `a_id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'id值',
  `a_author` char(20) NOT NULL COMMENT '网站作者',
  `a_photo` char(50) NOT NULL,
  `a_username` char(20) NOT NULL,
  `a_password` char(20) NOT NULL,
  `a_introduce` varchar(255) NOT NULL,
  `a_copyright` varchar(255) NOT NULL COMMENT '版权信息',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='//管理员数据表';

-- ----------------------------
-- Records of lq_administrator
-- ----------------------------
INSERT INTO `lq_administrator` VALUES ('2', '刘强', '/static/index/head/14924956137173.png', 'joker', 'HelloWorld', '毫无权势，一些知识，一些智慧，以及尽可能多的趣味。', 'Copyright © 2014-2017 <a href=\'http://www.joker1996.com\'>http://www.joker1996.com</a>. All rights reserved.');

-- ----------------------------
-- Table structure for lq_album
-- ----------------------------
DROP TABLE IF EXISTS `lq_album`;
CREATE TABLE `lq_album` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '相册分类id',
  `a_title` char(20) NOT NULL COMMENT '相册标题',
  `a_description` varchar(255) NOT NULL COMMENT '相册描述',
  `a_cover` char(60) NOT NULL COMMENT '相册封面图',
  `a_encryption` tinyint(2) NOT NULL COMMENT '是否加密',
  `a_question` varchar(255) DEFAULT NULL COMMENT '相册问题',
  `a_password` char(30) DEFAULT NULL COMMENT '相册密码',
  `a_create_time` datetime NOT NULL COMMENT '创建相册时间',
  `a_author` char(20) NOT NULL COMMENT '相册作者',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='//个人网站相册表';

-- ----------------------------
-- Records of lq_album
-- ----------------------------
INSERT INTO `lq_album` VALUES ('15', '我的高中', '那时候我还是一枚小鲜肉！', '\\static\\index\\album\\cover\\2017-04-18143949.jpg', '0', '', '', '2017-04-18 14:39:49', '不敢为天下');
INSERT INTO `lq_album` VALUES ('16', '我的家人', '不能随便看啊~', '\\static\\index\\album\\cover\\2017-04-18144126.jpg', '1', '我的外号？', 'liuhao', '2017-04-18 14:41:26', '不敢为天下');
INSERT INTO `lq_album` VALUES ('17', '我和朋友', '各种浪啊浪~~', '\\static\\index\\album\\cover\\2017-04-18144219.jpg', '0', '', '', '2017-04-18 14:42:19', '不敢为天下');
INSERT INTO `lq_album` VALUES ('18', '随手乱拍', '瞎几把乱拍的图片~', '\\static\\index\\album\\cover\\2017-04-18144336.jpg', '0', '', '', '2017-04-18 14:43:36', '不敢为天下');
INSERT INTO `lq_album` VALUES ('19', '一些回忆', '恩，你懂得~', '\\static\\index\\album\\cover\\2017-04-18144415.jpg', '1', 'My Love？', 'null', '2017-04-18 14:44:15', '不敢为天下');
INSERT INTO `lq_album` VALUES ('20', '一些自拍', '总有些自拍用来镇场子~~', '\\static\\index\\album\\cover\\2017-04-18144511.jpg', '0', '', '', '2017-04-18 14:45:11', '不敢为天下');

-- ----------------------------
-- Table structure for lq_message
-- ----------------------------
DROP TABLE IF EXISTS `lq_message`;
CREATE TABLE `lq_message` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '留言自增ID',
  `m_name` char(50) NOT NULL COMMENT '留言昵称',
  `m_email` varchar(20) NOT NULL COMMENT '留言邮箱',
  `m_content` varchar(255) NOT NULL COMMENT '留言内容',
  `m_time` datetime NOT NULL COMMENT '留言时间',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='//建立个人网站留言表';

-- ----------------------------
-- Records of lq_message
-- ----------------------------

-- ----------------------------
-- Table structure for lq_photos
-- ----------------------------
DROP TABLE IF EXISTS `lq_photos`;
CREATE TABLE `lq_photos` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '//照片id',
  `p_category` tinyint(4) NOT NULL COMMENT '相册分类，对应lq_album的a_id',
  `p_title` char(60) NOT NULL COMMENT '图片标题',
  `p_address` char(75) NOT NULL COMMENT '图片地址',
  `p_thum` char(60) NOT NULL COMMENT '图片缩略图',
  `p_time` datetime NOT NULL COMMENT '上传时间',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8 COMMENT='// 个人网站图片表';

-- ----------------------------
-- Records of lq_photos
-- ----------------------------
INSERT INTO `lq_photos` VALUES ('293', '15', '20170510/c8ad935ad457212ffb0e173c2fb37473.jpg', '/static/index/album/photos/20170510/c8ad935ad457212ffb0e173c2fb37473.jpg', '/static/index/album/thumb/14944204572522.png', '2017-05-10 20:47:37');
INSERT INTO `lq_photos` VALUES ('294', '15', '20170510/ecc2acf405652a573a24e88bf0161941.jpg', '/static/index/album/photos/20170510/ecc2acf405652a573a24e88bf0161941.jpg', '/static/index/album/thumb/14944204571226.png', '2017-05-10 20:47:38');
INSERT INTO `lq_photos` VALUES ('295', '15', '20170510/3f187904a792e5604e211150a30e80f3.jpg', '/static/index/album/photos/20170510/3f187904a792e5604e211150a30e80f3.jpg', '/static/index/album/thumb/14944204586614.png', '2017-05-10 20:47:38');
INSERT INTO `lq_photos` VALUES ('296', '15', '20170510/7237717d3b0b08ea1638e1df9eef7797.jpg', '/static/index/album/photos/20170510/7237717d3b0b08ea1638e1df9eef7797.jpg', '/static/index/album/thumb/14944204585284.png', '2017-05-10 20:47:38');
INSERT INTO `lq_photos` VALUES ('297', '15', '20170510/9decebed32227c9062882cbe6cc0ab87.jpg', '/static/index/album/photos/20170510/9decebed32227c9062882cbe6cc0ab87.jpg', '/static/index/album/thumb/14944204588312.png', '2017-05-10 20:47:38');
INSERT INTO `lq_photos` VALUES ('298', '15', '20170510/ba0317f77ad7e43bc581258637736553.jpg', '/static/index/album/photos/20170510/ba0317f77ad7e43bc581258637736553.jpg', '/static/index/album/thumb/14944204587908.png', '2017-05-10 20:47:39');
INSERT INTO `lq_photos` VALUES ('299', '15', '20170510/3cdab663306f03dca488e999203e4593.jpg', '/static/index/album/photos/20170510/3cdab663306f03dca488e999203e4593.jpg', '/static/index/album/thumb/14944204597134.png', '2017-05-10 20:47:40');
INSERT INTO `lq_photos` VALUES ('300', '15', '20170510/a3492202014867c563f6c26a2a44c0aa.jpg', '/static/index/album/photos/20170510/a3492202014867c563f6c26a2a44c0aa.jpg', '/static/index/album/thumb/14944204608907.png', '2017-05-10 20:47:40');
INSERT INTO `lq_photos` VALUES ('301', '15', '20170510/f9b815a27a908d9b068899e35fd378ec.jpg', '/static/index/album/photos/20170510/f9b815a27a908d9b068899e35fd378ec.jpg', '/static/index/album/thumb/14944204607135.png', '2017-05-10 20:47:41');
INSERT INTO `lq_photos` VALUES ('302', '15', '20170510/f872cf580751a2a07af835224a01e2c0.jpg', '/static/index/album/photos/20170510/f872cf580751a2a07af835224a01e2c0.jpg', '/static/index/album/thumb/14944204613635.png', '2017-05-10 20:47:42');
INSERT INTO `lq_photos` VALUES ('303', '15', '20170510/37ba57bdbe6bdf2906bbadb1a45d38cc.jpg', '/static/index/album/photos/20170510/37ba57bdbe6bdf2906bbadb1a45d38cc.jpg', '/static/index/album/thumb/14944204625501.png', '2017-05-10 20:47:42');
INSERT INTO `lq_photos` VALUES ('304', '15', '20170510/6460ffe1224770849229a0fc918bcb77.jpg', '/static/index/album/photos/20170510/6460ffe1224770849229a0fc918bcb77.jpg', '/static/index/album/thumb/14944204628015.png', '2017-05-10 20:47:43');
INSERT INTO `lq_photos` VALUES ('305', '15', '20170510/7c6450eb84c673ad8bb72f33dcc691e3.jpg', '/static/index/album/photos/20170510/7c6450eb84c673ad8bb72f33dcc691e3.jpg', '/static/index/album/thumb/14944204631023.png', '2017-05-10 20:47:43');
INSERT INTO `lq_photos` VALUES ('306', '15', '20170510/7b3f5bdb35c34254d90fd308a082e43d.jpg', '/static/index/album/photos/20170510/7b3f5bdb35c34254d90fd308a082e43d.jpg', '/static/index/album/thumb/14944204633690.png', '2017-05-10 20:47:43');
INSERT INTO `lq_photos` VALUES ('307', '15', '20170510/eaa27f8a9fd7648ba5422f31bbcded13.jpg', '/static/index/album/photos/20170510/eaa27f8a9fd7648ba5422f31bbcded13.jpg', '/static/index/album/thumb/14944204631499.png', '2017-05-10 20:47:44');
INSERT INTO `lq_photos` VALUES ('308', '15', '20170510/92ab835dfb43b713476c5b4052f12c59.jpg', '/static/index/album/photos/20170510/92ab835dfb43b713476c5b4052f12c59.jpg', '/static/index/album/thumb/14944204641895.png', '2017-05-10 20:47:44');
INSERT INTO `lq_photos` VALUES ('309', '15', '20170510/54dd343c63773cb64852318dd2be4780.jpg', '/static/index/album/photos/20170510/54dd343c63773cb64852318dd2be4780.jpg', '/static/index/album/thumb/14944204647354.png', '2017-05-10 20:47:45');
INSERT INTO `lq_photos` VALUES ('310', '15', '20170510/2eacaf4c33cf85a2ef6a67ff072e66dc.jpg', '/static/index/album/photos/20170510/2eacaf4c33cf85a2ef6a67ff072e66dc.jpg', '/static/index/album/thumb/14944204655801.png', '2017-05-10 20:47:45');
INSERT INTO `lq_photos` VALUES ('311', '15', '20170510/1a945c2949894d5d457f07d1dc471649.jpg', '/static/index/album/photos/20170510/1a945c2949894d5d457f07d1dc471649.jpg', '/static/index/album/thumb/14944204651047.png', '2017-05-10 20:47:45');
INSERT INTO `lq_photos` VALUES ('312', '15', '20170510/6f9109c5533efa367e8d7e411462c131.jpg', '/static/index/album/photos/20170510/6f9109c5533efa367e8d7e411462c131.jpg', '/static/index/album/thumb/14944204651769.png', '2017-05-10 20:47:46');
INSERT INTO `lq_photos` VALUES ('313', '15', '20170510/662c8ec0e3adf3470511b8733afbef6d.jpg', '/static/index/album/photos/20170510/662c8ec0e3adf3470511b8733afbef6d.jpg', '/static/index/album/thumb/14944204668054.png', '2017-05-10 20:47:47');
INSERT INTO `lq_photos` VALUES ('314', '15', '20170510/53af3b08553c064781b68b49688aa6e1.jpg', '/static/index/album/photos/20170510/53af3b08553c064781b68b49688aa6e1.jpg', '/static/index/album/thumb/14944204673935.png', '2017-05-10 20:47:47');
INSERT INTO `lq_photos` VALUES ('315', '15', '20170510/c1295ca2e061f039e27b1f57e5b8396a.jpg', '/static/index/album/photos/20170510/c1295ca2e061f039e27b1f57e5b8396a.jpg', '/static/index/album/thumb/14944204675513.png', '2017-05-10 20:47:48');
INSERT INTO `lq_photos` VALUES ('316', '15', '20170510/52367ae68d5fdeeda1e106c15592ed70.jpg', '/static/index/album/photos/20170510/52367ae68d5fdeeda1e106c15592ed70.jpg', '/static/index/album/thumb/14944204684251.png', '2017-05-10 20:47:48');
INSERT INTO `lq_photos` VALUES ('317', '15', '20170510/55c24ca5af43c2fc1f66626c40f53b3c.jpg', '/static/index/album/photos/20170510/55c24ca5af43c2fc1f66626c40f53b3c.jpg', '/static/index/album/thumb/14944204693055.png', '2017-05-10 20:47:49');
INSERT INTO `lq_photos` VALUES ('318', '15', '20170510/90a7b1993e6a488650c8ed8b45660854.jpg', '/static/index/album/photos/20170510/90a7b1993e6a488650c8ed8b45660854.jpg', '/static/index/album/thumb/14944204694794.png', '2017-05-10 20:47:49');
INSERT INTO `lq_photos` VALUES ('319', '15', '20170510/d2d82bb88f52ff47ace211beb1f7688e.jpg', '/static/index/album/photos/20170510/d2d82bb88f52ff47ace211beb1f7688e.jpg', '/static/index/album/thumb/14944204696761.png', '2017-05-10 20:47:50');
INSERT INTO `lq_photos` VALUES ('320', '15', '20170510/4a18d0f6a5d0b745982836e4414db5f0.jpg', '/static/index/album/photos/20170510/4a18d0f6a5d0b745982836e4414db5f0.jpg', '/static/index/album/thumb/14944204702189.png', '2017-05-10 20:47:50');
INSERT INTO `lq_photos` VALUES ('321', '15', '20170510/34d5b43c8120948565a5b958b3022faf.jpg', '/static/index/album/photos/20170510/34d5b43c8120948565a5b958b3022faf.jpg', '/static/index/album/thumb/14944204716794.png', '2017-05-10 20:47:51');
INSERT INTO `lq_photos` VALUES ('322', '15', '20170510/34daa55a2c4baa29db1bbb1e02f4b563.jpg', '/static/index/album/photos/20170510/34daa55a2c4baa29db1bbb1e02f4b563.jpg', '/static/index/album/thumb/14944204718194.png', '2017-05-10 20:47:51');
INSERT INTO `lq_photos` VALUES ('323', '15', '20170510/b884c1f3f6cbb6729fd32a4dab4760ad.jpg', '/static/index/album/photos/20170510/b884c1f3f6cbb6729fd32a4dab4760ad.jpg', '/static/index/album/thumb/14944204717118.png', '2017-05-10 20:47:52');
INSERT INTO `lq_photos` VALUES ('324', '15', '20170510/6756ffaa350e9f64d0212242619dc508.jpg', '/static/index/album/photos/20170510/6756ffaa350e9f64d0212242619dc508.jpg', '/static/index/album/thumb/14944204728316.png', '2017-05-10 20:47:52');
INSERT INTO `lq_photos` VALUES ('325', '15', '20170510/b29c372ac97478dbfcc573280c7a349f.jpg', '/static/index/album/photos/20170510/b29c372ac97478dbfcc573280c7a349f.jpg', '/static/index/album/thumb/14944204728421.png', '2017-05-10 20:47:52');
INSERT INTO `lq_photos` VALUES ('326', '15', '20170510/0701710d2f3f702a2fbe9198a4ab8cf4.jpg', '/static/index/album/photos/20170510/0701710d2f3f702a2fbe9198a4ab8cf4.jpg', '/static/index/album/thumb/14944204733732.png', '2017-05-10 20:47:53');
INSERT INTO `lq_photos` VALUES ('327', '15', '20170510/57fd894ec1ca75efbabf76d86892563d.jpg', '/static/index/album/photos/20170510/57fd894ec1ca75efbabf76d86892563d.jpg', '/static/index/album/thumb/14944204733600.png', '2017-05-10 20:47:54');
INSERT INTO `lq_photos` VALUES ('328', '15', '20170510/eb89d33653dc2b4a9bec07e845d3f444.jpg', '/static/index/album/photos/20170510/eb89d33653dc2b4a9bec07e845d3f444.jpg', '/static/index/album/thumb/14944204746733.png', '2017-05-10 20:47:54');
INSERT INTO `lq_photos` VALUES ('329', '15', '20170510/0f561b752390830b16b0de332a7786aa.jpg', '/static/index/album/photos/20170510/0f561b752390830b16b0de332a7786aa.jpg', '/static/index/album/thumb/14944204741641.png', '2017-05-10 20:47:55');
INSERT INTO `lq_photos` VALUES ('330', '15', '20170510/93c45fcad73410aed3f66b3f0b13bc93.jpg', '/static/index/album/photos/20170510/93c45fcad73410aed3f66b3f0b13bc93.jpg', '/static/index/album/thumb/14944204759734.png', '2017-05-10 20:47:56');
INSERT INTO `lq_photos` VALUES ('331', '15', '20170510/f5f4af097c07c061b97a71042611970d.jpg', '/static/index/album/photos/20170510/f5f4af097c07c061b97a71042611970d.jpg', '/static/index/album/thumb/14944204765641.png', '2017-05-10 20:47:56');
INSERT INTO `lq_photos` VALUES ('332', '15', '20170510/eb529528b21e1f37a985aac6d8993bca.jpg', '/static/index/album/photos/20170510/eb529528b21e1f37a985aac6d8993bca.jpg', '/static/index/album/thumb/14944204767777.png', '2017-05-10 20:47:56');
INSERT INTO `lq_photos` VALUES ('333', '15', '20170510/c261495d5b36b809010ba15cfe0388ca.jpg', '/static/index/album/photos/20170510/c261495d5b36b809010ba15cfe0388ca.jpg', '/static/index/album/thumb/14944204763370.png', '2017-05-10 20:47:57');
INSERT INTO `lq_photos` VALUES ('334', '15', '20170510/cbbe8aef0452cc3608651676afac266c.jpg', '/static/index/album/photos/20170510/cbbe8aef0452cc3608651676afac266c.jpg', '/static/index/album/thumb/14944204771143.png', '2017-05-10 20:47:57');
INSERT INTO `lq_photos` VALUES ('335', '15', '20170510/c291bbd05e2ea6acac392ac0120a0772.jpg', '/static/index/album/photos/20170510/c291bbd05e2ea6acac392ac0120a0772.jpg', '/static/index/album/thumb/14944204775793.png', '2017-05-10 20:47:57');
INSERT INTO `lq_photos` VALUES ('336', '15', '20170510/b04c0cf511c06005331d88f16ad28066.jpg', '/static/index/album/photos/20170510/b04c0cf511c06005331d88f16ad28066.jpg', '/static/index/album/thumb/14944204773394.png', '2017-05-10 20:47:58');
INSERT INTO `lq_photos` VALUES ('337', '15', '20170510/a20c0a52eb613f520e20e0e325ccc6bc.jpg', '/static/index/album/photos/20170510/a20c0a52eb613f520e20e0e325ccc6bc.jpg', '/static/index/album/thumb/14944204783833.png', '2017-05-10 20:47:58');
INSERT INTO `lq_photos` VALUES ('338', '15', '20170510/cee701250b57040e48ee26d845cf4356.jpg', '/static/index/album/photos/20170510/cee701250b57040e48ee26d845cf4356.jpg', '/static/index/album/thumb/14944204786292.png', '2017-05-10 20:47:59');
INSERT INTO `lq_photos` VALUES ('339', '15', '20170510/bf2dcac6ea1e5621d0fed048a675c728.jpg', '/static/index/album/photos/20170510/bf2dcac6ea1e5621d0fed048a675c728.jpg', '/static/index/album/thumb/14944204794289.png', '2017-05-10 20:47:59');
INSERT INTO `lq_photos` VALUES ('340', '15', '20170510/9ccb9abf708f16d648e3cb073763d5fe.jpg', '/static/index/album/photos/20170510/9ccb9abf708f16d648e3cb073763d5fe.jpg', '/static/index/album/thumb/14944204791188.png', '2017-05-10 20:48:00');
INSERT INTO `lq_photos` VALUES ('341', '15', '20170510/2a98c7e64b4ae15d2e1f2b47bfe8f352.jpg', '/static/index/album/photos/20170510/2a98c7e64b4ae15d2e1f2b47bfe8f352.jpg', '/static/index/album/thumb/14944204802094.png', '2017-05-10 20:48:01');
INSERT INTO `lq_photos` VALUES ('342', '15', '20170510/f3898f2fd1e6ee19bd0f453f50265478.jpg', '/static/index/album/photos/20170510/f3898f2fd1e6ee19bd0f453f50265478.jpg', '/static/index/album/thumb/14944204814337.png', '2017-05-10 20:48:02');
INSERT INTO `lq_photos` VALUES ('343', '15', '20170510/e2c793cb128dda1c60ac32800aab096c.jpg', '/static/index/album/photos/20170510/e2c793cb128dda1c60ac32800aab096c.jpg', '/static/index/album/thumb/14944204821957.png', '2017-05-10 20:48:02');
INSERT INTO `lq_photos` VALUES ('344', '15', '20170510/7e13cefa85a6b4da47166d44c721658a.jpg', '/static/index/album/photos/20170510/7e13cefa85a6b4da47166d44c721658a.jpg', '/static/index/album/thumb/14944204829148.png', '2017-05-10 20:48:04');
INSERT INTO `lq_photos` VALUES ('345', '15', '20170510/4367f4218cdc6ea1d9c53ab3de625306.jpg', '/static/index/album/photos/20170510/4367f4218cdc6ea1d9c53ab3de625306.jpg', '/static/index/album/thumb/14944204847273.png', '2017-05-10 20:48:04');
INSERT INTO `lq_photos` VALUES ('346', '15', '20170510/2029c0260c6083344560e40c547e1c09.jpg', '/static/index/album/photos/20170510/2029c0260c6083344560e40c547e1c09.jpg', '/static/index/album/thumb/14944204846471.png', '2017-05-10 20:48:05');
INSERT INTO `lq_photos` VALUES ('347', '15', '20170510/e823c33e6de9e38515cad3018d9bdd60.jpg', '/static/index/album/photos/20170510/e823c33e6de9e38515cad3018d9bdd60.jpg', '/static/index/album/thumb/14944204853400.png', '2017-05-10 20:48:05');
INSERT INTO `lq_photos` VALUES ('348', '15', '20170510/91110e08a9df9529dff7d2ec33cf8ab4.jpg', '/static/index/album/photos/20170510/91110e08a9df9529dff7d2ec33cf8ab4.jpg', '/static/index/album/thumb/14944204859328.png', '2017-05-10 20:48:06');
INSERT INTO `lq_photos` VALUES ('349', '15', '20170510/21ebc5f0e052a1fe884da313f170419e.jpg', '/static/index/album/photos/20170510/21ebc5f0e052a1fe884da313f170419e.jpg', '/static/index/album/thumb/14944204861266.png', '2017-05-10 20:48:07');
INSERT INTO `lq_photos` VALUES ('350', '15', '20170510/e18304d62eea27d128f66bf5b073415c.jpg', '/static/index/album/photos/20170510/e18304d62eea27d128f66bf5b073415c.jpg', '/static/index/album/thumb/14944204879162.png', '2017-05-10 20:48:07');
INSERT INTO `lq_photos` VALUES ('351', '15', '20170510/f19e22121420ef3a191c103fc66a1d58.jpg', '/static/index/album/photos/20170510/f19e22121420ef3a191c103fc66a1d58.jpg', '/static/index/album/thumb/14944204871518.png', '2017-05-10 20:48:08');
INSERT INTO `lq_photos` VALUES ('352', '15', '20170510/cbb51713289368aedfcfbe1bbd4a6851.jpg', '/static/index/album/photos/20170510/cbb51713289368aedfcfbe1bbd4a6851.jpg', '/static/index/album/thumb/14944204887060.png', '2017-05-10 20:48:10');
INSERT INTO `lq_photos` VALUES ('353', '15', '20170510/2dca9f3b963c7d23b943497f85bab23a.jpg', '/static/index/album/photos/20170510/2dca9f3b963c7d23b943497f85bab23a.jpg', '/static/index/album/thumb/14944204907357.png', '2017-05-10 20:48:10');
INSERT INTO `lq_photos` VALUES ('354', '15', '20170510/ed7f6130b7b417b43ec8e81262847da2.jpg', '/static/index/album/photos/20170510/ed7f6130b7b417b43ec8e81262847da2.jpg', '/static/index/album/thumb/14944204907636.png', '2017-05-10 20:48:12');
INSERT INTO `lq_photos` VALUES ('355', '15', '20170510/ca49711a71859ca69665838e3ad76882.jpg', '/static/index/album/photos/20170510/ca49711a71859ca69665838e3ad76882.jpg', '/static/index/album/thumb/14944204925377.png', '2017-05-10 20:48:12');
INSERT INTO `lq_photos` VALUES ('356', '15', '20170510/d3628f49b37bf2f765fec84c4a7adf5f.jpg', '/static/index/album/photos/20170510/d3628f49b37bf2f765fec84c4a7adf5f.jpg', '/static/index/album/thumb/14944204925778.png', '2017-05-10 20:48:14');
INSERT INTO `lq_photos` VALUES ('357', '15', '20170510/791ba413cb2109ff6e4835831bf5b423.jpg', '/static/index/album/photos/20170510/791ba413cb2109ff6e4835831bf5b423.jpg', '/static/index/album/thumb/14944204941369.png', '2017-05-10 20:48:15');
INSERT INTO `lq_photos` VALUES ('358', '15', '20170510/70bf0034cc36424ecda9c60d81b979d8.jpg', '/static/index/album/photos/20170510/70bf0034cc36424ecda9c60d81b979d8.jpg', '/static/index/album/thumb/14944204957977.png', '2017-05-10 20:48:16');
INSERT INTO `lq_photos` VALUES ('359', '15', '20170510/95b73669f075e6e62139d094e0aa6f8f.jpg', '/static/index/album/photos/20170510/95b73669f075e6e62139d094e0aa6f8f.jpg', '/static/index/album/thumb/14944204962511.png', '2017-05-10 20:48:17');
INSERT INTO `lq_photos` VALUES ('360', '15', '20170510/20430ab9cb239672da2c2b00d4fd89f9.jpg', '/static/index/album/photos/20170510/20430ab9cb239672da2c2b00d4fd89f9.jpg', '/static/index/album/thumb/14944204972011.png', '2017-05-10 20:48:18');
INSERT INTO `lq_photos` VALUES ('361', '15', '20170510/c3997606fd39a6d098b05e8ad3289817.jpg', '/static/index/album/photos/20170510/c3997606fd39a6d098b05e8ad3289817.jpg', '/static/index/album/thumb/14944204987712.png', '2017-05-10 20:48:19');
INSERT INTO `lq_photos` VALUES ('362', '15', '20170510/c59fbd4f84b58b4893e12759cd291b58.jpg', '/static/index/album/photos/20170510/c59fbd4f84b58b4893e12759cd291b58.jpg', '/static/index/album/thumb/14944204997153.png', '2017-05-10 20:48:20');
INSERT INTO `lq_photos` VALUES ('363', '15', '20170510/2eb1f3129aa223cd6f0b332579caa964.jpg', '/static/index/album/photos/20170510/2eb1f3129aa223cd6f0b332579caa964.jpg', '/static/index/album/thumb/14944205008788.png', '2017-05-10 20:48:20');
INSERT INTO `lq_photos` VALUES ('364', '15', '20170510/0e9f47112b1c19020d39787474edc719.jpg', '/static/index/album/photos/20170510/0e9f47112b1c19020d39787474edc719.jpg', '/static/index/album/thumb/14944205001083.png', '2017-05-10 20:48:20');
INSERT INTO `lq_photos` VALUES ('365', '15', '20170510/c874936137c17a9d1bc6a637506c1fbe.jpg', '/static/index/album/photos/20170510/c874936137c17a9d1bc6a637506c1fbe.jpg', '/static/index/album/thumb/14944205007296.png', '2017-05-10 20:48:20');
INSERT INTO `lq_photos` VALUES ('366', '15', '20170510/1f62dbdbda4b7c7e08b3a2e27b05bbbd.jpg', '/static/index/album/photos/20170510/1f62dbdbda4b7c7e08b3a2e27b05bbbd.jpg', '/static/index/album/thumb/14944205004581.png', '2017-05-10 20:48:21');
