/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.24 : Database - imronman
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`imronman` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `imronman`;

/*Table structure for table `complaint` */

DROP TABLE IF EXISTS `complaint`;

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) DEFAULT NULL,
  `id_member_respon` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `desc` text,
  `status` tinyint(1) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_respon` datetime DEFAULT NULL,
  `date_finish` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `complaint` */

/*Table structure for table `division` */

DROP TABLE IF EXISTS `division`;

CREATE TABLE `division` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `division` */

insert  into `division`(`id`,`name`) values (1,'Personalia'),(2,'Keuangan'),(3,'Produksi'),(4,'Akunting'),(5,'IT Support');

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` tinyint(1) DEFAULT NULL,
  `id_division` tinyint(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `tlp` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `member` */

insert  into `member`(`id`,`username`,`password`,`level`,`id_division`,`status`,`name`,`tlp`) values (1,'karyawan1','c4ca4238a0b923820dcc509a6f75849b',2,1,1,'budi','089111111111'),(2,'it1','c4ca4238a0b923820dcc509a6f75849b',2,5,1,'tono','089222222222'),(3,'karyawan2','c4ca4238a0b923820dcc509a6f75849b',2,3,1,'linda','089333333333'),(4,'admin','c4ca4238a0b923820dcc509a6f75849b',1,NULL,1,'anton','089444444444'),(5,'it2','c4ca4238a0b923820dcc509a6f75849b',2,5,1,'reno','089555555555');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
