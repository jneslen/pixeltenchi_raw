# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.24-cll)
# Database: darth
# Generation Time: 2012-07-06 21:59:37 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table components
# ------------------------------------------------------------

DROP TABLE IF EXISTS `components`;

CREATE TABLE `components` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('model','method','view','content') NOT NULL DEFAULT 'content',
  `name` varchar(85) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `content` text,
  `model` varchar(255) DEFAULT NULL,
  `directory` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `view` varchar(255) DEFAULT NULL,
  `vars` varchar(255) DEFAULT NULL,
  `language` tinyint(1) NOT NULL DEFAULT '1',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `components` WRITE;
/*!40000 ALTER TABLE `components` DISABLE KEYS */;

INSERT INTO `components` (`id`, `type`, `name`, `description`, `content`, `model`, `directory`, `controller`, `method`, `view`, `vars`, `language`, `disabled`)
VALUES
	(1,'method','%%leadform%%','Lead capture body form',NULL,NULL,NULL,'public','lead_form',NULL,NULL,1,0),
	(2,'content','%%getstartedpage%%','A Get Started well that scrolls to the leadform on the same page','<div class=\"well margin-right\">\n	<div class=\"left\">\n		<h3 class=\"no-margin\">Let Matrix42 empower you to be in control of your IT needs.</h3>\n		<h4 class=\"no-margin\">Get started with the perfect IT solution now.</h4>\n	</div>\n	<a href=\"/request_a_call\" class=\"btn btn-info btn-large right margin-right\">Get Started Today!</a>\n	<div class=\"clearfix\"></div>\n</div><!-- well -->',NULL,NULL,NULL,NULL,NULL,NULL,1,0),
	(3,'method','%%sidebarsupport%%','The support and contact well for the sidebar',NULL,NULL,NULL,'public','side_support',NULL,NULL,1,0),
	(4,'method','%%awardslist%%','Award list table',NULL,NULL,'public','press','awards',NULL,NULL,1,0),
	(5,'method','%%sidebarleadform%%','Lead capture form for sidebar',NULL,NULL,NULL,'public','side_lead_form',NULL,NULL,1,0),
	(6,'view','%%sidebarsuccessstories%%','Sidebar Success Stories',NULL,NULL,NULL,NULL,NULL,'sidebar/success_stories',NULL,1,0),
	(7,'method','%%resellerlist%%','Reseller list table',NULL,NULL,'public','partners','resellers',NULL,NULL,1,0),
	(8,'method','%%publicationslist%%','Publication list table',NULL,NULL,'public','press','publications',NULL,NULL,1,0);

/*!40000 ALTER TABLE `components` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
