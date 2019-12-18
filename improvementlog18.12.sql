-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 18, 2019 at 06:17 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `improvementlog`
--

-- --------------------------------------------------------

--
-- Table structure for table `actioncomments`
--

CREATE TABLE `actioncomments` (
  `commentId` int(11) NOT NULL,
  `comment` text NOT NULL,
  `createdBy` varchar(256) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actionItemId` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actioncomments`
--

INSERT INTO `actioncomments` (`commentId`, `comment`, `createdBy`, `dateCreated`, `actionItemId`, `deleted`) VALUES
(1, 'comments123', 'bheban', '2019-12-02 16:08:07', 31, 0),
(2, 'ddd', 'shuuma', '2019-12-11 11:59:39', 31, 0),
(3, 'OD with refresher is like hiroshima and nagasaki all over again', 'shuuma', '2019-12-11 13:14:03', 33, 0),
(4, 'This is a comment.', 'tepers', '2019-12-12 08:55:46', 35, 1),
(5, 'ILENH1TS1', 'shuuma', '2019-12-13 12:42:48', 36, 0),
(6, 'edited', 'shuuma', '2019-12-17 09:40:14', 42, 1),
(7, 'sdfghj', 'tepers', '2019-12-17 11:46:28', 42, 0);

-- --------------------------------------------------------

--
-- Table structure for table `actionitem`
--

CREATE TABLE `actionitem` (
  `actionItemId` int(11) NOT NULL,
  `painPoint` varchar(256) NOT NULL,
  `estimatedMandDays` float NOT NULL,
  `solution` text NOT NULL,
  `resp` varchar(256) NOT NULL,
  `owner` varchar(256) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `backup` varchar(100) NOT NULL,
  `tentativeCompletionDate` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `project` text,
  `acreatedBy` varchar(50) DEFAULT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModified` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `reminderMail` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actionitem`
--

INSERT INTO `actionitem` (`actionItemId`, `painPoint`, `estimatedMandDays`, `solution`, `resp`, `owner`, `email`, `backup`, `tentativeCompletionDate`, `status`, `project`, `acreatedBy`, `dateCreated`, `dateModified`, `deleted`, `reminderMail`) VALUES
(30, 're', 2, '3434', '', 'Dowtal Bhoomeshwur', 'bhoomeshwur.dowtal@mcb.mu', '', NULL, 'WIP', NULL, 'bhodow', '2019-08-14 10:47:38', '2019-08-14 10:47:38', 0, 0),
(31, 'Pain point 1', 2, 'work on pain point 1', 'it apps', 'Bansropun Bhesham', 'bhesham.bansropun@mcb.mu', '', '2019-12-03 16:07:57', 'WIP', NULL, 'bheban', '2019-12-02 16:08:06', '2019-12-12 09:00:08', 0, 1),
(32, 'newpaintpoint', 4, 'actiontest', 'lul', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'joe', '2019-12-05 12:25:11', 'NYS', NULL, 'shuuma', '2019-12-11 12:25:15', '2019-12-11 12:25:15', 1, 0),
(33, 'Dota2', 4, 'Nerf OD Volvo', 'IceFraud', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'benga', '2019-12-04 16:07:57', 'NYS', '', 'shuuma', '2019-12-11 13:14:02', '2019-12-16 14:09:33', 0, 1),
(34, 'wabalabadubdub', 0.25, 'y', 'ss', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', '', NULL, 'WIP', NULL, 'shuuma', '2019-12-11 13:26:36', '2019-12-11 13:26:36', 0, 0),
(35, 'soupz', 50, 'Action', 'ITS', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'Teeshan', '2019-12-26 08:54:46', 'WIP', '|Project/CR/Task Name|', 'tepers', '2019-12-12 08:55:06', '2019-12-16 15:26:48', 0, 0),
(36, 'ILENH1TS1', 0.25, 'ILENH1TS1', 'ILENH1TS1', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'za', '2019-12-20 12:42:33', 'NYS', NULL, 'shuuma', '2019-12-13 12:42:48', '2019-12-17 09:00:02', 0, 1),
(38, 'Action Fresh', 1.25, 'fresh', '', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'fresh', NULL, 'CPL', '|Project/CR/Task Name|', 'faraju', '2019-12-16 11:47:02', '2019-12-16 13:48:05', 0, 0),
(39, 'v', 0.25, 'c', '', 'Persand Teeshan', 'teeshan.persand@mcb.mu', '', NULL, 'CPL', NULL, 'faraju', '2019-12-16 13:48:40', '2019-12-16 13:50:27', 0, 0),
(40, 'create', 0.25, 'create', '', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', '', '2019-12-16 13:57:27', 'CPL', '|fresh|', 'faraju', '2019-12-16 13:57:30', '2019-12-17 09:28:03', 0, 0),
(41, 'fff', 0.25, 'fff', 'fff', 'Persand Teeshan', 'teeshan.persand@mcb.mu', '', NULL, 'On Going Follow Up', NULL, 'faraju', '2019-12-16 13:58:22', '2019-12-16 14:01:14', 0, 0),
(42, 'lolos', 1, 'lolos', 'lolo', 'Sreeneebus Ajitesh', 'ajitesh.sreeneebus@mcb.mu', 'lolosss', '2019-12-16 14:08:48', 'CPL', '|E|', 'faraju', '2019-12-16 14:09:12', '2019-12-17 13:42:52', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activityId` int(11) NOT NULL,
  `activity` varchar(256) NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activityId`, `activity`, `createdBy`, `dateCreated`, `deleted`) VALUES
(18, 'Troubleshooting', 'bhodow', '2019-08-12 11:50:20', 0),
(19, 'Test Environment', 'bhodow', '2019-08-12 12:34:55', 0),
(20, 'Research', 'bheban', '2019-12-02 16:09:39', 0),
(21, 'yash', 'tepers', '2019-12-11 16:08:48', 0),
(25, 'popo', 'tepers', '2019-12-11 16:18:38', 0),
(26, 'fresh', 'faraju', '2019-12-16 11:45:50', 0),
(27, 'a', 'faraju', '2019-12-16 12:01:48', 1),
(28, 'testingus', 'shuuma', '2019-12-16 13:26:53', 0),
(29, 'a', 'shuuma', '2019-12-17 10:25:25', 0),
(30, 'as', 'shuuma', '2019-12-17 10:27:26', 0),
(31, 'asf', 'shuuma', '2019-12-17 10:28:31', 0),
(32, 'sdsdsd', 'shuuma', '2019-12-17 10:33:12', 0),
(33, 'test', 'shuuma', '2019-12-17 10:38:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `actionItemStatus` varchar(30) NOT NULL,
  `superusers` varchar(256) CHARACTER SET utf32 NOT NULL,
  `dns` varchar(256) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`actionItemStatus`, `superusers`, `dns`, `id`) VALUES
('NYS|WIP|CPL|On Going Follow Up', 'faraju|bhodow|shuuma', 'devtswebapp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `imp_rec`
--

CREATE TABLE `imp_rec` (
  `recId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `activityId` int(11) NOT NULL,
  `createdBy` varchar(256) NOT NULL,
  `actionItem` text NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imp_rec`
--

INSERT INTO `imp_rec` (`recId`, `projectId`, `activityId`, `createdBy`, `actionItem`, `dateCreated`, `dateModified`, `deleted`) VALUES
(33, 19, 18, 'bheban', '', '2019-08-12 07:51:43', '2019-08-12 11:51:43', 0),
(35, 20, 19, 'doutac', '', '2019-07-25 10:09:06', '2019-07-26 13:11:07', 1),
(48, 16, 20, 'shuuma', '', '2019-12-11 12:07:18', '2019-12-11 16:07:18', 0),
(49, 16, 21, 'tepers', '', '2019-12-11 12:08:48', '2019-12-11 16:08:48', 0),
(53, 31, 25, 'tepers', '', '2019-12-11 12:18:38', '2019-12-11 16:18:38', 0),
(54, 32, 21, 'tepers', '', '2019-12-11 12:21:05', '2019-12-11 16:21:05', 1),
(55, 14, 19, 'tepers', '', '2019-12-12 06:54:43', '2019-12-12 10:54:43', 0),
(56, 31, 20, 'shuuma', '', '2019-12-12 07:06:08', '2019-12-12 11:06:08', 0),
(57, 36, 18, 'tepers', '', '2019-12-12 08:17:11', '2019-12-12 12:17:11', 1),
(58, 38, 25, 'faraju', '', '2019-12-12 09:32:10', '2019-12-12 13:32:10', 0),
(59, 39, 21, 'faraju', '', '2019-12-12 09:33:19', '2019-12-12 13:33:19', 0),
(60, 40, 20, 'faraju', '', '2019-12-12 09:33:58', '2019-12-12 13:33:58', 0),
(61, 41, 20, 'shuuma', '', '2019-12-12 09:46:59', '2019-12-12 13:46:59', 0),
(62, 42, 20, 'faraju', '', '2019-12-12 10:49:08', '2019-12-12 14:49:08', 0),
(63, 46, 25, 'shuuma', '', '2019-12-13 07:09:48', '2019-12-13 11:09:48', 0),
(64, 47, 21, 'shuuma', '|Action Fresh|soupz|', '2019-12-13 07:11:45', '2019-12-16 15:26:48', 1),
(65, 47, 25, 'shuuma', '|Action Fresh|soupz|', '2019-12-13 07:13:08', '2019-12-16 15:26:48', 0),
(66, 48, 25, 'shuuma', '', '2019-12-13 08:47:58', '2019-12-13 12:47:58', 0),
(67, 8, 21, 'shuuma', '', '2019-12-13 10:28:32', '2019-12-13 14:28:32', 0),
(68, 49, 21, 'shuuma', '', '2019-12-13 10:30:09', '2019-12-13 14:30:09', 1),
(69, 9, 21, 'shuuma', '', '2019-12-13 10:39:06', '2019-12-13 14:39:06', 0),
(70, 50, 20, 'shuuma', '', '2019-12-13 10:46:52', '2019-12-13 14:46:52', 0),
(71, 51, 26, 'faraju', '', '2019-12-16 07:45:50', '2019-12-16 13:57:42', 1),
(72, 52, 27, 'faraju', '', '2019-12-16 08:01:48', '2019-12-16 12:01:48', 1),
(73, 10, 26, 'tepers', '|lolos|', '2019-12-16 10:29:37', '2019-12-17 13:42:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `imp_rec_comment`
--

CREATE TABLE `imp_rec_comment` (
  `commentId` int(11) NOT NULL,
  `comment` text NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recId` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imp_rec_comment`
--

INSERT INTO `imp_rec_comment` (`commentId`, `comment`, `createdBy`, `dateCreated`, `recId`, `deleted`) VALUES
(18, 'Issue happens on an ad hoc basis', 'bheban', '2019-08-12 11:52:26', 33, 0),
(19, 'dfdfdf', 'shuuma', '2019-12-11 13:27:29', 35, 1),
(20, 'd', 'shuuma', '2019-12-11 16:07:18', 48, 0),
(21, 'xsxxs', 'tepers', '2019-12-11 16:08:48', 49, 0),
(22, 'sx', 'tepers', '2019-12-11 16:09:44', 49, 0),
(23, 'xsxsxsxsxsxsxs', 'tepers', '2019-12-11 16:18:39', 53, 0),
(24, 'ddd', 'tepers', '2019-12-11 16:21:05', 54, 0),
(25, 'testsdsd', 'shuuma', '2019-12-16 11:29:00', 63, 1),
(26, 'testsdsd', 'faraju', '2019-12-16 11:34:56', 63, 1),
(27, 'testsdsd', 'faraju', '2019-12-16 11:35:53', 63, 1),
(28, 'test', 'shuuma', '2019-12-16 11:37:16', 63, 1),
(29, 'Hello', 'faraju', '2019-12-16 11:59:50', 71, 0),
(30, 'boo', 'tepers', '2019-12-17 10:22:19', 73, 0),
(31, 'dwd', 'faraju', '2019-12-17 11:10:18', 73, 0);

-- --------------------------------------------------------

--
-- Table structure for table `imp_rec_description`
--

CREATE TABLE `imp_rec_description` (
  `rec_descriptionId` int(11) NOT NULL,
  `recId` int(11) NOT NULL,
  `description` text NOT NULL,
  `manDays` decimal(5,2) NOT NULL,
  `loggedBy` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime DEFAULT NULL,
  `dateModified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imp_rec_description`
--

INSERT INTO `imp_rec_description` (`rec_descriptionId`, `recId`, `description`, `manDays`, `loggedBy`, `email`, `startDate`, `endDate`, `dateModified`, `deleted`) VALUES
(43, 33, 'Performance testing of ATM delayed due to several issues on ICPS side and due to the long reponse time to solve issues.', '6.00', 'bheban', 'bhesham.bansropun@mcb.mu', '2019-04-18 11:50:00', '2019-04-30 11:50:24', '2019-08-12 11:51:43', 0),
(45, 35, 'COB blocking execution of UAT', '1.00', 'doutac', 'doumila.tacouri@mcb.mu', '2019-07-25 14:09:06', '2019-07-26 13:11:07', '2019-08-12 12:32:54', 1),
(46, 48, 'ddd', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-11 16:00:00', '2019-12-18 16:00:03', '2019-12-11 16:07:18', 0),
(47, 49, 'yash', '8.00', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-11 16:08:02', '2019-12-31 16:08:02', '2019-12-11 16:08:48', 0),
(48, 49, 'sx', '0.25', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-09 16:09:24', '2019-12-09 16:09:24', '2019-12-11 16:09:44', 0),
(49, 53, 'cdcdc', '0.50', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-09 16:10:27', '2019-12-17 16:10:27', '2019-12-11 16:18:38', 0),
(50, 54, 'dddd', '0.25', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-04 16:20:29', '2019-12-11 16:20:29', '2019-12-11 16:21:05', 1),
(51, 55, 'hhgfds', '5.00', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-12 10:54:00', NULL, '2019-12-12 10:54:43', 0),
(52, 56, 'wdsd', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-12 11:05:00', '2019-12-17 11:05:52', '2019-12-12 11:06:08', 0),
(53, 57, 'asdf', '3.00', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-12 12:16:00', NULL, '2019-12-12 12:17:12', 1),
(54, 58, 'd', '3.00', 'faraju', 'fardeenah.ajubtally@mcb.mu', '2019-12-12 13:31:00', '2019-12-24 13:31:57', '2019-12-12 13:32:10', 0),
(55, 58, 'ddd', '3.00', 'faraju', 'fardeenah.ajubtally@mcb.mu', '2019-12-03 13:32:43', '2019-12-24 13:32:43', '2019-12-12 13:32:54', 0),
(56, 59, 'de', '3.00', 'faraju', 'fardeenah.ajubtally@mcb.mu', '2019-12-12 13:33:00', '2019-12-30 13:33:04', '2019-12-12 13:33:19', 0),
(57, 60, 'rfrf', '3.00', 'faraju', 'fardeenah.ajubtally@mcb.mu', '2019-12-11 13:33:28', '2019-12-11 13:33:28', '2019-12-12 13:33:58', 0),
(58, 59, 'sdsd', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-09 13:41:40', NULL, '2019-12-12 13:41:50', 0),
(59, 61, 'sdsdsd', '5.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-10 13:43:30', '2019-12-10 13:43:30', '2019-12-12 13:46:59', 0),
(60, 62, 'ddd', '3.00', 'faraju', 'fardeenah.ajubtally@mcb.mu', '2019-12-03 14:48:54', '2019-12-17 14:48:54', '2019-12-12 14:49:08', 0),
(61, 63, 'il_5', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-02 11:09:31', '2019-12-05 11:09:31', '2019-12-13 11:09:48', 0),
(62, 64, 'cfil_1', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-09 11:10:51', NULL, '2019-12-13 11:11:45', 1),
(63, 65, 'cfil_2', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 11:12:00', NULL, '2019-12-13 11:13:08', 1),
(64, 65, 'cfil_2', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 11:14:00', NULL, '2019-12-13 11:15:10', 0),
(65, 66, 'ILENH1TS2', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 12:46:00', '2019-12-15 12:46:00', '2019-12-13 12:47:58', 0),
(66, 67, 'gg', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-09 14:27:49', '2019-12-16 14:27:49', '2019-12-13 14:28:32', 0),
(67, 68, 'ILBF1TS1', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-12 14:28:51', '2019-12-14 14:28:51', '2019-12-13 14:30:09', 1),
(68, 69, 'sdsdsds', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-12 14:38:00', '2019-12-14 14:38:43', '2019-12-13 14:39:06', 0),
(69, 70, 'ILBF1TS1', '4.00', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 14:46:21', '2019-12-15 14:46:21', '2019-12-13 14:46:52', 0),
(70, 63, 'xx', '3.00', 'faraju', 'fardeenah.ajubtally@mcb.mu', '2019-12-02 11:32:46', '2019-12-16 11:32:46', '2019-12-16 11:33:04', 0),
(71, 71, 'fresh', '3.00', 'faraju', 'fardeenah.ajubtally@mcb.mu', '2019-12-16 11:45:00', NULL, '2019-12-16 11:45:50', 1),
(72, 72, 'a', '0.25', 'faraju', 'fardeenah.ajubtally@mcb.mu', '2019-12-04 12:00:15', '2019-12-11 12:00:15', '2019-12-16 12:01:48', 1),
(73, 73, 'adf', '0.25', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-11 14:27:56', NULL, '2019-12-16 14:29:37', 0),
(74, 73, 'SADFD', '0.25', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-17 11:48:00', NULL, '2019-12-17 11:48:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projectId` int(11) NOT NULL,
  `projectName` varchar(256) NOT NULL,
  `createdBy` varchar(256) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectId`, `projectName`, `createdBy`, `dateCreated`, `deleted`) VALUES
(19, 'T24 R18 Upgrade', 'bhodow', '2019-08-12 11:49:30', 0),
(20, 'SPCR-565 - 20187141 - New transactional workflow for E_C transactions', 'bhodow', '2019-08-12 12:02:48', 0),
(21, 'Project1', 'bheban', '2019-12-02 16:09:25', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actioncomments`
--
ALTER TABLE `actioncomments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `acionItemId` (`actionItemId`);

--
-- Indexes for table `actionitem`
--
ALTER TABLE `actionitem`
  ADD PRIMARY KEY (`actionItemId`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activityId`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imp_rec`
--
ALTER TABLE `imp_rec`
  ADD PRIMARY KEY (`recId`),
  ADD UNIQUE KEY `projectId_2` (`projectId`,`activityId`),
  ADD KEY `activityId` (`activityId`),
  ADD KEY `projectId` (`projectId`);

--
-- Indexes for table `imp_rec_comment`
--
ALTER TABLE `imp_rec_comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `recId` (`recId`);

--
-- Indexes for table `imp_rec_description`
--
ALTER TABLE `imp_rec_description`
  ADD PRIMARY KEY (`rec_descriptionId`),
  ADD KEY `issueId` (`recId`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actioncomments`
--
ALTER TABLE `actioncomments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `actionitem`
--
ALTER TABLE `actionitem`
  MODIFY `actionItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `imp_rec`
--
ALTER TABLE `imp_rec`
  MODIFY `recId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `imp_rec_comment`
--
ALTER TABLE `imp_rec_comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `imp_rec_description`
--
ALTER TABLE `imp_rec_description`
  MODIFY `rec_descriptionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `projectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actioncomments`
--
ALTER TABLE `actioncomments`
  ADD CONSTRAINT `actioncomments_ibfk_1` FOREIGN KEY (`actionItemId`) REFERENCES `actionitem` (`actionItemId`);

--
-- Constraints for table `imp_rec`
--
ALTER TABLE `imp_rec`
  ADD CONSTRAINT `imp_rec_ibfk_1` FOREIGN KEY (`activityId`) REFERENCES `activity` (`activityId`),
  ADD CONSTRAINT `imp_rec_ibfk_2` FOREIGN KEY (`projectId`) REFERENCES `customerfeedback`.`project` (`projectId`);

--
-- Constraints for table `imp_rec_comment`
--
ALTER TABLE `imp_rec_comment`
  ADD CONSTRAINT `imp_rec_comment_ibfk_1` FOREIGN KEY (`recId`) REFERENCES `imp_rec` (`recId`);

--
-- Constraints for table `imp_rec_description`
--
ALTER TABLE `imp_rec_description`
  ADD CONSTRAINT `imp_rec_description_ibfk_1` FOREIGN KEY (`recId`) REFERENCES `imp_rec` (`recId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
