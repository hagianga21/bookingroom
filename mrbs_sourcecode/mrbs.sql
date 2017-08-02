-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2017 at 02:02 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `mrbs_area`
--

CREATE TABLE `mrbs_area` (
  `id` int(11) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `area_name` varchar(30) DEFAULT NULL,
  `sort_key` varchar(30) NOT NULL DEFAULT '',
  `timezone` varchar(50) DEFAULT NULL,
  `area_admin_email` text,
  `resolution` int(11) DEFAULT NULL,
  `default_duration` int(11) DEFAULT NULL,
  `default_duration_all_day` tinyint(1) NOT NULL DEFAULT '0',
  `morningstarts` int(11) DEFAULT NULL,
  `morningstarts_minutes` int(11) DEFAULT NULL,
  `eveningends` int(11) DEFAULT NULL,
  `eveningends_minutes` int(11) DEFAULT NULL,
  `private_enabled` tinyint(1) DEFAULT NULL,
  `private_default` tinyint(1) DEFAULT NULL,
  `private_mandatory` tinyint(1) DEFAULT NULL,
  `private_override` varchar(32) DEFAULT NULL,
  `min_create_ahead_enabled` tinyint(1) DEFAULT NULL,
  `min_create_ahead_secs` int(11) DEFAULT NULL,
  `max_create_ahead_enabled` tinyint(1) DEFAULT NULL,
  `max_create_ahead_secs` int(11) DEFAULT NULL,
  `min_delete_ahead_enabled` tinyint(1) DEFAULT NULL,
  `min_delete_ahead_secs` int(11) DEFAULT NULL,
  `max_delete_ahead_enabled` tinyint(1) DEFAULT NULL,
  `max_delete_ahead_secs` int(11) DEFAULT NULL,
  `max_per_day_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `max_per_day` int(11) NOT NULL DEFAULT '0',
  `max_per_week_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `max_per_week` int(11) NOT NULL DEFAULT '0',
  `max_per_month_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `max_per_month` int(11) NOT NULL DEFAULT '0',
  `max_per_year_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `max_per_year` int(11) NOT NULL DEFAULT '0',
  `max_per_future_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `max_per_future` int(11) NOT NULL DEFAULT '0',
  `max_duration_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `max_duration_secs` int(11) NOT NULL DEFAULT '0',
  `max_duration_periods` int(11) NOT NULL DEFAULT '0',
  `custom_html` text,
  `approval_enabled` tinyint(1) DEFAULT NULL,
  `reminders_enabled` tinyint(1) DEFAULT NULL,
  `enable_periods` tinyint(1) DEFAULT NULL,
  `confirmation_enabled` tinyint(1) DEFAULT NULL,
  `confirmed_default` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mrbs_area`
--

INSERT INTO `mrbs_area` (`id`, `disabled`, `area_name`, `sort_key`, `timezone`, `area_admin_email`, `resolution`, `default_duration`, `default_duration_all_day`, `morningstarts`, `morningstarts_minutes`, `eveningends`, `eveningends_minutes`, `private_enabled`, `private_default`, `private_mandatory`, `private_override`, `min_create_ahead_enabled`, `min_create_ahead_secs`, `max_create_ahead_enabled`, `max_create_ahead_secs`, `min_delete_ahead_enabled`, `min_delete_ahead_secs`, `max_delete_ahead_enabled`, `max_delete_ahead_secs`, `max_per_day_enabled`, `max_per_day`, `max_per_week_enabled`, `max_per_week`, `max_per_month_enabled`, `max_per_month`, `max_per_year_enabled`, `max_per_year`, `max_per_future_enabled`, `max_per_future`, `max_duration_enabled`, `max_duration_secs`, `max_duration_periods`, `custom_html`, `approval_enabled`, `reminders_enabled`, `enable_periods`, `confirmation_enabled`, `confirmed_default`) VALUES
(1, 0, 'DEK', 'DEK', 'Asia/Ho_Chi_Minh', NULL, 1800, 3600, 0, 7, 0, 18, 30, 0, 0, 0, 'none', 0, 0, 0, 604800, 0, 0, 0, 604800, 0, 1, 0, 5, 0, 10, 0, 50, 0, 100, 0, 7200, 2, NULL, 0, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrbs_entry`
--

CREATE TABLE `mrbs_entry` (
  `id` int(11) NOT NULL,
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL DEFAULT '0',
  `entry_type` int(11) NOT NULL DEFAULT '0',
  `repeat_id` int(11) DEFAULT NULL,
  `room_id` int(11) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_by` varchar(80) NOT NULL DEFAULT '',
  `modified_by` varchar(80) NOT NULL DEFAULT '',
  `name` varchar(80) NOT NULL DEFAULT '',
  `type` char(1) NOT NULL DEFAULT 'E',
  `description` text,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `reminded` int(11) DEFAULT NULL,
  `info_time` int(11) DEFAULT NULL,
  `info_user` varchar(80) DEFAULT NULL,
  `info_text` text,
  `ical_uid` varchar(255) NOT NULL DEFAULT '',
  `ical_sequence` smallint(6) NOT NULL DEFAULT '0',
  `ical_recur_id` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mrbs_entry`
--

INSERT INTO `mrbs_entry` (`id`, `start_time`, `end_time`, `entry_type`, `repeat_id`, `room_id`, `timestamp`, `create_by`, `modified_by`, `name`, `type`, `description`, `status`, `reminded`, `info_time`, `info_user`, `info_text`, `ical_uid`, `ical_sequence`, `ical_recur_id`) VALUES
(1, 1496712600, 1496716200, 0, NULL, 2, '2017-06-06 09:27:39', 'tranxuancuong', '', 'test', 'I', 'test', 0, NULL, NULL, NULL, NULL, 'MRBS-5936758b012fa-fa083808@localhost', 0, NULL),
(2, 1496745000, 1496748600, 0, NULL, 2, '2017-06-06 09:29:09', 'tranxuancuong', '', 'test2', 'I', 'test2', 0, NULL, NULL, NULL, NULL, 'MRBS-593675e5c4bfd-9a39edd9@localhost', 0, NULL),
(3, 1496739600, 1496745000, 0, NULL, 2, '2017-06-06 09:29:54', 'tranxuancuong', '', 'tet3', 'I', 'test3', 0, NULL, NULL, NULL, NULL, 'MRBS-593676129485a-71b1be35@localhost', 0, NULL),
(4, 1496739600, 1496743200, 0, NULL, 3, '2017-06-06 09:30:59', 'tranxuancuong', '', 'test4', 'I', 'test4', 0, NULL, NULL, NULL, NULL, 'MRBS-593676538bfac-e65686e7@localhost', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mrbs_repeat`
--

CREATE TABLE `mrbs_repeat` (
  `id` int(11) NOT NULL,
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL DEFAULT '0',
  `rep_type` int(11) NOT NULL DEFAULT '0',
  `end_date` int(11) NOT NULL DEFAULT '0',
  `rep_opt` varchar(32) NOT NULL DEFAULT '',
  `room_id` int(11) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_by` varchar(80) NOT NULL DEFAULT '',
  `modified_by` varchar(80) NOT NULL DEFAULT '',
  `name` varchar(80) NOT NULL DEFAULT '',
  `type` char(1) NOT NULL DEFAULT 'E',
  `description` text,
  `rep_num_weeks` smallint(6) DEFAULT NULL,
  `month_absolute` smallint(6) DEFAULT NULL,
  `month_relative` varchar(4) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `reminded` int(11) DEFAULT NULL,
  `info_time` int(11) DEFAULT NULL,
  `info_user` varchar(80) DEFAULT NULL,
  `info_text` text,
  `ical_uid` varchar(255) NOT NULL DEFAULT '',
  `ical_sequence` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mrbs_room`
--

CREATE TABLE `mrbs_room` (
  `id` int(11) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `area_id` int(11) NOT NULL DEFAULT '0',
  `room_name` varchar(25) NOT NULL DEFAULT '',
  `sort_key` varchar(25) NOT NULL DEFAULT '',
  `description` varchar(60) DEFAULT NULL,
  `capacity` int(11) NOT NULL DEFAULT '0',
  `room_admin_email` text,
  `custom_html` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mrbs_room`
--

INSERT INTO `mrbs_room` (`id`, `disabled`, `area_id`, `room_name`, `sort_key`, `description`, `capacity`, `room_admin_email`, `custom_html`) VALUES
(2, 0, 1, '1L-Earth', '1L-Earth', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(3, 0, 1, '1S-Moon', '1S-Moon', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(4, 0, 1, '1S-Sun', '1S-Sun', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(5, 0, 1, '2L-Venus', '2L-Venus', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(6, 0, 1, '2S-Jupiter', '2S-Jupiter', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(7, 0, 1, '2S-Saturn', '2S-Saturn', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(8, 0, 1, '3L-Mercury', '3L-Mercury', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(9, 0, 1, '3S-Mars', '3S-Mars', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(10, 0, 1, '4S-Ferrari', '4S-Ferrari', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(11, 0, 1, '4S-Mercedes', '4S-Mercedes', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(12, 0, 1, '4S-Redbull', '4S-Redbull', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(13, 0, 1, '4S-Williams', '4S-Williams', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(14, 0, 1, '7L-Neptune', '7L-Neptune', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(15, 0, 1, 'Projector 1', 'Projector 1', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(16, 0, 1, 'Projector 2', 'Projector 2', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(17, 0, 1, 'Projector 3', 'Projector 3', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(18, 0, 1, 'Projector 4', 'Projector 4', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(19, 0, 1, 'Projector 5', 'Projector 5', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(20, 0, 1, 'Projector 6', 'Projector 6', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(21, 0, 1, 'VC1', 'VC1', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(22, 0, 1, 'VC2', 'VC2', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', ''),
(23, 0, 1, 'VC3', 'VC3', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(24, 0, 1, 'VC4', 'VC4', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL),
(25, 0, 1, 'VC5', 'VC5', '', 0, 'tranxuancuong.a2vd.2015@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mrbs_users`
--

CREATE TABLE `mrbs_users` (
  `id` int(11) NOT NULL,
  `level` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mrbs_users`
--

INSERT INTO `mrbs_users` (`id`, `level`, `name`, `password_hash`, `email`) VALUES
(1, 2, 'admin', '$2y$10$TrmLz5bbGPJ.qxgokVkANOHRRL7KGtVkWwPOzRq/w8scw4tDpZTkC', 'tranxuancuong.a2vd.2015@gmail.com'),
(2, 1, 'tranxuancuong', '$2y$10$j7j6Ivp91Vt.F.8yI0zYaeCrtZS3UpD9xPZOIIiiBiwQeQyblSJEG', 'tranxuancuong96@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mrbs_variables`
--

CREATE TABLE `mrbs_variables` (
  `id` int(11) NOT NULL,
  `variable_name` varchar(80) DEFAULT NULL,
  `variable_content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mrbs_variables`
--

INSERT INTO `mrbs_variables` (`id`, `variable_name`, `variable_content`) VALUES
(1, 'db_version', '49'),
(2, 'local_db_version', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mrbs_zoneinfo`
--

CREATE TABLE `mrbs_zoneinfo` (
  `id` int(11) NOT NULL,
  `timezone` varchar(255) NOT NULL DEFAULT '',
  `outlook_compatible` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `vtimezone` text,
  `last_updated` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mrbs_zoneinfo`
--

INSERT INTO `mrbs_zoneinfo` (`id`, `timezone`, `outlook_compatible`, `vtimezone`, `last_updated`) VALUES
(1, 'Asia/Ho_Chi_Minh', 1, 'BEGIN:VTIMEZONE\r\nTZID:Asia/Ho_Chi_Minh\r\nTZURL:http://tzurl.org/zoneinfo-outlook/Asia/Ho_Chi_Minh\r\nX-LIC-LOCATION:Asia/Ho_Chi_Minh\r\nBEGIN:STANDARD\r\nTZOFFSETFROM:+0700\r\nTZOFFSETTO:+0700\r\nTZNAME:ICT\r\nDTSTART:19700101T000000\r\nEND:STANDARD\r\nEND:VTIMEZONE', 1496734414);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mrbs_area`
--
ALTER TABLE `mrbs_area`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_area_name` (`area_name`);

--
-- Indexes for table `mrbs_entry`
--
ALTER TABLE `mrbs_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `repeat_id` (`repeat_id`),
  ADD KEY `idxStartTime` (`start_time`),
  ADD KEY `idxEndTime` (`end_time`);

--
-- Indexes for table `mrbs_repeat`
--
ALTER TABLE `mrbs_repeat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `mrbs_room`
--
ALTER TABLE `mrbs_room`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_room_name` (`area_id`,`room_name`),
  ADD KEY `idxSortKey` (`sort_key`);

--
-- Indexes for table `mrbs_users`
--
ALTER TABLE `mrbs_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_name` (`name`);

--
-- Indexes for table `mrbs_variables`
--
ALTER TABLE `mrbs_variables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_variable_name` (`variable_name`);

--
-- Indexes for table `mrbs_zoneinfo`
--
ALTER TABLE `mrbs_zoneinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_timezone` (`timezone`,`outlook_compatible`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mrbs_area`
--
ALTER TABLE `mrbs_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mrbs_entry`
--
ALTER TABLE `mrbs_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mrbs_repeat`
--
ALTER TABLE `mrbs_repeat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mrbs_room`
--
ALTER TABLE `mrbs_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `mrbs_users`
--
ALTER TABLE `mrbs_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mrbs_variables`
--
ALTER TABLE `mrbs_variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mrbs_zoneinfo`
--
ALTER TABLE `mrbs_zoneinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mrbs_entry`
--
ALTER TABLE `mrbs_entry`
  ADD CONSTRAINT `mrbs_entry_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `mrbs_room` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mrbs_entry_ibfk_2` FOREIGN KEY (`repeat_id`) REFERENCES `mrbs_repeat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mrbs_repeat`
--
ALTER TABLE `mrbs_repeat`
  ADD CONSTRAINT `mrbs_repeat_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `mrbs_room` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `mrbs_room`
--
ALTER TABLE `mrbs_room`
  ADD CONSTRAINT `mrbs_room_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `mrbs_area` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
