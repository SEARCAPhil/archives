-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2017 at 06:05 AM
-- Server version: 5.6.21-log
-- PHP Version: 7.1.2

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `login_db_instance_1`
--
CREATE DATABASE IF NOT EXISTS `login_db_instance_1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `login_db_instance_1`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `account_username` varchar(255) NOT NULL,
  `account_password` varchar(255) NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `account_profile`
--

DROP TABLE IF EXISTS `account_profile`;
CREATE TABLE IF NOT EXISTS `account_profile` (
`id` int(11) NOT NULL,
  `uid` int(255) DEFAULT NULL,
  `profile_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `profile_age` int(3) DEFAULT NULL,
  `profile_address` varchar(255) DEFAULT NULL,
  `fax` varchar(255) NOT NULL,
  `resident_tel` varchar(255) NOT NULL,
  `office_tel` varchar(255) NOT NULL,
  `profile_contact_number` varchar(255) DEFAULT NULL,
  `profile_email` varchar(255) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
`dept_id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `dept_alias` varchar(100) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

DROP TABLE IF EXISTS `designation`;
CREATE TABLE IF NOT EXISTS `designation` (
`id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `appointment` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `date_ended` date NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doc_sys_privilege`
--

DROP TABLE IF EXISTS `doc_sys_privilege`;
CREATE TABLE IF NOT EXISTS `doc_sys_privilege` (
  `uid` int(11) NOT NULL,
  `priv` enum('admin','user','super_user','human_resource','archives') NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `office`
--
DROP VIEW IF EXISTS `office`;
CREATE TABLE IF NOT EXISTS `office` (
`office_id` int(11)
,`office_name` varchar(255)
,`alias` varchar(100)
,`active` int(11)
,`unit_id` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `office_tb`
--

DROP TABLE IF EXISTS `office_tb`;
CREATE TABLE IF NOT EXISTS `office_tb` (
`office_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `off_id` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
CREATE TABLE IF NOT EXISTS `position` (
  `position` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `unit`
--
DROP VIEW IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
`dept_name` varchar(255)
,`allias` varchar(100)
,`active` int(11)
,`off_id` int(11)
,`unit_id` int(11)
);
-- --------------------------------------------------------

--
-- Structure for view `office`
--
DROP TABLE IF EXISTS `office`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `office` AS select `office_tb`.`office_id` AS `office_id`,`department`.`dept_name` AS `office_name`,`department`.`dept_alias` AS `alias`,`office_tb`.`active` AS `active`,`office_tb`.`off_id` AS `unit_id` from (`department` left join `office_tb` on((`department`.`dept_id` = `office_tb`.`dept_id`))) where (`office_tb`.`active` = 1);

-- --------------------------------------------------------

--
-- Structure for view `unit`
--
DROP TABLE IF EXISTS `unit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `unit` AS select `department`.`dept_name` AS `dept_name`,`department`.`dept_alias` AS `allias`,`office_tb`.`active` AS `active`,`office_tb`.`off_id` AS `off_id`,`office_tb`.`office_id` AS `unit_id` from (`department` left join `office_tb` on((`department`.`dept_id` = `office_tb`.`dept_id`))) where (`office_tb`.`active` = 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`), ADD KEY `username` (`account_username`);

--
-- Indexes for table `account_profile`
--
ALTER TABLE `account_profile`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uid_2` (`uid`), ADD KEY `uid` (`uid`), ADD KEY `dept_id` (`dept_id`), ADD FULLTEXT KEY `profile_name` (`profile_name`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`dept_id`), ADD KEY `dept_name` (`dept_name`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
 ADD PRIMARY KEY (`id`), ADD KEY `uid` (`uid`);

--
-- Indexes for table `doc_sys_privilege`
--
ALTER TABLE `doc_sys_privilege`
 ADD PRIMARY KEY (`id`), ADD KEY `uid` (`uid`);

--
-- Indexes for table `office_tb`
--
ALTER TABLE `office_tb`
 ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT for table `account_profile`
--
ALTER TABLE `account_profile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `doc_sys_privilege`
--
ALTER TABLE `doc_sys_privilege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `office_tb`
--
ALTER TABLE `office_tb`
MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_profile`
--
ALTER TABLE `account_profile`
ADD CONSTRAINT `account_profile_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `account_profile_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `doc_sys_privilege`
--
ALTER TABLE `doc_sys_privilege`
ADD CONSTRAINT `doc_sys_privilege_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
