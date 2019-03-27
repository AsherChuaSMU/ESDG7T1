-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 20, 2019 at 10:45 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alanexpress_restaurant`

--
-- Table structure for table `resturant`
--

DROP DATABASE IF EXISTS alanexpress_restaurant;
DROP DATABASE IF EXISTS alanexpress_user;
DROP DATABASE IF EXISTS alanexpress_driver;
DROP DATABASE IF EXISTS alanexpress_order;

CREATE DATABASE IF NOT EXISTS alanexpress_restaurant;

USE alanexpress_restaurant;
DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `restaurant_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `address` varchar(150) NOT NULL,
  `postal_code` int(6) DEFAULT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`restaurant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `name`, `address`, `postal_code`, `description`) VALUES
(1, 'Restaurant 1', 'SMU Labs', 641653, 'Description for Restaurant 1'),
(2, 'Restaurant 2', 'Jurong West Street 61', 641652, 'Description for Restaurant 2'),
(3, 'Restaurant 3', 'Dover Block 3', 665670, 'Description for Restaurant 3');


-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `food_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  PRIMARY KEY (`food_id`),
  FOREIGN KEY (`restaurant_id`) REFERENCES restaurant(`restaurant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `name`, `price`, `restaurant_id`) VALUES
(1, 'Curry Rice', '10.50', 1),
(2, 'Chicken Rice', '5.50', 2),
(3, 'Bee Hoon', '7.00', 3),
(4, 'Sushi', '6.00', 3);
COMMIT;


CREATE DATABASE IF NOT EXISTS alanexpress_user;

USE alanexpress_user;
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `usertype` varchar(256) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `longitude` varchar(256),
  `latitude` varchar(256),
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `users` (`username`, `password`, `usertype` , `gender`) VALUES
('hello', 'hello123', 'customer', 'male'),
('hey', 'hey123', 'owner', 'male'),
('bye', 'bye123', 'driver', 'female'),
('admin', 'admin123', 'admin', 'male');
COMMIT;

CREATE DATABASE IF NOT EXISTS alanexpress_driver;

USE alanexpress_driver;
DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `driver_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `longitude` varchar(256),
  `latitude` varchar(256),
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `username`, `password`, `gender`) VALUES
('1', 'driver', 'driver123', 'male'),
('2', 'uncle', 'uncle123', 'female'),
('3', 'auntie', 'auntie123', 'male');
COMMIT;

CREATE DATABASE IF NOT EXISTS alanexpress_order;

USE alanexpress_order;
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(32) NOT NULL,
  `food_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `driver_id` int(11),
  `quantity` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`,`food_id`,`restaurant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `food_id`, `restaurant_id`, `driver_id`, `status`, `quantity`, `timestamp`) VALUES
(1, 'hello', 1, 1, 1, 2, 1, '2018-11-14 14:42:31');

COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
--

-- --------------------------------------------------------


