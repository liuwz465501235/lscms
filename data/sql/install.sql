/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : lscms

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-01-24 22:43:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `#@__auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `#@__auth_assignment`;
CREATE TABLE `#@__auth_assignment` (
  `user` varchar(64) NOT NULL,
  `role` varchar(64) NOT NULL,
  PRIMARY KEY (`user`,`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__auth_assignment
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__auth_category`
-- ----------------------------
DROP TABLE IF EXISTS `#@__auth_category`;
CREATE TABLE `#@__auth_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `sort_num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__auth_category
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__auth_permission`
-- ----------------------------
DROP TABLE IF EXISTS `#@__auth_permission`;
CREATE TABLE `#@__auth_permission` (
  `id` varchar(64) NOT NULL,
  `category` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `form` int(11) NOT NULL,
  `options` text,
  `default_value` mediumtext,
  `rule` varchar(64) DEFAULT NULL,
  `sort_num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__auth_permission
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__auth_relation`
-- ----------------------------
DROP TABLE IF EXISTS `#@__auth_relation`;
CREATE TABLE `#@__auth_relation` (
  `role` varchar(64) NOT NULL,
  `permission` varchar(64) NOT NULL,
  `value` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`role`,`permission`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__auth_relation
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__auth_role`
-- ----------------------------
DROP TABLE IF EXISTS `#@__auth_role`;
CREATE TABLE `#@__auth_role` (
  `id` varchar(64) NOT NULL,
  `category` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__auth_role
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__category`
-- ----------------------------
DROP TABLE IF EXISTS `#@__category`;
CREATE TABLE `#@__category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(100) NOT NULL COMMENT '分类名称',
  `url` varchar(255) DEFAULT NULL COMMENT '分类地址',
  `root` int(10) DEFAULT NULL COMMENT '根节点',
  `lft` int(10) NOT NULL COMMENT '左值',
  `rgt` int(10) NOT NULL COMMENT '右值',
  `pid` int(10) NOT NULL COMMENT '父节点的id',
  `level` smallint(5) unsigned NOT NULL COMMENT '节点所在的级别',
  `pic` varchar(255) DEFAULT NULL COMMENT '图片',
  `position` varchar(45) DEFAULT NULL COMMENT '位置',
  `if_show` tinyint(1) DEFAULT NULL COMMENT '是否显示',
  `if_delete` int(1) DEFAULT '1' COMMENT '是否可删除 1-可删除 0-不可删除',
  `memo` text COMMENT '备注',
  `sort` int(6) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `level` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of #@__category
-- ----------------------------
INSERT INTO `#@__category` VALUES ('1', '文章分类', '', '1', '1', '10', '0', '1', null, null, '1', '0', '', '0');

-- ----------------------------
-- Table structure for `#@__comment`
-- ----------------------------
DROP TABLE IF EXISTS `#@__comment`;
CREATE TABLE `#@__comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_ids` varchar(128) DEFAULT NULL,
  `content_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(64) DEFAULT NULL,
  `user_email` varchar(64) DEFAULT NULL,
  `user_url` varchar(128) DEFAULT NULL,
  `user_ip` varchar(64) DEFAULT NULL,
  `user_address` varchar(128) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__comment
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__config`
-- ----------------------------
DROP TABLE IF EXISTS `#@__config`;
CREATE TABLE `#@__config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(50) NOT NULL DEFAULT '',
  `value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__config
-- ----------------------------
INSERT INTO `#@__config` VALUES ('1', 'site_name', 'LsCMS系统');
INSERT INTO `#@__config` VALUES ('2', 'site_description', '这是一个LsCMS系统');
INSERT INTO `#@__config` VALUES ('3', 'site_domain', 'www.lscms.com');
INSERT INTO `#@__config` VALUES ('4', 'site_email', 'liuweizhong4655@gmail.com');
INSERT INTO `#@__config` VALUES ('5', 'site_language', 'zh-CN');
INSERT INTO `#@__config` VALUES ('6', 'site_status', '1');
INSERT INTO `#@__config` VALUES ('7', 'sys_icp', '');
INSERT INTO `#@__config` VALUES ('8', 'site_about', '');
INSERT INTO `#@__config` VALUES ('9', 'seo_title', 'LsCMS');
INSERT INTO `#@__config` VALUES ('10', 'seo_keywords', 'ls,cms,yii2');
INSERT INTO `#@__config` VALUES ('11', 'seo_description', '这是一个用yii2开发的cms系统');
INSERT INTO `#@__config` VALUES ('12', 'seo_head', '');
INSERT INTO `#@__config` VALUES ('13', 'home_theme', 'default');
INSERT INTO `#@__config` VALUES ('14', 'admin_theme', 'default');
INSERT INTO `#@__config` VALUES ('15', 'allow_register', '1');
INSERT INTO `#@__config` VALUES ('19', 'datetime_timezone', 'Etc/GMT-8');
INSERT INTO `#@__config` VALUES ('20', 'datetime_date_format', 'Y-m-d H:i:s');
INSERT INTO `#@__config` VALUES ('21', 'datetime_time_format', '24');

-- ----------------------------
-- Table structure for `#@__content`
-- ----------------------------
DROP TABLE IF EXISTS `#@__content`;
CREATE TABLE `#@__content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxonomy_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(64) DEFAULT NULL,
  `last_user_id` int(11) DEFAULT NULL,
  `last_user_name` varchar(64) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `focus_count` int(11) NOT NULL DEFAULT '0',
  `favorite_count` int(11) NOT NULL DEFAULT '0',
  `view_count` int(11) NOT NULL DEFAULT '0',
  `comment_count` int(11) NOT NULL DEFAULT '0',
  `agree_count` int(11) NOT NULL DEFAULT '0',
  `against_count` int(11) NOT NULL DEFAULT '0',
  `recommend` int(1) DEFAULT '0',
  `headline` int(1) DEFAULT '0',
  `sticky` int(1) DEFAULT '0',
  `flag` tinyint(4) DEFAULT '0',
  `allow_comment` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(64) DEFAULT NULL,
  `view` varchar(64) DEFAULT NULL,
  `layout` varchar(64) DEFAULT NULL,
  `sort_num` int(11) NOT NULL DEFAULT '0',
  `visibility` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `content_type` varchar(64) NOT NULL,
  `seo_title` varchar(256) DEFAULT NULL,
  `seo_keywords` varchar(256) DEFAULT NULL,
  `seo_description` varchar(256) DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `sub_title` varchar(256) DEFAULT NULL,
  `url_alias` varchar(256) DEFAULT NULL,
  `redirect_url` varchar(256) DEFAULT NULL,
  `summary` varchar(512) DEFAULT NULL,
  `thumb` varchar(256) DEFAULT NULL,
  `thumbs` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__content
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__content_page`
-- ----------------------------
DROP TABLE IF EXISTS `#@__content_page`;
CREATE TABLE `#@__content_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__content_page
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__content_post`
-- ----------------------------
DROP TABLE IF EXISTS `#@__content_post`;
CREATE TABLE `#@__content_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__content_post
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__dict`
-- ----------------------------
DROP TABLE IF EXISTS `#@__dict`;
CREATE TABLE `#@__dict` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `category_id` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  `thumb` varchar(512) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__dict
-- ----------------------------
INSERT INTO `#@__dict` VALUES ('1', '0', 'Article_Visibility', '公开', '1', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('2', '0', 'Article_Visibility', '回复可见', '2', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('3', '0', 'Article_Visibility', '密码保护', '3', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('4', '0', 'Article_Visibility', '私有', '4', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('5', '0', 'Article_Status', '发布', '1', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('6', '0', 'Article_Status', '草稿', '2', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('8', '0', 'Article_Status', '等待审核', '3', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('9', '0', 'Sex', '男', '1', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('10', '0', 'Sex', '女', '2', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('11', '0', 'Sex', '保密', '3', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('12', '0', 'Nation', '汉族', '1', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('13', '0', 'Nation', '壮族', '2', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('14', '0', 'Nation', '藏族', '3', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('15', '0', 'Nation', '裕固族', '4', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('16', '0', 'Nation', '彝族', '5', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('17', '0', 'Nation', '瑶族', '6', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('18', '0', 'Nation', '锡伯族', '7', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('19', '0', 'Nation', '乌孜别克族', '8', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('20', '0', 'Nation', '维吾尔族', '9', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('21', '0', 'Nation', '佤族', '10', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('22', '0', 'Nation', '土家族', '11', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('23', '0', 'Nation', '土族', '12', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('24', '0', 'Nation', '塔塔尔族', '13', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('25', '0', 'Nation', '塔吉克族', '14', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('26', '0', 'Nation', '水族', '15', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('27', '0', 'Nation', '畲族', '16', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('28', '0', 'Nation', '撒拉族', '17', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('29', '0', 'Nation', '羌族', '18', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('30', '0', 'Nation', '普米族', '19', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('31', '0', 'Nation', '怒族', '20', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('32', '0', 'Nation', '纳西族', '21', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('33', '0', 'Nation', '仫佬族', '22', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('34', '0', 'Nation', '苗族', '23', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('35', '0', 'Nation', '蒙古族', '24', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('36', '0', 'Nation', '门巴族', '25', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('37', '0', 'Nation', '毛南族', '26', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('38', '0', 'Nation', '满族', '27', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('39', '0', 'Nation', '珞巴族', '28', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('40', '0', 'Nation', '僳僳族', '29', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('41', '0', 'Nation', '黎族', '30', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('42', '0', 'Nation', '拉祜族', '31', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('43', '0', 'Nation', '柯尔克孜族', '32', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('44', '0', 'Nation', '景颇族', '33', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('45', '0', 'Nation', '京族', '34', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('46', '0', 'Nation', '基诺族', '35', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('47', '0', 'Nation', '回族', '36', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('48', '0', 'Nation', '赫哲族', '37', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('49', '0', 'Nation', '哈萨克族', '38', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('50', '0', 'Nation', '哈尼族', '39', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('51', '0', 'Nation', '仡佬族', '40', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('52', '0', 'Nation', '高山族', '41', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('53', '0', 'Nation', '鄂温克族', '42', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('54', '0', 'Nation', '俄罗斯族', '43', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('55', '0', 'Nation', '鄂伦春族', '44', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('56', '0', 'Nation', '独龙族', '45', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('57', '0', 'Nation', '东乡族', '46', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('58', '0', 'Nation', '侗族', '47', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('59', '0', 'Nation', '德昂族', '48', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('60', '0', 'Nation', '傣族', '49', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('61', '0', 'Nation', '达斡尔族', '50', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('62', '0', 'Nation', '朝鲜族', '51', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('63', '0', 'Nation', '布依族', '52', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('64', '0', 'Nation', '布朗族', '53', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('65', '0', 'Nation', '保安族', '54', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('66', '0', 'Nation', '白族', '55', '', null, '1', '0');
INSERT INTO `#@__dict` VALUES ('68', '0', 'Nation', '阿昌族', '56', '', null, '1', '0');

-- ----------------------------
-- Table structure for `#@__dict_category`
-- ----------------------------
DROP TABLE IF EXISTS `#@__dict_category`;
CREATE TABLE `#@__dict_category` (
  `id` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__dict_category
-- ----------------------------
INSERT INTO `#@__dict_category` VALUES ('Article_Status', '文章状态', '');
INSERT INTO `#@__dict_category` VALUES ('Article_Visibility', '文章公开性', '');
INSERT INTO `#@__dict_category` VALUES ('Nation', '民族', '');
INSERT INTO `#@__dict_category` VALUES ('Sex', '性别', '');

-- ----------------------------
-- Table structure for `#@__fragment`
-- ----------------------------
DROP TABLE IF EXISTS `#@__fragment`;
CREATE TABLE `#@__fragment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `code` varchar(63) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__fragment
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__fragment1_data`
-- ----------------------------
DROP TABLE IF EXISTS `#@__fragment1_data`;
CREATE TABLE `#@__fragment1_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fragment_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` varchar(64) DEFAULT NULL,
  `sort_num` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__fragment1_data
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__fragment2_data`
-- ----------------------------
DROP TABLE IF EXISTS `#@__fragment2_data`;
CREATE TABLE `#@__fragment2_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fragment_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `title_format` varchar(64) DEFAULT NULL,
  `thumb` varchar(256) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `sub_title` varchar(256) DEFAULT NULL,
  `summary` varchar(512) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` varchar(64) DEFAULT NULL,
  `sort_num` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__fragment2_data
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__fragment_category`
-- ----------------------------
DROP TABLE IF EXISTS `#@__fragment_category`;
CREATE TABLE `#@__fragment_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__fragment_category
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__log`
-- ----------------------------
DROP TABLE IF EXISTS `#@__log`;
CREATE TABLE `#@__log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text,
  `message` text,
  PRIMARY KEY (`id`),
  KEY `idx_log_level` (`level`),
  KEY `idx_log_category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__log
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__menu`
-- ----------------------------
DROP TABLE IF EXISTS `#@__menu`;
CREATE TABLE `#@__menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `url` varchar(255) DEFAULT NULL COMMENT '菜单地址',
  `root` int(10) DEFAULT NULL COMMENT '根节点',
  `lft` int(10) NOT NULL COMMENT '左值',
  `rgt` int(10) NOT NULL COMMENT '右值',
  `pid` int(10) NOT NULL COMMENT '父节点的id',
  `level` smallint(5) unsigned NOT NULL COMMENT '节点所在的级别',
  `pic` varchar(255) DEFAULT NULL COMMENT '图片',
  `position` varchar(45) DEFAULT NULL COMMENT '位置',
  `if_show` tinyint(1) DEFAULT NULL COMMENT '是否显示',
  `if_delete` int(1) DEFAULT '1' COMMENT '是否可删除 1-可删除 0-不可被删除',
  `memo` text COMMENT '备注',
  `sort` int(6) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `level` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of #@__menu
-- ----------------------------
INSERT INTO `#@__menu` VALUES ('1', '后台菜单', '', '1', '1', '82', '0', '1', null, null, '1', '0', '', '0');
INSERT INTO `#@__menu` VALUES ('2', '前台菜单', '', '2', '83', '84', '0', '1', null, null, '1', '0', '', '0');
INSERT INTO `#@__menu` VALUES ('3', '首页', '/site/index', '1', '2', '3', '1', '2', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('4', '设置', '/system/config/basic', '1', '4', '23', '1', '2', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('5', '站点设置', '', '1', '5', '14', '4', '3', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('6', '基础设置', '/system/config/basic', '1', '6', '7', '5', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('7', 'SEO配置', '/system/config/seo', '1', '8', '9', '5', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('8', '主题设置', '/system/config/theme', '1', '10', '11', '5', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('9', '其它设置', '', '1', '15', '22', '4', '3', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('10', '时间设置', '/system/config/datetime', '1', '16', '17', '9', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('11', '邮件服务器设置', '/email/default/index', '1', '18', '19', '9', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('12', '模块设置', '/modularity/default/index', '1', '20', '21', '9', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('13', '用户', '/user/member/index', '1', '24', '37', '1', '2', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('14', '用户管理', '', '1', '25', '30', '13', '3', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('15', '角色管理', '', '1', '31', '36', '13', '3', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('16', '注册会员', '/user/member/index', '1', '26', '27', '14', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('17', '会员角色', '', '1', '32', '33', '15', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('18', '管理员组管理', '', '1', '34', '35', '15', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('19', '内容', '', '1', '38', '53', '1', '2', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('20', '广告', '', '1', '39', '42', '19', '3', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('21', '广告管理', '', '1', '40', '41', '20', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('22', '分类', '', '1', '43', '46', '19', '3', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('23', '文章分类', '', '1', '44', '45', '22', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('25', '文章', '', '1', '47', '52', '19', '3', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('26', '文章管理', '', '1', '48', '49', '25', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('27', '系统', '/menu/site/index', '1', '54', '75', '1', '2', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('28', '基础功能', '', '1', '55', '62', '27', '3', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('29', '菜单管理', '/menu/site/index', '1', '56', '57', '28', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('30', '分类管理', '/category/default/index', '1', '58', '59', '28', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('31', '数据', '', '1', '63', '68', '27', '3', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('33', '数据库备份', '', '1', '64', '65', '31', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('34', '数据库还原', '', '1', '66', '67', '31', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('35', '日志', '', '1', '69', '74', '27', '3', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('36', '系统日志', '', '1', '70', '71', '35', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('37', '注册会员日志', '', '1', '72', '73', '35', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('38', '其它', '', '1', '76', '81', '1', '2', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('39', '缓存', '', '1', '77', '80', '38', '3', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('40', '缓存管理', '', '1', '78', '79', '39', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('41', '回收站', '', '1', '50', '51', '25', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('42', '后台管理员', '/user/adminuser/index', '1', '28', '29', '14', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('43', '字典管理', '/dict/dictcategory/index', '1', '60', '61', '28', '4', null, null, '1', '1', '', '0');
INSERT INTO `#@__menu` VALUES ('44', '注册与访问', '/system/config/access', '1', '12', '13', '5', '4', null, null, '1', '1', '', '0');

-- ----------------------------
-- Table structure for `#@__modularity`
-- ----------------------------
DROP TABLE IF EXISTS `#@__modularity`;
CREATE TABLE `#@__modularity` (
  `id` varchar(64) NOT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  `is_content` tinyint(1) NOT NULL DEFAULT '0',
  `enable_admin` tinyint(1) NOT NULL DEFAULT '0',
  `enable_home` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__modularity
-- ----------------------------
INSERT INTO `#@__modularity` VALUES ('category', '0', '0', '1', '0');
INSERT INTO `#@__modularity` VALUES ('dict', '0', '0', '1', '0');
INSERT INTO `#@__modularity` VALUES ('menu', '0', '0', '1', '0');
INSERT INTO `#@__modularity` VALUES ('modularity', '1', '0', '1', '1');
INSERT INTO `#@__modularity` VALUES ('system', '1', '0', '1', '0');
INSERT INTO `#@__modularity` VALUES ('user', '1', '0', '1', '0');

-- ----------------------------
-- Table structure for `#@__taxonomy`
-- ----------------------------
DROP TABLE IF EXISTS `#@__taxonomy`;
CREATE TABLE `#@__taxonomy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `category_id` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `url_alias` varchar(64) DEFAULT NULL,
  `redirect_url` varchar(128) DEFAULT NULL,
  `thumb` varchar(128) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `page_size` int(11) DEFAULT NULL,
  `list_view` varchar(64) DEFAULT NULL,
  `list_layout` varchar(64) DEFAULT NULL,
  `detail_view` varchar(64) DEFAULT NULL,
  `detail_layout` varchar(64) DEFAULT NULL,
  `seo_title` varchar(256) DEFAULT NULL,
  `seo_keywords` varchar(256) DEFAULT NULL,
  `seo_description` varchar(256) DEFAULT NULL,
  `contents` int(11) NOT NULL DEFAULT '0',
  `sort_num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__taxonomy
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__taxonomy_category`
-- ----------------------------
DROP TABLE IF EXISTS `#@__taxonomy_category`;
CREATE TABLE `#@__taxonomy_category` (
  `id` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__taxonomy_category
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__taxonomy_content`
-- ----------------------------
DROP TABLE IF EXISTS `#@__taxonomy_content`;
CREATE TABLE `#@__taxonomy_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `takonomy_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of #@__taxonomy_content
-- ----------------------------

-- ----------------------------
-- Table structure for `#@__user`
-- ----------------------------
DROP TABLE IF EXISTS `#@__user`;
CREATE TABLE `#@__user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `role` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;