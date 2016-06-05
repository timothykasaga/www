/*
SQLyog Community v12.09 (64 bit)
MySQL - 5.6.17 : Database - smsd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`smsd` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `smsd`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `AdminName` varchar(30) NOT NULL,
  `AdminUsername` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `TelephoneNo` varchar(10) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`AdminUsername`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `ProductName` varchar(25) NOT NULL,
  `ProductID` varchar(10) NOT NULL,
  `Measurement` varchar(25) NOT NULL,
  `UnitCost` double NOT NULL,
  `SupermarketID` varchar(25) NOT NULL,
  `SectionName` varchar(11) NOT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `SupermarketID` (`SupermarketID`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`SupermarketID`) REFERENCES `supermarket_details` (`SupermarketID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `product` */

/*Table structure for table `section` */

DROP TABLE IF EXISTS `section`;

CREATE TABLE `section` (
  `SectionName` varchar(11) NOT NULL,
  `SupermarketID` varchar(25) NOT NULL,
  `X_value` double NOT NULL,
  `Y_value` double NOT NULL,
  PRIMARY KEY (`SectionName`),
  KEY `SupermarketID` (`SupermarketID`),
  CONSTRAINT `section_ibfk_1` FOREIGN KEY (`SupermarketID`) REFERENCES `supermarket_details` (`SupermarketID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `section` */

/*Table structure for table `supermarket_details` */

DROP TABLE IF EXISTS `supermarket_details`;

CREATE TABLE `supermarket_details` (
  `SupermarketName` varchar(25) NOT NULL,
  `SupermarketID` varchar(25) NOT NULL,
  `AdminUsername` varchar(25) NOT NULL,
  `Website` varchar(30) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `TelephoneNo` varchar(10) DEFAULT NULL,
  `Slogan` tinytext,
  PRIMARY KEY (`SupermarketID`),
  KEY `AdminUsername` (`AdminUsername`),
  CONSTRAINT `supermarket_details_ibfk_1` FOREIGN KEY (`AdminUsername`) REFERENCES `admin` (`AdminUsername`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `supermarket_details` */

/*Table structure for table `supermarket_location` */

DROP TABLE IF EXISTS `supermarket_location`;

CREATE TABLE `supermarket_location` (
  `SupermarketID` varchar(25) NOT NULL,
  `Latitude` double NOT NULL,
  `Longitude` double NOT NULL,
  `LocationName` varchar(25) NOT NULL,
  KEY `SupermarketID` (`SupermarketID`),
  CONSTRAINT `supermarket_location_ibfk_1` FOREIGN KEY (`SupermarketID`) REFERENCES `supermarket_details` (`SupermarketID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `supermarket_location` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
