-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2016 at 07:30 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `techgrid`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE IF NOT EXISTS `biodata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nik` int(10) unsigned NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone` bigint(20) unsigned NOT NULL,
  `gender` tinyint(1) unsigned NOT NULL,
  `marital` tinyint(1) unsigned NOT NULL,
  `wife_husband` varchar(50) NOT NULL,
  `child` int(10) unsigned NOT NULL,
  `photo` varchar(100) NOT NULL,
  `religion` tinyint(1) unsigned NOT NULL,
  `salary` float NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `author` int(10) unsigned NOT NULL,
  `updater` int(10) unsigned NOT NULL,
  `birth_date` date NOT NULL,
  `birth_place` int(10) unsigned NOT NULL,
  `blood_type` tinyint(1) unsigned NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id`, `nik`, `fullname`, `address`, `phone`, `gender`, `marital`, `wife_husband`, `child`, `photo`, `religion`, `salary`, `status`, `created`, `updated`, `author`, `updater`, `birth_date`, `birth_place`, `blood_type`, `email`) VALUES
(2, 123412, 'ftrythfhgf', '<p>ghjhghjg</p>', 867674675675, 1, 1, '-', 0, '1452661152_lucu2.jpg', 2, 84653500, 1, '2016-01-13 05:59:12', '2016-01-13 05:59:12', 1, 1, '2016-01-13', 0, 4, 'bjhgjhh@gfgh.ghj'),
(3, 129748312, 'djfkldhjgdsh', '<p>fdsfd</p>', 734467324, 1, 1, '-', 0, '1452661442_lucu2.jpg', 2, 1000000, 1, '2016-01-13 06:00:53', '2016-01-13 06:04:02', 1, 1, '2016-01-13', 0, 1, 'asdfhjska@hf.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(150) NOT NULL,
  `retype_password` varchar(150) NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `create` datetime NOT NULL,
  `update` datetime NOT NULL,
  `author` int(10) unsigned NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `retype_password`, `level`, `status`, `create`, `update`, `author`, `last_login`) VALUES
(1, 'alfin', '73431d27bec7eebe91f5a89b0b89a5f2', '73431d27bec7eebe91f5a89b0b89a5f2', 1, 1, '2015-10-26 09:11:19', '2015-11-10 07:37:34', 1, '2015-10-26 09:11:19'),
(2, 'demo', '5ee74266d8b7516b0e47ffc5260ad1eb', '5ee74266d8b7516b0e47ffc5260ad1eb', 1, 1, '2016-01-13 07:15:08', '2016-01-13 07:15:08', 1, '2016-01-13 07:15:08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
