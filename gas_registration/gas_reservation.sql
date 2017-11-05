-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 05, 2017 at 11:19 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gas_reservation`
--
CREATE DATABASE IF NOT EXISTS `gas_reservation` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gas_reservation`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(200) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `date_of_request` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Triggers `bookings`
--
DROP TRIGGER IF EXISTS `log_add_gas`;
DELIMITER $$
CREATE TRIGGER `log_add_gas` AFTER INSERT ON `bookings` FOR EACH ROW BEGIN
    INSERT INTO logs
    SET action_performed  = 'Booked Gas',
    first_name      =  new.first_name,
    last_name		  =  new.last_name,
    address 		= new.address;


END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `log_change_location`;
DELIMITER $$
CREATE TRIGGER `log_change_location` BEFORE UPDATE ON `bookings` FOR EACH ROW BEGIN
    INSERT INTO logs
    SET action_performed  = 'Changed Address',
    first_name      =  new.first_name,
    last_name		  =  new.last_name,
    address 		= new.address;


END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `log_delete_gas`;
DELIMITER $$
CREATE TRIGGER `log_delete_gas` BEFORE DELETE ON `bookings` FOR EACH ROW BEGIN
    INSERT INTO logs
    SET action_performed  = 'Deleted Order To Book Gas',
    first_name      =  old.first_name,
    last_name		  =  old.last_name,
    address 		= old.address;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gas_booked` varchar(11) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `address`, `gas_booked`) VALUES
(1, 'nikhil', 'shinde', 'nikhilshinde@gmail.com', '13,B Hiranandani Estate Powai Mumbai', 'No'),
(2, 'abc', 'def', 'abc@gmail.com', 'EXcel Towers Bangalore', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `action_performed` varchar(100) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `first_name`, `last_name`, `address`, `action_performed`, `time`) VALUES
(1, 'abc', 'def', '12 B Xcel Towers Pune', 'Booked Gas', '2017-11-05 10:11:47'),
(2, 'abc', 'def', 'EXcel Towers Bangalore', 'Changed Address', '2017-11-05 10:14:16'),
(3, 'abc', 'def', 'EXcel Towers Bangalore', 'Deleted Order To Book Gas', '2017-11-05 10:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `time`) VALUES
(1, 'nikhil', 'shinde', '2017-11-04 07:56:43'),
(2, 'abc', 'abc', '2017-11-04 11:57:52');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`);
