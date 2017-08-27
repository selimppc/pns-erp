/*
SQLyog Ultimate v11.33 (32 bit)
MySQL - 10.0.31-MariaDB-0ubuntu0.16.04.2 : Database - pns_erp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pns_erp` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `pns_erp`;

/*Table structure for table `am_ap_allocation` */

DROP TABLE IF EXISTS `am_ap_allocation`;

CREATE TABLE `am_ap_allocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `am_voucher_head_id` varchar(50) DEFAULT NULL,
  `voucher_number` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `exchage_rate` decimal(20,2) DEFAULT NULL,
  `prime_amount` decimal(20,2) DEFAULT NULL,
  `base_amount` decimal(20,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `voucher_unique` (`am_voucher_head_id`,`voucher_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `am_ap_allocation` */

/*Table structure for table `am_balance` */

DROP TABLE IF EXISTS `am_balance`;

CREATE TABLE `am_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_number` varchar(50) NOT NULL,
  `coa_id` varchar(50) NOT NULL,
  `type` enum('customer','supplier') DEFAULT NULL,
  `customer_or_supplier_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `period` int(11) DEFAULT NULL,
  `currency_id` varchar(50) DEFAULT NULL,
  `exchange_rate` decimal(20,5) DEFAULT NULL,
  `prime_amount` decimal(20,2) DEFAULT NULL,
  `base_amount` decimal(20,5) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coa_id` (`coa_id`),
  KEY `voucher_number` (`voucher_number`,`coa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `am_balance` */

/*Table structure for table `am_coa` */

DROP TABLE IF EXISTS `am_coa`;

CREATE TABLE `am_coa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_code` varchar(16) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `account_type` varchar(16) DEFAULT NULL,
  `account_usage` varchar(16) DEFAULT NULL,
  `group_one_id` int(11) DEFAULT NULL,
  `group_two_id` int(11) DEFAULT NULL,
  `group_three_id` int(11) DEFAULT NULL,
  `group_four_id` int(11) DEFAULT NULL,
  `analyical_code` varchar(16) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `group_one_id` (`group_one_id`),
  KEY `group_two_id` (`group_two_id`),
  KEY `group_three_id` (`group_three_id`),
  KEY `group_four_id` (`group_four_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `am_coa_ibfk_1` FOREIGN KEY (`group_one_id`) REFERENCES `group_one` (`id`),
  CONSTRAINT `am_coa_ibfk_2` FOREIGN KEY (`group_two_id`) REFERENCES `group_two` (`id`),
  CONSTRAINT `am_coa_ibfk_3` FOREIGN KEY (`group_three_id`) REFERENCES `group_three` (`id`),
  CONSTRAINT `am_coa_ibfk_4` FOREIGN KEY (`group_four_id`) REFERENCES `group_four` (`id`),
  CONSTRAINT `am_coa_ibfk_5` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `am_coa` */

insert  into `am_coa`(`id`,`account_code`,`title`,`description`,`account_type`,`account_usage`,`group_one_id`,`group_two_id`,`group_three_id`,`group_four_id`,`analyical_code`,`branch_id`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'101-001','Buildings','Buildings','Asset','Ledger',1,1,1,1,'Non-Cash',1,'active',NULL,NULL,'2017-07-19 05:01:03','0000-00-00 00:00:00'),(2,'22','22','22','Asset','Ledger',1,2,1,1,'Cash',1,'active',1,1,'2017-07-23 03:03:13','2017-07-23 03:03:13'),(3,'101-002','Building','','Asset','',1,1,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:21:10','2017-08-16 06:21:10'),(4,'101-003','Rehabilitation','','Asset','',1,1,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:22:01','2017-08-16 06:22:01'),(5,'101-004','Motor  Vehicle','','Asset','',1,1,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:23:10','2017-08-16 06:23:10'),(6,'101-005','Plant, Machinery , Equipment','','Asset','',1,1,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:26:17','2017-08-16 06:26:17'),(7,'101-006','Generators ','','Asset','',1,1,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:27:18','2017-08-16 06:27:18'),(8,'101-007','Computers','','Asset','',1,1,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:28:02','2017-08-16 06:28:02'),(9,'102-101','Accumulated depreciation on Building','','Asset','',1,NULL,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:29:58','2017-08-16 06:29:58'),(10,'102-102 ','Accumulated depreciation on Motor vehicle','','Asset','',1,NULL,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:30:50','2017-08-16 06:30:50'),(11,'102-103','Accumulated depreciation on Plant, Machinery,equipment','','Asset','',NULL,NULL,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:31:43','2017-08-16 06:31:43'),(12,'102-104','Accumulated depreciation on Generators','','Asset','',NULL,NULL,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:32:19','2017-08-16 06:32:19'),(13,'102-105','Accumulated depreciation on Computer','','Asset','',NULL,NULL,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:33:05','2017-08-16 06:33:05'),(14,'104-101','Main Cash','','Asset','',NULL,NULL,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:38:35','2017-08-16 06:38:35'),(15,'104-102','Cash in hand head cashier','','Asset','',1,3,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:39:43','2017-08-16 06:39:43'),(16,'104-103','Bank Account Mercantile Bank Ltd- OD','','Asset','',1,3,NULL,NULL,'',1,'active',1,1,'2017-08-16 06:43:07','2017-08-16 06:43:07'),(17,'103-001','Stock of ZJ9513G','D','Asset','',1,NULL,NULL,NULL,'',1,'active',1,1,'2017-08-21 06:35:27','2017-08-21 06:35:27'),(18,'103-002','ZJ9703BR-D4J','','Asset','',1,NULL,NULL,NULL,'',2,'active',1,1,'2017-08-21 06:45:52','2017-08-21 06:45:52'),(19,'103-003','Stock of ZJ9703BR-5-D4J','','Asset','',NULL,NULL,NULL,NULL,'',2,'active',1,1,'2017-08-21 06:48:54','2017-08-21 06:48:54');

/*Table structure for table `am_default` */

DROP TABLE IF EXISTS `am_default`;

CREATE TABLE `am_default` (
  `id` int(11) NOT NULL,
  `offset` int(11) DEFAULT NULL,
  `pnl_acount` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `period` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `am_default` */

/*Table structure for table `am_voucher_detail` */

DROP TABLE IF EXISTS `am_voucher_detail`;

CREATE TABLE `am_voucher_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `am_voucher_head_id` int(11) DEFAULT NULL,
  `am_coa_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `exchange_rate` decimal(20,8) DEFAULT NULL,
  `prime_amount` decimal(20,8) DEFAULT NULL,
  `base_amount` decimal(20,8) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `note` text,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `am_voucher_head_id` (`am_voucher_head_id`),
  KEY `am_coa_id` (`am_coa_id`),
  KEY `am_sub_coa_id` (`supplier_id`),
  KEY `currency_id` (`currency_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `am_voucher_detail_ibfk_1` FOREIGN KEY (`am_voucher_head_id`) REFERENCES `am_voucher_head` (`id`),
  CONSTRAINT `am_voucher_detail_ibfk_2` FOREIGN KEY (`am_coa_id`) REFERENCES `am_coa` (`id`),
  CONSTRAINT `am_voucher_detail_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `am_coa` (`id`),
  CONSTRAINT `am_voucher_detail_ibfk_4` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`),
  CONSTRAINT `am_voucher_detail_ibfk_5` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`),
  CONSTRAINT `am_voucher_detail_ibfk_6` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `am_voucher_detail` */

/*Table structure for table `am_voucher_head` */

DROP TABLE IF EXISTS `am_voucher_head`;

CREATE TABLE `am_voucher_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_number` varchar(16) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reference` varchar(128) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `period` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `note` text,
  `status` enum('balanced','posted') DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `am_voucher_head_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `am_voucher_head` */

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_assignment` */

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values ('admin','1',1500110242),('admin','42',1499884586),('customer','1',1500110246),('super-admin','1',1499928244),('super-admin','33',1499339062),('super-admin','34',1499440166),('super-admin','35',1499440169),('super-admin','36',1499440172),('super-admin','37',1499440174),('super-admin','38',1499440177),('super-admin','39',1499440598),('super-admin','40',1499441088),('super-admin','41',1499872973);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/*',2,NULL,NULL,NULL,1499162867,1499162867),('/category/*',2,NULL,NULL,NULL,1499162867,1499162867),('/category/create',2,NULL,NULL,NULL,1499162867,1499162867),('/category/delete',2,NULL,NULL,NULL,1499162867,1499162867),('/category/index',2,NULL,NULL,NULL,1499162867,1499162867),('/category/update',2,NULL,NULL,NULL,1499162867,1499162867),('/category/view',2,NULL,NULL,NULL,1499162867,1499162867),('/department/*',2,NULL,NULL,NULL,1499162867,1499162867),('/department/create',2,NULL,NULL,NULL,1499162867,1499162867),('/department/delete',2,NULL,NULL,NULL,1499162867,1499162867),('/department/index',2,NULL,NULL,NULL,1499162867,1499162867),('/department/update',2,NULL,NULL,NULL,1499162867,1499162867),('/department/view',2,NULL,NULL,NULL,1499162867,1499162867),('/gii/*',2,NULL,NULL,NULL,1499162867,1499162867),('/gii/default/*',2,NULL,NULL,NULL,1499162867,1499162867),('/gii/default/action',2,NULL,NULL,NULL,1499162867,1499162867),('/gii/default/diff',2,NULL,NULL,NULL,1499162867,1499162867),('/gii/default/index',2,NULL,NULL,NULL,1499162867,1499162867),('/gii/default/preview',2,NULL,NULL,NULL,1499162867,1499162867),('/gii/default/view',2,NULL,NULL,NULL,1499162867,1499162867),('/platform/*',2,NULL,NULL,NULL,1499162867,1499162867),('/platform/create',2,NULL,NULL,NULL,1499162867,1499162867),('/platform/delete',2,NULL,NULL,NULL,1499162867,1499162867),('/platform/index',2,NULL,NULL,NULL,1499162867,1499162867),('/platform/update',2,NULL,NULL,NULL,1499162867,1499162867),('/platform/view',2,NULL,NULL,NULL,1499162867,1499162867),('/priority/*',2,NULL,NULL,NULL,1499162867,1499162867),('/priority/create',2,NULL,NULL,NULL,1499162867,1499162867),('/priority/delete',2,NULL,NULL,NULL,1499162867,1499162867),('/priority/index',2,NULL,NULL,NULL,1499162867,1499162867),('/priority/update',2,NULL,NULL,NULL,1499162867,1499162867),('/priority/view',2,NULL,NULL,NULL,1499162867,1499162867),('/site/*',2,NULL,NULL,NULL,1499162867,1499162867),('/site/error',2,NULL,NULL,NULL,1499162867,1499162867),('/site/forgot_password',2,NULL,NULL,NULL,1499162867,1499162867),('/site/index',2,NULL,NULL,NULL,1499162867,1499162867),('/site/login',2,NULL,NULL,NULL,1499162867,1499162867),('/site/logout',2,NULL,NULL,NULL,1499162867,1499162867),('/site/reset_password',2,NULL,NULL,NULL,1499162867,1499162867),('/site/signup',2,NULL,NULL,NULL,1499162867,1499162867),('/upload/*',2,NULL,NULL,NULL,1499162867,1499162867),('/upload/error',2,NULL,NULL,NULL,1499162867,1499162867),('/upload/upload',2,NULL,NULL,NULL,1499162867,1499162867),('/user/*',2,NULL,NULL,NULL,1499162867,1499162867),('/user/create',2,NULL,NULL,NULL,1499162867,1499162867),('/user/delete',2,NULL,NULL,NULL,1499162867,1499162867),('/user/index',2,NULL,NULL,NULL,1499162867,1499162867),('/user/update',2,NULL,NULL,NULL,1499162867,1499162867),('/user/view',2,NULL,NULL,NULL,1499162867,1499162867),('admin',1,'Admin',NULL,NULL,1499162897,1499871731),('customer',1,'Customer',NULL,NULL,1499162887,1499871755),('super-admin',1,'Super Admin',NULL,NULL,1499162912,1499871777);

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values ('admin','/category/*'),('admin','/department/*'),('admin','/platform/*'),('admin','/priority/*'),('admin','/site/*'),('admin','/upload/*'),('super-admin','/*');

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_rule` */

/*Table structure for table `branch` */

DROP TABLE IF EXISTS `branch`;

CREATE TABLE `branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_code` varchar(16) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `exchange_rate` decimal(20,8) DEFAULT NULL,
  `contact_person` varchar(45) DEFAULT NULL,
  `designation` varchar(45) DEFAULT NULL,
  `mailing_addess` text,
  `phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `cell` varchar(16) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `currency_id` (`currency_id`),
  CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `branch` */

insert  into `branch`(`id`,`branch_code`,`title`,`currency_id`,`exchange_rate`,`contact_person`,`designation`,`mailing_addess`,`phone`,`fax`,`cell`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'DHK-001','Dhaka 001',1,'1.00000000','Shamim','IT ','Mirpur -1 ','123456789','123456789','123456789','active',NULL,NULL,'2017-07-19 04:42:45','0000-00-00 00:00:00'),(2,'SVR-001','Savar Branch',1,'1.00000000','Shamim','IT','Savar','123456789','123456789','123456789','active',NULL,NULL,'2017-07-19 04:43:20','0000-00-00 00:00:00');

/*Table structure for table `codes_param` */

DROP TABLE IF EXISTS `codes_param`;

CREATE TABLE `codes_param` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `code` varchar(16) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `am_coa_id` int(11) DEFAULT NULL,
  `am_coa_cr_id` int(11) DEFAULT NULL,
  `am_coa_dr_id` int(11) DEFAULT NULL,
  `long` varchar(16) DEFAULT NULL,
  `percentage` varchar(8) DEFAULT NULL,
  `am_coa_tax_id` int(11) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `am_coa_id` (`am_coa_id`),
  KEY `am_coa_cr_id` (`am_coa_cr_id`),
  KEY `am_coa_dr_id` (`am_coa_dr_id`),
  KEY `am_coa_tax_id` (`am_coa_tax_id`),
  CONSTRAINT `codes_param_ibfk_1` FOREIGN KEY (`am_coa_id`) REFERENCES `am_coa` (`id`),
  CONSTRAINT `codes_param_ibfk_2` FOREIGN KEY (`am_coa_cr_id`) REFERENCES `am_coa` (`id`),
  CONSTRAINT `codes_param_ibfk_3` FOREIGN KEY (`am_coa_dr_id`) REFERENCES `am_coa` (`id`),
  CONSTRAINT `codes_param_ibfk_4` FOREIGN KEY (`am_coa_tax_id`) REFERENCES `am_coa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `codes_param` */

insert  into `codes_param`(`id`,`type`,`code`,`title`,`am_coa_id`,`am_coa_cr_id`,`am_coa_dr_id`,`long`,`percentage`,`am_coa_tax_id`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'Customer Group','SALES POINT','SALES POINT',1,1,1,'SALES POINT','',NULL,'active',NULL,NULL,'2017-07-19 05:01:49','0000-00-00 00:00:00'),(2,'Customer Group','WHOLESALE','WHOLESALE',1,1,1,'WHOLESALE','',NULL,'active',NULL,NULL,'2017-07-19 05:02:08','0000-00-00 00:00:00'),(3,'Product Category','ENTERTAINMENT','ENTERTAINMENT',1,1,1,'ENTERTAINMENT','',NULL,'active',NULL,NULL,'2017-07-19 05:02:32','0000-00-00 00:00:00'),(4,'Product Category','FASHION','FASHION',1,1,1,'FASHION','',NULL,'active',NULL,NULL,'2017-07-19 05:02:50','0000-00-00 00:00:00'),(5,'Product Category','HOUSEHOLD','HOUSEHOLD',1,1,1,'HOUSEHOLD','',NULL,'active',NULL,NULL,'2017-07-19 05:03:11','0000-00-00 00:00:00'),(6,'Product Category','MACHINERIES','MACHINERIES',1,1,1,'MACHINERIES','',NULL,'active',NULL,NULL,'2017-07-19 05:03:40','0000-00-00 00:00:00'),(7,'Product Category','PERSONAL','PERSONAL',1,1,1,'PERSONAL','',NULL,'active',NULL,NULL,'2017-07-19 05:04:04','0000-00-00 00:00:00'),(8,'Product Class','PRODUCT','PRODUCT',1,1,1,'PRODUCT','',NULL,'active',NULL,NULL,'2017-07-19 05:04:27','0000-00-00 00:00:00'),(9,'Product Group','ACCESSORIES','ACCESSORIES',1,1,1,'ACCESSORIES','',NULL,'active',NULL,NULL,'2017-07-19 05:04:48','0000-00-00 00:00:00'),(10,'Product Group','MACHINARIES','MACHINARIES',1,1,1,'MACHINARIES','',NULL,'active',NULL,NULL,'2017-07-19 05:05:26','0000-00-00 00:00:00'),(11,'Unit Of Measurement','PCS','PCS',1,1,1,'PCS','',NULL,'active',NULL,NULL,'2017-07-23 01:37:07','0000-00-00 00:00:00'),(12,'Unit Of Measurement','SET','SET',1,1,1,'SET','',NULL,'active',NULL,NULL,'2017-07-23 01:37:11','0000-00-00 00:00:00');

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `image` varchar(64) DEFAULT NULL,
  `thumb_image` varchar(64) DEFAULT NULL,
  `web_url` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `company` */

insert  into `company`(`id`,`title`,`description`,`image`,`thumb_image`,`web_url`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'PNS Group','PNS Group','','','http://PNSGroup.com',NULL,NULL,'2017-07-19 04:56:52','0000-00-00 00:00:00'),(2,'PNS Machineries','PNS Machineries','','','http://PNSMachineries.com',NULL,NULL,'2017-07-19 04:57:21','0000-00-00 00:00:00');

/*Table structure for table `company_profile` */

DROP TABLE IF EXISTS `company_profile`;

CREATE TABLE `company_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `image` varchar(64) DEFAULT NULL,
  `thumb_image` varchar(64) DEFAULT NULL,
  `web_url` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `company_profile` */

/*Table structure for table `currency` */

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_code` varchar(16) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `exchange_rate` decimal(20,8) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `currency` */

insert  into `currency`(`id`,`currency_code`,`title`,`exchange_rate`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'BDT','Bangladeshi Taka','1.00000000','active',NULL,NULL,'2017-07-19 04:41:39','0000-00-00 00:00:00'),(2,'USD','US Dollar','80.00000000','active',NULL,NULL,'2017-07-19 04:42:03','0000-00-00 00:00:00'),(3,'EUR','EURO Currency ','95.00000000','active',1,1,'2017-08-05 06:40:37','2017-08-05 06:40:37');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(16) DEFAULT NULL,
  `customer_group` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `api_id` varchar(16) DEFAULT NULL,
  `address` text,
  `terotorry` varchar(16) DEFAULT NULL,
  `group_one_id` int(11) DEFAULT NULL,
  `type` varchar(16) DEFAULT NULL,
  `cell` varchar(16) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `market` varchar(45) DEFAULT NULL,
  `sales_person` varchar(45) DEFAULT NULL,
  `credit_limit` decimal(20,8) DEFAULT NULL,
  `hub` varchar(16) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `group_one_id` (`group_one_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`group_one_id`) REFERENCES `group_one` (`id`),
  CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `customer` */

insert  into `customer`(`id`,`customer_code`,`customer_group`,`name`,`api_id`,`address`,`terotorry`,`group_one_id`,`type`,`cell`,`phone`,`fax`,`email`,`branch_id`,`market`,`sales_person`,`credit_limit`,`hub`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'CUS-001',NULL,'Ratul International',NULL,'Misco Super market, Mirpur - 1, Dhaka','',3,'','','0','N/A','Ratul@gmail.com',1,'','',NULL,'','active',1,1,'2017-08-05 06:50:20','2017-08-05 06:50:20'),(2,'CUS 002',NULL,'MK Trading',NULL,'Misco super market, Mirpur - 1, Dhaka','',3,'','0','0','N/A','mk@gmail.com',1,'','',NULL,'','active',1,1,'2017-08-01 06:09:29','2017-08-01 06:09:29'),(3,'CUS 003',NULL,'Yousuf Enterprise',NULL,'Misco super market, Mirpur - 1, Dhaka','',3,'','0','0','N/A','yousuf@gmail.com',1,'','',NULL,'','active',1,1,'2017-08-01 06:11:29','2017-08-01 06:11:29'),(4,'CUS 004',NULL,'Master Cimex',NULL,'Pachdona Narshindi','',3,'','0','0','N/A','mastercimex@gmail.com',1,'','','0.00000000','','active',1,1,'2017-08-01 06:15:27','2017-08-01 06:15:27'),(5,'CUS 005',NULL,'Mr. H. Habib',NULL,'Misco super market, Mirpur - 1, Dhaka','',3,'','0','0','0','habib@gmail.com',1,'','',NULL,'','active',1,1,'2017-08-02 02:24:11','2017-08-02 02:24:11'),(6,'CUS 006',NULL,'Texville Apparel Ltd',NULL,'Mirer Changoan, Asulia , Savar ,Dhaka','',3,'','0','0','0','habib@gmail.com',1,'','','0.00000000','','active',1,1,'2017-08-02 02:35:16','2017-08-02 02:35:16'),(7,'CUS 007',NULL,'Evergreen International',NULL,'Misco super market, Mirpur - 1, Dhaka','',3,'','0','0','0','habib@gmail.com',1,'','','0.00000000','','active',1,1,'2017-08-02 03:00:42','2017-08-02 03:00:42'),(8,'CUS 008',NULL,'Noor Corporation',NULL,'Misco super market, Mirpur - 1, Dhaka','',3,'','0','0','0','habib@gmail.com',1,'','','0.00000000','','active',1,1,'2017-08-02 03:02:21','2017-08-02 03:02:21'),(9,'CUS-009','2','Tamanna Enterprise',NULL,'Mirpur,Dhaka','',NULL,'','','','','',1,'','',NULL,'','active',1,1,'2017-08-12 02:17:03','2017-08-12 02:17:03'),(10,'Cus-010','2','Hasnat Trade international',NULL,'95, Hashem plaza ,DEPZ Gate, Ashulia ,Dhaka','',NULL,'','','','','',1,'','',NULL,'','active',1,1,'2017-08-12 02:21:42','2017-08-12 02:21:42'),(11,'CUS-011','2','N.N. Corporation',NULL,'Misco super market,  Darus Salam Road,Mirpur - 1, Dhaka ','',NULL,'','','','','',1,'','',NULL,'','active',1,1,'2017-08-12 02:23:38','2017-08-12 02:23:38'),(12,'CUS-012','2','Best Machineries',NULL,'Misco super market,  Darus Salam Road,Mirpur - 1, Dhaka ','',NULL,'','','','','',1,'','',NULL,'','active',1,1,'2017-08-12 02:25:54','2017-08-12 02:25:54'),(13,'CUS-013','2','Bappery Enterprise',NULL,'Onnesha Super Market, Mirpur - 1, Dhaka ','',NULL,'','','','','',1,'','',NULL,'','active',1,1,'2017-08-12 02:31:19','2017-08-12 02:31:19'),(14,'CUS-014','2','Rowza International',NULL,'Mirpur,Dhaka','',NULL,'','','','','',1,'','',NULL,'','active',1,1,'2017-08-12 02:28:28','2017-08-12 02:28:28');

/*Table structure for table `group_four` */

DROP TABLE IF EXISTS `group_four`;

CREATE TABLE `group_four` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_three_id` int(11) DEFAULT NULL,
  `code` varchar(16) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `group_three_id` (`group_three_id`),
  CONSTRAINT `group_four_ibfk_1` FOREIGN KEY (`group_three_id`) REFERENCES `group_three` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `group_four` */

insert  into `group_four`(`id`,`group_three_id`,`code`,`title`,`description`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,1,NULL,'GP4','GP4',NULL,NULL,'2017-07-19 05:00:54','0000-00-00 00:00:00');

/*Table structure for table `group_one` */

DROP TABLE IF EXISTS `group_one`;

CREATE TABLE `group_one` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(16) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `create_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `group_one` */

insert  into `group_one`(`id`,`code`,`title`,`description`,`create_by`,`updated_by`,`created_at`,`updated_at`) values (1,NULL,'ASSETS','ASSETS',NULL,NULL,'2017-07-19 04:46:10','0000-00-00 00:00:00'),(2,NULL,'LIABILITIES','LIABILITIES',NULL,NULL,'2017-07-19 04:46:30','0000-00-00 00:00:00'),(3,NULL,'REVENUES','REVENUES',NULL,NULL,'2017-07-19 04:46:42','0000-00-00 00:00:00'),(4,NULL,'EXPENDITURES','EXPENDITURES',NULL,NULL,'2017-07-19 04:46:55','0000-00-00 00:00:00');

/*Table structure for table `group_three` */

DROP TABLE IF EXISTS `group_three`;

CREATE TABLE `group_three` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_two_id` int(11) DEFAULT NULL,
  `code` varchar(16) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `group_two_id` (`group_two_id`),
  CONSTRAINT `group_three_ibfk_1` FOREIGN KEY (`group_two_id`) REFERENCES `group_two` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `group_three` */

insert  into `group_three`(`id`,`group_two_id`,`code`,`title`,`description`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,1,NULL,'GP3','GP3',NULL,NULL,'2017-07-19 05:00:41','0000-00-00 00:00:00');

/*Table structure for table `group_two` */

DROP TABLE IF EXISTS `group_two`;

CREATE TABLE `group_two` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_one_id` int(11) DEFAULT NULL,
  `code` varchar(16) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `group_one_id` (`group_one_id`),
  CONSTRAINT `group_two_ibfk_1` FOREIGN KEY (`group_one_id`) REFERENCES `group_one` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `group_two` */

insert  into `group_two`(`id`,`group_one_id`,`code`,`title`,`description`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,1,NULL,'FIXED ASSETS','FIXED ASSETS',NULL,NULL,'2017-07-19 04:47:17','0000-00-00 00:00:00'),(2,1,NULL,'DEPRECIATION','DEPRECIATION',NULL,NULL,'2017-07-19 04:47:45','0000-00-00 00:00:00'),(3,1,NULL,'CASH & BANK','CASH & BANK',NULL,NULL,'2017-07-19 04:48:00','0000-00-00 00:00:00'),(4,1,NULL,'OTHER MISCELLANEOUS ASSETS','OTHER MISCELLANEOUS ASSETS',NULL,NULL,'2017-07-19 04:48:17','0000-00-00 00:00:00'),(5,2,NULL,'FUNDS OR GRANTS','FUNDS OR GRANTS',NULL,NULL,'2017-07-19 04:48:33','0000-00-00 00:00:00'),(6,2,NULL,'LONG TERM LIABILITIES','LONG TERM LIABILITIES',NULL,NULL,'2017-07-19 04:48:49','0000-00-00 00:00:00'),(7,2,NULL,'CURRENT LIABILITIES','CURRENT LIABILITIES',NULL,NULL,'2017-07-19 04:49:00','0000-00-00 00:00:00'),(8,3,NULL,'OPERATIONAL REVENUES','OPERATIONAL REVENUES',NULL,NULL,'2017-07-19 04:49:09','0000-00-00 00:00:00'),(9,3,NULL,'REVENUES GRANTS','REVENUES GRANTS',NULL,NULL,'2017-07-19 04:49:19','0000-00-00 00:00:00'),(10,3,NULL,'MISCELLANEOUS REVENUES','MISCELLANEOUS REVENUES',NULL,NULL,'2017-07-19 04:49:28','0000-00-00 00:00:00'),(11,4,NULL,'COSTS OF GOODS SOLD (COGS)','COSTS OF GOODS SOLD (COGS)',NULL,NULL,'2017-07-19 04:49:36','0000-00-00 00:00:00'),(12,4,NULL,'SG&A EXPENDITURES','SG&A EXPENDITURES',NULL,NULL,'2017-07-19 04:49:45','0000-00-00 00:00:00'),(13,4,NULL,'FINANCIAL EXPENSES','FINANCIAL EXPENSES',NULL,NULL,'2017-07-19 04:55:26','0000-00-00 00:00:00'),(14,4,NULL,'OTHER MISCELLANEOUS EXPENSES','OTHER MISCELLANEOUS EXPENSES',NULL,NULL,'2017-07-19 04:55:40','0000-00-00 00:00:00'),(15,1,NULL,'CURRENT ASSETS','CURRENT ASSETS',NULL,NULL,'2017-07-19 04:55:50','0000-00-00 00:00:00'),(16,2,NULL,'SHORT TERM LIABILITIES','SHORT TERM LIABILITIES',NULL,NULL,'2017-07-19 04:55:59','0000-00-00 00:00:00');

/*Table structure for table `im_adjust_detail` */

DROP TABLE IF EXISTS `im_adjust_detail`;

CREATE TABLE `im_adjust_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `im_adjust_head_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `batch_number` varchar(16) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `uom` varchar(8) DEFAULT NULL,
  `quantity` decimal(8,0) DEFAULT NULL,
  `stock_rate` decimal(20,8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `im_adjust_head_id` (`im_adjust_head_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `im_adjust_detail_ibfk_1` FOREIGN KEY (`im_adjust_head_id`) REFERENCES `im_adjust_head` (`id`),
  CONSTRAINT `im_adjust_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `im_adjust_detail` */

/*Table structure for table `im_adjust_head` */

DROP TABLE IF EXISTS `im_adjust_head`;

CREATE TABLE `im_adjust_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_no` varchar(16) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `type` enum('positive') DEFAULT NULL,
  `confirm_date` date DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `exchange_rate` decimal(20,2) DEFAULT NULL,
  `voucher_number` varchar(16) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  KEY `currency_id` (`currency_id`),
  CONSTRAINT `im_adjust_head_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`),
  CONSTRAINT `im_adjust_head_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `im_adjust_head` */

/*Table structure for table `im_batch_transfer` */

DROP TABLE IF EXISTS `im_batch_transfer`;

CREATE TABLE `im_batch_transfer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `im_transfer_head_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `batch_number` varchar(32) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `quantity` decimal(20,0) DEFAULT NULL,
  `uom` varchar(8) DEFAULT NULL,
  `rate` decimal(20,8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `im_transfer_head_id` (`im_transfer_head_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `im_batch_transfer_ibfk_1` FOREIGN KEY (`im_transfer_head_id`) REFERENCES `im_transfer_head` (`id`),
  CONSTRAINT `im_batch_transfer_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `im_batch_transfer` */

/*Table structure for table `im_grn_detail` */

DROP TABLE IF EXISTS `im_grn_detail`;

CREATE TABLE `im_grn_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `im_grn_head_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `batch_number` varchar(16) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `receive_quantity` decimal(8,0) DEFAULT NULL,
  `cost_price` decimal(20,8) DEFAULT NULL,
  `uom` varchar(8) DEFAULT NULL,
  `quantity` decimal(8,0) DEFAULT NULL,
  `row_amount` decimal(20,8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `im_grn_head_id` (`im_grn_head_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `im_grn_detail_ibfk_1` FOREIGN KEY (`im_grn_head_id`) REFERENCES `im_grn_head` (`id`),
  CONSTRAINT `im_grn_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `im_grn_detail` */

/*Table structure for table `im_grn_head` */

DROP TABLE IF EXISTS `im_grn_head`;

CREATE TABLE `im_grn_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grn_number` varchar(16) DEFAULT NULL,
  `pp_purchase_head_id` int(11) DEFAULT NULL,
  `am_voucher_head_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `pay_terms` varchar(16) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `tax_rate` decimal(20,8) DEFAULT NULL,
  `tax_ammount` decimal(20,8) DEFAULT NULL,
  `discount_rate` decimal(20,8) DEFAULT NULL,
  `discount_amount` decimal(20,8) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `exchnage_rate` decimal(20,8) DEFAULT NULL,
  `prime_amount` decimal(20,8) DEFAULT NULL,
  `net_amount` decimal(20,8) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pp_purchase_head_id` (`pp_purchase_head_id`),
  KEY `am_voucher_head_id` (`am_voucher_head_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `branch_id` (`branch_id`),
  KEY `currency_id` (`currency_id`),
  CONSTRAINT `im_grn_head_ibfk_1` FOREIGN KEY (`pp_purchase_head_id`) REFERENCES `pp_purchase_head` (`id`),
  CONSTRAINT `im_grn_head_ibfk_2` FOREIGN KEY (`am_voucher_head_id`) REFERENCES `am_voucher_head` (`id`),
  CONSTRAINT `im_grn_head_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`),
  CONSTRAINT `im_grn_head_ibfk_4` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`),
  CONSTRAINT `im_grn_head_ibfk_5` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `im_grn_head` */

/*Table structure for table `im_transaction` */

DROP TABLE IF EXISTS `im_transaction`;

CREATE TABLE `im_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_number` varchar(16) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `batch_number` varchar(45) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `exchange_rate` decimal(20,8) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `uom` varchar(8) DEFAULT NULL,
  `quantity` decimal(8,0) DEFAULT NULL,
  `sign` enum('-1','1') DEFAULT NULL,
  `foreign_rate` decimal(20,8) DEFAULT NULL,
  `rate` decimal(20,8) DEFAULT NULL,
  `total_price` decimal(20,8) DEFAULT NULL,
  `base_value` decimal(20,8) DEFAULT NULL,
  `reference_number` varchar(16) DEFAULT NULL,
  `reference_row` varchar(16) DEFAULT NULL,
  `note` text,
  `voucher_number` varchar(32) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `im_transaction_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `im_transaction_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `im_transaction` */

/*Table structure for table `im_transfer_detail` */

DROP TABLE IF EXISTS `im_transfer_detail`;

CREATE TABLE `im_transfer_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `im_transfer_head_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `uom` varchar(8) DEFAULT NULL,
  `quantity` decimal(8,0) DEFAULT NULL,
  `rate` decimal(20,8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `im_transfer_head_id` (`im_transfer_head_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `im_transfer_detail_ibfk_1` FOREIGN KEY (`im_transfer_head_id`) REFERENCES `im_transfer_head` (`id`),
  CONSTRAINT `im_transfer_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `im_transfer_detail` */

/*Table structure for table `im_transfer_head` */

DROP TABLE IF EXISTS `im_transfer_head`;

CREATE TABLE `im_transfer_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_number` varchar(16) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `confirm_date` date DEFAULT NULL,
  `note` text,
  `from_branch_id` int(11) DEFAULT NULL,
  `from_currency_id` int(11) DEFAULT NULL,
  `from_exchange_rate` decimal(20,8) DEFAULT NULL,
  `to_branch_id` int(11) DEFAULT NULL,
  `to_currency_id` int(11) DEFAULT NULL,
  `to_exchange_rate` decimal(20,8) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `from_branch_id` (`from_branch_id`),
  KEY `from_currency_id` (`from_currency_id`),
  KEY `to_branch_id` (`to_branch_id`),
  KEY `to_currency_id` (`to_currency_id`),
  CONSTRAINT `im_transfer_head_ibfk_1` FOREIGN KEY (`from_branch_id`) REFERENCES `branch` (`id`),
  CONSTRAINT `im_transfer_head_ibfk_2` FOREIGN KEY (`from_currency_id`) REFERENCES `currency` (`id`),
  CONSTRAINT `im_transfer_head_ibfk_3` FOREIGN KEY (`to_branch_id`) REFERENCES `branch` (`id`),
  CONSTRAINT `im_transfer_head_ibfk_4` FOREIGN KEY (`to_currency_id`) REFERENCES `currency` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `im_transfer_head` */

/*Table structure for table `it_im_gl` */

DROP TABLE IF EXISTS `it_im_gl`;

CREATE TABLE `it_im_gl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `transaction_code` varchar(16) DEFAULT NULL,
  `group` varchar(16) DEFAULT NULL,
  `dr_coa_id` int(11) DEFAULT NULL,
  `cr_coa_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `it_im_gl_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `it_im_gl` */

/*Table structure for table `it_im_to_ap` */

DROP TABLE IF EXISTS `it_im_to_ap`;

CREATE TABLE `it_im_to_ap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_group` varchar(16) DEFAULT NULL,
  `sub_group` varchar(16) DEFAULT NULL,
  `dr_coa_id` int(11) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `dr_coa_id` (`dr_coa_id`),
  CONSTRAINT `it_im_to_ap_ibfk_1` FOREIGN KEY (`dr_coa_id`) REFERENCES `am_coa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `it_im_to_ap` */

/*Table structure for table `pp_purchase_detail` */

DROP TABLE IF EXISTS `pp_purchase_detail`;

CREATE TABLE `pp_purchase_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pp_purchase_head_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` decimal(8,0) DEFAULT NULL,
  `grn_quantity` decimal(8,0) DEFAULT NULL,
  `tax_rate` decimal(20,8) DEFAULT NULL,
  `tax_amount` decimal(20,8) DEFAULT NULL,
  `uom` varchar(16) DEFAULT NULL,
  `uom_quantity` decimal(8,0) DEFAULT NULL,
  `unit_quantity` decimal(8,0) DEFAULT NULL,
  `purchase_rate` decimal(20,8) DEFAULT NULL,
  `row_amount` decimal(20,8) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pp_purchase_head_id` (`pp_purchase_head_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `pp_purchase_detail_ibfk_1` FOREIGN KEY (`pp_purchase_head_id`) REFERENCES `pp_purchase_head` (`id`),
  CONSTRAINT `pp_purchase_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `pp_purchase_detail` */

insert  into `pp_purchase_detail`(`id`,`pp_purchase_head_id`,`product_id`,`quantity`,`grn_quantity`,`tax_rate`,`tax_amount`,`uom`,`uom_quantity`,`unit_quantity`,`purchase_rate`,`row_amount`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,'2017-08-14 06:50:12','2017-08-14 06:50:12'),(2,1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,'2017-08-14 06:50:12','2017-08-14 06:50:12'),(3,2,8,'1','1',NULL,NULL,'1','1',NULL,'1.00000000',NULL,NULL,1,1,'2017-08-15 04:47:26','2017-08-15 04:47:26'),(4,2,13,'2','2',NULL,NULL,'2','2',NULL,'2.00000000',NULL,NULL,1,1,'2017-08-15 04:47:26','2017-08-15 04:47:26'),(5,3,2,'1','1',NULL,NULL,'1','1',NULL,'1.10000000',NULL,NULL,1,1,'2017-08-15 05:09:53','2017-08-15 05:09:53');

/*Table structure for table `pp_purchase_head` */

DROP TABLE IF EXISTS `pp_purchase_head`;

CREATE TABLE `pp_purchase_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_order_number` varchar(16) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `pay_terms` varchar(16) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `tax_rate` decimal(20,8) DEFAULT NULL,
  `tax_amount` decimal(20,8) DEFAULT NULL,
  `discount_rate` decimal(20,8) DEFAULT NULL,
  `discount_amount` decimal(20,8) DEFAULT NULL,
  `prime_amount` decimal(20,8) DEFAULT NULL,
  `net_amount` decimal(20,8) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `pp_purchase_head_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`),
  CONSTRAINT `pp_purchase_head_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `pp_purchase_head` */

insert  into `pp_purchase_head`(`id`,`po_order_number`,`date`,`supplier_id`,`pay_terms`,`delivery_date`,`branch_id`,`tax_rate`,`tax_amount`,`discount_rate`,`discount_amount`,`prime_amount`,`net_amount`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'asdsadsa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,'2017-08-14 06:50:12','2017-08-14 06:50:12'),(2,'PO--00000001','2017-08-15',4,'Cash','2017-08-16',2,'0.00000000','0.00000000','0.00000000','0.00000000','0.00000000','0.00000000','open',1,1,'2017-08-15 04:47:26','2017-08-15 04:47:26'),(3,'PO--00000002','2017-08-15',2,'Cash','2017-08-16',2,'0.00000000','0.00000000','0.00000000','0.00000000','0.00000000','0.00000000','open',1,1,'2017-08-15 05:09:53','2017-08-15 05:09:53');

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(16) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` text,
  `image` varchar(64) DEFAULT NULL,
  `thumb_image` varchar(64) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `group` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `size` varchar(45) DEFAULT NULL,
  `origin` varchar(45) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `exchange_rate` decimal(20,8) DEFAULT NULL,
  `sell_rate` decimal(20,8) DEFAULT NULL,
  `cost_price` decimal(20,8) DEFAULT NULL,
  `sell_uom` varchar(8) DEFAULT NULL,
  `sell_uom_qty` decimal(8,0) DEFAULT NULL,
  `purchase_uom` varchar(8) DEFAULT NULL,
  `purchase_uom_qty` decimal(8,0) DEFAULT NULL,
  `sell_tax` decimal(20,8) DEFAULT NULL,
  `stock_uom` varchar(8) DEFAULT NULL,
  `stock_uom_qty` decimal(8,0) DEFAULT NULL,
  `pack_size` varchar(8) DEFAULT NULL,
  `stock_type` varchar(8) DEFAULT NULL,
  `generic` varchar(8) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `manufacturer_code` varchar(16) DEFAULT NULL,
  `manufacturer_year` decimal(8,0) DEFAULT NULL,
  `speed` varchar(45) DEFAULT NULL,
  `machine_size` varchar(45) DEFAULT NULL,
  `max_level` varchar(8) DEFAULT NULL,
  `min_level` varchar(8) DEFAULT NULL,
  `re_order` varchar(8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `currency_id` (`currency_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`),
  CONSTRAINT `product_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `product` */

insert  into `product`(`id`,`product_code`,`title`,`description`,`image`,`thumb_image`,`class`,`group`,`category`,`model`,`size`,`origin`,`currency_id`,`exchange_rate`,`sell_rate`,`cost_price`,`sell_uom`,`sell_uom_qty`,`purchase_uom`,`purchase_uom_qty`,`sell_tax`,`stock_uom`,`stock_uom_qty`,`pack_size`,`stock_type`,`generic`,`supplier_id`,`manufacturer_code`,`manufacturer_year`,`speed`,`machine_size`,`max_level`,`min_level`,`re_order`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'SewZ-01','Lockstich Machine (plane machine)','Direct-drive integrate single needle auto-trimmer machine. Auto-trimmer, auto back latching, electronic wipper, LED light, Needle position setting, complete set with china made head, table & stand.','','',8,10,6,'ZJ9513G','N/A','China',1,'0.00000000','16000.00000000','14600.00000000','12','1','12','1','0.00000000','12','1','N/A','stock','N/A',3,'N/A','0','N/A','N/A','0','0','0',1,1,'2017-08-12 03:47:58','2017-08-12 03:47:58'),(2,'SewZ-02','Lockstich Machine (plane Machine)','Direct-drive integrate single needle auto-trimmer machine with auto foot lift. Chinese hook, auto- trimmer, auto back latching, electronic wipper, LED light, needle posting setting. Complete set with China made head, table & stand.','','',8,10,6,'ZJ9703BR-D4J','0','China',1,'0.00000000','25000.00000000','25000.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','N/A','0','0','0','0',1,1,'2017-08-12 03:48:11','2017-08-12 03:48:11'),(3,'SewZ-03','Lockstich Machine (plane Machine)','Direct-drive integrate single needle auto-trimmer machine for heavy duty with auto foot lift. Chinese hook, auto- trimmer, auto back latching, electronic wipper, LED light, needle posting setting. Complete set with China made head, table & stand.','','',8,10,6,'ZJ9703BR-5-D4J','0','China',1,'0.00000000','30000.00000000','25000.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','0','0','0','0','0',1,1,'2017-08-12 03:48:21','2017-08-12 03:48:21'),(4,'SewZ 04','Semi dry head auto plain mc with short remair','Direct-drive semi-dry head,intergrate single needle machine with auto foot lift. Auto- trimmer with short thread (3MM thread) auto back latching, electronic wipper, LED light, needle posting setting. Complete set with China made head, table & stand with caster wheels.','','',8,10,6,'ZJ-9000D-D5S','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','0','0','0','0','0',1,1,'2017-07-31 02:12:30','2017-07-31 02:12:30'),(5,'SewZ 05','Vertical timer plain mc with direct drive','Direct-drive integrate single needle vertical trimmer machine , needle position setting. Complete set with China made head, table & stand with caster wheels. ','','',8,10,6,'ZJ5300-W-BD','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','0','0','0','0','0',1,1,'2017-07-31 02:12:51','2017-07-31 02:12:51'),(6,'SewZ 06','4 Thread overlock','Direct drive 2 needle 4 thread overlock machine. 6000RPM, needle position setting. complete set with China made head, control box, table & stand. ','','',8,10,6,'ZJ880-4-13-BD','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','0','0','0','0','0',1,1,'2017-07-31 02:13:13','2017-07-31 02:13:13'),(7,'SewZ 07','5 thread overlock','Direct drive 2 needle 5 thread overlock machine.(8MM). 6000RPM, needle position setting. complete set with China made head, control box, table & stand. ','','',8,10,6,'ZJ880-5-38-BD','0','China',1,NULL,'0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','0','0','0','0','0',1,1,'2017-07-31 02:14:12','2017-07-31 02:14:12'),(8,'SewZ 08','Flat bed','High speed,direct drive, 3 needle 5 thread flat bed top & bottom cover stitch flatlock machine. needle position seeting. complete set with China made head, control box, table & stand. ','','',8,10,6,'ZJW562-1-BD','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','High speed','0','0','0','0',1,1,'2017-07-31 02:14:33','2017-07-31 02:14:33'),(9,'SewZ 09','Flat bed with binder ','High speed,direct drive, 3 needle 5 thread flat bed top & bottom cover stitch flatlock machine with tape binder. Needle position seeting. complete set with China made head, control box, table & stand. ','','',8,10,6,'ZJW562-2-BD','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','High speed','0','0','0','0',1,1,'2017-07-31 02:14:52','2017-07-31 02:14:52'),(10,'SewZ 10','Cyliner bed','High speed,direct drive, 3 needle 5 thread cylinder bed top & bottom cover stitch flatlock machine. complete set with China made head, clutch motor, table & stand.','','',8,10,6,'ZJW662-1','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','High speed','0','0','0','0',1,1,'2017-07-31 02:17:02','2017-07-31 02:17:02'),(11,'SewZ 11','Computerized button hole','High speed,direct drive, semi-dry head, computerized straight button hole machine. complete set with China made head, control box, table & stand with caster wheels.','','',8,10,6,'ZJ5780AS','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','High speed','0','0','0','0',1,1,'2017-07-31 02:16:43','2017-07-31 02:16:43'),(12,'SewZ 12','Two needle chain stitch','High speed,direct drive, flat bed, 2 needle double chain stitch machine (parallel stitch). complete set with China made head, control box, table & stand.','','',8,10,6,'ZJ3800-BD','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','High speed','0','0','0','0',1,1,'2017-07-31 02:16:21','2017-07-31 02:16:21'),(13,'SewZ 13','Two Needle lockstitch','High speed two needle lockstitch sewing machine. needle feed, fixed needle bar, standard hook. Complete set with China made head, control box, table & stand. ','','',8,10,6,'ZJ8420A','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','0','0','0','0','0',1,1,'2017-07-31 02:16:01','2017-07-31 02:16:01'),(14,'SewZ 14','Auto Bartack','High speed (3200RPM) , direct drive, semi-dry head, 5 step motor power supply computerized bartacking machine. Complete set with China made head, control box, table & stand with caster wheels.','','',8,10,6,'ZJ1900DSS-C','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','High speed','0','0','0','0',1,1,'2017-07-31 02:15:40','2017-07-31 02:15:40'),(15,'SewZ 15','Auto bartack heavy','High speed (3200RPM) , direct drive, semi-dry head, 5 step motor power supply computerized bartacking machine for heavy duty. Complete set with China made head, control box, table & stand with caster wheels. ','','',8,10,6,'ZJ1900DHS-C','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','High speed','0','0','0','0',1,1,'2017-07-31 02:15:13','2017-07-31 02:15:13'),(16,'SewZ 16','Auto button stitch ','High speed (3000RPM) , direct drive, semi-dry head, 5 step motor power supply computerized button stitch machine. Complete set with China made head, control box, table & stand with caster wheels. ','','',8,10,6,'ZJ1903D-301-C','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','High speed','0','0','0','0',1,1,'2017-07-31 02:43:14','2017-07-31 02:43:14'),(17,'SewZ 17','Auto eyelet hole','High speed (2700RPM) , direct drive, semi-dry head, computerized eyelet button hole machine. Complete set with China made head, control box, table & stand with caster wheels. ','','',8,10,6,'ZJ5821A','0','China',1,'0.00000000','0.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',3,'0','0','High speed','0','0','0','0',1,1,'2017-07-31 02:47:08','2017-07-31 02:47:08'),(18,'SewJ  01','A3 - CQ','High speed intergrated direct drive speaking lockstich sewing machine with automatic thread trimmer, for light to medium heavy material, oil lubrication with LED light, with tension device, complete set with servo motor & std.','','',8,10,6,'A3- CQ','0','China',1,'0.00000000','24570.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',13,'0','0','High speed','0','0','0','0',1,1,'2017-08-01 01:56:05','2017-08-01 01:56:05'),(19,'SewJ  02','JK - 8569 ADI-01GBX356 ( Flat bed)','Three needle five thread direct drive flat bed interlock machine, for basic sewing complete set with energy saving motor with , with LED light and std accessories.','','',8,10,6,'JK - 8569 ADI-01GBX356 ( Flat bed)','0','China',1,'0.00000000','35000.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',13,'0','0','0','0','0','0','0',1,1,'2017-08-01 02:02:15','2017-08-01 02:02:15'),(20,'SewJ  03','JK 9100 BS','single needle intergrated direct drive lock stitch sewing machine , for light to medium heavy material, with LED light and needle position with thread knife, complete set with energy saving motor & std accessories. ','','',8,10,6,'JK 9100BS','0','China',1,'0.00000000','15650.00000000','0.00000000','12','1','12','1','0.00000000','12','1','0','stock','0',13,'0','0','0','0','0','0','0',1,1,'2017-08-01 04:41:12','2017-08-01 04:41:12');

/*Table structure for table `sm_batch_sale` */

DROP TABLE IF EXISTS `sm_batch_sale`;

CREATE TABLE `sm_batch_sale` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sm_head_id` int(11) NOT NULL,
  `product_id` int(1) NOT NULL,
  `batch_number` varchar(50) DEFAULT '',
  `expire_date` date DEFAULT NULL,
  `uom` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `bonus_quantity` int(11) DEFAULT NULL,
  `sell_rate` decimal(20,8) DEFAULT NULL,
  `rate` decimal(20,8) DEFAULT NULL,
  `tax_rate` decimal(20,8) DEFAULT NULL,
  `tax_amount` decimal(20,8) DEFAULT NULL,
  `line_amount` decimal(20,8) DEFAULT NULL,
  `courency_id` int(11) NOT NULL,
  `exchange_rate` decimal(20,8) DEFAULT NULL,
  `reference_code` varchar(50) DEFAULT NULL,
  `created_by` int(1) DEFAULT NULL,
  `updated_by` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sm_number` (`sm_head_id`,`product_id`,`batch_number`),
  KEY `product_id` (`product_id`),
  KEY `courency_id` (`courency_id`),
  CONSTRAINT `sm_batch_sale_ibfk_1` FOREIGN KEY (`sm_head_id`) REFERENCES `sm_head` (`id`),
  CONSTRAINT `sm_batch_sale_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `sm_batch_sale_ibfk_3` FOREIGN KEY (`courency_id`) REFERENCES `currency` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sm_batch_sale` */

/*Table structure for table `sm_detail` */

DROP TABLE IF EXISTS `sm_detail`;

CREATE TABLE `sm_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sm_head_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `uom` varchar(8) DEFAULT NULL,
  `uom_quantity` decimal(8,0) DEFAULT NULL,
  `rate` decimal(20,8) DEFAULT NULL,
  `bonus_quantity` decimal(8,0) DEFAULT NULL,
  `quantity` decimal(8,0) DEFAULT NULL,
  `row_amount` decimal(20,8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `sm_head_id` (`sm_head_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `sm_detail_ibfk_1` FOREIGN KEY (`sm_head_id`) REFERENCES `sm_head` (`id`),
  CONSTRAINT `sm_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sm_detail` */

/*Table structure for table `sm_head` */

DROP TABLE IF EXISTS `sm_head`;

CREATE TABLE `sm_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sm_number` varchar(16) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `doc_type` enum('sales','return','receipt') DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `am_coa_id` int(11) DEFAULT NULL,
  `check_number` varchar(45) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `exchange_rate` decimal(20,8) DEFAULT NULL,
  `note` text,
  `tax_rate` decimal(20,8) DEFAULT NULL,
  `tax_amount` decimal(20,8) DEFAULT NULL,
  `discount_rate` decimal(20,8) DEFAULT NULL,
  `discount_amount` decimal(20,8) DEFAULT NULL,
  `prime_amount` decimal(20,8) DEFAULT NULL,
  `net_amount` decimal(20,8) DEFAULT NULL,
  `sign` varchar(16) DEFAULT NULL,
  `status` enum('confirmed','delivered') DEFAULT NULL,
  `reference_code` varchar(16) DEFAULT NULL,
  `gl_voucher_number` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `branch_id` (`branch_id`),
  KEY `am_coa_id` (`am_coa_id`),
  KEY `currency_id` (`currency_id`),
  CONSTRAINT `sm_head_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `sm_head_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`),
  CONSTRAINT `sm_head_ibfk_3` FOREIGN KEY (`am_coa_id`) REFERENCES `am_coa` (`id`),
  CONSTRAINT `sm_head_ibfk_4` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sm_head` */

/*Table structure for table `sm_invoice_allocation` */

DROP TABLE IF EXISTS `sm_invoice_allocation`;

CREATE TABLE `sm_invoice_allocation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sm_head_id` int(11) DEFAULT NULL,
  `invoice_number` varchar(32) DEFAULT NULL,
  `amount` decimal(20,8) DEFAULT NULL,
  `balance_amount` decimal(20,8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sm_head_id` (`sm_head_id`),
  CONSTRAINT `sm_invoice_allocation_ibfk_1` FOREIGN KEY (`sm_head_id`) REFERENCES `sm_head` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `sm_invoice_allocation` */

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_code` varchar(16) DEFAULT NULL,
  `org_name` varchar(45) DEFAULT NULL,
  `address` text,
  `state` varchar(16) DEFAULT NULL,
  `zip` decimal(5,0) DEFAULT NULL,
  `contct_person` varchar(45) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `cell` varchar(16) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `web_url` varchar(45) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `supplier` */

insert  into `supplier`(`id`,`supplier_code`,`org_name`,`address`,`state`,`zip`,`contct_person`,`phone`,`fax`,`cell`,`email`,`web_url`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (2,'SUP-001','PNS Graphics Australia Pty Ltd','4 & 5, 37-51, Lusher Road, Croydon, Victora',' Austra','3136','Mr. Kamrul HossainChowdhury','+61397239132','+61397239339','+61418561987','pnsgraph@hotmail.com','','active',1,1,'2017-08-05 06:38:05','2017-08-05 06:38:05'),(3,'SUP 002','ZOJE SEWING MACHINE CO. LTD.','DAMAIYU HING KONG, ROAD NO. 198','CHINA',NULL,'N/A','86-576-7338266','86-576-7332702','N/A','N/A','','active',1,1,'2017-07-24 02:13:26','2017-07-24 02:13:26'),(4,'SUP 003','VERSTAERKER ROLLE (M) SDN BHD','Lot-40, Jalan P10/16, Taman Industry, Bandar Baru Bangi, Selangar','Darul Ehsan Mala','43650','N/A','603-89269888','603-89269688','N/A','info@verstaerkerolle.com','','active',1,1,'2017-07-26 03:37:30','2017-07-26 03:37:30'),(5,'SUP 004','PATROL TANITIM VE TURIZM LTD. STI.','Maltepe Mh. Davutpasa CD. Kale','Istanbul, Turkey','34010','N/A','N/A','N/A','N/A','N/A','','active',1,1,'2017-07-26 03:43:30','2017-07-26 03:43:30'),(6,'SUP 005','CHANGSHU EVERGRANDE IMP. & EXP. CO. LTD','No-2, Dianhu Road, Changshu','Jiangsu, China',NULL,'N/A','N/A','N/A','N/A','N/A','','active',1,1,'2017-07-26 03:47:58','2017-07-26 03:47:58'),(7,'SUP 006','A-1 PRINTING EQUIPMENT (THAILAND) CO. LTD.','301 Soi Pattanakarn 20, Pattanakarn RD, Suanluang','Bangkok, Thailan','10250','N/A','6623195166','6623195162','N/A','N/A','','active',1,1,'2017-07-26 03:53:02','2017-07-26 03:53:02'),(8,'SUP 007','HANGZHOU KINGSENSE IMPORT & EXPORT CO. LTD','47 Xiangyuan Road, Gongshu District','Hangzhou, China',NULL,'N/A','86571-85801031','N/A','N/A','N/A','','active',1,1,'2017-07-26 03:57:21','2017-07-26 03:57:21'),(9,'SUP 008','MEDIA GRAPHIC SERVICES','70 Vallon des Vaux','Cagnes sur Mer, ','6800','N/A','33493073636','N/A','n','info@mgsfrance.com','','active',1,1,'2017-07-27 01:41:14','2017-07-27 01:41:14'),(10,'SUP 009','BE FORWARD CO. LTD.','4-6-1 Fuda, Chofu-SHI','Tokyo, Japan','99999','Mr. Mainul','81424403440','81424403450','N/A','N','','active',1,1,'2017-07-27 01:44:47','2017-07-27 01:44:47'),(11,'SUP 010','CAMPORESE MACHINE GRAFICHE S.P.A','Via Del Santo','Limena, Italy','35010','N/A','39049767166','39049767629','N/A','info@camporese.it','','active',1,1,'2017-07-27 01:48:55','2017-07-27 01:48:55'),(12,'SUP 011','EUROGRAPH IMPORT EXPORT SL','Pol. Ind Can Mir calle 504','Barcelona','8232','N/A','N/A','N/A','N/A','N/A','','active',1,1,'2017-07-27 02:00:19','2017-07-27 02:00:19'),(13,'SUP 12','Jack ','N/A','',NULL,'Mr. Kamrul HossainChowdhury','0','','','','','active',1,1,'2017-08-01 01:42:39','2017-08-01 01:42:39');

/*Table structure for table `transaction_code` */

DROP TABLE IF EXISTS `transaction_code`;

CREATE TABLE `transaction_code` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('ACCOUNT PAYABLE','ADJUSTMENT NUMBER','CUSTOMER TRN NUMBER','GRN NUMBER','IM TRANSACTION','INVOICE NUMBER','MONEY RECEIPT','PURCHASE ORDER NUMBER','REQUISITION NUMBER','SUPPLIER NUMBER','VOUCHER NUMBER','IM Transfer Number') DEFAULT NULL,
  `code` varchar(16) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `last_number` decimal(10,0) DEFAULT NULL,
  `increment` decimal(10,0) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `transaction_code_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaction_code` */

insert  into `transaction_code`(`id`,`type`,`code`,`title`,`branch_id`,`last_number`,`increment`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'ACCOUNT PAYABLE','APV-','Account Payable',NULL,'0','1',1,NULL,NULL,NULL,NULL),(2,'ADJUSTMENT NUMBER','AD--','Adjustment NUmber',NULL,'0','1',1,NULL,NULL,NULL,NULL),(3,'CUSTOMER TRN NUMBER','CUS-','Customer Transaction Number',NULL,'0','1',1,NULL,NULL,NULL,NULL),(4,'GRN NUMBER','GRN-','GRN Number',NULL,'0','1',1,NULL,NULL,NULL,NULL),(5,'IM TRANSACTION','AJRE','IM Transaction ',NULL,'0','1',1,NULL,NULL,NULL,NULL),(6,'IM TRANSACTION','AJIS','Adjust Issue',NULL,'0','1',1,NULL,NULL,NULL,NULL),(7,'IM TRANSACTION','BO--','Bonus Order',NULL,'0','1',1,NULL,NULL,NULL,NULL),(8,'IM TRANSACTION','BR--','Bonus Order Return',NULL,'0','1',1,NULL,NULL,NULL,NULL),(9,'IM TRANSACTION','DO--','Delivery Order',NULL,'0','1',1,NULL,NULL,NULL,NULL),(10,'IM TRANSACTION','PO--','Purchase Order',NULL,'2','1',1,NULL,1,NULL,'2017-08-15 05:09:53'),(11,'IM TRANSACTION','IT--',NULL,NULL,'0','1',1,NULL,NULL,NULL,NULL),(12,'IM TRANSACTION','RE--','Requision Number',NULL,'0','1',1,NULL,NULL,NULL,NULL),(13,'IM TRANSACTION','SR--','Sales Return ',NULL,'0','1',1,NULL,NULL,NULL,NULL),(14,'IM Transfer Number','TRNF','Transfer NUmber ',NULL,'0','1',1,NULL,NULL,NULL,NULL),(15,'INVOICE NUMBER','IN--','Sales Invoice No',NULL,'0','1',1,NULL,NULL,NULL,NULL),(16,'INVOICE NUMBER','DS--','Direct Sales Invoice No',NULL,'0','1',1,NULL,NULL,NULL,NULL),(17,'MONEY RECEIPT','MR--','Money Receipt',NULL,'0','1',1,NULL,NULL,NULL,NULL),(18,'PURCHASE ORDER NUMBER','PR--','PO Order Number ',NULL,'0','1',1,NULL,NULL,NULL,NULL),(19,'REQUISITION NUMBER','RE--','Requisition Number',NULL,'0','1',1,NULL,NULL,NULL,NULL),(20,'SUPPLIER NUMBER','SUP-','Supplier Code',NULL,'0','1',1,NULL,NULL,NULL,NULL),(21,'VOUCHER NUMBER','AJRE',NULL,NULL,'0','1',1,NULL,NULL,NULL,NULL),(22,'VOUCHER NUMBER','AP--',NULL,NULL,'0','1',1,NULL,NULL,NULL,NULL),(23,'VOUCHER NUMBER','APV-','Account Payment Voucher',NULL,'0','1',1,NULL,NULL,NULL,NULL),(24,'VOUCHER NUMBER','AR--','Account Receivable',NULL,'0','1',1,NULL,NULL,NULL,NULL),(25,'VOUCHER NUMBER','JV--','Journal Voucher',NULL,'0','1',1,NULL,NULL,NULL,NULL),(26,'VOUCHER NUMBER','MR--','Money Receipt',NULL,'0','1',1,NULL,NULL,NULL,NULL),(27,'VOUCHER NUMBER','PAY-','Payment Voucher Code',NULL,'0','1',1,NULL,NULL,NULL,NULL),(28,'VOUCHER NUMBER','RCV-','Received Voucher Code',NULL,'0','1',1,NULL,NULL,NULL,NULL),(29,'VOUCHER NUMBER','REV-','Revers Entry Voucher',NULL,'0','1',1,NULL,NULL,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `auth_key` varchar(64) DEFAULT NULL,
  `password_reset_token` varchar(64) DEFAULT NULL,
  `last_access` datetime DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `ip_address` varchar(16) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`password`,`first_name`,`last_name`,`auth_key`,`password_reset_token`,`last_access`,`status`,`ip_address`,`image`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'admin','admin@admin.com','$2y$13$napDuUoWhldpmscJANqoNeciNbH0GboGK17L/ao8xIboGLwCUE6Cq','admin','admin',NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Jasmine','jasmin.bd07@gmail.com','$2y$13$2uulRKiq0hNJzqsxnH3AAOJyBQIJw9XjbNeYtGVOOTqOK0669.htC','Jasmine','Jasmine',NULL,NULL,NULL,'10',NULL,NULL,1,1,'2017-07-23 07:02:55','2017-07-23 07:04:36'),(3,'Sharmin','shamin2a1@yahoo.com','$2y$13$gYnGpyDUr/2WL8J0I/nEpujcLysakpAtWSfLjyVIPY9KlglhrrAqW','Sharmin','Sharmin',NULL,NULL,NULL,'10',NULL,NULL,1,1,'2017-07-23 07:04:11','2017-07-23 07:04:11'),(4,'Shahjahan','sazupnsiml@yahoo.com','123','Shahjahan','Sazu',NULL,NULL,NULL,'10',NULL,NULL,1,1,'2017-07-23 07:29:49','2017-07-23 07:30:08');

/*Table structure for table `users_activity` */

DROP TABLE IF EXISTS `users_activity`;

CREATE TABLE `users_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(64) DEFAULT NULL,
  `table_id` varchar(64) DEFAULT NULL,
  `action_note` text,
  `url` varchar(128) DEFAULT NULL,
  `reference` text,
  `comment` text,
  `users_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users_activity` */

/* Function  structure for function  `fu_get_trn` */

/*!50003 DROP FUNCTION IF EXISTS `fu_get_trn` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`reza`@`localhost` FUNCTION `fu_get_trn`(s_type VARCHAR(50),s_code VARCHAR(4), s_length INT) RETURNS varchar(50) CHARSET utf8mb4
BEGIN
	DECLARE vLastNum INT;
	DECLARE vIncri INT;
	DECLARE vTrnNumber VARCHAR(50);
	DECLARE vLength INT;
	DECLARE vCnt INT DEFAULT 1;

	SELECT `last_number`,`increment` INTO vLastNum,vIncri FROM `transaction_code` WHERE `type`=s_type AND `code`=s_code AND `status`=1;
	SET vTrnNumber = vLastNum+vIncri;
	SET vLength=(p_len-LENGTH(vTrnNumber));
	
	WHILE vCnt<=vLength DO
		SET vTrnNumber=CONCAT('0',vTrnNumber); -- This concat padding zero before transaction number.
		SET vCnt=vCnt+1;
	END WHILE;
	
	-- UPDATE `transaction_code` 
	--	SET `last_number`=vTrnNumber, `updated_at`=CURRENT_TIMESTAMP
	-- WHERE `type`=s_type AND `code`=s_code;
	
    SET vTrnNumber=CONCAT(s_code, vTrnNumber);
    RETURN vTrnNumber;
    
END */$$
DELIMITER ;

/* Function  structure for function  `fu_period` */

/*!50003 DROP FUNCTION IF EXISTS `fu_period` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`reza`@`localhost` FUNCTION `fu_period`(s_date DATE) RETURNS int(11)
BEGIN
	
		DECLARE vfperiod INT;
		DECLARE vPer INT;
		SELECT offset INTO vfperiod FROM am_default;
		
		SET vPer=12+MONTH(s_date)-vfperiod;
		IF vPer>12 THEN
			SET vPer=vPer-12;
		END IF;
		
		RETURN vPer;

END */$$
DELIMITER ;

/* Function  structure for function  `fu_year` */

/*!50003 DROP FUNCTION IF EXISTS `fu_year` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`reza`@`localhost` FUNCTION `fu_year`(s_date DATE) RETURNS int(11)
BEGIN
	

		DECLARE vfperiod INT;
		DECLARE vYear INT;
		DECLARE vPer INT;
		SELECT offset INTO vfperiod FROM am_default;
		
		SET vYear=YEAR(s_date);
		SET vPer=12+MONTH(s_date)-vfperiod;
		IF vPer<=12 THEN
			SET vYear=vYear-1;
		END IF;
		
		RETURN vYear;


END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_am_voucher_post` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_am_voucher_post` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`reza`@`localhost` PROCEDURE `sp_am_voucher_post`(
	voucherNumber varchar(45),
	userId int(11)
)
BEGIN

	INSERT INTO `am_balance`(`voucher_number`,`coa_id`,`type`, `customer_or_supplier_id`,`date`,`branch_id`,`referance`,`year`,`period`,`currency_id`,
												 `exchage_rate`,`prime_amount`,`base_amount`,`status`,`created_at`,`created_by`)
												 
	SELECT `a`.`voucher_number`,`b`.`am_coa_id`,'supplier', `b`.`supplier_id`,`a`.`date`,`a`.`branch_id`,`a`.`referance`,`a`.`year`,`a`.`period`,`b`.`currency_id`, `b`.`exchage_rate`,`b`.`prime_amount`,`b`.`base_amount`,'post',CURRENT_TIMESTAMP,userId
	
	FROM `am_voucher_head` `a`
	INNER JOIN `am_voucher_detail` `b` ON `a`.`id` = `b`.`am_voucher_head_id`
	WHERE `a`.status='balanced' AND `a`.`voucher_number`=voucherNumber;
	
	update `am_voucher_head` set `status`='posted' where `voucher_number`=voucherNumber and `status`='balanced';



END */$$
DELIMITER ;

/*Table structure for table `vw_ap_payable` */

DROP TABLE IF EXISTS `vw_ap_payable`;

/*!50001 DROP VIEW IF EXISTS `vw_ap_payable` */;
/*!50001 DROP TABLE IF EXISTS `vw_ap_payable` */;

/*!50001 CREATE TABLE  `vw_ap_payable`(
 `supplier_id` int(11) ,
 `org_name` varchar(45) ,
 `branch_id` int(11) ,
 `am_coa_id` int(11) ,
 `coa_title` varchar(100) ,
 `contct_person` varchar(45) ,
 `payable_amount` decimal(42,8) 
)*/;

/*Table structure for table `vw_coa` */

DROP TABLE IF EXISTS `vw_coa`;

/*!50001 DROP VIEW IF EXISTS `vw_coa` */;
/*!50001 DROP TABLE IF EXISTS `vw_coa` */;

/*!50001 CREATE TABLE  `vw_coa`(
 `id` int(11) ,
 `account_type` varchar(16) ,
 `Group_One` varchar(117) ,
 `Group_Two` varchar(117) ,
 `Group_Three` varchar(117) ,
 `Group_Four` varchar(117) ,
 `account_code` varchar(16) ,
 `title` varchar(100) ,
 `account_usage` varchar(16) ,
 `analyical_code` varchar(16) ,
 `status` varchar(16) 
)*/;

/*Table structure for table `vw_gl_trn` */

DROP TABLE IF EXISTS `vw_gl_trn`;

/*!50001 DROP VIEW IF EXISTS `vw_gl_trn` */;
/*!50001 DROP TABLE IF EXISTS `vw_gl_trn` */;

/*!50001 CREATE TABLE  `vw_gl_trn`(
 `am_voucher_head_id` int(11) ,
 `voucher_number` varchar(16) ,
 `reference` varchar(128) ,
 `date` date ,
 `year` int(11) ,
 `period` int(11) ,
 `branch_id` int(11) ,
 `am_coa_id` int(11) ,
 `account_code` varchar(16) ,
 `title` varchar(100) ,
 `debit` decimal(20,8) ,
 `credit` decimal(20,8) 
)*/;

/*Table structure for table `vw_grn_detail` */

DROP TABLE IF EXISTS `vw_grn_detail`;

/*!50001 DROP VIEW IF EXISTS `vw_grn_detail` */;
/*!50001 DROP TABLE IF EXISTS `vw_grn_detail` */;

/*!50001 CREATE TABLE  `vw_grn_detail`(
 `id` int(11) ,
 `grn_number` varchar(16) ,
 `po_order_number` varchar(16) ,
 `product_code` varchar(16) ,
 `title` varchar(45) ,
 `batch_number` varchar(16) ,
 `expire_date` date ,
 `receive_quantity` decimal(8,0) ,
 `cost_price` decimal(20,8) ,
 `uom` varchar(8) ,
 `quantity` decimal(8,0) ,
 `row_amount` decimal(20,8) 
)*/;

/*Table structure for table `vw_im_grn_detail` */

DROP TABLE IF EXISTS `vw_im_grn_detail`;

/*!50001 DROP VIEW IF EXISTS `vw_im_grn_detail` */;
/*!50001 DROP TABLE IF EXISTS `vw_im_grn_detail` */;

/*!50001 CREATE TABLE  `vw_im_grn_detail`(
 `id` int(11) ,
 `im_grn_head_id` int(11) ,
 `grn_number` varchar(16) ,
 `pp_purchase_head_id` int(11) ,
 `product_id` int(11) ,
 `product_code` varchar(16) ,
 `title` varchar(45) ,
 `batch_number` varchar(16) ,
 `expire_date` date ,
 `receive_quantity` decimal(8,0) ,
 `cost_price` decimal(20,8) ,
 `uom` varchar(8) ,
 `quantity` decimal(8,0) ,
 `row_amount` decimal(20,8) 
)*/;

/*Table structure for table `vw_im_post_to_gl` */

DROP TABLE IF EXISTS `vw_im_post_to_gl`;

/*!50001 DROP VIEW IF EXISTS `vw_im_post_to_gl` */;
/*!50001 DROP TABLE IF EXISTS `vw_im_post_to_gl` */;

/*!50001 CREATE TABLE  `vw_im_post_to_gl`(
 `transaction_number` varchar(16) ,
 `branch_id` int(11) ,
 `date` date ,
 `product_id` int(11) ,
 `product_code` varchar(16) ,
 `title` varchar(45) ,
 `currency_id` int(11) ,
 `exchange_rate` decimal(20,8) ,
 `quantity` decimal(8,0) ,
 `total_price` decimal(20,8) ,
 `base_value` decimal(20,8) ,
 `status` varchar(16) ,
 `voucher_number` varchar(32) 
)*/;

/*Table structure for table `vw_im_purchase_order_head` */

DROP TABLE IF EXISTS `vw_im_purchase_order_head`;

/*!50001 DROP VIEW IF EXISTS `vw_im_purchase_order_head` */;
/*!50001 DROP TABLE IF EXISTS `vw_im_purchase_order_head` */;

/*!50001 CREATE TABLE  `vw_im_purchase_order_head`(
 `id` int(11) ,
 `po_order_number` varchar(16) ,
 `supplier_id` int(11) ,
 `org_name` varchar(45) ,
 `Order_Date` date ,
 `delivery_date` date ,
 `status` varchar(16) 
)*/;

/*Table structure for table `vw_im_transaction` */

DROP TABLE IF EXISTS `vw_im_transaction`;

/*!50001 DROP VIEW IF EXISTS `vw_im_transaction` */;
/*!50001 DROP TABLE IF EXISTS `vw_im_transaction` */;

/*!50001 CREATE TABLE  `vw_im_transaction`(
 `transaction_number` varchar(16) ,
 `product_id` int(11) ,
 `product_code` varchar(16) ,
 `title` varchar(45) ,
 `branch_code` varchar(16) ,
 `branch` varchar(45) ,
 `batch_number` varchar(45) ,
 `expire_date` date ,
 `quantity` decimal(8,0) ,
 `uom` varchar(8) ,
 `rate` decimal(20,8) ,
 `value` decimal(28,8) ,
 `status` varchar(16) 
)*/;

/*Table structure for table `vw_im_transfer` */

DROP TABLE IF EXISTS `vw_im_transfer`;

/*!50001 DROP VIEW IF EXISTS `vw_im_transfer` */;
/*!50001 DROP TABLE IF EXISTS `vw_im_transfer` */;

/*!50001 CREATE TABLE  `vw_im_transfer`(
 `product_id` int(11) ,
 `Batch` varchar(32) ,
 `ToStore` int(11) ,
 `ReceiveQty` decimal(42,0) 
)*/;

/*Table structure for table `vw_im_transfer_issue` */

DROP TABLE IF EXISTS `vw_im_transfer_issue`;

/*!50001 DROP VIEW IF EXISTS `vw_im_transfer_issue` */;
/*!50001 DROP TABLE IF EXISTS `vw_im_transfer_issue` */;

/*!50001 CREATE TABLE  `vw_im_transfer_issue`(
 `product_id` int(11) ,
 `Batch` varchar(32) ,
 `FromStore` int(11) ,
 `IssueQty` decimal(42,0) 
)*/;

/*Table structure for table `vw_im_trn` */

DROP TABLE IF EXISTS `vw_im_trn`;

/*!50001 DROP VIEW IF EXISTS `vw_im_trn` */;
/*!50001 DROP TABLE IF EXISTS `vw_im_trn` */;

/*!50001 CREATE TABLE  `vw_im_trn`(
 `transaction_number` varchar(16) ,
 `product_id` int(11) ,
 `product_code` varchar(16) ,
 `title` varchar(45) ,
 `branch` varchar(45) ,
 `batch_number` varchar(45) ,
 `expire_date` date ,
 `quantity` decimal(8,0) ,
 `uom` varchar(8) ,
 `rate` decimal(20,8) ,
 `value` decimal(28,8) ,
 `status` varchar(16) 
)*/;

/*Table structure for table `vw_invoice_supplier` */

DROP TABLE IF EXISTS `vw_invoice_supplier`;

/*!50001 DROP VIEW IF EXISTS `vw_invoice_supplier` */;
/*!50001 DROP TABLE IF EXISTS `vw_invoice_supplier` */;

/*!50001 CREATE TABLE  `vw_invoice_supplier`(
 `supplier_id` int(11) ,
 `org_name` varchar(45) ,
 `am_voucher_head_id` varchar(50) ,
 `voucher_number` varchar(20) ,
 `date` date ,
 `branch_id` int(11) ,
 `currency_id` varchar(20) ,
 `exchange_rate` decimal(26,8) ,
 `prime_amount` decimal(26,8) ,
 `base_amount` decimal(26,8) 
)*/;

/*Table structure for table `vw_pay_invoice` */

DROP TABLE IF EXISTS `vw_pay_invoice`;

/*!50001 DROP VIEW IF EXISTS `vw_pay_invoice` */;
/*!50001 DROP TABLE IF EXISTS `vw_pay_invoice` */;

/*!50001 CREATE TABLE  `vw_pay_invoice`(
 `supplier_id` int(11) ,
 `am_voucher_head_id` varchar(20) ,
 `date` date ,
 `branch_id` int(11) ,
 `currency_id` varchar(20) ,
 `exchange_rate` decimal(26,8) ,
 `prime_amount` decimal(26,8) ,
 `base_amount` decimal(26,8) 
)*/;

/*Table structure for table `vw_purchase_detail` */

DROP TABLE IF EXISTS `vw_purchase_detail`;

/*!50001 DROP VIEW IF EXISTS `vw_purchase_detail` */;
/*!50001 DROP TABLE IF EXISTS `vw_purchase_detail` */;

/*!50001 CREATE TABLE  `vw_purchase_detail`(
 `pp_purchase_head_id` int(11) ,
 `product_id` int(11) ,
 `product_code` varchar(16) ,
 `title` varchar(45) ,
 `uom` varchar(16) ,
 `uom_quantity` decimal(8,0) ,
 `quantity` decimal(9,0) ,
 `purchase_rate` decimal(20,8) ,
 `total_amount` decimal(30,0) 
)*/;

/*Table structure for table `vw_sm_batch_sale` */

DROP TABLE IF EXISTS `vw_sm_batch_sale`;

/*!50001 DROP VIEW IF EXISTS `vw_sm_batch_sale` */;
/*!50001 DROP TABLE IF EXISTS `vw_sm_batch_sale` */;

/*!50001 CREATE TABLE  `vw_sm_batch_sale`(
 `sm_number` varchar(50) ,
 `product_id` int(1) ,
 `product_code` varchar(16) ,
 `title` varchar(45) ,
 `batch_number` varchar(50) ,
 `expire_date` date ,
 `uom` varchar(20) ,
 `sell_rate` decimal(20,8) ,
 `rate` decimal(20,8) ,
 `quantity` double ,
 `tax_rate` decimal(20,8) ,
 `line_amount` double 
)*/;

/*Table structure for table `vw_sm_mr_allocation` */

DROP TABLE IF EXISTS `vw_sm_mr_allocation`;

/*!50001 DROP VIEW IF EXISTS `vw_sm_mr_allocation` */;
/*!50001 DROP TABLE IF EXISTS `vw_sm_mr_allocation` */;

/*!50001 CREATE TABLE  `vw_sm_mr_allocation`(
 `invoice_number` varchar(32) ,
 `customer_id` int(11) ,
 `branch_id` int(11) ,
 `sign` varchar(16) ,
 `currency_id` int(11) ,
 `exchange_rate` decimal(20,8) ,
 `receive_amount` decimal(20,8) 
)*/;

/*Table structure for table `vw_sm_mr_receive` */

DROP TABLE IF EXISTS `vw_sm_mr_receive`;

/*!50001 DROP VIEW IF EXISTS `vw_sm_mr_receive` */;
/*!50001 DROP TABLE IF EXISTS `vw_sm_mr_receive` */;

/*!50001 CREATE TABLE  `vw_sm_mr_receive`(
 `invoice_number` varchar(32) ,
 `customer_id` int(11) ,
 `branch_id` int(11) ,
 `currency_id` int(11) ,
 `exchange_rate` decimal(20,8) ,
 `amount` double 
)*/;

/*Table structure for table `vw_sm_sale_allocation` */

DROP TABLE IF EXISTS `vw_sm_sale_allocation`;

/*!50001 DROP VIEW IF EXISTS `vw_sm_sale_allocation` */;
/*!50001 DROP TABLE IF EXISTS `vw_sm_sale_allocation` */;

/*!50001 CREATE TABLE  `vw_sm_sale_allocation`(
 `branch_id` int(11) ,
 `product_id` int(1) ,
 `batch_number` varchar(50) ,
 `quantity` double 
)*/;

/*Table structure for table `vw_unitofm` */

DROP TABLE IF EXISTS `vw_unitofm`;

/*!50001 DROP VIEW IF EXISTS `vw_unitofm` */;
/*!50001 DROP TABLE IF EXISTS `vw_unitofm` */;

/*!50001 CREATE TABLE  `vw_unitofm`(
 `sell_uom_qty` decimal(8,0) 
)*/;

/*Table structure for table `vw_unpaid_invoice` */

DROP TABLE IF EXISTS `vw_unpaid_invoice`;

/*!50001 DROP VIEW IF EXISTS `vw_unpaid_invoice` */;
/*!50001 DROP TABLE IF EXISTS `vw_unpaid_invoice` */;

/*!50001 CREATE TABLE  `vw_unpaid_invoice`(
 `supplier_id` int(11) ,
 `am_voucher_head_id` varchar(20) ,
 `date` date ,
 `branch_id` int(11) ,
 `currency_id` varchar(20) ,
 `exchange_rate` decimal(26,8) ,
 `prime_amount` decimal(48,8) ,
 `base_amount` decimal(48,8) 
)*/;

/*Table structure for table `vw_voucher` */

DROP TABLE IF EXISTS `vw_voucher`;

/*!50001 DROP VIEW IF EXISTS `vw_voucher` */;
/*!50001 DROP TABLE IF EXISTS `vw_voucher` */;

/*!50001 CREATE TABLE  `vw_voucher`(
 `am_voucher_head_id` int(11) ,
 `am_coa_id` int(11) ,
 `account_code` varchar(16) ,
 `title` varchar(100) ,
 `supplier_id` int(11) ,
 `currency_id` int(11) ,
 `exchange_rate` decimal(20,8) ,
 `prime_debit` decimal(20,8) ,
 `prime_credit` decimal(20,8) ,
 `base_debit` decimal(20,8) ,
 `base_credit` decimal(20,8) 
)*/;

/*View structure for view vw_ap_payable */

/*!50001 DROP TABLE IF EXISTS `vw_ap_payable` */;
/*!50001 DROP VIEW IF EXISTS `vw_ap_payable` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_ap_payable` AS select `a`.`supplier_id` AS `supplier_id`,`b`.`org_name` AS `org_name`,`c`.`branch_id` AS `branch_id`,`a`.`am_coa_id` AS `am_coa_id`,`d`.`title` AS `coa_title`,`b`.`contct_person` AS `contct_person`,abs(sum(`a`.`prime_amount`)) AS `payable_amount` from (((`am_voucher_detail` `a` join `supplier` `b` on((`a`.`supplier_id` = `b`.`id`))) join `am_voucher_head` `c` on((`c`.`id` = `a`.`am_voucher_head_id`))) join `am_coa` `d` on((`d`.`id` = `a`.`am_coa_id`))) group by `a`.`supplier_id`,`c`.`branch_id` */;

/*View structure for view vw_coa */

/*!50001 DROP TABLE IF EXISTS `vw_coa` */;
/*!50001 DROP VIEW IF EXISTS `vw_coa` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_coa` AS select `a`.`id` AS `id`,`a`.`account_type` AS `account_type`,concat(`b`.`code`,'-',`b`.`title`) AS `Group_One`,ifnull(concat(`c`.`code`,'-',`c`.`title`),'') AS `Group_Two`,ifnull(concat(`d`.`code`,'-',`d`.`title`),'') AS `Group_Three`,ifnull(concat(`e`.`code`,'-',`e`.`title`),'') AS `Group_Four`,`a`.`account_code` AS `account_code`,`a`.`title` AS `title`,`a`.`account_usage` AS `account_usage`,`a`.`analyical_code` AS `analyical_code`,`a`.`status` AS `status` from ((((`am_coa` `a` left join `group_one` `b` on((`a`.`group_one_id` = `b`.`id`))) left join `group_two` `c` on(((`b`.`id` = `c`.`group_one_id`) and (`a`.`group_two_id` = `c`.`id`)))) left join `group_three` `d` on(((`c`.`id` = `d`.`group_two_id`) and (`a`.`group_three_id` = `d`.`id`)))) left join `group_four` `e` on(((`d`.`id` = `e`.`group_three_id`) and (`a`.`group_four_id` = `e`.`id`)))) */;

/*View structure for view vw_gl_trn */

/*!50001 DROP TABLE IF EXISTS `vw_gl_trn` */;
/*!50001 DROP VIEW IF EXISTS `vw_gl_trn` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_gl_trn` AS select `a`.`am_voucher_head_id` AS `am_voucher_head_id`,`c`.`voucher_number` AS `voucher_number`,`c`.`reference` AS `reference`,`c`.`date` AS `date`,`c`.`year` AS `year`,`c`.`period` AS `period`,`c`.`branch_id` AS `branch_id`,`a`.`am_coa_id` AS `am_coa_id`,`b`.`account_code` AS `account_code`,`b`.`title` AS `title`,(case when (`a`.`base_amount` > 0) then `a`.`base_amount` end) AS `debit`,(case when (`a`.`base_amount` < 0) then abs(`a`.`base_amount`) end) AS `credit` from ((`am_voucher_detail` `a` join `am_coa` `b`) join `am_voucher_head` `c`) where ((`a`.`am_coa_id` = `b`.`id`) and (`a`.`am_voucher_head_id` = `c`.`id`)) */;

/*View structure for view vw_grn_detail */

/*!50001 DROP TABLE IF EXISTS `vw_grn_detail` */;
/*!50001 DROP VIEW IF EXISTS `vw_grn_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_grn_detail` AS select `a`.`id` AS `id`,`c`.`grn_number` AS `grn_number`,`d`.`po_order_number` AS `po_order_number`,`b`.`product_code` AS `product_code`,`b`.`title` AS `title`,`a`.`batch_number` AS `batch_number`,`a`.`expire_date` AS `expire_date`,`a`.`receive_quantity` AS `receive_quantity`,`a`.`cost_price` AS `cost_price`,`a`.`uom` AS `uom`,`a`.`quantity` AS `quantity`,`a`.`row_amount` AS `row_amount` from (((`im_grn_detail` `a` join `product` `b` on((convert(`a`.`product_id` using utf8) = `b`.`id`))) join `im_grn_head` `c` on((`a`.`im_grn_head_id` = `c`.`id`))) join `pp_purchase_head` `d` on((`c`.`pp_purchase_head_id` = `d`.`id`))) */;

/*View structure for view vw_im_grn_detail */

/*!50001 DROP TABLE IF EXISTS `vw_im_grn_detail` */;
/*!50001 DROP VIEW IF EXISTS `vw_im_grn_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_im_grn_detail` AS select `a`.`id` AS `id`,`a`.`im_grn_head_id` AS `im_grn_head_id`,`c`.`grn_number` AS `grn_number`,`c`.`pp_purchase_head_id` AS `pp_purchase_head_id`,`a`.`product_id` AS `product_id`,`b`.`product_code` AS `product_code`,`b`.`title` AS `title`,`a`.`batch_number` AS `batch_number`,`a`.`expire_date` AS `expire_date`,`a`.`receive_quantity` AS `receive_quantity`,`a`.`cost_price` AS `cost_price`,`a`.`uom` AS `uom`,`a`.`quantity` AS `quantity`,`a`.`row_amount` AS `row_amount` from ((`im_grn_detail` `a` join `product` `b` on((convert(`a`.`product_id` using utf8) = `b`.`id`))) join `im_grn_head` `c` on((`a`.`im_grn_head_id` = `c`.`id`))) */;

/*View structure for view vw_im_post_to_gl */

/*!50001 DROP TABLE IF EXISTS `vw_im_post_to_gl` */;
/*!50001 DROP VIEW IF EXISTS `vw_im_post_to_gl` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_im_post_to_gl` AS select `a`.`transaction_number` AS `transaction_number`,`a`.`branch_id` AS `branch_id`,`a`.`date` AS `date`,`a`.`product_id` AS `product_id`,`b`.`product_code` AS `product_code`,`b`.`title` AS `title`,`a`.`currency_id` AS `currency_id`,`a`.`exchange_rate` AS `exchange_rate`,`a`.`quantity` AS `quantity`,`a`.`total_price` AS `total_price`,`a`.`base_value` AS `base_value`,`a`.`status` AS `status`,`a`.`voucher_number` AS `voucher_number` from ((`im_transaction` `a` join `product` `b` on((`a`.`product_id` = `b`.`id`))) join `it_im_gl` `c` on(((left(`a`.`transaction_number`,4) = `c`.`transaction_code`) and (`b`.`group` = `c`.`group`) and (`c`.`branch_id` = `a`.`branch_id`) and (`a`.`status` = 'open')))) group by `a`.`transaction_number` */;

/*View structure for view vw_im_purchase_order_head */

/*!50001 DROP TABLE IF EXISTS `vw_im_purchase_order_head` */;
/*!50001 DROP VIEW IF EXISTS `vw_im_purchase_order_head` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_im_purchase_order_head` AS select `a`.`id` AS `id`,`a`.`po_order_number` AS `po_order_number`,`a`.`supplier_id` AS `supplier_id`,`b`.`org_name` AS `org_name`,`a`.`date` AS `Order_Date`,`a`.`delivery_date` AS `delivery_date`,`a`.`status` AS `status` from (`pp_purchase_head` `a` join `supplier` `b` on((`a`.`supplier_id` = `b`.`id`))) where (`a`.`status` not in ('open','cancel')) */;

/*View structure for view vw_im_transaction */

/*!50001 DROP TABLE IF EXISTS `vw_im_transaction` */;
/*!50001 DROP VIEW IF EXISTS `vw_im_transaction` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_im_transaction` AS select `a`.`transaction_number` AS `transaction_number`,`a`.`product_id` AS `product_id`,`b`.`product_code` AS `product_code`,`b`.`title` AS `title`,`c`.`branch_code` AS `branch_code`,`c`.`title` AS `branch`,`a`.`batch_number` AS `batch_number`,`a`.`expire_date` AS `expire_date`,`a`.`quantity` AS `quantity`,`a`.`uom` AS `uom`,`a`.`rate` AS `rate`,(`a`.`quantity` * `a`.`rate`) AS `value`,`a`.`status` AS `status` from ((`im_transaction` `a` join `product` `b`) join `branch` `c`) where ((`a`.`product_id` = `b`.`id`) and (`a`.`branch_id` = `c`.`id`)) */;

/*View structure for view vw_im_transfer */

/*!50001 DROP TABLE IF EXISTS `vw_im_transfer` */;
/*!50001 DROP VIEW IF EXISTS `vw_im_transfer` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_im_transfer` AS select `a`.`product_id` AS `product_id`,`a`.`batch_number` AS `Batch`,`b`.`to_branch_id` AS `ToStore`,sum(`a`.`quantity`) AS `ReceiveQty` from (`im_batch_transfer` `a` join `im_transfer_head` `b` on((`a`.`im_transfer_head_id` = `b`.`id`))) where (`b`.`status` = 'open') group by `a`.`product_id`,`a`.`batch_number`,`b`.`to_branch_id` */;

/*View structure for view vw_im_transfer_issue */

/*!50001 DROP TABLE IF EXISTS `vw_im_transfer_issue` */;
/*!50001 DROP VIEW IF EXISTS `vw_im_transfer_issue` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_im_transfer_issue` AS select `a`.`product_id` AS `product_id`,`a`.`batch_number` AS `Batch`,`b`.`from_branch_id` AS `FromStore`,sum(`a`.`quantity`) AS `IssueQty` from (`im_batch_transfer` `a` join `im_transfer_head` `b` on((`a`.`im_transfer_head_id` = `b`.`id`))) where (`b`.`status` = 'open') group by `a`.`product_id`,`a`.`batch_number`,`b`.`from_branch_id` */;

/*View structure for view vw_im_trn */

/*!50001 DROP TABLE IF EXISTS `vw_im_trn` */;
/*!50001 DROP VIEW IF EXISTS `vw_im_trn` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_im_trn` AS select `a`.`transaction_number` AS `transaction_number`,`a`.`product_id` AS `product_id`,`b`.`product_code` AS `product_code`,`b`.`title` AS `title`,`c`.`title` AS `branch`,`a`.`batch_number` AS `batch_number`,`a`.`expire_date` AS `expire_date`,`a`.`quantity` AS `quantity`,`a`.`uom` AS `uom`,`a`.`rate` AS `rate`,(`a`.`quantity` * `a`.`rate`) AS `value`,`a`.`status` AS `status` from ((`im_transaction` `a` join `product` `b`) join `branch` `c`) where ((`a`.`product_id` = `b`.`id`) and (`a`.`branch_id` = `c`.`id`)) */;

/*View structure for view vw_invoice_supplier */

/*!50001 DROP TABLE IF EXISTS `vw_invoice_supplier` */;
/*!50001 DROP VIEW IF EXISTS `vw_invoice_supplier` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_invoice_supplier` AS select `a`.`supplier_id` AS `supplier_id`,`b`.`org_name` AS `org_name`,`a`.`am_voucher_head_id` AS `am_voucher_head_id`,`f`.`voucher_number` AS `voucher_number`,`f`.`date` AS `date`,`f`.`branch_id` AS `branch_id`,`a`.`currency_id` AS `currency_id`,`a`.`exchange_rate` AS `exchange_rate`,`a`.`prime_amount` AS `prime_amount`,`a`.`base_amount` AS `base_amount` from ((`am_voucher_detail` `a` join `am_voucher_head` `f` on((`f`.`id` = `a`.`am_voucher_head_id`))) join `supplier` `b` on(((`a`.`supplier_id` = `b`.`id`) and (left(`f`.`voucher_number`,4) = 'AP--')))) union all select `d`.`supplier_id` AS `supplier_id`,`e`.`org_name` AS `org_name`,`c`.`am_voucher_head_id` AS `am_voucher_head_id`,`c`.`voucher_number` AS `voucher_number`,`c`.`date` AS `date`,`g`.`branch_id` AS `branch_id`,`c`.`currency` AS `currency`,`c`.`exchage_rate` AS `exchage_rate`,`c`.`prime_amount` AS `prime_amount`,`c`.`base_amount` AS `base_amount` from (((`am_ap_allocation` `c` join `am_voucher_detail` `d` on((`c`.`am_voucher_head_id` = `d`.`am_voucher_head_id`))) join `am_voucher_head` `g` on((`g`.`id` = `d`.`am_voucher_head_id`))) join `supplier` `e` on((`d`.`supplier_id` = `e`.`id`))) */;

/*View structure for view vw_pay_invoice */

/*!50001 DROP TABLE IF EXISTS `vw_pay_invoice` */;
/*!50001 DROP VIEW IF EXISTS `vw_pay_invoice` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_pay_invoice` AS select `a`.`supplier_id` AS `supplier_id`,`a`.`am_voucher_head_id` AS `am_voucher_head_id`,`f`.`date` AS `date`,`f`.`branch_id` AS `branch_id`,`a`.`currency_id` AS `currency_id`,`a`.`exchange_rate` AS `exchange_rate`,`a`.`prime_amount` AS `prime_amount`,`a`.`base_amount` AS `base_amount` from ((`am_voucher_detail` `a` join `am_voucher_head` `f` on((`f`.`id` = `a`.`am_voucher_head_id`))) join `supplier` `b` on(((`a`.`supplier_id` = `b`.`id`) and (left(`f`.`voucher_number`,4) = 'AP--')))) union all select `d`.`supplier_id` AS `supplier_id`,`c`.`voucher_number` AS `voucher_number`,`g`.`date` AS `date`,`g`.`branch_id` AS `branch_id`,`c`.`currency` AS `currency`,`c`.`exchage_rate` AS `exchage_rate`,`c`.`prime_amount` AS `prime_amount`,`c`.`base_amount` AS `base_amount` from (((`am_ap_allocation` `c` join `am_voucher_detail` `d` on((`c`.`am_voucher_head_id` = `d`.`am_voucher_head_id`))) join `am_voucher_head` `g` on((`g`.`id` = `d`.`am_voucher_head_id`))) join `supplier` `e` on((`d`.`supplier_id` = `e`.`id`))) */;

/*View structure for view vw_purchase_detail */

/*!50001 DROP TABLE IF EXISTS `vw_purchase_detail` */;
/*!50001 DROP VIEW IF EXISTS `vw_purchase_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_purchase_detail` AS select `a`.`pp_purchase_head_id` AS `pp_purchase_head_id`,`a`.`product_id` AS `product_id`,`b`.`product_code` AS `product_code`,`b`.`title` AS `title`,`a`.`uom` AS `uom`,`a`.`uom_quantity` AS `uom_quantity`,(`a`.`quantity` - ifnull(`a`.`grn_quantity`,0)) AS `quantity`,`a`.`purchase_rate` AS `purchase_rate`,round(((`a`.`purchase_rate` * `a`.`quantity`) * (`a`.`quantity` - ifnull(`a`.`grn_quantity`,0))),0) AS `total_amount` from (`pp_purchase_detail` `a` join `product` `b` on((`a`.`product_id` = `b`.`id`))) group by `a`.`pp_purchase_head_id`,`a`.`product_id` having (sum((`a`.`quantity` - ifnull(`a`.`grn_quantity`,0))) > 0) */;

/*View structure for view vw_sm_batch_sale */

/*!50001 DROP TABLE IF EXISTS `vw_sm_batch_sale` */;
/*!50001 DROP VIEW IF EXISTS `vw_sm_batch_sale` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_sm_batch_sale` AS select `a`.`reference_code` AS `sm_number`,`a`.`product_id` AS `product_id`,`c`.`product_code` AS `product_code`,`c`.`title` AS `title`,`a`.`batch_number` AS `batch_number`,`a`.`expire_date` AS `expire_date`,`a`.`uom` AS `uom`,`a`.`sell_rate` AS `sell_rate`,`a`.`rate` AS `rate`,sum((`a`.`quantity` * `b`.`sign`)) AS `quantity`,`a`.`tax_rate` AS `tax_rate`,sum(((`a`.`quantity` * `b`.`sign`) * `a`.`line_amount`)) AS `line_amount` from ((`sm_batch_sale` `a` join `sm_head` `b` on((`a`.`sm_head_id` = `b`.`id`))) join `product` `c` on((`a`.`product_id` = `c`.`id`))) group by `a`.`reference_code`,`a`.`product_id` */;

/*View structure for view vw_sm_mr_allocation */

/*!50001 DROP TABLE IF EXISTS `vw_sm_mr_allocation` */;
/*!50001 DROP VIEW IF EXISTS `vw_sm_mr_allocation` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_sm_mr_allocation` AS select `sm_head`.`reference_code` AS `invoice_number`,`sm_head`.`customer_id` AS `customer_id`,`sm_head`.`branch_id` AS `branch_id`,`sm_head`.`sign` AS `sign`,`sm_head`.`currency_id` AS `currency_id`,`sm_head`.`exchange_rate` AS `exchange_rate`,`sm_head`.`net_amount` AS `receive_amount` from `sm_head` where ((`sm_head`.`doc_type` in ('sales','return')) and (`sm_head`.`status` in ('confirmed','delivered'))) union all select `b`.`invoice_number` AS `invoice_number`,`a`.`customer_id` AS `customer_id`,`a`.`branch_id` AS `branch_id`,`a`.`sign` AS `sign`,`a`.`currency_id` AS `currency_id`,`a`.`exchange_rate` AS `exchange_rate`,`b`.`amount` AS `amount` from (`sm_head` `a` join `sm_invoice_allocation` `b` on(((`a`.`id` = `b`.`sm_head_id`) and (`a`.`doc_type` = 'receipt')))) */;

/*View structure for view vw_sm_mr_receive */

/*!50001 DROP TABLE IF EXISTS `vw_sm_mr_receive` */;
/*!50001 DROP VIEW IF EXISTS `vw_sm_mr_receive` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_sm_mr_receive` AS select `vw_sm_mr_allocation`.`invoice_number` AS `invoice_number`,`vw_sm_mr_allocation`.`customer_id` AS `customer_id`,`vw_sm_mr_allocation`.`branch_id` AS `branch_id`,`vw_sm_mr_allocation`.`currency_id` AS `currency_id`,`vw_sm_mr_allocation`.`exchange_rate` AS `exchange_rate`,sum((`vw_sm_mr_allocation`.`sign` * `vw_sm_mr_allocation`.`receive_amount`)) AS `amount` from `vw_sm_mr_allocation` group by `vw_sm_mr_allocation`.`invoice_number` having (sum((`vw_sm_mr_allocation`.`sign` * `vw_sm_mr_allocation`.`receive_amount`)) > 0) */;

/*View structure for view vw_sm_sale_allocation */

/*!50001 DROP TABLE IF EXISTS `vw_sm_sale_allocation` */;
/*!50001 DROP VIEW IF EXISTS `vw_sm_sale_allocation` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_sm_sale_allocation` AS select `a`.`branch_id` AS `branch_id`,`b`.`product_id` AS `product_id`,`b`.`batch_number` AS `batch_number`,sum(((`b`.`quantity` + ifnull(`b`.`bonus_quantity`,0)) * `a`.`sign`)) AS `quantity` from (`sm_head` `a` join `sm_batch_sale` `b` on(((`a`.`id` = `b`.`sm_head_id`) and (`a`.`doc_type` = 'sales') and (`a`.`status` not in ('delivered','cancel'))))) group by `b`.`product_id`,`b`.`batch_number`,`a`.`branch_id` */;

/*View structure for view vw_unitofm */

/*!50001 DROP TABLE IF EXISTS `vw_unitofm` */;
/*!50001 DROP VIEW IF EXISTS `vw_unitofm` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_unitofm` AS select distinct `product`.`sell_uom_qty` AS `sell_uom_qty` from `product` union all select distinct `product`.`purchase_uom_qty` AS `purchase_uom_qty` from `product` union all select distinct `product`.`stock_uom_qty` AS `stock_uom_qty` from `product` */;

/*View structure for view vw_unpaid_invoice */

/*!50001 DROP TABLE IF EXISTS `vw_unpaid_invoice` */;
/*!50001 DROP VIEW IF EXISTS `vw_unpaid_invoice` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_unpaid_invoice` AS select `vw_pay_invoice`.`supplier_id` AS `supplier_id`,`vw_pay_invoice`.`am_voucher_head_id` AS `am_voucher_head_id`,`vw_pay_invoice`.`date` AS `date`,`vw_pay_invoice`.`branch_id` AS `branch_id`,`vw_pay_invoice`.`currency_id` AS `currency_id`,`vw_pay_invoice`.`exchange_rate` AS `exchange_rate`,abs(sum(`vw_pay_invoice`.`prime_amount`)) AS `prime_amount`,abs(sum(`vw_pay_invoice`.`base_amount`)) AS `base_amount` from `vw_pay_invoice` group by `vw_pay_invoice`.`supplier_id`,`vw_pay_invoice`.`am_voucher_head_id`,`vw_pay_invoice`.`branch_id` having (abs(sum(`vw_pay_invoice`.`prime_amount`)) > 0) */;

/*View structure for view vw_voucher */

/*!50001 DROP TABLE IF EXISTS `vw_voucher` */;
/*!50001 DROP VIEW IF EXISTS `vw_voucher` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`reza`@`localhost` SQL SECURITY DEFINER VIEW `vw_voucher` AS select `a`.`am_voucher_head_id` AS `am_voucher_head_id`,`a`.`am_coa_id` AS `am_coa_id`,`b`.`account_code` AS `account_code`,`b`.`title` AS `title`,`a`.`supplier_id` AS `supplier_id`,`a`.`currency_id` AS `currency_id`,`a`.`exchange_rate` AS `exchange_rate`,(case when (`a`.`prime_amount` > 0) then `a`.`prime_amount` end) AS `prime_debit`,(case when (`a`.`prime_amount` < 0) then abs(`a`.`prime_amount`) end) AS `prime_credit`,(case when (`a`.`base_amount` > 0) then `a`.`base_amount` end) AS `base_debit`,(case when (`a`.`base_amount` < 0) then abs(`a`.`base_amount`) end) AS `base_credit` from (`am_voucher_detail` `a` join `am_coa` `b` on((`a`.`am_coa_id` = `b`.`id`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
