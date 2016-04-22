-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2016 at 05:48 AM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sfs`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Testings'),
(2, 'Testings 2');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `name`, `cat_id`, `is_locked`) VALUES
(1, 'Test Forum', 1, 0),
(2, 'Forum 2', 1, 0),
(3, 'Forum Number 3', 2, 0),
(4, 'Forum 4', 2, 0),
(5, 'Forum 5', 1, 0),
(6, 'Forum 6', 2, 0),
(7, 'Forum 7', 2, 0),
(8, 'Forum 8', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`,`reciever_id`),
  KEY `reciever_id` (`reciever_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_date` timestamp NULL DEFAULT NULL,
  `replier_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `replier_id` (`replier_id`,`thread_id`),
  KEY `thread_id` (`thread_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `body`, `creation_date`, `last_update_date`, `replier_id`, `thread_id`) VALUES
(4, 'First', '2016-04-20 07:45:11', NULL, 7, 10),
(5, 'hello', '2016-04-20 07:45:26', NULL, 7, 10),
(6, 'sad', '2016-04-20 07:45:57', NULL, 7, 10),
(7, 'dasd', '2016-04-20 07:46:32', NULL, 7, 10),
(8, 'HEllo', '2016-04-20 07:47:43', NULL, 7, 10),
(9, 'dasd', '2016-04-20 07:48:05', NULL, 7, 10),
(10, 'dasd', '2016-04-20 07:48:29', NULL, 7, 10),
(11, 'asd', '2016-04-20 07:48:54', NULL, 7, 10),
(36, 'Hello Edit Ahahaha', '2016-04-21 06:21:48', '2016-04-21 06:21:54', 7, 11),
(37, 'Ahaaaaaa', '2016-04-21 19:19:39', NULL, 1, 11),
(38, 'Ahahah', '2016-04-21 19:20:47', NULL, 7, 11);

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_date` timestamp NULL DEFAULT NULL,
  `forum_id` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `is_sticky` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`thread_id`),
  KEY `forum_id` (`forum_id`,`creator`),
  KEY `creator` (`creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`thread_id`, `title`, `body`, `creation_date`, `last_update_date`, `forum_id`, `creator`, `is_locked`, `is_sticky`) VALUES
(9, 'Hello THis is the post of year', 'hell yeah ', '2016-04-19 06:21:05', NULL, 1, 1, 0, 0),
(10, 'Hello Again', 'Hello world post for testing purposes :)', '2016-04-19 06:41:50', NULL, 2, 1, 0, 0),
(11, 'Hello Zend', 'Hello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello ZendHello Zendvv', '2016-04-19 18:13:25', '2016-04-20 06:08:54', 1, 7, 0, 0),
(12, 'hi', 'hello hello', '2016-04-22 02:10:53', NULL, 5, 9, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(64) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `country` varchar(20) NOT NULL,
  `signature` text,
  `picture` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `email`, `password`, `gender`, `country`, `signature`, `picture`, `is_admin`, `is_active`) VALUES
(1, 'admin', 'admin@mail.com', '4297f44b13955235245b2497399d7a93', 0, 'Egypt', 'Ahahahahahahah Hello :D', '/pic', 1, 1),
(7, 'root', 'root@mail.com', '4297f44b13955235245b2497399d7a93', 0, 'Egypt', NULL, 'root_Warm_grasses_by_dcsearle.t21.jpg', 0, 1),
(8, 'hazem', 'hazem@mail.com', '4297f44b13955235245b2497399d7a93', 0, 'Egypt', NULL, 'hazem_salcantayperu_by_Life_Nomadic.jpg', 0, 1),
(9, 'hussien', 'hussien@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Egypt', NULL, 'hussien_11875953_678664875567873_287322319_o.jpg', 1, 1),
(10, 'gollasha', 'gollasha@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Egypt', NULL, 'gollasha_11875953_678664875567873_287322319_o.jpg', 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`reciever_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`replier_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`thread_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thread_ibfk_2` FOREIGN KEY (`creator`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
