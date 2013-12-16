/*
Navicat MySQL Data Transfer

Source Server         : LocalDatabase
Source Server Version : 50027
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50027
File Encoding         : 65001

Date: 2013-12-16 22:32:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `feature`
-- ----------------------------
DROP TABLE IF EXISTS `feature`;
CREATE TABLE `feature` (
  `id` mediumint(4) unsigned NOT NULL auto_increment,
  `title` varchar(32) NOT NULL,
  `description` varchar(100) default NULL,
  `elementType` varchar(32) NOT NULL,
  `size` varchar(1024) NOT NULL default '0',
  `available` tinyint(1) unsigned default NULL,
  `require` tinyint(1) unsigned default NULL,
  `enableToMember` tinyint(1) unsigned default NULL,
  `enableToUser` tinyint(1) unsigned default NULL,
  `condition` varchar(256) default NULL,
  `systemItem` tinyint(1) unsigned default NULL,
  `rank` int(11) NOT NULL default '0',
  `createId` int(11) unsigned default NULL,
  `updateId` int(11) unsigned NOT NULL,
  `creator` varchar(256) default NULL,
  `editer` varchar(256) NOT NULL,
  `lastModifyTime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `title` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of feature
-- ----------------------------
INSERT INTO `feature` VALUES ('1', '姓名', '', 'text', '10', '1', null, '1', '1', '', '1', '0', '1', '1', 'UserAndUserGroup-userFeatureNew', 'UserAndUserGroup-userFeatureNew', '2013-12-15 18:47:29', '2013-12-15 13:38:09');
INSERT INTO `feature` VALUES ('3', '生日', '', 'text', '0', '1', '1', '1', '1', '', null, '0', '1', '1', 'UserAndUserGroup-userFeatureNew', 'UserAndUserGroup-userFeatureNew', '2013-12-15 13:53:59', '2013-12-15 13:53:59');
INSERT INTO `feature` VALUES ('4', '身份证', '', 'text', '0', '1', null, '1', '1', '', null, '0', '1', '1', 'UserAndUserGroup-userFeatureNew', 'UserAndUserGroup-userFeatureNew', '2013-12-15 13:56:14', '2013-12-15 13:56:13');
INSERT INTO `feature` VALUES ('5', '星座', '', 'text', '0', '1', null, '1', '1', '', null, '0', '1', '1', 'UserAndUserGroup-userFeatureNew', 'UserAndUserGroup-userFeatureNew', '2013-12-15 13:57:19', '2013-12-15 13:57:19');
INSERT INTO `feature` VALUES ('6', '血型', '', 'text', '0', '1', null, '1', '1', '', null, '0', '1', '1', 'UserAndUserGroup-userFeatureNew', 'UserAndUserGroup-userFeatureNew', '2013-12-15 13:58:36', '2013-12-15 13:58:36');
INSERT INTO `feature` VALUES ('7', '民族', '', 'text', '0', '1', null, '1', '1', '', null, '0', '1', '1', 'UserAndUserGroup-userFeatureNew', 'UserAndUserGroup-userFeatureNew', '2013-12-15 14:04:41', '2013-12-15 14:04:41');
INSERT INTO `feature` VALUES ('8', '性别', '', 'radio', '0', '1', null, '1', '1', '', null, '0', '1', '1', 'UserAndUserGroup-userFeatureNew', 'UserAndUserGroup-userFeatureNew', '2013-12-15 14:06:44', '2013-12-15 14:06:44');
INSERT INTO `feature` VALUES ('9', '学历', '学历', 'select', '50', null, '1', null, null, null, null, '2', '1', '1', 'UserAndUserGroup-userFeatureNew', 'UserAndUserGroup-userFeatureNew', '2013-12-15 18:43:51', '2013-12-15 18:43:51');

-- ----------------------------
-- Table structure for `featurecategory`
-- ----------------------------
DROP TABLE IF EXISTS `featurecategory`;
CREATE TABLE `featurecategory` (
  `id` mediumint(4) unsigned NOT NULL auto_increment,
  `title` varchar(32) NOT NULL,
  `isShow` tinyint(1) unsigned default '1',
  `rank` mediumint(4) unsigned default NULL,
  `createId` int(11) unsigned NOT NULL,
  `updateId` int(11) unsigned default NULL,
  `creator` varchar(256) NOT NULL,
  `editer` varchar(256) default NULL,
  `lastModifyTime` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of featurecategory
-- ----------------------------

-- ----------------------------
-- Table structure for `feature_featurecategory`
-- ----------------------------
DROP TABLE IF EXISTS `feature_featurecategory`;
CREATE TABLE `feature_featurecategory` (
  `featureId` mediumint(6) unsigned NOT NULL,
  `featureCategoryId` mediumint(4) unsigned NOT NULL,
  `createId` int(11) unsigned NOT NULL,
  `updateId` int(11) unsigned default NULL,
  `creator` varchar(256) NOT NULL,
  `editer` varchar(256) default NULL,
  `lastModifyTime` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL,
  PRIMARY KEY  (`featureId`,`featureCategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of feature_featurecategory
-- ----------------------------

-- ----------------------------
-- Table structure for `member`
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `sex` enum('boy','girl') NOT NULL,
  `birthday` date NOT NULL,
  `nativePlace` int(11) default NULL,
  `nation` int(11) default NULL,
  `identifyNumber` varchar(20) default NULL,
  `studentNumber` varchar(16) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `college` int(11) NOT NULL,
  `major` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `nullIfDeleted` int(1) default NULL,
  `createId` int(11) NOT NULL,
  `updateId` int(11) default NULL,
  `creator` varchar(256) NOT NULL,
  `editer` varchar(256) default NULL,
  `lastModifyTime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------

-- ----------------------------
-- Table structure for `memberstatus`
-- ----------------------------
DROP TABLE IF EXISTS `memberstatus`;
CREATE TABLE `memberstatus` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `systemItem` int(1) default NULL,
  `updateId` int(11) default NULL,
  `createId` int(11) NOT NULL,
  `creator` varchar(256) NOT NULL,
  `editer` varchar(256) default NULL,
  `lastModifyTime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of memberstatus
-- ----------------------------

-- ----------------------------
-- Table structure for `membertype`
-- ----------------------------
DROP TABLE IF EXISTS `membertype`;
CREATE TABLE `membertype` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `systemItem` int(1) default NULL,
  `updateId` int(11) default NULL,
  `createId` int(11) NOT NULL,
  `creator` varchar(256) default NULL,
  `editer` varchar(256) NOT NULL,
  `lastModifyTime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of membertype
-- ----------------------------

-- ----------------------------
-- Table structure for `member_feature`
-- ----------------------------
DROP TABLE IF EXISTS `member_feature`;
CREATE TABLE `member_feature` (
  `memberId` int(11) NOT NULL,
  `featureId` int(11) NOT NULL,
  `value` varchar(512) NOT NULL,
  `updateId` int(11) default NULL,
  `createId` int(11) NOT NULL,
  `creator` varchar(256) default NULL,
  `editer` varchar(256) NOT NULL,
  `lastModifyTime` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member_feature
-- ----------------------------

-- ----------------------------
-- Table structure for `organizationstructure`
-- ----------------------------
DROP TABLE IF EXISTS `organizationstructure`;
CREATE TABLE `organizationstructure` (
  `id` int(11) NOT NULL auto_increment,
  `pId` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `type` int(11) NOT NULL,
  `updateId` int(11) default NULL,
  `createId` int(11) NOT NULL,
  `creator` varchar(256) NOT NULL,
  `editer` varchar(256) default NULL,
  `lastModifyTime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of organizationstructure
-- ----------------------------
INSERT INTO `organizationstructure` VALUES ('1', '0', '江西中医药大学', '1', '0', '0', 'Manual', 'Manual', '2013-12-07 16:18:56', '0000-00-00 00:00:00');
INSERT INTO `organizationstructure` VALUES ('2', '1', '科技学院', '2', '0', '0', 'Manual', 'Manual', '2013-12-07 16:20:37', '0000-00-00 00:00:00');
INSERT INTO `organizationstructure` VALUES ('3', '2', '临床医学系', '3', '0', '0', 'Manual', 'Manual', '2013-12-07 16:21:37', '0000-00-00 00:00:00');
INSERT INTO `organizationstructure` VALUES ('4', '2', '药学系', '3', '0', '0', 'Maunal', 'Maunal', '2013-12-07 16:24:07', '0000-00-00 00:00:00');
INSERT INTO `organizationstructure` VALUES ('5', '2', '护理系', '3', '0', '0', 'Manual', 'Manual', '2013-12-07 16:25:04', '0000-00-00 00:00:00');
INSERT INTO `organizationstructure` VALUES ('6', '2', '信息工程系', '3', '0', '0', 'Manual', 'Manual', '2013-12-07 16:26:03', '0000-00-00 00:00:00');
INSERT INTO `organizationstructure` VALUES ('7', '2', '人文系', '3', '0', '0', 'Manual', 'Manual', '2013-12-07 16:26:11', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `permission`
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `pId` mediumint(8) NOT NULL,
  `name` char(80) NOT NULL default '',
  `title` char(20) NOT NULL default '',
  `URL` varchar(256) default NULL,
  `showInMenu` tinyint(1) NOT NULL default '0',
  `icon` varchar(56) default NULL,
  `level` varchar(256) NOT NULL,
  `rank` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `condition` char(100) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES ('1', '0', 'systemAdministration', '系统管理员', '/index.php/backend/UserAndUserGroup/user', '1', 'icon-user', '0', '0', 'backend_menu', '1', '');
INSERT INTO `permission` VALUES ('2', '1', 'UserAndUserGroup', '用户和用户组', null, '1', 'icon-user', '0,0', '0', 'backend_menu', '1', '');
INSERT INTO `permission` VALUES ('3', '2', 'UserAndUserGroup_user', '用户', '/index.php/backend/UserAndUserGroup/user', '1', null, '0,0,0', '0', 'backend_menu', '1', '');
INSERT INTO `permission` VALUES ('4', '2', 'UserAndUserGroup_userGroup', '用户组', '/index.php/backend/UserAndUserGroup/userGroup', '1', null, '0,0,1', '1', 'backend_menu', '1', '');
INSERT INTO `permission` VALUES ('5', '3', 'UserAndUserGroup_userView', '查看', null, '0', null, '0,0,0,0', '0', 'backend_permissionaction', '1', '');
INSERT INTO `permission` VALUES ('6', '3', 'UserAndUserGroup_userEdit', '编辑', '#', '0', '', '0,0,0,1', '1', 'backend_menu', '1', '');
INSERT INTO `permission` VALUES ('7', '3', 'UserAndUserGroup_userAdd', '添加用户', '#', '1', '', '0,0,0,2', '2', 'backend_menu', '1', '');
INSERT INTO `permission` VALUES ('8', '3', 'UserAndUserGroup_userDelete', '删除', '#', '0', null, '0,0,0,3', '3', 'backend_menu', '1', '');
INSERT INTO `permission` VALUES ('9', '2', 'UserAndUserGroup_userFeature', '用户栏目', '/index.php/backend/UserAndUserGroup/userFeature', '1', null, '0,0,2', '2', 'backend_menu', '1', '');
INSERT INTO `permission` VALUES ('10', '9', 'UserAndUserGroup_userFeatureNew', '添加用户栏目', '/index.php/backend/UserAndUserGroup/userFeatureNew', '1', null, '0,0,2,1', '1', 'backend_menu', '1', '');
INSERT INTO `permission` VALUES ('11', '9', 'UserAndUserGroup_userFeatureEdit', '编辑用户栏目', '/index.php/backend/UserAndUserGroup/userFeatureEdit', '1', null, '0,0,2,2', '2', 'backend_menu', '1', '');
INSERT INTO `permission` VALUES ('12', '9', 'UserAndUserGroup_userFeatureView', '查看', null, '0', null, '0,0,2,0', '0', 'backend_permissionaction', '1', '');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `Email` varchar(254) default NULL,
  `restKey` int(6) default NULL,
  `status` int(11) NOT NULL,
  `nullIfDeleted` int(1) default NULL,
  `updateId` int(11) default NULL,
  `createId` int(11) NOT NULL,
  `creator` varchar(256) NOT NULL,
  `editer` varchar(256) default NULL,
  `lastModifyTime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `E-mail` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'Admin', 'admin', null, null, '1', null, '0', '0', 'Manual', 'Manual', '2013-12-07 23:48:18', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `usergroup`
-- ----------------------------
DROP TABLE IF EXISTS `usergroup`;
CREATE TABLE `usergroup` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `title` char(100) NOT NULL default '',
  `status` tinyint(1) NOT NULL default '1',
  `rules` char(80) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of usergroup
-- ----------------------------
INSERT INTO `usergroup` VALUES ('1', 'systemReserved', '1', '1,2,3,4,5,6,7,8,9,10,11');

-- ----------------------------
-- Table structure for `userstatus`
-- ----------------------------
DROP TABLE IF EXISTS `userstatus`;
CREATE TABLE `userstatus` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `systemItem` int(1) default NULL,
  `updateId` int(11) default NULL,
  `createId` int(11) NOT NULL,
  `creator` varchar(256) NOT NULL,
  `editer` varchar(256) default NULL,
  `lastModifyTime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userstatus
-- ----------------------------
INSERT INTO `userstatus` VALUES ('1', 'Active', '1', '0', '0', 'Manual', 'Manual', '2013-12-07 23:45:44', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `usertype`
-- ----------------------------
DROP TABLE IF EXISTS `usertype`;
CREATE TABLE `usertype` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `systemItem` int(1) default NULL,
  `disable` tinyint(1) default NULL COMMENT 'Mark to whether enable to choose when edit user',
  `updateId` int(11) default NULL,
  `createId` int(11) NOT NULL,
  `creator` varchar(256) default NULL,
  `editer` varchar(256) NOT NULL,
  `lastModifyTime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usertype
-- ----------------------------
INSERT INTO `usertype` VALUES ('1', 'systemReserved', '1', '1', '0', '0', 'Manual', 'Manual', '2013-12-10 07:56:51', '0000-00-00 00:00:00');
INSERT INTO `usertype` VALUES ('2', 'Developer', '1', null, '0', '0', 'Manual', 'Manual', '2013-12-10 08:19:40', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `user_usergroup`
-- ----------------------------
DROP TABLE IF EXISTS `user_usergroup`;
CREATE TABLE `user_usergroup` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of user_usergroup
-- ----------------------------
INSERT INTO `user_usergroup` VALUES ('1', '1');

-- ----------------------------
-- Table structure for `user_usertype`
-- ----------------------------
DROP TABLE IF EXISTS `user_usertype`;
CREATE TABLE `user_usertype` (
  `userId` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  PRIMARY KEY  (`userId`,`userTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_usertype
-- ----------------------------
INSERT INTO `user_usertype` VALUES ('1', '1');
INSERT INTO `user_usertype` VALUES ('1', '2');
