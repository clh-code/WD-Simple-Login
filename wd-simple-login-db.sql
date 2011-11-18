-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2011 at 06:57 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wd_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` VALUES(1, 0x5768617420697320796f7572206d6f746865722773206d616964656e206e616d653f);
INSERT INTO `questions` VALUES(2, 0x5768617420697320746865206e616d65206f6620796f7572206661766f7269746520746561636865723f);
INSERT INTO `questions` VALUES(3, 0x5768617420697320796f7572206661746865722773206d6964646c65206e616d653f);
INSERT INTO `questions` VALUES(4, 0x5768617420697320746865206e616d65206f6620796f7572206669727374207065743f);
INSERT INTO `questions` VALUES(5, 0x5768617420697320746865206e616d65206f6620796f7572206661766f72697465206163746f723f);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(35) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(35) COLLATE utf8_bin NOT NULL,
  `username` varchar(55) COLLATE utf8_bin NOT NULL,
  `password` blob NOT NULL,
  `q_id` int(7) NOT NULL,
  `q_answer` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'Joe', 'Lava', 'joelava', 0x3a2619c160ed5978a4d935d18c0f9435, 1, 0x536d697468);
