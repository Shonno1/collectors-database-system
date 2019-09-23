# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.27)
# Database: seanCollection
# Generation Time: 2019-09-23 13:29:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table things
# ------------------------------------------------------------

DROP TABLE IF EXISTS `things`;

CREATE TABLE `things` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `widgetName` varchar(255) DEFAULT NULL,
  `widgetDescription` varchar(255) DEFAULT NULL,
  `widgetSize` int(11) DEFAULT NULL,
  `widgetRating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `things` WRITE;
/*!40000 ALTER TABLE `things` DISABLE KEYS */;

INSERT INTO `things` (`id`, `widgetName`, `widgetDescription`, `widgetSize`, `widgetRating`)
VALUES
	(1,'Widget One','This is the first ever Widget',1,1),
	(2,'Widget Two','This is the second Widget',2,3),
	(3,'Widget Three','This is the third Widget',3,9),
	(4,'Widget Four','This is the fourth Widget',5,5);

/*!40000 ALTER TABLE `things` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
