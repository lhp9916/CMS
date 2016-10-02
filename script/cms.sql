/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.7.10 : Database - cms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cms` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `cms`;

/*Table structure for table `cms_admin` */

DROP TABLE IF EXISTS `cms_admin`;

CREATE TABLE `cms_admin` (
  `admin_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `lastloginip` varchar(15) DEFAULT '0',
  `lastlogintime` int(10) unsigned DEFAULT '0',
  `email` varchar(40) DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `cms_admin` */

insert  into `cms_admin`(`admin_id`,`username`,`password`,`lastloginip`,`lastlogintime`,`email`,`realname`,`status`) values (1,'admin','d099d126030d3207ba102efa8e60630a','0',1461135752,'tracywxh0830@126.com','张三',1);

/*Table structure for table `cms_menu` */

DROP TABLE IF EXISTS `cms_menu`;

CREATE TABLE `cms_menu` (
  `menu_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `m` varchar(20) NOT NULL DEFAULT '',
  `c` varchar(20) NOT NULL DEFAULT '',
  `f` varchar(20) NOT NULL DEFAULT '',
  `data` varchar(100) NOT NULL DEFAULT '',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`),
  KEY `module` (`m`,`c`,`f`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `cms_menu` */

insert  into `cms_menu`(`menu_id`,`name`,`parentid`,`m`,`c`,`f`,`data`,`listorder`,`status`,`type`) values (1,'菜单管理',0,'admin','menu','index','',13,1,1),(2,'文章管理',0,'admin','Content','index','',0,-1,1),(3,'体育',0,'home','cat','index','',3,1,0),(4,'科技',0,'home','cat ','index','',0,-1,0),(5,'汽车',0,'home','cat','index','',0,-1,0),(6,'文章管理',0,'admin','content','index','',9,1,1),(7,'用户管理',0,'admin','user','index','',0,-1,1),(8,'科技',0,'home','cat','index','',9999,1,0),(9,'推荐位管理',0,'admin','position','index','',4,1,1),(10,'推荐位内容管理',0,'admin','positioncontent','index','',0,1,1),(11,'基本管理',0,'admin','basic','index','',6,1,1),(12,'新闻',0,'home','cat','index','',1,1,0),(13,'用户管理',0,'admin','admin','index','',9,1,1),(15,'test1',0,'test1','index1','index1','',0,-1,1);

/*Table structure for table `cms_news` */

DROP TABLE IF EXISTS `cms_news`;

CREATE TABLE `cms_news` (
  `news_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `small_title` varchar(30) NOT NULL DEFAULT '',
  `title_font_color` varchar(250) DEFAULT NULL COMMENT '标题颜色',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` varchar(250) NOT NULL COMMENT '文章描述',
  `posids` varchar(250) NOT NULL DEFAULT '',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `copyfrom` varchar(250) DEFAULT NULL COMMENT '来源',
  `username` char(20) NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`news_id`),
  KEY `status` (`status`,`listorder`,`news_id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`news_id`),
  KEY `catid` (`catid`,`status`,`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Data for the table `cms_news` */

insert  into `cms_news`(`news_id`,`catid`,`title`,`small_title`,`title_font_color`,`thumb`,`keywords`,`description`,`posids`,`listorder`,`status`,`copyfrom`,`username`,`create_time`,`update_time`,`count`) values (27,12,'习近平谈团结：打好“团结牌” 实现中国梦','习近平谈团结：打好“团结牌” 实现中国梦','#ed568b','/upload/2016/10/03/57f1523d49f63.jpg','团结，是中国共产党执政的旗帜','央视网消息：10月1日，中华人民共和国迎来67周年华诞。回首过去的67年，新中国实现了民族独立、国家富强，这是中国共产党领导全国人民团结奋斗取得的累累硕果。今天，我们在以习近平同志为总书记的党中央的领导下，更加紧密地团结在一起，奋斗在全面建成小康社会、实现中华民族伟大复兴中国梦的道路上。','',0,1,'4','admin',1475433071,0,8);

/*Table structure for table `cms_news_content` */

DROP TABLE IF EXISTS `cms_news_content`;

CREATE TABLE `cms_news_content` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` mediumint(8) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `cms_news_content` */

insert  into `cms_news_content`(`id`,`news_id`,`content`,`create_time`,`update_time`) values (17,27,'&lt;p style=&quot;font-size:14px;font-family:宋体, simsun, sans-serif, Arial;background-color:#FFFFFF;&quot;&gt;\r\n	央视网消息：10月1日，中华人民共和国迎来67周年华诞。回首过去的67年，新中国实现了民族独立、国家富强，这是中国共产党领导全国人民团结奋斗取得的累累硕果。今天，我们在以习近平同志为总书记的党中央的领导下，更加紧密地团结在一起，奋斗在全面建成小康社会、实现中华民族伟大复兴中国梦的道路上。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:宋体, simsun, sans-serif, Arial;background-color:#FFFFFF;&quot;&gt;\r\n	2012年11月15日，在党的第十八届中央委员会第一次全体会议上刚刚当选中共中央总书记的习近平对中外记者说：“我们的责任，就是要团结带领全党全国各族人民，接过历史的接力棒，继续为实现中华民族伟大复兴而努力奋斗”、“我们的责任，就是要团结带领全党全国各族人民，继续解放思想，坚持改革开放，不断解放和发展社会生产力，坚定不移走共同富裕的道路”……\r\n&lt;/p&gt;\r\n&lt;div align=&quot;center&quot; style=&quot;border:0px;margin:0px;padding:0px;font-size:14px;color:#333333;font-family:宋体, simsun, sans-serif, Arial;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;img src=&quot;http://photocdn.sohu.com/20161002/Img469543954.jpeg&quot; alt=&quot;2014年9月30日晚，国务院在北京人民大会堂举行国庆65周年招待会，热烈庆祝中华人民共和国成立65周年。中共中央总书记、国家主席、中央军委主席习近平代表党中央、国务院发表重要讲话。新华社记者 庞兴雷 摄&quot; align=&quot;middle&quot; border=&quot;1&quot; class=&quot;flag_bigP&quot; /&gt;\r\n	&lt;div class=&quot;conserve-photo&quot; style=&quot;border:0px;margin:0px;padding:0px;background:url(&amp;quot;&quot;&gt;\r\n		&lt;div class=&quot;comCount&quot; style=&quot;border:0px;margin:0px;padding:0px;font-size:11px;font-family:宋体;color:white;&quot;&gt;\r\n			1\r\n		&lt;/div&gt;\r\n	&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;span style=&quot;color:#333333;font-family:宋体, simsun, sans-serif, Arial;background-color:#FFFFFF;&quot;&gt; 2014年9月30日晚，国务院在北京人民大会堂举行国庆65周年招待会，热烈庆祝中华人民共和国成立65周年。中共中央总书记、国家主席、中央军委主席习近平代表党中央、国务院发表重要讲话。新华社记者 庞兴雷 摄&lt;/span&gt;&lt;span style=&quot;color:#333333;font-family:宋体, simsun, sans-serif, Arial;font-size:14px;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:宋体, simsun, sans-serif, Arial;background-color:#FFFFFF;&quot;&gt;\r\n	在新一届中央最高领导层的首次集体公开亮相时，团结，被这样突出地强调。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:宋体, simsun, sans-serif, Arial;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;团结，是中国共产党执政的旗帜&lt;/strong&gt;\r\n&lt;/p&gt;',1475433071,0);

/*Table structure for table `cms_position` */

DROP TABLE IF EXISTS `cms_position`;

CREATE TABLE `cms_position` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` char(100) DEFAULT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `cms_position` */

insert  into `cms_position`(`id`,`name`,`status`,`description`,`create_time`,`update_time`) values (1,'首页大图',-1,'展示首页大图的推荐位1',1455634352,0),(2,'首页大图',1,'展示首页大图的',1455634715,0),(3,'小图推荐',1,'小图推荐位',1456665873,0),(4,'首页后侧推荐位',-1,'',1457248469,0),(5,'右侧广告位',1,'右侧广告位',1457873143,0);

/*Table structure for table `cms_position_content` */

DROP TABLE IF EXISTS `cms_position_content`;

CREATE TABLE `cms_position_content` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `position_id` int(5) unsigned NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) DEFAULT NULL,
  `news_id` mediumint(8) unsigned NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `cms_position_content` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
