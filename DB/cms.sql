-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2018 at 08:18 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--
CREATE DATABASE IF NOT EXISTS `cms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cms`;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
`id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` varchar(300) DEFAULT 'null',
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `subject`, `body`, `user_id`, `image`) VALUES
(4, 'www', 'www', 2, 'clock2.jpg'),
(5, 'ww', 'ww', 2, 'logo.jpg'),
(6, 'wwwww', 'wwwww', 2, 'kitten.png'),
(7, 'ww', 'ww', 2, 'clock.jpg'),
(9, 'ww', 'ww', 2, 'kitten.png'),
(10, 'bb', 'bb', 10, 'logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `content_tag`
--

CREATE TABLE IF NOT EXISTS `content_tag` (
  `content_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
`id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','client') NOT NULL DEFAULT 'client',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `role`, `created_time`) VALUES
(1, 'qq', 'qq', 'client', '2018-11-09 10:49:32'),
(2, 'ww', 'ww', 'client', '2018-11-09 10:49:32'),
(3, 'aa', 'aa', 'client', '2018-11-09 10:49:32'),
(4, 'ff', 'ff', 'client', '2018-11-10 08:12:34'),
(5, 'gg', 'gg', 'client', '2018-11-10 08:13:58'),
(6, 'zz', 'zz', 'client', '2018-11-10 08:14:51'),
(7, 'vv', 'vv', 'client', '2018-11-10 08:18:08'),
(8, 'hh', 'hh', 'client', '2018-11-10 08:18:23'),
(9, 'll', 'll', 'client', '2018-11-10 08:18:43'),
(10, 'bb', 'bb', 'client', '2018-11-11 21:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_content`
--

CREATE TABLE IF NOT EXISTS `user_content` (
  `user_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_content`
--

INSERT INTO `user_content` (`user_id`, `content_id`) VALUES
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 9),
(10, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `content_tag`
--
ALTER TABLE `content_tag`
 ADD KEY `content_id` (`content_id`), ADD KEY `tag_id` (`tag_id`), ADD KEY `content_tag_ibfk_3` (`user_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_content`
--
ALTER TABLE `user_content`
 ADD KEY `user_id` (`user_id`), ADD KEY `content_id` (`content_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `content`
--
ALTER TABLE `content`
ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `content_tag`
--
ALTER TABLE `content_tag`
ADD CONSTRAINT `content_tag_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `content_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `content_tag_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_content`
--
ALTER TABLE `user_content`
ADD CONSTRAINT `user_content_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_content_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
