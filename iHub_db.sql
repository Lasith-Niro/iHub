-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2015 at 11:11 ප.ව.
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iHub_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `GroupDetails`
--

CREATE TABLE IF NOT EXISTS `GroupDetails` (
  `gID` int(11) NOT NULL AUTO_INCREMENT,
  `grpName` varchar(50) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `ModeratorID` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`gID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `GroupDetails`
--

INSERT INTO `GroupDetails` (`gID`, `grpName`, `AdminID`, `ModeratorID`, `date`, `time`) VALUES
(1, 'NEW', 1, 3, '2015-09-05', '08:56:14'),
(2, 'lasithGroup', 3, 3, '2015-09-05', '08:56:47'),
(3, 'NEW', 3, 3, '2015-09-05', '08:58:16'),
(4, 'xxx', 1, 1, '2015-09-05', '09:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE IF NOT EXISTS `group_users` (
  `gID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_users`
--

INSERT INTO `group_users` (`gID`, `userID`) VALUES
(3, 1),
(0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE IF NOT EXISTS `levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`, `permissions`) VALUES
(1, 'Standard user', ''),
(2, 'Moderators', '{"mod": 1}'),
(3, 'Administrator', '{"admin": 2}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `levels` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `phone`, `levels`) VALUES
(1, 'Lasith', '3d1b33ad0aee33adbf451ca2104a2c3b63757943c6d85b45ceb0c00662c7cf0f', 'lasith123', 'niroshan', 'lasith2013.l2n@gmail.org', '0712837662', 3),
(2, 'Sunimal', '3d1b33ad0aee33adbf451ca2104a2c3b63757943c6d85b45ceb0c00662c7cf0f', 'sunimal', 'malkakulage', 'sskmal@gmail.com', '0712837555', 1),
(3, 'NewTest', 'f2d30afea3131fcffa86fc0c76cbc5f1f0e5940c587af3a37a4df46c7a89c72a', 'new', 'user', 'lasith2013.l2n@gmail.com', '0712837662', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users_session`
--

INSERT INTO `users_session` (`id`, `user_id`, `hash`) VALUES
(1, 1, 'ec0c6e3ec02ef4ecb0e53af7dc72782bf8bb1cf6a8f2c6f3379e951e994953d8');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
