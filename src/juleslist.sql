-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2013 at 12:36 AM
-- Server version: 5.5.28
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `juleslist`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE IF NOT EXISTS `buyer` (
  `id` int(11) NOT NULL,
  `contact_info_id` int(11) NOT NULL,
  `delivery_location_id` int(11) NOT NULL,
  `delivery_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`id`, `contact_info_id`, `delivery_location_id`, `delivery_type_id`) VALUES
(2, 2, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE IF NOT EXISTS `contact_info` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` text NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `parish` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `first_name`, `last_name`, `address`, `city`, `parish`, `phone`, `email`) VALUES
(2, 'John', 'Doe', 'John Doe Street', 'kgn', 'sa', '94354325', 'ritesh_r_reddy@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_location`
--

CREATE TABLE IF NOT EXISTS `delivery_location` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_location`
--

INSERT INTO `delivery_location` (`id`, `location`) VALUES
(1, 'pickup'),
(2, 'deliver');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_type`
--

CREATE TABLE IF NOT EXISTS `delivery_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_type`
--

INSERT INTO `delivery_type` (`id`, `type`) VALUES
(1, 'home'),
(2, 'office');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE IF NOT EXISTS `farmer` (
  `id` int(11) NOT NULL,
  `contact_info_id` int(11) NOT NULL,
  `rada_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `goods_rfq`
--

CREATE TABLE IF NOT EXISTS `goods_rfq` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `delivery_type_id` int(11) NOT NULL,
  `delivery_location_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `state` set('Open','Filled','Partially Filled','Withdrawn') NOT NULL DEFAULT 'Open',
  PRIMARY KEY (`id`),
  KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goods_rfq`
--

INSERT INTO `goods_rfq` (`id`, `start_date`, `end_date`, `delivery_type_id`, `delivery_location_id`, `buyer_id`, `state`) VALUES
(1, '2013-04-02', '2013-04-26', 1, 1, 2, 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `goods_rfq_item`
--

CREATE TABLE IF NOT EXISTS `goods_rfq_item` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `goods_rfq_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goods_rfq_item`
--

INSERT INTO `goods_rfq_item` (`id`, `item`, `qty`, `goods_rfq_id`) VALUES
(1, 'Tomato', 2, 1),
(2, 'Potato', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produce`
--

CREATE TABLE IF NOT EXISTS `produce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `famer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rfq_response`
--

CREATE TABLE IF NOT EXISTS `rfq_response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produce_id` int(11) NOT NULL,
  `rfq_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `type` set('RFQ','Sale','Other') NOT NULL,
  `rfq_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
