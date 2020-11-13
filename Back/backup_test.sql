/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 5.7.28 : Database - intelcost_bienes
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`intelcost_bienes` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `intelcost_bienes`;

/*Table structure for table `bienes` */

DROP TABLE IF EXISTS `bienes`;

CREATE TABLE `bienes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_bien` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `bienes` */

insert  into `bienes`(`id`,`id_bien`,`content`,`user_id`) values 
(3,1,'{\"Id\":1,\"Direccion\":\"Ap #549-7395 Ut Rd.\",\"Ciudad\":\"New York\",\"Telefono\":\"334-052-0954\",\"Codigo_Postal\":\"85328\",\"Tipo\":\"Casa\",\"Precio\":30746}',1),
(4,4,'{\"Id\":4,\"Direccion\":\"347-866 Laoreet Road\",\"Ciudad\":\"Los Angeles\",\"Telefono\":\"997-640-8188\",\"Codigo_Postal\":\"94526-134\",\"Tipo\":\"Casa de Campo\",\"Precio\":16048}',1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`name`) values 
(1,'Mauricio Cantor');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
