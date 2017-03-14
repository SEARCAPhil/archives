-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2017 at 08:24 AM
-- Server version: 5.6.21-log
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dms`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `account_profile`
--

CREATE TABLE IF NOT EXISTS `account_profile` (
`id` int(11) NOT NULL,
  `uid` int(255) DEFAULT NULL,
  `profile_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `profile_email` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `department_alias` varchar(50) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(150) NOT NULL,
  `code` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `is_private` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
`id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `document_title` varchar(255) DEFAULT NULL,
  `content_description` text,
  `publisher` varchar(255) DEFAULT NULL,
  `creator` varchar(255) DEFAULT NULL,
  `date_range` varchar(100) NOT NULL,
  `language` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `shelf_cabinet_number` varchar(255) DEFAULT NULL,
  `tier_number` varchar(255) DEFAULT NULL,
  `box_number` varchar(255) DEFAULT NULL,
  `folder_number` varchar(255) DEFAULT NULL,
  `record_number` varchar(255) DEFAULT NULL,
  `material` varchar(255) NOT NULL DEFAULT 'printable',
  `access_condition` varchar(255) DEFAULT NULL,
  `physical_condition` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `record_group` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `source_title` varchar(255) DEFAULT NULL,
  `collation` varchar(255) DEFAULT NULL,
  `datez` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` text,
  `keywords` varchar(255) DEFAULT NULL,
  `provenance` varchar(255) DEFAULT NULL,
  `encoded_by` varchar(255) DEFAULT NULL,
  `encoded_by_id` int(11) NOT NULL,
  `date_of_input` varchar(255) DEFAULT NULL,
  `remarks` text,
  `file_name` varchar(255) NOT NULL,
  `original_file_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12944 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_profile`
--
ALTER TABLE `account_profile`
 ADD PRIMARY KEY (`id`), ADD FULLTEXT KEY `profile_name` (`profile_name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
 ADD PRIMARY KEY (`id`), ADD KEY `cat_id` (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `account_profile`
--
ALTER TABLE `account_profile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12944;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
