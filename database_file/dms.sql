-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 10:31 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=12945 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_category_exclusion`
--

CREATE TABLE IF NOT EXISTS `role_category_exclusion` (
`id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_category_inclusion`
--

CREATE TABLE IF NOT EXISTS `role_category_inclusion` (
`id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `read_privilege` int(11) NOT NULL DEFAULT '1',
  `write_privilege` int(11) NOT NULL,
  `update_privilege` int(11) NOT NULL,
  `delete_privilege` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3017 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_privilege`
--

CREATE TABLE IF NOT EXISTS `role_privilege` (
`id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `read_public_category_privilege` int(11) NOT NULL,
  `read_private_category_privilege` int(11) NOT NULL,
  `read_included_category_only_privilege` int(11) NOT NULL,
  `write_materials_privilege` int(11) NOT NULL,
  `grant_role_privilege` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_category_exclusion`
--
ALTER TABLE `role_category_exclusion`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_category_inclusion`
--
ALTER TABLE `role_category_inclusion`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_privilege`
--
ALTER TABLE `role_privilege`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `account_profile`
--
ALTER TABLE `account_profile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=198;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12945;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role_category_exclusion`
--
ALTER TABLE `role_category_exclusion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role_category_inclusion`
--
ALTER TABLE `role_category_inclusion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3017;
--
-- AUTO_INCREMENT for table `role_privilege`
--
ALTER TABLE `role_privilege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
