# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.2.6-MariaDB)
# Database: pns_erp
# Generation Time: 2017-07-11 19:19:08 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table am_coa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `am_coa`;

CREATE TABLE `am_coa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_code` varchar(16) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table am_voucher_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `am_voucher_detail`;

CREATE TABLE `am_voucher_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `am_voucher_head_id` int(11) DEFAULT NULL,
  `am_coa_id` int(11) DEFAULT NULL,
  `am_sub_coa_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `exchange_rate` decimal(20,8) DEFAULT NULL,
  `prime_amount` decimal(20,8) DEFAULT NULL,
  `base_amount` decimal(20,8) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `am_voucher_head_id` (`am_voucher_head_id`),
  KEY `am_coa_id` (`am_coa_id`),
  KEY `am_sub_coa_id` (`am_sub_coa_id`),
  KEY `currency_id` (`currency_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `am_voucher_detail_ibfk_1` FOREIGN KEY (`am_voucher_head_id`) REFERENCES `am_voucher_head` (`id`),
  CONSTRAINT `am_voucher_detail_ibfk_2` FOREIGN KEY (`am_coa_id`) REFERENCES `am_coa` (`id`),
  CONSTRAINT `am_voucher_detail_ibfk_3` FOREIGN KEY (`am_sub_coa_id`) REFERENCES `am_coa` (`id`),
  CONSTRAINT `am_voucher_detail_ibfk_4` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`),
  CONSTRAINT `am_voucher_detail_ibfk_5` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table am_voucher_head
# ------------------------------------------------------------

DROP TABLE IF EXISTS `am_voucher_head`;

CREATE TABLE `am_voucher_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_number` varchar(16) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reference` varchar(128) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `period` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `am_voucher_head_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table branch
# ------------------------------------------------------------

DROP TABLE IF EXISTS `branch`;

CREATE TABLE `branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_code` varchar(16) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `exchange_rate` decimal(20,8) DEFAULT NULL,
  `contact_person` varchar(45) DEFAULT NULL,
  `designation` varchar(45) DEFAULT NULL,
  `mailing_addess` text DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `cell` varchar(16) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `currency_id` (`currency_id`),
  CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table codes_param
# ------------------------------------------------------------

DROP TABLE IF EXISTS `codes_param`;

CREATE TABLE `codes_param` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(16) DEFAULT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table company
# ------------------------------------------------------------

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(64) DEFAULT NULL,
  `thumb_image` varchar(64) DEFAULT NULL,
  `web_url` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table currency
# ------------------------------------------------------------

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_code` varchar(16) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `exchange_rate` decimal(20,8) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(16) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `api_id` varchar(16) DEFAULT NULL,
  `address` text DEFAULT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `group_one_id` (`group_one_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`group_one_id`) REFERENCES `group_one` (`id`),
  CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table group_four
# ------------------------------------------------------------

DROP TABLE IF EXISTS `group_four`;

CREATE TABLE `group_four` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_three_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `group_three_id` (`group_three_id`),
  CONSTRAINT `group_four_ibfk_1` FOREIGN KEY (`group_three_id`) REFERENCES `group_three` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table group_one
# ------------------------------------------------------------

DROP TABLE IF EXISTS `group_one`;

CREATE TABLE `group_one` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table group_three
# ------------------------------------------------------------

DROP TABLE IF EXISTS `group_three`;

CREATE TABLE `group_three` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_two_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `group_two_id` (`group_two_id`),
  CONSTRAINT `group_three_ibfk_1` FOREIGN KEY (`group_two_id`) REFERENCES `group_two` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table group_two
# ------------------------------------------------------------

DROP TABLE IF EXISTS `group_two`;

CREATE TABLE `group_two` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_one_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `group_one_id` (`group_one_id`),
  CONSTRAINT `group_two_ibfk_1` FOREIGN KEY (`group_one_id`) REFERENCES `group_one` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table im_adjust_detail
# ------------------------------------------------------------

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `im_adjust_head_id` (`im_adjust_head_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `im_adjust_detail_ibfk_1` FOREIGN KEY (`im_adjust_head_id`) REFERENCES `im_adjust_head` (`id`),
  CONSTRAINT `im_adjust_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table im_adjust_head
# ------------------------------------------------------------

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  KEY `currency_id` (`currency_id`),
  CONSTRAINT `im_adjust_head_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`),
  CONSTRAINT `im_adjust_head_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table im_grn_detail
# ------------------------------------------------------------

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `im_grn_head_id` (`im_grn_head_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `im_grn_detail_ibfk_1` FOREIGN KEY (`im_grn_head_id`) REFERENCES `im_grn_head` (`id`),
  CONSTRAINT `im_grn_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table im_grn_head
# ------------------------------------------------------------

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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



# Dump of table im_transaction
# ------------------------------------------------------------

DROP TABLE IF EXISTS `im_transaction`;

CREATE TABLE `im_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_number` varchar(16) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `batch_number` varchar(45) DEFAULT NULL,
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
  `note` text DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `im_transaction_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `im_transaction_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table im_transfer_detail
# ------------------------------------------------------------

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `im_transfer_head_id` (`im_transfer_head_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `im_transfer_detail_ibfk_1` FOREIGN KEY (`im_transfer_head_id`) REFERENCES `im_transfer_head` (`id`),
  CONSTRAINT `im_transfer_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table im_transfer_head
# ------------------------------------------------------------

DROP TABLE IF EXISTS `im_transfer_head`;

CREATE TABLE `im_transfer_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_number` varchar(16) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `confirm_date` date DEFAULT NULL,
  `note` text DEFAULT NULL,
  `from_branch_id` int(11) DEFAULT NULL,
  `from_currency_id` int(11) DEFAULT NULL,
  `from_exchange_rate` decimal(20,8) DEFAULT NULL,
  `to_branch_id` int(11) DEFAULT NULL,
  `to_currency_id` int(11) DEFAULT NULL,
  `to_exchange_rate` decimal(20,8) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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



# Dump of table it_im_gl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `it_im_gl`;

CREATE TABLE `it_im_gl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `transaction_code` varchar(16) DEFAULT NULL,
  `group` varchar(16) DEFAULT NULL,
  `dr_coa_id` int(11) DEFAULT NULL,
  `cr_coa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `it_im_gl_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table it_im_to_ap
# ------------------------------------------------------------

DROP TABLE IF EXISTS `it_im_to_ap`;

CREATE TABLE `it_im_to_ap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_group` varchar(16) DEFAULT NULL,
  `sub_group` varchar(16) DEFAULT NULL,
  `dr_coa_id` int(11) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `dr_coa_id` (`dr_coa_id`),
  CONSTRAINT `it_im_to_ap_ibfk_1` FOREIGN KEY (`dr_coa_id`) REFERENCES `am_coa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table pp_purchase_detail
# ------------------------------------------------------------

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pp_purchase_head_id` (`pp_purchase_head_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `pp_purchase_detail_ibfk_1` FOREIGN KEY (`pp_purchase_head_id`) REFERENCES `pp_purchase_head` (`id`),
  CONSTRAINT `pp_purchase_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table pp_purchase_head
# ------------------------------------------------------------

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `pp_purchase_head_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`),
  CONSTRAINT `pp_purchase_head_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(16) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(64) DEFAULT NULL,
  `thumb_image` varchar(64) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `group` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
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
  `manufacture_code` varchar(16) DEFAULT NULL,
  `max_level` varchar(8) DEFAULT NULL,
  `min_level` varchar(8) DEFAULT NULL,
  `re_order` varchar(8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `currency_id` (`currency_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`),
  CONSTRAINT `product_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sm_detail
# ------------------------------------------------------------

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `sm_head_id` (`sm_head_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `sm_detail_ibfk_1` FOREIGN KEY (`sm_head_id`) REFERENCES `sm_head` (`id`),
  CONSTRAINT `sm_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sm_head
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sm_head`;

CREATE TABLE `sm_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sm_number` varchar(16) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `doc_type` varchar(16) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `am_coa_id` int(11) DEFAULT NULL,
  `check_number` varchar(45) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `exchange_rate` decimal(20,8) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `tax_rate` decimal(20,8) DEFAULT NULL,
  `tax_amount` decimal(20,8) DEFAULT NULL,
  `discount_rate` decimal(20,8) DEFAULT NULL,
  `discount_amount` decimal(20,8) DEFAULT NULL,
  `prime_amount` decimal(20,8) DEFAULT NULL,
  `net_amount` decimal(20,8) DEFAULT NULL,
  `sign` varchar(16) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `reference_code` varchar(16) DEFAULT NULL,
  `gl_voucher_number` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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



# Dump of table supplier
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_code` varchar(16) DEFAULT NULL,
  `org_name` varchar(45) DEFAULT NULL,
  `address` text DEFAULT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table transaction_code
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transaction_code`;

CREATE TABLE `transaction_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trn_code` varchar(8) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `last_number` decimal(11,0) DEFAULT NULL,
  `increment` decimal(1,0) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `transaction_code_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users_activity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_activity`;

CREATE TABLE `users_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(64) DEFAULT NULL,
  `table_id` varchar(64) DEFAULT NULL,
  `action_note` text DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `reference` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
