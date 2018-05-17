/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.5.53 : Database - qiye
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`qiye` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `qiye`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '密码md5加密',
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `login_count` int(4) DEFAULT NULL COMMENT '登录次数',
  `last_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `is_update` int(11) DEFAULT NULL COMMENT '是否更新成功',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`,`email`,`login_count`,`last_time`,`is_update`,`update_time`) values (1,'admin','e10adc3949ba59abbe56e057f20f883e','admin@qq.php',14,1526452990,NULL,NULL);

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `title` varchar(100) NOT NULL COMMENT '资讯标题',
  `content` text NOT NULL COMMENT '资讯内容',
  `fuser` varchar(100) NOT NULL COMMENT '发布人',
  `last_time` varchar(100) NOT NULL COMMENT '提交时间',
  `look_size` int(10) NOT NULL COMMENT '浏览次数',
  `pid` varchar(100) NOT NULL COMMENT '所在类别',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `article` */

insert  into `article`(`id`,`title`,`content`,`fuser`,`last_time`,`look_size`,`pid`) values (1,'校园现象','暗示法暗示法师范','admin','1526378523',1,'1'),(2,'社会现象',' 社会现象社会现象社会现象 ','admin','1526456290',2,'2'),(3,'123山东省',' 撒发放 ','admin','1526455684',0,'5');

/*Table structure for table `banner` */

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `image` varchar(100) NOT NULL COMMENT '图片路径与名称',
  `link` varchar(100) NOT NULL COMMENT '链接地址',
  `desc` varchar(200) NOT NULL COMMENT '图片描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `banner` */

insert  into `banner`(`id`,`image`,`link`,`desc`) values (1,'20180515\\075df9130c8b9fa0e45da62c4b9bcd4e.png','www.doyj.com','测试'),(2,'20180514\\f736fbe50c3b22740587ab1dc7921000.png','www.php100.cn','测试2');

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cate_name` varchar(200) NOT NULL COMMENT '分类名称',
  `cate_order` int(11) NOT NULL COMMENT '栏目排序',
  `pid` int(11) NOT NULL COMMENT '父ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `category` */

insert  into `category`(`id`,`cate_name`,`cate_order`,`pid`) values (1,'新闻',1,0),(2,'产品',2,0),(3,'公司新闻',1,1),(4,'行业新闻',2,1),(5,'家用系列',1,2),(6,'商用系列',2,2),(7,'国内新闻',0,1);

/*Table structure for table `system` */

DROP TABLE IF EXISTS `system`;

CREATE TABLE `system` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '网站标题',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '网站关键字',
  `desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '网站描述',
  `is_close` int(11) NOT NULL COMMENT '是否关闭 0关 1开',
  `is_update` int(11) NOT NULL COMMENT '更新标志位',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `system` */

insert  into `system`(`id`,`title`,`keywords`,`desc`,`is_close`,`is_update`) values (1,'tp5学习12','th5,thinkphp.php','tp5企业管理',1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
