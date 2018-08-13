-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: localhost    Database: tpshop
-- ------------------------------------------------------
-- Server version	5.5.53

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `tpshop`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `tpshop` /*!40100 DEFAULT CHARACTER SET gbk */;

USE `tpshop`;

--
-- Table structure for table `tp_ad_sort`
--

DROP TABLE IF EXISTS `tp_ad_sort`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_ad_sort` (
  `sort_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_name` varchar(255) NOT NULL DEFAULT '',
  `sort_description` varchar(255) NOT NULL DEFAULT '',
  `sort_width` varchar(255) NOT NULL DEFAULT '',
  `sort_height` varchar(255) NOT NULL DEFAULT '',
  `sort_time` varchar(255) NOT NULL DEFAULT '',
  `sort_state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sort_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_ad_sort`
--

LOCK TABLES `tp_ad_sort` WRITE;
/*!40000 ALTER TABLE `tp_ad_sort` DISABLE KEYS */;
INSERT INTO `tp_ad_sort` VALUES (1,'首页轮播','首页轮播','960','320','2018-01-15 20:01:31',1),(3,'特惠','商城头条中的广告','200','200','2018-01-17 14:34:09',1),(4,'公告','商城头条中的公告','200','200','2018-01-17 14:35:26',1);
/*!40000 ALTER TABLE `tp_ad_sort` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_admin`
--

DROP TABLE IF EXISTS `tp_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_admin` (
  `ad_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(255) NOT NULL COMMENT '管理员账号',
  `pass` varchar(255) NOT NULL COMMENT '密码',
  `pow_id` int(11) NOT NULL COMMENT '权限id',
  `ad_state` int(11) NOT NULL DEFAULT '1' COMMENT '状态 ，1启用，0停用',
  `da_id` int(11) NOT NULL COMMENT '资料ID',
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_admin`
--

LOCK TABLES `tp_admin` WRITE;
/*!40000 ALTER TABLE `tp_admin` DISABLE KEYS */;
INSERT INTO `tp_admin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',1,1,1),(2,'xiexinlei','e10adc3949ba59abbe56e057f20f883e',2,1,2);
/*!40000 ALTER TABLE `tp_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_admin_data`
--

DROP TABLE IF EXISTS `tp_admin_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_admin_data` (
  `da_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `da_name` varchar(255) NOT NULL COMMENT '用户昵称',
  `da_head` varchar(255) NOT NULL COMMENT '用户头像',
  `da_time` datetime NOT NULL COMMENT '注册时间',
  `da_sex` enum('保密','女','男') NOT NULL DEFAULT '保密' COMMENT '性别',
  `da_age` int(11) NOT NULL COMMENT '年龄',
  `da_remarks` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`da_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_admin_data`
--

LOCK TABLES `tp_admin_data` WRITE;
/*!40000 ALTER TABLE `tp_admin_data` DISABLE KEYS */;
INSERT INTO `tp_admin_data` VALUES (1,'name','[\"men\",\"admin\",\"adminhead.jpg\"]','2018-01-17 09:48:21','男',20,'SuperStar'),(2,'嘻嘻嘻','[\"men\",\"xiexinlei\",\"20180120\\\\0744dfbf122cc0b44b3b2226bda86c64.jpg\"]','2018-01-20 10:05:10','男',23,'2312345');
/*!40000 ALTER TABLE `tp_admin_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_adveritising`
--

DROP TABLE IF EXISTS `tp_adveritising`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_adveritising` (
  `adv_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gol_id` varchar(255) NOT NULL DEFAULT '' COMMENT '广告名称',
  `adv_name` varchar(255) NOT NULL DEFAULT '',
  `adv_img` varchar(255) NOT NULL DEFAULT '',
  `adv_width` varchar(255) NOT NULL DEFAULT '' COMMENT '广告宽度',
  `adv_height` varchar(255) NOT NULL DEFAULT '' COMMENT '广告高度',
  `adv_show` int(11) NOT NULL DEFAULT '1' COMMENT '是否显示，0否，1是',
  `adv_rank` int(11) NOT NULL DEFAULT '0',
  `adv_link` varchar(255) NOT NULL DEFAULT '',
  `adv_content` text NOT NULL,
  `adv_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`adv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_adveritising`
--

LOCK TABLES `tp_adveritising` WRITE;
/*!40000 ALTER TABLE `tp_adveritising` DISABLE KEYS */;
INSERT INTO `tp_adveritising` VALUES (1,'首页轮播','美食','http://www.tpshop.com/static/images/advertise/8248ad5.jpg','320','960',1,1,'http://www.tpshop.com','','2018-01-29 23:59:00'),(2,'首页轮播','美食','http://www.tpshop.com/static/images/advertise/5794ad6.jpg','320','960',1,2,'http://www.tpshop.com','<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;相关服务的简介\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>','0000-00-00 00:00:00'),(3,'首页轮播','美食','http://www.tpshop.com/static/images/advertise/3538ad7.jpg','320','960',1,3,'http://www.tpshop.com','','2018-01-29 23:59:00'),(4,'首页轮播','美食','http://www.tpshop.com/static/images/advertise/4820ad8.jpg','320','960',1,4,'http://www.tpshop.com','','2018-01-29 23:00:00'),(5,'公告','淘金开业','http://www.tpshop.com/static/images/advertise/8561act1.png','320','960',1,1,'http://www.tpshop.com/index/index/adv_details?id=5','<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;今天是淘金商城开业的喜庆日子，淘金能带给广大顾客朋友更多，更好，更优的服务，欢迎顾客朋友来淘金采购属于你的宝贝。 &nbsp; &nbsp; &nbsp;&nbsp;</p>','2018-01-29 23:59:00'),(6,'特惠','淘金来袭','http://www.tpshop.com/static/images/advertise/3650act1.png','320','960',1,1,'http://www.tpshop.com/index/index/adv_details?id=6','<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; line-height: 2.8em; color: rgb(102, 102, 102); font-family: Arial; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp; &nbsp;淘金大放价！买、买、买，没错你没有听错，淘金推出开业季优惠活动，凡来店购买就有打折优惠，真真正正的将打折进行到底！全场商品只要是在互动期间，一律5折，机不可失，你还等什么，赶快行动吧！！！</p><p>&nbsp;&nbsp;<br/></p>','2018-01-31 00:00:00'),(7,'特惠','淘金五一节','http://www.tpshop.com/static/images/advertise/4889act1.png','320','960',1,2,'http://www.tpshop.com/index/index/adv_details?id=7','<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;五一特惠大放送，更有精品等你来，为此本店推出五一特惠抽奖活动，亲爱的顾客，赶快心动吧！</p>','2018-01-31 00:00:00'),(8,'特惠','六一节活动','http://www.tpshop.com/static/images/advertise/9891act1.png','320','960',1,3,'http://www.tpshop.com/index/index/adv_details?id=8','<p>&nbsp; &nbsp; &nbsp; &nbsp; 六一六一，精品等你，快带上你的孩子来店抢购吧，这里有你孩子成长需要的一系列学习神器，什么点读机的都out啦，快来感受人工智能带来的新体验吧，让你的孩子即使在家里也能享受别家孩子只能在私人学校拥有的学习条件，此外，孩子生活上的一些列所需这里一应俱全，更有打折优惠哦，快快行动吧！！！ &nbsp;&nbsp;</p>','2018-01-31 00:00:00'),(9,'特惠','淘金热卖','http://www.tpshop.com/static/images/advertise/3915act1.png','320','960',1,4,'http://www.tpshop.com/index/index/adv_details?id=9','<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;淘金热卖节开始啦，亲爱的顾客朋友 ，还不快快行动，购买精美礼品尽在淘金商城 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>','2018-01-31 23:59:00'),(10,'公告','五一节抽奖公告','http://www.tpshop.com/static/images/advertise/8990act1.png','320','960',1,2,'http://www.tpshop.com/index/index/adv_details?id=10','<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;恭喜大头儿子和小头爸爸家庭在本次五一节夺冠，奖品为苹果15.4寸笔记本电脑一台：</p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20180129/1517204201150611.jpg\" title=\"1517204201150611.jpg\" alt=\"5a694948N5cc36e24.jpg!cc_230x230.jpg\" width=\"230\" height=\"194\" style=\"width: 230px; height: 194px;\"/></p><p><img src=\"http://img.baidu.com/hi/jx2/j_0066.gif\"/><img src=\"http://img.baidu.com/hi/jx2/j_0066.gif\"/><img src=\"http://img.baidu.com/hi/jx2/j_0066.gif\"/></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<br/></p>','2018-02-01 14:59:00'),(11,'特惠','淘金限时抢购','http://www.tpshop.com/static/images/advertise/1336act1.png','320','960',1,5,'http://www.tpshop.com/index/index/adv_details?id=11','<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><h1 label=\"标题居左\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: left; margin: 0px 0px 10px;\"><img src=\"/ueditor/php/upload/image/20180129/1517205383219935.jpg\" title=\"1517205383219935.jpg\" alt=\"5a694948N5cc36e24.jpg!cc_230x230.jpg\" width=\"483\" height=\"419\" style=\"width: 483px; height: 419px;\"/></h1><p>来吧，这里是抢购商品中的冰山一角，只是一点点哦！上面是苹果笔记本电脑<br/></p>','2018-12-01 00:59:00');
/*!40000 ALTER TABLE `tp_adveritising` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_article`
--

DROP TABLE IF EXISTS `tp_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_article` (
  `art_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `art_name` varchar(255) NOT NULL COMMENT '文章标题',
  `cat_id` int(11) NOT NULL COMMENT '分类id',
  `art_show` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示，0否，1是',
  `art_time` date NOT NULL COMMENT '上传时间',
  `art_content` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`art_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_article`
--

LOCK TABLES `tp_article` WRITE;
/*!40000 ALTER TABLE `tp_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_categories`
--

DROP TABLE IF EXISTS `tp_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_categories` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL COMMENT '分类名',
  `cat_fid` int(11) NOT NULL COMMENT '父id',
  `cat_show` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示，0否，1是',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_categories`
--

LOCK TABLES `tp_categories` WRITE;
/*!40000 ALTER TABLE `tp_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_gollgie`
--

DROP TABLE IF EXISTS `tp_gollgie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_gollgie` (
  `gol_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gol_name` varchar(255) NOT NULL COMMENT '广告名称',
  `gol_width` int(11) NOT NULL COMMENT '广告宽度',
  `gol_height` int(11) NOT NULL COMMENT '广告高度',
  `gol_state` int(10) NOT NULL DEFAULT '0' COMMENT '是否显示，0否，1是',
  PRIMARY KEY (`gol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_gollgie`
--

LOCK TABLES `tp_gollgie` WRITE;
/*!40000 ALTER TABLE `tp_gollgie` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_gollgie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_goods`
--

DROP TABLE IF EXISTS `tp_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_goods` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_name` varchar(255) NOT NULL DEFAULT '' COMMENT '商品名',
  `g_pri` decimal(10,0) unsigned NOT NULL COMMENT '商品价格',
  `g_num` varchar(255) NOT NULL COMMENT '商品编号',
  `cla_id` int(11) unsigned NOT NULL COMMENT '分类id',
  `brand_id` int(11) unsigned NOT NULL COMMENT '品牌id',
  `sto_num` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `weight` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '重量 以g为单位',
  `cost_price` decimal(10,0) unsigned NOT NULL,
  `keyword` varchar(255) NOT NULL COMMENT '商品关键字',
  `g_remark` varchar(255) NOT NULL COMMENT '简要描述',
  `g_content` text NOT NULL COMMENT '详细描述',
  `original_img` varchar(255) NOT NULL COMMENT '商品原始图片',
  `virtual_refund` int(11) NOT NULL DEFAULT '0' COMMENT '是否允许退款，0否，1是',
  `is_on_sale` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '是否上架，0否，1是',
  `is_free_shipping` int(11) NOT NULL DEFAULT '0' COMMENT '是否包邮，0否，1是',
  `on_time` date NOT NULL COMMENT '上架时间',
  `is_new` int(11) NOT NULL DEFAULT '0' COMMENT '是否新品，0否，1是',
  `is_recommend` int(11) NOT NULL DEFAULT '0' COMMENT '是否推荐。0否，1是',
  `last_update` date NOT NULL COMMENT '最后修改时间',
  `sales_sum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品销量',
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_goods`
--

LOCK TABLES `tp_goods` WRITE;
/*!40000 ALTER TABLE `tp_goods` DISABLE KEYS */;
INSERT INTO `tp_goods` VALUES (1,'55英寸32核人工智能 ',5600,'0001',17,4,95,20,0,'电视人工智能','HDR曲面超薄4K电视金属机身（枪色）','<p><img src=\"/ueditor/php/upload/image/20180124/1516768895689369.jpg\" title=\"1516768895689369.jpg\"/></p><p><img src=\"/ueditor/php/upload/image/20180124/1516768895108310.jpg\" title=\"1516768895108310.jpg\"/></p><p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516768895714456.jpg\" title=\"1516768895714456.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516768910121526.jpg\" title=\"1516768910121526.jpg\" alt=\"56970ffc37d61.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516768926579939.jpg\" title=\"1516768926579939.jpg\" alt=\"569710f50e7d8.jpg\"/></p><p><br/></p>','http://www.tpshop.com/Good_uploads//569710f50e7d8.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(2,'八核安卓智能LED液晶电视',3000,'0002',17,4,120,30,0,'TCL D50A710 50英寸 40万小时视频 全高清 内置WiFi 八核安卓智能LED液晶电视','TCL D50A710 50英寸 40万小时视频 全高清 内置WiFi ','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516769091173116.jpg\" title=\"1516769091173116.jpg\" alt=\"569710f50e7d8.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516769098100866.jpg\" title=\"1516769098100866.jpg\" alt=\"56975c95f197f.jpg\"/></p>','http://www.tpshop.com/Good_uploads//569711056715a.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(3,'全高清 智能 网络 LED液晶电视',5000,'0003',17,5,110,30,0,'彩电LED55EC290N 55英寸 全高清 智能 网络 LED液晶电视','彩电LED55EC290N 55英寸 全高清 智能 网络 LED液晶电视','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516769354123565.jpg\" title=\"1516769354123565.jpg\" alt=\"56975c9e35e62.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516769361700643.jpg\" title=\"1516769361700643.jpg\" alt=\"56975c95c5fcf.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516769365888520.jpg\" title=\"1516769365888520.jpg\" alt=\"56975c95f197f.jpg\"/></p>','http://www.tpshop.com/Good_uploads//56975c95abb06.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(4,'智能网络液晶平板电视',5000,'0004',18,6,110,50,0,' K50 50英寸智能网络液晶平板电视 酷开系统WiFi',' K50 50英寸智能网络液晶平板电视 酷开系统WiFi','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516769581102221.jpg\" title=\"1516769581102221.jpg\" alt=\"569752476ce87.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516769593895276.jpg\" title=\"1516769593895276.jpg\" alt=\"56975c9e889f0.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516769600200269.jpg\" title=\"1516769600200269.jpg\" alt=\"56975c9e5b5e9.jpg\"/></p>','http://www.tpshop.com/Good_uploads//569749208c88d.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(5,'4K轻薄智能网络平板液晶电视',4000,'0005',18,7,121,15,0,'4K轻薄智能网络平板液晶电视','4K轻薄智能网络平板液晶电视','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516769793130132.jpg\" title=\"1516769793130132.jpg\" alt=\"56975c9e712d2.jpg\"/></p>','http://www.tpshop.com/Good_uploads//56975c9e5b5e9.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(6,'全自动变频静音滚筒洗衣机',2000,'0007',19,8,112,15,0,'Haier/海尔 EG8012B29WI 8公斤大容量全自动变频静音滚筒洗衣机','Haier/海尔 EG8012B29WI 8公斤大容量全自动变频静音滚筒洗衣机','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516770240538930.jpg\" title=\"1516770240538930.jpg\" alt=\"5715f4f0d4ce1.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516770249654341.jpg\" title=\"1516770249654341.jpg\" alt=\"5715f4f056bf2.jpg\"/></p>','http://www.tpshop.com/Good_uploads//5715f4f0d4ce1.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(7,'圆柱柜式定速冷暖空调 ',8000,'0008',20,9,170,50,0,'美的（Midea）2匹 智能除湿 静音 圆柱柜式定速冷暖空调 KFR-51LW/DY-YA400(D3)','美的（Midea）2匹 智能除湿 静音 圆柱柜式定速冷暖空调 KFR-51LW/DY-YA400(D3)','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516770530609846.jpg\" title=\"1516770530609846.jpg\" alt=\"5a671573N08e749df.jpg\"/></p>','http://www.tpshop.com/Good_uploads//5a0717e2N8cf04467.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(8,'iPhone 6s 16GB',6000,'0009',22,10,210,1,0,'Apple iPhone 6s 16GB 玫瑰金色 移动联通电信4G手机','Apple iPhone 6s 16GB 玫瑰金色 移动联通电信4G手机','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516770666336551.jpg\" title=\"1516770666336551.jpg\" alt=\"5719844a174d0.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516770671123737.jpg\" title=\"1516770671123737.jpg\" alt=\"5719844a4ca6e.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516770674248250.jpg\" title=\"1516770674248250.jpg\" alt=\"5719844a61cbd.jpg\"/></p>','http://www.tpshop.com/Good_uploads//5719844a2c06c.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(9,'双卡双待双通 移动4G版',2000,'0010',22,11,115,1,0,'双卡双待双通 移动4G版 16GB存储（冰河银）豪华套装一','双卡双待双通 移动4G版 16GB存储（冰河银）豪华套装一','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516770897110191.jpg\" title=\"1516770897110191.jpg\" alt=\"56e3e6e13859a.jpg\"/></p>','http://www.tpshop.com/Good_uploads//56e3e6ce7efcb.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(10,'15.6英寸游戏笔记本电脑',5600,'0011',24,12,174,5,0,' 华硕(ASUS) 飞行堡垒三代FX60VM GTX1060 15.6英寸游戏笔记本电脑(i7-6700HQ 8G 128GSSD+1T FHD)黑色',' 华硕(ASUS) 飞行堡垒三代FX60VM GTX1060 15.6英寸游戏笔记本电脑(i7-6700HQ 8G 128GSSD+1T FHD)黑色','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516771095690530.jpg\" title=\"1516771095690530.jpg\" alt=\"5695b35c65802.jpg\"/></p>','http://www.tpshop.com/Good_uploads//5695b2f14616a.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(11,'15.6英寸游戏笔记本电脑',5600,'0012',24,13,330,2,0,'戴尔DELL灵越游匣15PR-6648B GTX1050 15.6英寸游戏笔记本电脑(i5-7300HQ 8G 128GSSD+1T 4G独显 IPS)黑','戴尔DELL灵越游匣15PR-6648B GTX1050 15.6英寸游戏笔记本电脑(i5-7300HQ 8G 128GSSD+1T 4G独显 IPS)黑','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516771194628177.jpg\" title=\"1516771194628177.jpg\" alt=\"5695b370311ea.jpg\"/></p>','http://www.tpshop.com/Good_uploads//5695bc6403c1b.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(12,'飞利浦 (PHILIPS) LED台灯',230,'0013',26,14,50,2,0,'飞利浦 (PHILIPS) LED台灯 工作学习卧室床头灯 四档触摸调光乌金色 酷永','飞利浦 (PHILIPS) LED台灯 工作学习卧室床头灯 四档触摸调光乌金色 酷永','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516771343241838.jpg\" title=\"1516771343241838.jpg\" alt=\"599e843cNff364400.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516771350344684.jpg\" title=\"1516771350344684.jpg\" alt=\"58118b08Nb6839f8d.jpg\"/></p>','http://www.tpshop.com/Good_uploads//5979c672N9dccb730.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(13,'工作学习简约台灯 ',125,'0014',26,15,290,2,0,' 松下（Panasonic）台灯LED触摸六段/连续调光阅读工作学习简约台灯 HHLT0620',' 松下（Panasonic）台灯LED触摸六段/连续调光阅读工作学习简约台灯 HHLT0620','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516771479918341.jpg\" title=\"1516771479918341.jpg\" alt=\"5922aeb2N27534c66.jpg\"/></p>','http://www.tpshop.com/Good_uploads//5922aeaaN90dc9c4c.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(14,'2017冬季新品毛呢大衣男',260,'0015',28,16,55,1,0,' HLA海澜之家精致西装领针织大衣2017冬季新品毛呢大衣男HWDAD4V008A 宝蓝花纹08 宝蓝花纹 175/92A',' HLA海澜之家精致西装领针织大衣2017冬季新品毛呢大衣男HWDAD4V008A 宝蓝花纹08 宝蓝花纹 175/92A','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516771602112459.jpg\" title=\"1516771602112459.jpg\" alt=\"59ce386cN688fd97c.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516771606545470.jpg\" title=\"1516771606545470.jpg\" alt=\"59ce3853N10cca408.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516771610855213.jpg\" title=\"1516771610855213.jpg\" alt=\"59ce3864Ne211d636.jpg\"/></p>','http://www.tpshop.com/Good_uploads//59ce385cNe7956760.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(15,'七匹狼毛呢大衣男士中长款翻领羊毛外套',500,'0017',28,17,70,1,0,'七匹狼毛呢大衣男士中长款翻领羊毛外套2017冬装新款毛呢子男装 6693 黑色 ','七匹狼毛呢大衣男士中长款翻领羊毛外套2017冬装新款毛呢子男装 6693 黑色 ','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516772343873889.jpg\" title=\"1516772343873889.jpg\" alt=\"5a6547aaN4108890a.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516772348440042.jpg\" title=\"1516772348440042.jpg\" alt=\"5a654658N5dadbb03.jpg\"/></p>','http://www.tpshop.com/Good_uploads//5a221a29N7cb69192.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(16,' 进口华盛顿红蛇果',52,'0018',30,18,110,3,0,'美国 进口华盛顿红蛇果 苹果4个装 单果重约180g 新鲜水果','美国 进口华盛顿红蛇果 苹果4个装 单果重约180g 新鲜水果','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516772514140455.jpg\" title=\"1516772514140455.jpg\" alt=\"5a163c93Naa182466.jpg\"/></p>','http://www.tpshop.com/Good_uploads//5a14e701N139506ac.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(17,'阿克苏苹果 12粒装',75,'0019',30,19,700,5,0,'农夫山泉 17.5°苹果 阿克苏苹果 12粒装 单果径约90-94mm 新鲜水果','农夫山泉 17.5°苹果 阿克苏苹果 12粒装 单果径约90-94mm 新鲜水果','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516772627973034.jpg\" title=\"1516772627973034.jpg\" alt=\"5a324890N04050199.jpg\"/></p>','http://www.tpshop.com/Good_uploads//5a5c0aa9N06e5ffef.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(18,'雪域精粹纯粹滋润洗颜霜',150,'0020',32,20,400,0,0,'自然堂（CHANDO）雪域精粹纯粹滋润洗颜霜110g（洗面奶 洁面）','自然堂（CHANDO）雪域精粹纯粹滋润洗颜霜110g（洗面奶 洁面）','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516772717634933.jpg\" title=\"1516772717634933.jpg\" alt=\"5a20f049N734fe264.jpg\"/></p>','http://www.tpshop.com/Good_uploads//5a17d882N54971d15.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0),(19,'男士控油炭爽抗黑头洁面膏',150,'0021',32,21,240,0,0,' 欧莱雅（LOREAL）男士控油炭爽抗黑头洁面膏100ml（男士洗面奶 收缩毛孔 去黑头）',' 欧莱雅（LOREAL）男士控油炭爽抗黑头洁面膏100ml（男士洗面奶 收缩毛孔 去黑头）','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20180124/1516772814894974.jpg\" title=\"1516772814894974.jpg\" alt=\"591ac9fbNfbbf91dd.jpg\"/><img src=\"/ueditor/php/upload/image/20180124/1516772819105281.jpg\" title=\"1516772819105281.jpg\" alt=\"586f7ce1N4b43c2e5.jpg\"/></p>','http://www.tpshop.com/Good_uploads//586f7ce1N4b43c2e5.jpg',0,1,1,'2018-01-24',1,1,'2018-01-31',0);
/*!40000 ALTER TABLE `tp_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_goods_brand`
--

DROP TABLE IF EXISTS `tp_goods_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_goods_brand` (
  `b_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `b_name` varchar(255) NOT NULL COMMENT '品牌名称',
  `b_logo` varchar(255) NOT NULL COMMENT '品牌logo图片地址',
  `cla_id` int(11) NOT NULL COMMENT '分类id',
  `b_choose` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示，0否，1是',
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_goods_brand`
--

LOCK TABLES `tp_goods_brand` WRITE;
/*!40000 ALTER TABLE `tp_goods_brand` DISABLE KEYS */;
INSERT INTO `tp_goods_brand` VALUES (4,'TCL','http://www.tpshop.com/brand_uploads/u=1118107849,3683812142&fm=27&gp=0.jpg',17,1),(5,'小米','http://www.tpshop.com/brand_uploads/xiaomi.jpg',17,1),(6,'海尔','http://www.tpshop.com/brand_uploads/haier.jpg',18,1),(7,'康佳','http://www.tpshop.com/brand_uploads/u=1250477076,4074460946&fm=27&gp=0.jpg',18,1),(8,'海尔','http://www.tpshop.com/brand_uploads/14393692.jpg',19,1),(9,'美的','http://www.tpshop.com/brand_uploads/meidi.jpg',20,1),(10,'苹果','http://www.tpshop.com/brand_uploads/u=3854062463,315073822&fm=27&gp=0.jpg',22,1),(11,'OPPO','http://www.tpshop.com/brand_uploads/OPPO.jpg',22,1),(12,'华硕','http://www.tpshop.com/brand_uploads/u=1579349120,1451102222&fm=27&gp=0.jpg',24,1),(13,'戴尔','http://www.tpshop.com/brand_uploads/daier.jpg',24,1),(14,'飞利浦','http://www.tpshop.com/brand_uploads/feilipu.jpg',26,1),(15,'松下','http://www.tpshop.com/brand_uploads/songxia.gif',26,1),(16,'海澜之家','http://www.tpshop.com/brand_uploads/hailan.jpg',28,1),(17,'七匹狼','http://www.tpshop.com/brand_uploads/qipilang.jpg',28,1),(18,'京东生鲜','http://www.tpshop.com/brand_uploads/jd.jpg',30,1),(19,'农夫山泉生鲜','http://www.tpshop.com/brand_uploads/nongfushanquan.jpg',30,1),(20,'自然堂','http://www.tpshop.com/brand_uploads/ziran.jpg',32,1),(21,'欧莱雅','http://www.tpshop.com/brand_uploads/oulaiya.jpg',32,1);
/*!40000 ALTER TABLE `tp_goods_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_goods_cla`
--

DROP TABLE IF EXISTS `tp_goods_cla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_goods_cla` (
  `cla_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cla_name` varchar(255) NOT NULL COMMENT '分类名称',
  `cla_fid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `choose` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示，0否，1是',
  `cla_link` varchar(255) NOT NULL COMMENT '链接地址',
  PRIMARY KEY (`cla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_goods_cla`
--

LOCK TABLES `tp_goods_cla` WRITE;
/*!40000 ALTER TABLE `tp_goods_cla` DISABLE KEYS */;
INSERT INTO `tp_goods_cla` VALUES (6,'家用电器',0,1,'/jiayong'),(7,'手机数码',0,1,'/phone'),(8,'电脑办公',0,1,'/diannao'),(9,'家具家居',0,1,'/jiaju'),(10,'服装',0,1,'/fuzhuang'),(11,'食品',0,1,'/shipin'),(12,'美妆',0,1,'/meizhuang'),(13,'电视',6,1,'/dianshi'),(14,'洗衣机',6,1,'/xiyiji'),(15,'空调',6,1,'/kongtiao'),(17,'曲面电视',13,1,'/qumian'),(18,'超薄电视',13,1,'/chaobo'),(19,'滚筒洗衣机',14,1,'/guntong'),(20,'柜式空调',15,1,'/guishi'),(21,'手机通讯',7,1,'/tongxun'),(22,'手机',21,1,'/shou'),(23,'电脑整机',8,1,'/zhengji'),(24,'笔记本电脑',23,1,'/biji'),(25,'灯具',9,1,'/dengju'),(26,'台灯',25,1,'/taideng'),(27,'男装',10,1,'/nanzhuang'),(28,'外套',27,1,'/waitao'),(29,'水果',11,1,'/shuiguo'),(30,'苹果',29,1,'/pingguo'),(31,'面部护肤',12,1,'/mianbu'),(32,'洁面',31,1,'/jiemian');
/*!40000 ALTER TABLE `tp_goods_cla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_goods_count`
--

DROP TABLE IF EXISTS `tp_goods_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_goods_count` (
  `count_id` int(11) NOT NULL AUTO_INCREMENT,
  `total_user_num` int(11) DEFAULT NULL COMMENT '总用户量',
  `volume` int(11) DEFAULT NULL COMMENT '成交金额',
  `page_view_num` int(11) DEFAULT NULL COMMENT '网站访问量',
  `count_time` datetime DEFAULT NULL COMMENT '统计时间',
  `total_order_num` int(11) DEFAULT NULL COMMENT '订单量',
  PRIMARY KEY (`count_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_goods_count`
--

LOCK TABLES `tp_goods_count` WRITE;
/*!40000 ALTER TABLE `tp_goods_count` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_count` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_goods_img`
--

DROP TABLE IF EXISTS `tp_goods_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_goods_img` (
  `img_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `g_id` int(11) NOT NULL COMMENT '商品ID',
  `img_url` varchar(255) NOT NULL COMMENT '图片地址',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_goods_img`
--

LOCK TABLES `tp_goods_img` WRITE;
/*!40000 ALTER TABLE `tp_goods_img` DISABLE KEYS */;
INSERT INTO `tp_goods_img` VALUES (1,1,'http://www.tpshop.com/Good_uploads/569710f50e7d8.jpg'),(2,1,'http://www.tpshop.com/Good_uploads/56975c9e5b5e9.jpg'),(3,2,'http://www.tpshop.com/Good_uploads/56970ff3516a1.jpg'),(4,2,'http://www.tpshop.com/Good_uploads/56970ff2cf4b4.jpg'),(5,2,'http://www.tpshop.com/Good_uploads/56970ff300985.jpg'),(6,3,'http://www.tpshop.com/Good_uploads/56975c95c5fcf.jpg'),(7,3,'http://www.tpshop.com/Good_uploads/56975c95db726.jpg'),(8,3,'http://www.tpshop.com/Good_uploads/569769de3c6ee.jpg'),(9,4,'http://www.tpshop.com/Good_uploads/56970ffc37d61.jpg'),(10,4,'http://www.tpshop.com/Good_uploads/56975c9e712d2.jpg'),(11,4,'http://www.tpshop.com/Good_uploads/56970ff300985.jpg'),(12,5,'http://www.tpshop.com/Good_uploads/56970ffc7cfca.jpg'),(13,5,'http://www.tpshop.com/Good_uploads/56970ffcb99f8.jpg'),(14,6,'http://www.tpshop.com/Good_uploads/5715edaa69459.jpg'),(15,6,'http://www.tpshop.com/Good_uploads/5715edaa3182e.jpg'),(16,7,'http://www.tpshop.com/Good_uploads/5a0717e2N8cf04467.jpg'),(17,7,'http://www.tpshop.com/Good_uploads/5a0717e2N8cf04467.jpg'),(18,8,'http://www.tpshop.com/Good_uploads/56e01a54a2c6d.jpg'),(19,8,'http://www.tpshop.com/Good_uploads/56e01a54bcc53.jpg'),(20,8,'http://www.tpshop.com/Good_uploads/56e01a4088d3b.jpg'),(21,9,'http://www.tpshop.com/Good_uploads/56e3e6dae9b86.jpg'),(22,9,'http://www.tpshop.com/Good_uploads/56e3e6e13859a.jpg'),(23,10,'http://www.tpshop.com/Good_uploads/5695b35c538bb.jpg'),(24,10,'http://www.tpshop.com/Good_uploads/5695b69d3a186.jpg'),(25,19,'http://www.tpshop.com/Good_uploads/586f7ce1N4b43c2e5.jpg'),(26,19,'http://www.tpshop.com/Good_uploads/591ac9fbNfbbf91dd.jpg'),(27,18,'http://www.tpshop.com/Good_uploads/5a17d882N54971d15.jpg'),(28,18,'http://www.tpshop.com/Good_uploads/5a20f049N734fe264.jpg'),(29,17,'http://www.tpshop.com/Good_uploads/5a5c0aa9N06e5ffef.jpg'),(30,17,'http://www.tpshop.com/Good_uploads/5a324890N04050199.jpg'),(31,16,'http://www.tpshop.com/Good_uploads/5a14e701N139506ac.jpg'),(32,16,'http://www.tpshop.com/Good_uploads/5a5c0aa9N06e5ffef.jpg'),(33,15,'http://www.tpshop.com/Good_uploads/5a221a29N7cb69192.jpg'),(34,15,'http://www.tpshop.com/Good_uploads/59ce385cNe7956760.jpg'),(35,14,'http://www.tpshop.com/Good_uploads/59ce386cN688fd97c.jpg'),(36,14,'http://www.tpshop.com/Good_uploads/59ce3853N10cca408.jpg'),(37,14,'http://www.tpshop.com/Good_uploads/59ce3864Ne211d636.jpg'),(38,13,'http://www.tpshop.com/Good_uploads/5922aeaaN90dc9c4c.jpg'),(39,13,'http://www.tpshop.com/Good_uploads/5922aeb2N27534c66.jpg'),(40,12,'http://www.tpshop.com/Good_uploads/57bf9b25Nc9304459.jpg'),(41,12,'http://www.tpshop.com/Good_uploads/58118b08Nb6839f8d.jpg'),(42,11,'http://www.tpshop.com/Good_uploads/5695b35c538bb.jpg'),(43,11,'http://www.tpshop.com/Good_uploads/5695b3705039c.jpg');
/*!40000 ALTER TABLE `tp_goods_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_goods_spec`
--

DROP TABLE IF EXISTS `tp_goods_spec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_goods_spec` (
  `spec_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `g_id` int(11) NOT NULL COMMENT '商品id',
  `sto_count` int(11) NOT NULL COMMENT '库存数量',
  `spec_price` decimal(10,0) NOT NULL COMMENT '商品价格',
  `key` varchar(255) NOT NULL COMMENT '规格键名',
  `key_name` varchar(255) NOT NULL COMMENT '规格键名中文',
  `spec_img` varchar(255) NOT NULL COMMENT '规格商品主图',
  `updata_time` date DEFAULT NULL,
  PRIMARY KEY (`spec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_goods_spec`
--

LOCK TABLES `tp_goods_spec` WRITE;
/*!40000 ALTER TABLE `tp_goods_spec` DISABLE KEYS */;
INSERT INTO `tp_goods_spec` VALUES (1,1,-2,5700,'55寸','大小','http://www.tpshop.com/Good_uploads/56975c9e5b5e9.jpg','2018-01-24'),(2,1,33,6000,'65寸','大小','http://www.tpshop.com/Good_uploads/56970ffc37d61.jpg','2018-01-24'),(3,2,55,3500,'45寸','大小','http://www.tpshop.com/Good_uploads/56975c9e889f0.jpg','2018-01-24'),(4,2,65,3800,'50寸','大小','http://www.tpshop.com/Good_uploads/56975c95abb06.jpg','2018-01-24'),(5,3,60,6500,'65寸','大小','http://www.tpshop.com/Good_uploads/56970ffc0e7ac.jpg','2018-01-24'),(6,3,50,5000,'50寸','大小','http://www.tpshop.com/Good_uploads/56975c95db726.jpg','2018-01-24'),(7,4,55,5100,'55寸','大小','http://www.tpshop.com/Good_uploads/56975c9e889f0.jpg','2018-01-24'),(8,4,55,5000,'45寸','大小','http://www.tpshop.com/Good_uploads/56975c95f197f.jpg','2018-01-24'),(9,5,55,4500,'55寸','大小','http://www.tpshop.com/Good_uploads/56975c9e5b5e9.jpg','2018-01-24'),(10,5,63,5000,'65寸','大小','http://www.tpshop.com/Good_uploads/56975c9e5b5e9.jpg','2018-01-24'),(11,6,56,2000,'8kg','大小','http://www.tpshop.com/Good_uploads/5715efe42b4d8.jpg','2018-01-24'),(12,6,56,3000,'10kg','大小','http://www.tpshop.com/Good_uploads/5715edaa238fc.jpg','2018-01-24'),(13,7,85,8500,'2P','大小','http://www.tpshop.com/Good_uploads/5a0717e2N8cf04467.jpg','2018-01-24'),(14,7,85,8000,'1.5P','大小','http://www.tpshop.com/Good_uploads/5a0717e2N8cf04467.jpg','2018-01-24'),(15,8,77,6800,'64G金色','大小颜色','http://www.tpshop.com/Good_uploads/56e01a54de5a9.jpg','2018-01-24'),(16,8,79,6800,'128G粉红色','大小颜色','http://www.tpshop.com/Good_uploads/56e01a54bcc53.jpg','2018-01-24'),(17,8,50,7000,'128G银色','大小颜色','http://www.tpshop.com/Good_uploads/56e01a54a2c6d.jpg','2018-01-24'),(18,9,50,3000,'64G银色','大小颜色','http://www.tpshop.com/Good_uploads/56e3e6dae9b86.jpg','2018-01-24'),(19,9,65,3100,'128G红色','大小颜色','http://www.tpshop.com/Good_uploads/56e3e746b2582.jpg','2018-01-24'),(20,10,85,5000,'15寸 金色','大小颜色','http://www.tpshop.com/Good_uploads/5695b37074c60.jpg','2018-01-24'),(21,10,89,4500,'13.5寸银色','大小颜色','http://www.tpshop.com/Good_uploads/5695b69d3a186.jpg','2018-01-24'),(22,19,120,120,'控油洁亮','效果','http://www.tpshop.com/Good_uploads/586f7ce1N4b43c2e5.jpg','2018-01-24'),(23,19,120,120,'深度清理','效果','http://www.tpshop.com/Good_uploads/591ac9fbNfbbf91dd.jpg','2018-01-24'),(24,18,150,300,'深度补水','效果','http://www.tpshop.com/Good_uploads/5a20f049N734fe264.jpg','2018-01-24'),(25,18,250,250,'洁面控油','效果','http://www.tpshop.com/Good_uploads/5a17d882N54971d15.jpg','2018-01-24'),(26,17,300,300,'3盒装','数量','http://www.tpshop.com/Good_uploads/5a5c0aa9N06e5ffef.jpg','2018-01-24'),(27,17,400,400,'4盒装','数量','http://www.tpshop.com/Good_uploads/5a324890N04050199.jpg','2018-01-24'),(28,16,55,55,'3kg','重量','http://www.tpshop.com/Good_uploads/5a5c0aa9N06e5ffef.jpg','2018-01-24'),(29,16,55,85,'5kg','重量','http://www.tpshop.com/Good_uploads/5a14e701N139506ac.jpg','2018-01-24'),(30,15,35,350,'XL','大小','http://www.tpshop.com/Good_uploads/5a221a29N7cb69192.jpg','2018-01-24'),(31,15,35,350,'XXL','大小','http://www.tpshop.com/Good_uploads/59ce385cNe7956760.jpg','2018-01-24'),(32,14,25,250,'XL','大小','http://www.tpshop.com/Good_uploads/59ce386cN688fd97c.jpg','2018-01-24'),(33,14,30,250,'XXL','大小','http://www.tpshop.com/Good_uploads/59ce3853N10cca408.jpg','2018-01-24'),(34,13,150,150,'30W','亮度','http://www.tpshop.com/Good_uploads/5922aeaaN90dc9c4c.jpg','2018-01-24'),(35,13,140,140,'40W','亮度','http://www.tpshop.com/Good_uploads/5922aeb2N27534c66.jpg','2018-01-24'),(36,12,25,250,'35W','大小','http://www.tpshop.com/Good_uploads/57bf9b25Nc9304459.jpg','2018-01-24'),(37,12,24,300,'40W','大小','http://www.tpshop.com/Good_uploads/58118b08Nb6839f8d.jpg','2018-01-24'),(38,11,150,1500,'64G银色','大小颜色','http://www.tpshop.com/Good_uploads/5695b37074c60.jpg','2018-01-24'),(39,11,180,1800,'64G金色','大小颜色','http://www.tpshop.com/Good_uploads/5695bc6498401.jpg','2018-01-24');
/*!40000 ALTER TABLE `tp_goods_spec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_goods_stock`
--

DROP TABLE IF EXISTS `tp_goods_stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_goods_stock` (
  `sto_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `g_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `sto_lev` int(11) NOT NULL DEFAULT '0' COMMENT '库存量',
  `ad_id` int(11) NOT NULL COMMENT '操作人id',
  PRIMARY KEY (`sto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_goods_stock`
--

LOCK TABLES `tp_goods_stock` WRITE;
/*!40000 ALTER TABLE `tp_goods_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_loginmess`
--

DROP TABLE IF EXISTS `tp_loginmess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_loginmess` (
  `lo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) unsigned NOT NULL COMMENT '管理员id',
  `login_time` datetime NOT NULL COMMENT '登陆时间',
  `login_ip` varchar(255) NOT NULL COMMENT '登录ip',
  `pow_name` varchar(255) NOT NULL COMMENT '权限名称',
  PRIMARY KEY (`lo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_loginmess`
--

LOCK TABLES `tp_loginmess` WRITE;
/*!40000 ALTER TABLE `tp_loginmess` DISABLE KEYS */;
INSERT INTO `tp_loginmess` VALUES (1,1,'2018-02-01 20:45:53','127.0.0.1','超级管理员');
/*!40000 ALTER TABLE `tp_loginmess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_navbar`
--

DROP TABLE IF EXISTS `tp_navbar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_navbar` (
  `nav_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(255) NOT NULL COMMENT '导航名称',
  `nav_site` varchar(255) NOT NULL COMMENT '链接地址',
  `nav_show` int(10) NOT NULL DEFAULT '0' COMMENT '是否显示，0否，1是',
  PRIMARY KEY (`nav_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_navbar`
--

LOCK TABLES `tp_navbar` WRITE;
/*!40000 ALTER TABLE `tp_navbar` DISABLE KEYS */;
INSERT INTO `tp_navbar` VALUES (1,'首页','http://www.tpshop.com',0),(4,'家电城','/Index/index/goodsModu?name=家用',0),(5,'数码城','/Index/index/goodsModu?name=数码',0),(6,'团购','www.tpshop.com',0);
/*!40000 ALTER TABLE `tp_navbar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_order`
--

DROP TABLE IF EXISTS `tp_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `order_num` varchar(255) NOT NULL DEFAULT '' COMMENT '订单号',
  `u_id` int(11) DEFAULT NULL COMMENT '会员id',
  `order_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '下单时间',
  `good_num` int(11) DEFAULT NULL COMMENT '商品数量',
  `sto_count` int(11) NOT NULL,
  `total_money` varchar(255) DEFAULT NULL COMMENT '总价',
  `spec_id` int(11) DEFAULT NULL COMMENT '规格id',
  `good_id` int(11) DEFAULT NULL COMMENT '商品id',
  `send_method` varchar(255) NOT NULL DEFAULT '' COMMENT '配送方式',
  `pay_method` varchar(255) NOT NULL DEFAULT '' COMMENT '支付方式',
  `recei_name` varchar(255) NOT NULL DEFAULT '' COMMENT '收货人',
  `recei_addr` varchar(255) NOT NULL DEFAULT '' COMMENT '收货地址',
  `recei_phone` varchar(255) NOT NULL DEFAULT '' COMMENT '收货人联系方式',
  `good_img` varchar(255) DEFAULT NULL COMMENT '商品图片地址',
  `user_leave_word` text COMMENT '买家留言',
  `or_show_admin` int(1) NOT NULL DEFAULT '1' COMMENT '订单在后台页面的显示状态',
  `or_show_index` int(1) NOT NULL DEFAULT '1' COMMENT '订单在前端页面显示状态',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_order`
--

LOCK TABLES `tp_order` WRITE;
/*!40000 ALTER TABLE `tp_order` DISABLE KEYS */;
INSERT INTO `tp_order` VALUES (1,'1fc3dca423dfac1517492916999918',1,'2018-02-01 21:48:36',4,37,'24000',2,1,'韵达','支付宝','谢鑫磊','四川省成都市武侯区长寿范','18380425296','http://www.tpshop.com/Good_uploads/56970ffc37d61.jpg','',1,0),(2,'aa276238a0facc1517492955571920',1,'2018-02-01 21:49:15',1,80,'6800',16,8,'韵达','微信','谢鑫磊','四川省成都市武侯区长寿范','18380425296','http://www.tpshop.com/Good_uploads/56e01a54bcc53.jpg','',1,0),(3,'49a978a0b9facc1517498621270212',1,'2018-02-01 23:23:41',3,66,'15000',10,5,'申通','微信','谢鑫磊','四川省成都市武侯区长寿范 ','18380425296','http://www.tpshop.com/Good_uploads/56975c9e5b5e9.jpg','',1,1);
/*!40000 ALTER TABLE `tp_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_power`
--

DROP TABLE IF EXISTS `tp_power`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_power` (
  `pow_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pow_name` varchar(255) NOT NULL COMMENT '职位名',
  `pow_describe` text NOT NULL COMMENT '权利描述',
  PRIMARY KEY (`pow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_power`
--

LOCK TABLES `tp_power` WRITE;
/*!40000 ALTER TABLE `tp_power` DISABLE KEYS */;
INSERT INTO `tp_power` VALUES (1,'超级管理员','至高无上'),(2,'没有权限','可以登录主页，和修改个人信息的最低权限'),(3,'下级','酱油'),(4,'上级','酱油'),(5,'中级','酱油'),(6,'垃圾','酱油');
/*!40000 ALTER TABLE `tp_power` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_power_fun`
--

DROP TABLE IF EXISTS `tp_power_fun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_power_fun` (
  `fun_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fun_name` varchar(255) NOT NULL COMMENT '权限名称',
  `fun_val` varchar(255) NOT NULL COMMENT '权限范围',
  PRIMARY KEY (`fun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_power_fun`
--

LOCK TABLES `tp_power_fun` WRITE;
/*!40000 ALTER TABLE `tp_power_fun` DISABLE KEYS */;
INSERT INTO `tp_power_fun` VALUES (1,'人员管理总权','Admin'),(2,'分配人员总权','Power'),(3,'商品管理','Goods'),(4,'会员管理','User'),(5,'广告管理','Advertise'),(6,'网站信息管理','System'),(7,'栏目管理','Columns');
/*!40000 ALTER TABLE `tp_power_fun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_power_have`
--

DROP TABLE IF EXISTS `tp_power_have`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_power_have` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pow_id` int(11) NOT NULL COMMENT '权限职位id',
  `fun_id` int(11) NOT NULL COMMENT '权限范围id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_power_have`
--

LOCK TABLES `tp_power_have` WRITE;
/*!40000 ALTER TABLE `tp_power_have` DISABLE KEYS */;
INSERT INTO `tp_power_have` VALUES (1,3,1),(2,4,2);
/*!40000 ALTER TABLE `tp_power_have` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_shopping cart`
--

DROP TABLE IF EXISTS `tp_shopping cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_shopping cart` (
  `ca_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL COMMENT '用户id',
  `spec_id` int(11) DEFAULT NULL COMMENT '商品规格id（含有商品图片）',
  `good_num` varchar(255) DEFAULT NULL COMMENT '商品数量',
  `total_money` int(11) DEFAULT NULL COMMENT '商品总价',
  `card_time` datetime DEFAULT NULL COMMENT '加入购物车时间',
  PRIMARY KEY (`ca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_shopping cart`
--

LOCK TABLES `tp_shopping cart` WRITE;
/*!40000 ALTER TABLE `tp_shopping cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_shopping cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_shopping_cart`
--

DROP TABLE IF EXISTS `tp_shopping_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_shopping_cart` (
  `ca_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL COMMENT '用户id',
  `spec_id` int(11) DEFAULT NULL COMMENT '商品规格id（含有商品图片）',
  `g_id` int(11) DEFAULT NULL COMMENT '商品id',
  `good_num` varchar(255) DEFAULT NULL COMMENT '商品数量',
  `total_money` int(11) DEFAULT NULL COMMENT '商品总价',
  `card_time` datetime DEFAULT NULL COMMENT '加入购物车时间',
  PRIMARY KEY (`ca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_shopping_cart`
--

LOCK TABLES `tp_shopping_cart` WRITE;
/*!40000 ALTER TABLE `tp_shopping_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_shopping_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_siteinfo`
--

DROP TABLE IF EXISTS `tp_siteinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_siteinfo` (
  `sit_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sit_filing` varchar(255) NOT NULL COMMENT '网站备案号',
  `sit_name` varchar(255) NOT NULL COMMENT '网站名称',
  `sit_logo` varchar(255) NOT NULL COMMENT '网站logo',
  `sit_user_logo` varchar(255) NOT NULL COMMENT '网站用户中心logo',
  `sit_title` varchar(255) NOT NULL COMMENT '网站标题',
  `sit_describe` varchar(255) NOT NULL COMMENT '网站描述',
  `sit_key` varchar(255) NOT NULL COMMENT '网站关键字',
  `sit_phone` varchar(255) NOT NULL COMMENT '联系手机',
  `sit_tel` varchar(255) NOT NULL COMMENT '联系电话',
  `sit_site` varchar(255) NOT NULL COMMENT '公司地址',
  `sit_qq` varchar(255) NOT NULL COMMENT '客服QQ',
  PRIMARY KEY (`sit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_siteinfo`
--

LOCK TABLES `tp_siteinfo` WRITE;
/*!40000 ALTER TABLE `tp_siteinfo` DISABLE KEYS */;
INSERT INTO `tp_siteinfo` VALUES (1,'粤12345678号','淘金商城','http://www.tpshop.com/static/img/8317logobig.png','http://www.tpshop.com/static/img/3020u=2810003445,1645479868&fm=27&gp=0.jpg','淘金商城||淘你所想||买你所买||只有买不到的，没有想不到的||一键天堂，一键地狱||','这是一个什么都能买的商城，当然商品不全，数据缺失，一切都是普通的样子，只要你心怀希望，万一恢复了也不一定啊；','淘金，淘金，淘金','18848998308','18848998308','四川省成都市桐梓林','2314398795');
/*!40000 ALTER TABLE `tp_siteinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_user`
--

DROP TABLE IF EXISTS `tp_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_user` (
  `u_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_name` varchar(255) DEFAULT NULL COMMENT '账号',
  `u_phone` varchar(255) DEFAULT NULL COMMENT '手机号码',
  `u_email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `pass` varchar(255) NOT NULL COMMENT '密码',
  `u_state` enum('1','0') NOT NULL DEFAULT '1' COMMENT '状态',
  `u_time` datetime NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `name` (`u_name`),
  UNIQUE KEY `phone` (`u_phone`),
  UNIQUE KEY `email` (`u_email`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_user`
--

LOCK TABLES `tp_user` WRITE;
/*!40000 ALTER TABLE `tp_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_user_address`
--

DROP TABLE IF EXISTS `tp_user_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_user_address` (
  `a_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `a_default` enum('0','1') NOT NULL DEFAULT '0' COMMENT '默认地址',
  `a_name` varchar(255) NOT NULL COMMENT '收货人',
  `a_address` text NOT NULL COMMENT '收获地址',
  `a_phone` varchar(255) NOT NULL COMMENT '收货人手机号码',
  `u_id` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_user_address`
--

LOCK TABLES `tp_user_address` WRITE;
/*!40000 ALTER TABLE `tp_user_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_user_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_user_means`
--

DROP TABLE IF EXISTS `tp_user_means`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_user_means` (
  `m_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `m_address` varchar(255) NOT NULL DEFAULT '暂无' COMMENT '地址',
  `m_img` varchar(255) NOT NULL DEFAULT '["","static","basic","images","no-img_mid_.jpg"]' COMMENT '用户个人头像',
  `m_name` varchar(255) NOT NULL DEFAULT '匿名用户' COMMENT '昵称',
  `m_sex` enum('保密','女','男') NOT NULL DEFAULT '保密' COMMENT '性别',
  `m_birthday` date NOT NULL COMMENT '生日',
  `v_id` int(11) unsigned NOT NULL COMMENT '会员id',
  `u_id` int(11) unsigned NOT NULL COMMENT '用户登id',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_user_means`
--

LOCK TABLES `tp_user_means` WRITE;
/*!40000 ALTER TABLE `tp_user_means` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_user_means` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_user_vip`
--

DROP TABLE IF EXISTS `tp_user_vip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_user_vip` (
  `v_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `v_name` varchar(255) NOT NULL COMMENT '会员名称',
  `v_grade` varchar(255) NOT NULL COMMENT '会员等级折扣',
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_user_vip`
--

LOCK TABLES `tp_user_vip` WRITE;
/*!40000 ALTER TABLE `tp_user_vip` DISABLE KEYS */;
INSERT INTO `tp_user_vip` VALUES (0,'普通成员','0'),(1,'vip1','0.009');
/*!40000 ALTER TABLE `tp_user_vip` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-12 10:36:53
