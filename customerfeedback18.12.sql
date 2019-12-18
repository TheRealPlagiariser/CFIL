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
-- Database: `customerfeedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `question_type_lowerBound` varchar(256) NOT NULL,
  `question_type_upperBound` varchar(256) NOT NULL,
  `defaultLeftLabel` varchar(50) NOT NULL,
  `defaultRightLabel` varchar(50) NOT NULL,
  `surveyExpiresIn` int(11) NOT NULL,
  `numPageAllowed` int(11) NOT NULL DEFAULT '5',
  `numDaysForReminderMail` int(11) NOT NULL DEFAULT '3',
  `dns` varchar(256) NOT NULL,
  `timeOfExpiry` varchar(256) NOT NULL DEFAULT '7:00 am'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `question_type_lowerBound`, `question_type_upperBound`, `defaultLeftLabel`, `defaultRightLabel`, `surveyExpiresIn`, `numPageAllowed`, `numDaysForReminderMail`, `dns`, `timeOfExpiry`) VALUES
(1, '1', '5,10', 'Low', 'High', 15, 5, 1, 'devtswebapp', '07:00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `cycle`
--

CREATE TABLE `cycle` (
  `cycleId` int(11) NOT NULL,
  `cycleName` varchar(100) NOT NULL,
  `display` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `cycle`
--

INSERT INTO `cycle` (`cycleId`, `cycleName`, `display`) VALUES
(1, 'SIT - System Integration Testing', 1),
(2, 'UAT - User Acceptance Testing', 1),
(3, 'both', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projectId` int(11) NOT NULL,
  `projectCode` varchar(100) NOT NULL,
  `projectName` varchar(256) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectId`, `projectCode`, `projectName`, `dateCreated`, `deleted`, `createdBy`) VALUES
(1, 's', 's', '2019-08-09 04:43:21', 0, 'faraju'),
(2, 'nm', 'nmm', '2019-08-09 11:43:27', 0, 'faraju'),
(3, 'Ã¨', 'S*', '2019-08-13 10:44:06', 1, 'swesoo'),
(4, '01234567890123456789012345678901234567890123456789', '01234567890123456789012345678901234567890123456789', '2019-08-13 10:43:53', 1, 'swesoo'),
(5, 'Ã©', 'S*', '2019-08-13 12:06:20', 1, 'swesoo'),
(6, 'test', 'test', '2019-08-13 12:15:47', 0, 'swesoo'),
(7, 'A', 'A', '2019-12-10 05:47:19', 1, 'swesoo'),
(8, 'B', 'B', '2019-08-14 07:38:28', 0, 'swesoo'),
(9, 'C', 'V', '2019-08-14 07:38:34', 0, 'swesoo'),
(10, 'D', 'E', '2019-08-14 07:38:40', 0, 'swesoo'),
(11, 'F', 'G', '2019-12-06 10:23:16', 1, 'swesoo'),
(12, 'F', 'F', '2019-12-11 10:05:43', 0, 'swesoo'),
(13, 'J', 'K', '2019-08-14 09:05:24', 1, 'swesoo'),
(14, 'Lop', 'M', '2019-12-11 10:37:53', 0, 'swesoo'),
(15, 'lolo', 'lolo', '2019-12-11 10:37:45', 1, 'swesoo'),
(16, '2018903', 'Juice Seychelles - Request to have the OLB transfer feature', '2019-11-18 11:28:17', 0, 'darpal'),
(17, 'boo', 'boya', '2019-12-06 10:22:51', 1, 'tepers'),
(18, 'Project one', 'Project name one', '2019-12-11 10:37:38', 1, 'faraju'),
(19, 'PRoject', 'jdiwhdw', '2019-12-11 06:37:23', 1, 'faraju'),
(20, 'Prwnni', 'kneiqfj', '2019-12-09 11:38:31', 1, 'faraju'),
(21, 'dddwd', 'dddddd', '2019-12-10 05:48:10', 1, 'tepers'),
(22, 'dddd', 'ddddd', '2019-12-10 05:48:30', 1, 'tepers'),
(23, 'sdv', 'sd', '2019-12-10 05:50:42', 1, 'tepers'),
(24, 'ASG', 'FGF', '2019-12-10 05:51:03', 1, 'tepers'),
(25, 'yash', 'D', '2019-12-11 10:37:33', 1, 'bhodow'),
(26, 'a', 'M', '2019-12-11 10:35:49', 1, 'shuuma'),
(27, 'umu', 'yu', '2019-12-11 07:13:48', 1, 'shuuma'),
(28, 'popo', 'yash3', '2019-12-12 04:35:35', 1, 'tepers'),
(29, 'popo', 'yash1', '2019-12-12 04:35:32', 1, 'tepers'),
(30, 'popo', 'yash0', '2019-12-12 04:35:30', 1, 'tepers'),
(31, 'popo', 'yash', '2019-12-11 12:18:38', 0, 'tepers'),
(32, '', 'popo', '2019-12-12 10:49:31', 1, 'tepers'),
(33, 'popo', 'yash', '2019-12-12 04:35:20', 1, 'tepers'),
(34, 'popo', 'yash', '2019-12-12 04:35:16', 1, 'tepers'),
(35, 'newone', 'Theone', '2019-12-12 07:31:25', 0, 'shuuma'),
(36, 'Project Code', 'Project Name', '2019-12-12 09:14:41', 1, 'tepers'),
(37, 'Project Code2', 'Project Name2', '2019-12-12 09:31:51', 1, 'tepers'),
(38, 'test 12/12/2019', 'test 12/12/2019', '2019-12-12 09:31:26', 0, 'faraju'),
(39, 'Prwnni', 'de', '2019-12-12 09:33:19', 0, 'faraju'),
(40, '', 'wwwww', '2019-12-12 09:33:58', 0, 'faraju'),
(41, 'yupyup', 'umu', '2019-12-12 09:46:59', 0, 'shuuma'),
(42, 'Yash', 'wardah', '2019-12-12 10:48:33', 0, 'faraju'),
(43, 'testingcf_2', 'testingcf_2', '2019-12-13 06:57:57', 1, 'shuuma'),
(44, 'Test Project', 'Test Project', '2019-12-13 06:59:35', 0, 'shuuma'),
(45, 'il_2', 'il_2', '2019-12-13 07:06:20', 1, 'shuuma'),
(46, 'il_5', 'il_5', '2019-12-13 07:08:52', 0, 'shuuma'),
(47, 'Project Code', 'Project/CR/Task Name', '2019-12-13 07:11:45', 0, 'shuuma'),
(48, 'ILENH1TS2', 'ILENH1TS2', '2019-12-13 08:47:58', 0, 'shuuma'),
(49, 'ILBF1TS', 'ILBF1TS', '2019-12-17 11:44:01', 0, 'shuuma'),
(50, 'ILBF1TS1', 'ILBF1TS1', '2019-12-13 10:46:52', 0, 'shuuma'),
(51, 'fresh', 'fresh', '2019-12-16 07:45:50', 0, 'faraju'),
(52, 'a', 'a', '2019-12-16 08:01:48', 0, 'faraju'),
(53, 'rsedtrjh', 'asrdtgfjhk', '2019-12-16 09:58:42', 0, 'faraju'),
(54, 'jdff', 'dsfjk', '2019-12-16 10:06:54', 1, 'shuuma'),
(55, 'fresh3', 'fresh1', '2019-12-17 06:25:51', 0, 'faraju'),
(56, 'w', 'w', '2019-12-17 06:44:04', 1, 'faraju'),
(57, 'wssds', 'gg', '2019-12-17 06:40:20', 0, 'shuuma');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `questionId` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `questionTypeId` int(11) NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`questionId`, `question`, `dateCreated`, `questionTypeId`, `createdBy`, `deleted`) VALUES
(1, 'abs', '2019-08-09 04:43:08', 1, 'faraju', 0),
(2, 'Question example 1', '2019-08-09 07:47:10', 1, 'tepers', 0),
(3, 'Question example 2', '2019-08-09 07:47:28', 2, 'tepers', 1),
(4, 'Scale', '2019-08-13 05:44:34', 2, 'swesoo', 0),
(5, 'Choice', '2019-08-13 05:44:56', 3, 'swesoo', 0),
(6, 'Freetext question 1', '2019-08-13 05:45:32', 1, 'swesoo', 1),
(7, 'FREE', '2019-08-13 05:52:10', 1, 'swesoo', 1),
(8, 'FreeText', '2019-08-13 05:53:33', 1, 'swesoo', 1),
(9, 'FreeText', '2019-08-13 07:13:42', 1, 'swesoo', 0),
(10, 'Question 2', '2019-08-13 07:14:02', 2, 'swesoo', 0),
(11, 'Question 3', '2019-08-14 07:02:37', 2, 'swesoo', 0),
(12, 'Question 4', '2019-08-14 07:03:04', 3, 'swesoo', 0),
(13, 'Question 5', '2019-08-14 07:03:22', 1, 'swesoo', 0),
(14, 'Question 6', '2019-08-14 07:03:46', 2, 'swesoo', 0),
(15, 'Question 7', '2019-08-14 07:03:57', 1, 'swesoo', 0),
(16, '2', '2019-08-14 07:15:05', 1, 'swesoo', 0),
(17, '3', '2019-08-14 07:16:45', 2, 'swesoo', 0),
(18, '4', '2019-08-14 07:16:50', 1, 'swesoo', 0),
(19, '5', '2019-08-14 07:16:53', 1, 'swesoo', 0),
(20, '6', '2019-08-14 07:16:58', 1, 'swesoo', 0),
(21, '7', '2019-08-14 07:17:04', 1, 'swesoo', 0),
(22, '8', '2019-08-14 07:17:11', 1, 'swesoo', 0),
(23, '9', '2019-08-14 07:17:15', 1, 'swesoo', 0),
(24, '10', '2019-08-14 07:17:19', 1, 'swesoo', 0),
(25, '11', '2019-08-14 07:17:24', 1, 'swesoo', 0),
(26, 'Prior sufficient notice for UAT execution.', '2019-12-04 10:09:08', 2, 'shuuma', 0),
(27, 'UAT execution within scheduled dates', '2019-12-04 10:09:23', 1, 'shuuma', 1),
(28, 'UAT execution within scheduled dates', '2019-12-04 10:09:36', 2, 'shuuma', 0),
(29, 'Time frame provided for the UAT execution', '2019-12-04 10:09:45', 2, 'shuuma', 0),
(30, 'Roll-out date as planned', '2019-12-04 10:09:56', 2, 'shuuma', 0),
(31, 'Availability and stability of the UAT test environment.', '2019-12-04 10:10:06', 2, 'shuuma', 0),
(32, 'How satisfied or dissatisfied are you with the SIT test script shared to help prepare the UAT test script?', '2019-12-04 10:10:17', 2, 'shuuma', 0),
(33, 'Test data provided for the UAT', '2019-12-04 10:10:27', 2, 'shuuma', 0),
(34, 'Testing Services facilitator knowledge on the subject matter.', '2019-12-04 10:10:35', 2, 'shuuma', 0),
(35, 'Accessibility of the Services facilitator.', '2019-12-04 10:10:44', 2, 'shuuma', 0),
(36, 'Have you been briefed by your superior/BRM/PM prior to the UAT?', '2019-12-04 10:11:13', 3, 'shuuma', 0),
(37, 'What is the number of bugs identified during the UAT?', '2019-12-04 10:11:37', 3, 'shuuma', 0),
(38, 'What is the number of enhancements identified during the UAT?', '2019-12-04 10:12:05', 3, 'shuuma', 0),
(39, 'Were the roll-out activities smooth?', '2019-12-04 10:12:24', 3, 'shuuma', 0),
(40, 'Do you have any suggestion/comment to provide?', '2019-12-04 10:12:37', 1, 'shuuma', 0),
(41, 'choive test', '2019-12-04 11:34:21', 3, 'shuuma', 0),
(42, 'choice oben', '2019-12-04 11:48:43', 3, 'shuuma', 1),
(43, 'x', '2019-12-13 05:06:13', 1, 'faraju', 0),
(44, 'd', '2019-12-13 07:13:53', 2, 'faraju', 1),
(45, 'c', '2019-12-13 07:14:50', 2, 'faraju', 1),
(46, 'test OnE', '2019-12-17 10:51:26', 1, 'faraju', 0),
(47, 'test two', '2019-12-17 10:52:17', 2, 'faraju', 0),
(48, 'test three', '2019-12-17 10:55:56', 2, 'faraju', 0),
(49, 'test four', '2019-12-17 10:56:40', 2, 'faraju', 0),
(50, 'test five', '2019-12-17 10:57:53', 3, 'faraju', 0),
(51, 'test six', '2019-12-17 10:58:33', 3, 'faraju', 0),
(52, 'test ten', '2019-12-17 11:32:19', 3, 'faraju', 1),
(53, 'add', '2019-12-17 11:40:46', 3, 'faraju', 0),
(54, 'add', '2019-12-17 11:40:56', 3, 'faraju', 0),
(55, 'dd', '2019-12-17 11:41:58', 1, 'faraju', 0),
(56, 'yash', '2019-12-17 11:42:45', 3, 'faraju', 0),
(57, 'test 1', '2019-12-17 11:47:05', 1, 'faraju', 0),
(58, 'test2', '2019-12-17 11:47:25', 2, 'faraju', 0),
(59, 'test 3', '2019-12-17 11:47:52', 2, 'faraju', 0),
(60, 'test 4', '2019-12-17 11:48:21', 2, 'faraju', 0),
(61, 'test 5', '2019-12-17 11:48:54', 3, 'faraju', 0),
(62, 'test 6', '2019-12-17 11:49:20', 3, 'faraju', 0),
(63, '1est', '2019-12-17 12:01:56', 1, 'faraju', 0),
(64, '2test', '2019-12-17 12:02:21', 2, 'faraju', 0),
(65, '4test', '2019-12-17 12:02:49', 2, 'faraju', 0),
(66, '5test', '2019-12-17 12:03:23', 3, 'faraju', 0),
(67, '6test', '2019-12-17 12:03:58', 3, 'faraju', 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_possible_answer`
--

CREATE TABLE `question_possible_answer` (
  `questionId` int(11) NOT NULL,
  `possibleAnswer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `question_possible_answer`
--

INSERT INTO `question_possible_answer` (`questionId`, `possibleAnswer`) VALUES
(3, '1'),
(3, '2'),
(3, '3'),
(3, '4'),
(3, '5'),
(4, '1'),
(4, '2'),
(4, '3'),
(4, '4'),
(4, '5'),
(5, '1'),
(5, '2'),
(5, '3'),
(5, '4'),
(5, '5'),
(10, '1'),
(10, '10'),
(10, '2'),
(10, '3'),
(10, '4'),
(10, '5'),
(10, '6'),
(10, '7'),
(10, '8'),
(10, '9'),
(11, '1'),
(11, '10'),
(11, '2'),
(11, '3'),
(11, '4'),
(11, '5'),
(11, '6'),
(11, '7'),
(11, '8'),
(11, '9'),
(12, 'Four'),
(12, 'One'),
(12, 'Three'),
(12, 'Two'),
(14, '1'),
(14, '10'),
(14, '2'),
(14, '3'),
(14, '4'),
(14, '5'),
(14, '6'),
(14, '7'),
(14, '8'),
(14, '9'),
(17, '1'),
(17, '2'),
(17, '3'),
(17, '4'),
(17, '5'),
(26, '1'),
(26, '2'),
(26, '3'),
(26, '4'),
(26, '5'),
(28, '1'),
(28, '2'),
(28, '3'),
(28, '4'),
(28, '5'),
(29, '1'),
(29, '2'),
(29, '3'),
(29, '4'),
(29, '5'),
(30, '1'),
(30, '2'),
(30, '3'),
(30, '4'),
(30, '5'),
(31, '1'),
(31, '2'),
(31, '3'),
(31, '4'),
(31, '5'),
(32, '1'),
(32, '2'),
(32, '3'),
(32, '4'),
(32, '5'),
(33, '1'),
(33, '2'),
(33, '3'),
(33, '4'),
(33, '5'),
(34, '1'),
(34, '2'),
(34, '3'),
(34, '4'),
(34, '5'),
(35, '1'),
(35, '2'),
(35, '3'),
(35, '4'),
(35, '5'),
(36, 'No'),
(36, 'Yes'),
(37, '0'),
(37, '1-5'),
(37, '6-10'),
(37, 'More than 10'),
(38, '0'),
(38, '1-5'),
(38, '6-10'),
(38, 'More than 10'),
(39, 'No'),
(39, 'Yes'),
(41, 'choice a'),
(41, 'choice b'),
(41, 'choice c'),
(41, 'choice d'),
(42, 'choice 1'),
(42, 'choice 1000'),
(42, 'choice 32'),
(44, '1'),
(44, '2'),
(44, '3'),
(44, '4'),
(44, '5'),
(45, '1'),
(45, '2'),
(45, '3'),
(45, '4'),
(45, '5'),
(47, '1'),
(47, '2'),
(47, '3'),
(47, '4'),
(47, '5'),
(48, '1'),
(48, '10'),
(48, '2'),
(48, '3'),
(48, '4'),
(48, '5'),
(48, '6'),
(48, '7'),
(48, '8'),
(48, '9'),
(49, '1'),
(49, '2'),
(49, '3'),
(49, '4'),
(49, '5'),
(50, 'No'),
(50, 'Yes'),
(51, 'No'),
(51, 'None of the above'),
(51, 'Yes'),
(53, 'no'),
(53, 'yes'),
(54, 'no'),
(54, 'yes'),
(56, 'no'),
(56, 'noo'),
(58, '1'),
(58, '2'),
(58, '3'),
(58, '4'),
(58, '5'),
(59, '1'),
(59, '10'),
(59, '2'),
(59, '3'),
(59, '4'),
(59, '5'),
(59, '6'),
(59, '7'),
(59, '8'),
(59, '9'),
(60, '1'),
(60, '2'),
(60, '3'),
(60, '4'),
(60, '5'),
(61, 'No'),
(61, 'Yes'),
(62, 'No'),
(62, 'None of the above'),
(62, 'Yes'),
(64, '1'),
(64, '2'),
(64, '3'),
(64, '4'),
(64, '5'),
(65, '1'),
(65, '2'),
(65, '3'),
(65, '4'),
(65, '5'),
(66, 'No'),
(66, 'Yes'),
(67, 'No'),
(67, 'None of the above'),
(67, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `question_template`
--

CREATE TABLE `question_template` (
  `templateId` int(11) NOT NULL,
  `pageNo` int(11) NOT NULL,
  `questionNo` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `question_template`
--

INSERT INTO `question_template` (`templateId`, `pageNo`, `questionNo`, `questionId`, `deleted`) VALUES
(1, 0, 1, 1, 0),
(2, 2, 3, 1, 1),
(11, 1, 2, 1, 0),
(12, 0, 1, 1, 1),
(13, 0, 1, 1, 1),
(1, 1, 2, 2, 0),
(2, 0, 1, 2, 1),
(6, 0, 1, 2, 0),
(12, 1, 2, 2, 1),
(14, 4, 8, 2, 0),
(2, 1, 2, 3, 1),
(9, 0, 1, 4, 0),
(11, 0, 1, 4, 0),
(13, 0, 2, 4, 1),
(14, 3, 6, 4, 0),
(16, 1, 2, 4, 0),
(4, 2, 3, 5, 0),
(5, 3, 6, 5, 0),
(6, 1, 2, 5, 0),
(8, 1, 2, 5, 0),
(10, 0, 1, 5, 0),
(14, 4, 7, 5, 0),
(3, 1, 2, 9, 1),
(4, 1, 2, 9, 0),
(8, 0, 1, 9, 0),
(13, 0, 3, 9, 1),
(3, 0, 1, 10, 1),
(4, 0, 1, 10, 0),
(6, 1, 3, 10, 0),
(12, 1, 3, 10, 1),
(14, 2, 5, 14, 0),
(5, 3, 5, 18, 0),
(14, 1, 4, 19, 0),
(5, 3, 4, 21, 0),
(14, 1, 3, 21, 0),
(5, 2, 3, 23, 0),
(14, 0, 1, 23, 0),
(5, 1, 2, 24, 0),
(14, 0, 2, 24, 0),
(5, 0, 1, 25, 0),
(7, 0, 1, 25, 0),
(15, 0, 1, 26, 0),
(15, 0, 2, 28, 0),
(15, 0, 3, 29, 0),
(15, 0, 4, 30, 0),
(15, 0, 5, 31, 0),
(15, 1, 6, 32, 0),
(15, 1, 7, 33, 0),
(15, 1, 8, 34, 0),
(15, 1, 9, 35, 0),
(15, 2, 10, 36, 0),
(15, 2, 11, 37, 0),
(18, 0, 2, 37, 1),
(15, 2, 12, 38, 0),
(15, 3, 13, 39, 0),
(15, 3, 14, 40, 0),
(16, 0, 1, 40, 0),
(17, 0, 1, 41, 0),
(18, 0, 1, 41, 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE `question_type` (
  `questionTypeId` int(11) NOT NULL,
  `questionType` varchar(50) NOT NULL,
  `inputName` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`questionTypeId`, `questionType`, `inputName`) VALUES
(1, 'FreeText', 'text'),
(2, 'Scale', 'radio'),
(3, 'Choice', 'radio');

-- --------------------------------------------------------

--
-- Table structure for table `scale_label`
--

CREATE TABLE `scale_label` (
  `questionId` int(11) NOT NULL,
  `leftLabel` varchar(256) NOT NULL,
  `rightLabel` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `scale_label`
--

INSERT INTO `scale_label` (`questionId`, `leftLabel`, `rightLabel`) VALUES
(3, 'Low', 'High'),
(4, 'Low', 'High'),
(10, 'Low', 'High'),
(11, 'Down', 'Up'),
(14, 'Low', 'High'),
(17, 'Low', 'High'),
(26, 'Low', 'High'),
(28, 'Low', 'High'),
(29, 'Low', 'High'),
(30, 'Low', 'High'),
(31, 'Low', 'High'),
(32, 'Low', 'High'),
(33, 'Low', 'High'),
(34, 'Low', 'High'),
(35, 'Low', 'High'),
(44, 'Low', 'High'),
(45, 'Low', 'High'),
(47, 'Low', 'High'),
(48, 'Low', 'High'),
(49, 'Bad', 'Good'),
(58, 'Low', 'High'),
(59, 'Low', 'High'),
(60, 'Bad', 'Good'),
(64, 'Low', 'High'),
(65, 'Bad', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `surveyId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `templateId` int(11) NOT NULL,
  `surveyName` varchar(256) NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `email` varchar(256) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `expired` tinyint(1) DEFAULT '0',
  `lastModified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`surveyId`, `projectId`, `templateId`, `surveyName`, `createdBy`, `email`, `dateCreated`, `deleted`, `expired`, `lastModified`) VALUES
(1, 1, 1, 'sa', 'faraju', '', '2019-08-09 08:43:34', 1, 0, NULL),
(2, 1, 1, 's1', 'faraju', '', '2019-08-09 09:14:29', 1, 0, NULL),
(3, 1, 1, 'TEST1', 'swesoo', '', '2019-08-09 10:40:24', 0, 1, '2019-12-01'),
(4, 2, 1, 'gg', 'faraju', '', '2019-08-09 17:50:54', 0, 1, '2019-12-04'),
(5, 6, 1, 'NEW SURVEY', 'swesoo', '', '2019-08-13 16:16:24', 1, 0, NULL),
(6, 2, 4, 'SIT survey', 'swesoo', '', '2019-08-14 09:46:23', 0, 1, '2019-12-03'),
(7, 14, 4, 'SIT progress', 'swesoo', '', '2019-08-14 11:49:07', 0, 0, NULL),
(8, 6, 8, 'UAT Progress', 'swesoo', '', '2019-08-14 11:50:27', 0, 0, NULL),
(9, 1, 6, 'Release', 'swesoo', '', '2019-08-14 11:52:36', 0, 0, NULL),
(10, 8, 5, 'Issues', 'swesoo', '', '2019-08-14 11:53:14', 0, 0, NULL),
(11, 12, 6, 'New release', 'swesoo', '', '2019-08-14 11:53:43', 1, 0, NULL),
(12, 6, 8, 'Progress', 'swesoo', '', '2019-08-14 11:54:07', 0, 1, '2019-12-09'),
(13, 9, 8, 'UAT Progress Survey', 'swesoo', '', '2019-08-14 11:54:33', 0, 1, '2019-12-09'),
(14, 8, 6, 'Release Management', 'swesoo', '', '2019-08-14 11:56:08', 0, 1, '2019-12-02'),
(15, 12, 5, 'NEW SURVEY 2', 'swesoo', '', '2019-08-14 14:07:04', 0, 1, '2019-12-01'),
(16, 14, 4, 'Survey tx', 'bhodow', '', '2019-08-28 11:14:25', 0, 1, '2019-12-01'),
(17, 15, 4, 'Survey txc', 'bhodow', '', '2019-08-28 11:20:52', 0, 1, '2019-12-01'),
(18, 14, 4, 'Survey txcs', 'bhodow', '', '2019-08-28 11:22:21', 0, 1, '2019-12-01'),
(19, 16, 4, '2018 - Juice Seychelles', 'darpal', '', '2019-11-18 15:29:42', 1, 0, NULL),
(20, 15, 14, 'testingsurvey04122019', 'shuuma', '', '2019-12-04 13:44:48', 0, 1, '2019-12-09'),
(21, 6, 15, 'SPCR-2304', 'shuuma', '', '2019-12-04 14:16:15', 0, 1, '2019-12-09'),
(22, 15, 16, 'ddd', 'shuuma', '', '2019-12-04 14:34:01', 0, 1, '2019-12-09'),
(23, 16, 14, 'dfdsfdsfsdf', 'shuuma', '', '2019-12-04 15:17:57', 0, 1, '2019-12-09'),
(24, 15, 14, 'testingprefinal', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-04 15:22:35', 0, 1, '2019-12-05'),
(25, 15, 17, 'choice survey', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-04 15:35:09', 0, 1, '2019-12-05'),
(26, 16, 4, 'joe', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-05 12:23:20', 0, 0, '2019-12-06'),
(27, 10, 1, 'd', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-06 15:53:39', 0, 0, NULL),
(28, 16, 1, 'xxx', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-06 15:54:37', 0, 0, NULL),
(29, 14, 6, 'survey yash', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-06 15:58:14', 0, 0, NULL),
(30, 15, 4, 'fgfdgdfgdfsg', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-09 09:52:22', 0, 0, NULL),
(31, 12, 5, 'survey test 09 12 2019', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-09 11:31:00', 0, 0, NULL),
(32, 18, 4, 'survey one', 'faraju', 'fardeenah.ajubtally@mcb.mu', '2019-12-09 14:22:38', 0, 1, '2019-12-09'),
(33, 35, 5, 'new', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-12 11:32:12', 1, 0, NULL),
(34, 37, 6, 'New Survey', 'tepers', 'teeshan.persand@mcb.mu', '2019-12-12 12:18:41', 1, 0, NULL),
(35, 44, 4, 'cf_5', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 11:00:49', 0, 0, NULL),
(36, 41, 6, 'cfenh2ts1', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 12:32:48', 0, 0, NULL),
(37, 42, 5, 'cfenh2ts2', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 12:33:24', 0, 1, '2019-12-13'),
(38, 47, 4, 'CFENH1TS1', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 14:10:20', 0, 0, NULL),
(39, 47, 5, 'CFENH1TS2', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 14:11:37', 0, 1, '2019-12-13'),
(40, 46, 5, 'CFENH1TS3', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 14:15:40', 0, 0, NULL),
(41, 47, 6, 'CFENH1TS4', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 14:19:15', 0, 1, '2019-12-15'),
(42, 46, 6, 'CFENH1TS5', 'shuuma', 'shujaat.umarkhan@mcb.mu', '2019-12-13 14:21:20', 0, 0, NULL),
(43, 53, 4, 'dfghjkl;\'\'', 'faraju', 'fardeenah.ajubtally@mcb.mu', '2019-12-16 13:59:11', 0, 0, NULL),
(44, 55, 5, 'sss', 'faraju', 'fardeenah.ajubtally@mcb.mu', '2019-12-17 12:08:02', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `survey_answer`
--

CREATE TABLE `survey_answer` (
  `surveyAnswerId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `surveyId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `pageNo` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `answer` varchar(1000) NOT NULL,
  `dateAnswered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateCompleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `survey_answer`
--

INSERT INTO `survey_answer` (`surveyAnswerId`, `username`, `surveyId`, `questionId`, `pageNo`, `question`, `answer`, `dateAnswered`, `dateCompleted`) VALUES
(1, 'ajisre', 3, 1, 0, 'abs', 'JGVB', '2019-08-09 07:18:07', '2019-08-09 07:18:07'),
(2, 'faraju', 4, 1, 0, 'abs', 'ccc', '2019-08-09 13:54:30', NULL),
(3, 'swesoo', 6, 10, 0, 'Question 2', '5', '2019-08-14 06:48:23', '2019-08-14 06:48:34'),
(4, 'swesoo', 6, 9, 1, 'FreeText', 'freetext', '2019-08-14 06:48:30', '2019-08-14 06:48:34'),
(5, 'swesoo', 6, 5, 2, 'Choice', '1', '2019-08-14 06:48:34', '2019-08-14 06:48:34'),
(6, 'swesoo', 15, 25, 0, '11', '1', '2019-08-16 07:51:46', '2019-08-16 07:52:00'),
(7, 'swesoo', 15, 24, 1, '10', '2', '2019-08-16 07:51:49', '2019-08-16 07:52:00'),
(8, 'swesoo', 15, 23, 2, '9', '3', '2019-08-16 07:51:53', '2019-08-16 07:52:00'),
(9, 'swesoo', 15, 21, 3, '7', 'h', '2019-08-16 07:52:00', '2019-08-16 07:52:00'),
(10, 'swesoo', 15, 18, 3, '4', 'h', '2019-08-16 07:52:00', '2019-08-16 07:52:00'),
(11, 'swesoo', 15, 5, 3, 'Choice', '4', '2019-08-16 07:52:00', '2019-08-16 07:52:00'),
(12, 'bhodow', 18, 10, 0, 'Question 2', '2', '2019-08-28 07:24:02', '2019-08-28 07:24:25'),
(13, 'bhodow', 18, 9, 1, 'FreeText', 'sdf', '2019-08-28 07:24:07', '2019-08-28 07:24:25'),
(14, 'bhodow', 18, 5, 2, 'Choice', '3', '2019-08-28 07:24:25', '2019-08-28 07:24:25'),
(15, 'bhodow', 16, 10, 0, 'Question 2', '4', '2019-09-11 07:29:22', '2019-09-11 07:29:59'),
(16, 'bhodow', 16, 9, 1, 'FreeText', '-les traductions engagent beaucoup de temps\r\n-beaucoup de mots franÃƒÂ§ais et caractÃƒÂ¨res spÃƒÂ©ciaux sont encore Ãƒ  corriger sur la version franÃƒÂ§aise\r\n-temps : respecter le timing\r\n-mieux expliciter les ÃƒÂ©tapes Ãƒ  suivre\r\n-bien prÃƒÂ©parer l\'environnement test UAT avant de commencer les te', '2019-09-11 07:29:53', '2019-09-11 07:29:59'),
(17, 'bhodow', 16, 5, 2, 'Choice', '2', '2019-09-11 07:29:59', '2019-09-11 07:29:59'),
(18, 'bhodow', 17, 10, 0, 'Question 2', '4', '2019-09-11 07:45:51', '2019-09-11 07:46:22'),
(19, 'bhodow', 17, 9, 1, 'FreeText', 'Dear Dowtal Bhoomeshwur,\r\n \r\nTo improve quality of our service, we are conducting our among our customer feedback survey to assess the level of satisfaction.\r\n \r\n In this respect, we would appreciate if you can share your feedback with us by clicking on the following web link to fill out a short online questionnaire.\r\nDear Dowtal Bhoomeshwur,\r\n \r\nTo improve quality of our service, we are conducting our among our customer feedback survey to assess the level of satisfaction.\r\n \r\n In this respect, we would appreciate if you can share your feedback with us by clicking on the following web link to fill out a short online questionnaire.\r\n', '2019-09-11 07:46:18', '2019-09-11 07:46:22'),
(20, 'bhodow', 17, 5, 2, 'Choice', '2', '2019-09-11 07:46:22', '2019-09-11 07:46:22'),
(21, 'shuuma', 12, 9, 0, 'FreeText', 'alo alo', '2019-12-04 09:39:22', '2019-12-04 09:39:30'),
(22, 'shuuma', 12, 5, 1, 'Choice', '3', '2019-12-04 09:39:30', '2019-12-04 09:39:30'),
(23, 'shuuma', 20, 23, 0, '9', 'answer 1', '2019-12-04 09:51:06', '2019-12-04 09:51:21'),
(24, 'shuuma', 20, 24, 0, '10', 'answer 2', '2019-12-04 09:51:06', '2019-12-04 09:51:21'),
(25, 'shuuma', 20, 21, 1, '7', 'answer 3', '2019-12-04 09:51:11', '2019-12-04 09:51:21'),
(26, 'shuuma', 20, 19, 1, '5', 'answer4', '2019-12-04 09:51:11', '2019-12-04 09:51:21'),
(27, 'shuuma', 20, 14, 2, 'Question 6', '1', '2019-12-04 09:51:13', '2019-12-04 09:51:21'),
(28, 'shuuma', 20, 4, 3, 'Scale', '3', '2019-12-04 09:51:15', '2019-12-04 09:51:21'),
(29, 'shuuma', 20, 5, 4, 'Choice', '4', '2019-12-04 09:51:21', '2019-12-04 09:51:21'),
(30, 'shuuma', 20, 2, 4, 'Question example 1', 'answer 8', '2019-12-04 09:51:21', '2019-12-04 09:51:21'),
(31, 'tepers', 20, 23, 0, '9', 'a1', '2019-12-04 09:53:31', '2019-12-04 09:51:21'),
(32, 'tepers', 20, 24, 0, '10', 'a2', '2019-12-04 09:53:31', '2019-12-04 09:51:21'),
(33, 'tepers', 20, 21, 1, '7', 'a3', '2019-12-04 09:53:34', '2019-12-04 09:51:21'),
(34, 'tepers', 20, 19, 1, '5', 'a4', '2019-12-04 09:53:34', '2019-12-04 09:51:21'),
(35, 'tepers', 20, 14, 2, 'Question 6', '2', '2019-12-04 09:53:37', '2019-12-04 09:51:21'),
(36, 'tepers', 20, 4, 3, 'Scale', '1', '2019-12-04 09:53:47', '2019-12-04 09:51:21'),
(37, 'tepers', 20, 5, 4, 'Choice', '5', '2019-12-04 09:53:53', '2019-12-04 09:51:21'),
(38, 'tepers', 20, 2, 4, 'Question example 1', 'a8', '2019-12-04 09:53:53', '2019-12-04 09:51:21'),
(39, 'shuuma', 21, 26, 0, 'Prior sufficient notice for UAT execution.', '3', '2019-12-04 10:19:01', '2019-12-04 10:19:46'),
(40, 'shuuma', 21, 28, 0, 'UAT execution within scheduled dates', '3', '2019-12-04 10:19:01', '2019-12-04 10:19:46'),
(41, 'shuuma', 21, 29, 0, 'Time frame provided for the UAT execution', '3', '2019-12-04 10:19:01', '2019-12-04 10:19:46'),
(42, 'shuuma', 21, 30, 0, 'Roll-out date as planned', '3', '2019-12-04 10:19:01', '2019-12-04 10:19:46'),
(43, 'shuuma', 21, 31, 0, 'Availability and stability of the UAT test environment.', '3', '2019-12-04 10:19:01', '2019-12-04 10:19:46'),
(44, 'shuuma', 21, 32, 1, 'How satisfied or dissatisfied are you with the SIT test script shared to help prepare the UAT test script?', '3', '2019-12-04 10:19:10', '2019-12-04 10:19:46'),
(45, 'shuuma', 21, 33, 1, 'Test data provided for the UAT', '3', '2019-12-04 10:19:10', '2019-12-04 10:19:46'),
(46, 'shuuma', 21, 34, 1, 'Testing Services facilitator knowledge on the subject matter.', '3', '2019-12-04 10:19:10', '2019-12-04 10:19:46'),
(47, 'shuuma', 21, 35, 1, 'Accessibility of the Services facilitator.', '3', '2019-12-04 10:19:10', '2019-12-04 10:19:46'),
(48, 'shuuma', 21, 36, 2, 'Have you been briefed by your superior/BRM/PM prior to the UAT?', 'Yes', '2019-12-04 10:19:26', '2019-12-04 10:19:46'),
(49, 'shuuma', 21, 37, 2, 'What is the number of bugs identified during the UAT?', '1-5', '2019-12-04 10:19:26', '2019-12-04 10:19:46'),
(50, 'shuuma', 21, 38, 2, 'What is the number of enhancements identified during the UAT?', 'More than 10', '2019-12-04 10:19:26', '2019-12-04 10:19:46'),
(51, 'shuuma', 21, 39, 3, 'Were the roll-out activities smooth?', 'No', '2019-12-04 10:19:46', '2019-12-04 10:19:46'),
(52, 'shuuma', 21, 40, 3, 'Do you have any suggestion/comment to provide?', 'An easier, more customer/staff friendly test script and explanation would be appreciated. This, since the users performing the tests are not IT savy and technical wordings/scripts of IT are not easily followed.', '2019-12-04 10:19:46', '2019-12-04 10:19:46'),
(53, 'faraju', 21, 26, 0, 'Prior sufficient notice for UAT execution.', '1', '2019-12-04 10:25:41', '2019-12-04 10:25:58'),
(54, 'faraju', 21, 28, 0, 'UAT execution within scheduled dates', '1', '2019-12-04 10:25:41', '2019-12-04 10:25:58'),
(55, 'faraju', 21, 29, 0, 'Time frame provided for the UAT execution', '1', '2019-12-04 10:25:41', '2019-12-04 10:25:58'),
(56, 'faraju', 21, 30, 0, 'Roll-out date as planned', '1', '2019-12-04 10:25:41', '2019-12-04 10:25:58'),
(57, 'faraju', 21, 31, 0, 'Availability and stability of the UAT test environment.', '1', '2019-12-04 10:25:41', '2019-12-04 10:25:58'),
(58, 'faraju', 21, 32, 1, 'How satisfied or dissatisfied are you with the SIT test script shared to help prepare the UAT test script?', '1', '2019-12-04 10:25:47', '2019-12-04 10:25:58'),
(59, 'faraju', 21, 33, 1, 'Test data provided for the UAT', '1', '2019-12-04 10:25:47', '2019-12-04 10:25:58'),
(60, 'faraju', 21, 34, 1, 'Testing Services facilitator knowledge on the subject matter.', '1', '2019-12-04 10:25:47', '2019-12-04 10:25:58'),
(61, 'faraju', 21, 35, 1, 'Accessibility of the Services facilitator.', '1', '2019-12-04 10:25:47', '2019-12-04 10:25:58'),
(62, 'faraju', 21, 36, 2, 'Have you been briefed by your superior/BRM/PM prior to the UAT?', 'No', '2019-12-04 10:25:52', '2019-12-04 10:25:58'),
(63, 'faraju', 21, 37, 2, 'What is the number of bugs identified during the UAT?', 'More than 10', '2019-12-04 10:25:52', '2019-12-04 10:25:58'),
(64, 'faraju', 21, 38, 2, 'What is the number of enhancements identified during the UAT?', '0', '2019-12-04 10:25:52', '2019-12-04 10:25:58'),
(65, 'faraju', 21, 39, 3, 'Were the roll-out activities smooth?', 'No', '2019-12-04 10:25:58', '2019-12-04 10:25:58'),
(66, 'faraju', 21, 40, 3, 'Do you have any suggestion/comment to provide?', 'testingu', '2019-12-04 10:25:58', '2019-12-04 10:25:58'),
(67, 'tepers', 21, 26, 0, 'Prior sufficient notice for UAT execution.', '1', '2019-12-04 10:27:04', '2019-12-04 10:27:21'),
(68, 'tepers', 21, 28, 0, 'UAT execution within scheduled dates', '1', '2019-12-04 10:27:04', '2019-12-04 10:27:21'),
(69, 'tepers', 21, 29, 0, 'Time frame provided for the UAT execution', '1', '2019-12-04 10:27:04', '2019-12-04 10:27:21'),
(70, 'tepers', 21, 30, 0, 'Roll-out date as planned', '1', '2019-12-04 10:27:04', '2019-12-04 10:27:21'),
(71, 'tepers', 21, 31, 0, 'Availability and stability of the UAT test environment.', '1', '2019-12-04 10:27:04', '2019-12-04 10:27:21'),
(72, 'tepers', 21, 32, 1, 'How satisfied or dissatisfied are you with the SIT test script shared to help prepare the UAT test script?', '1', '2019-12-04 10:27:11', '2019-12-04 10:27:21'),
(73, 'tepers', 21, 33, 1, 'Test data provided for the UAT', '1', '2019-12-04 10:27:11', '2019-12-04 10:27:21'),
(74, 'tepers', 21, 34, 1, 'Testing Services facilitator knowledge on the subject matter.', '1', '2019-12-04 10:27:11', '2019-12-04 10:27:21'),
(75, 'tepers', 21, 35, 1, 'Accessibility of the Services facilitator.', '1', '2019-12-04 10:27:11', '2019-12-04 10:27:21'),
(76, 'tepers', 21, 36, 2, 'Have you been briefed by your superior/BRM/PM prior to the UAT?', 'No', '2019-12-04 10:27:17', '2019-12-04 10:27:21'),
(77, 'tepers', 21, 37, 2, 'What is the number of bugs identified during the UAT?', '1-5', '2019-12-04 10:27:17', '2019-12-04 10:27:21'),
(78, 'tepers', 21, 38, 2, 'What is the number of enhancements identified during the UAT?', 'More than 10', '2019-12-04 10:27:17', '2019-12-04 10:27:21'),
(79, 'tepers', 21, 39, 3, 'Were the roll-out activities smooth?', 'No', '2019-12-04 10:27:21', '2019-12-04 10:27:21'),
(80, 'tepers', 21, 40, 3, 'Do you have any suggestion/comment to provide?', 'dsds', '2019-12-04 10:27:21', '2019-12-04 10:27:21'),
(81, 'shuuma', 13, 9, 0, 'FreeText', 'gbghtr', '2019-12-04 10:32:27', '2019-12-04 10:32:35'),
(82, 'shuuma', 13, 5, 1, 'Choice', '2', '2019-12-04 10:32:35', '2019-12-04 10:32:35'),
(83, 'shuuma', 22, 40, 0, 'Do you have any suggestion/comment to provide?', 'cdc', '2019-12-04 10:34:51', '2019-12-04 10:34:55'),
(84, 'shuuma', 22, 4, 1, 'Scale', '1', '2019-12-04 10:34:55', '2019-12-04 10:34:55'),
(85, 'darpal', 22, 40, 0, 'Do you have any suggestion/comment to provide?', 'ccc', '2019-12-04 10:35:28', '2019-12-04 10:35:33'),
(86, 'darpal', 22, 4, 1, 'Scale', '2', '2019-12-04 10:35:33', '2019-12-04 10:35:33'),
(87, 'shuuma', 23, 23, 0, '9', 'dfgdfg', '2019-12-04 11:18:23', '2019-12-04 11:18:59'),
(88, 'shuuma', 23, 24, 0, '10', 'dfgdfgdfg', '2019-12-04 11:18:23', '2019-12-04 11:18:59'),
(89, 'shuuma', 23, 21, 1, '7', 'dfgfdgdfg', '2019-12-04 11:18:26', '2019-12-04 11:18:59'),
(90, 'shuuma', 23, 19, 1, '5', 'dfgdfgdgf', '2019-12-04 11:18:26', '2019-12-04 11:18:59'),
(91, 'shuuma', 23, 14, 2, 'Question 6', '10', '2019-12-04 11:18:30', '2019-12-04 11:18:59'),
(92, 'shuuma', 23, 4, 3, 'Scale', '5', '2019-12-04 11:18:33', '2019-12-04 11:18:59'),
(93, 'shuuma', 23, 5, 4, 'Choice', '4', '2019-12-04 11:18:59', '2019-12-04 11:18:59'),
(94, 'shuuma', 23, 2, 4, 'Question example 1', 'dfgfdgdfg', '2019-12-04 11:18:59', '2019-12-04 11:18:59'),
(95, 'tepers', 23, 23, 0, '9', 'dfdf', '2019-12-04 11:20:54', '2019-12-04 11:21:19'),
(96, 'tepers', 23, 24, 0, '10', 'dfdfd', '2019-12-04 11:20:54', '2019-12-04 11:21:19'),
(97, 'tepers', 23, 21, 1, '7', 'fgfdgdf', '2019-12-04 11:20:56', '2019-12-04 11:21:19'),
(98, 'tepers', 23, 19, 1, '5', 'dfgfdgfdg', '2019-12-04 11:20:56', '2019-12-04 11:21:19'),
(99, 'tepers', 23, 14, 2, 'Question 6', '9', '2019-12-04 11:21:04', '2019-12-04 11:21:19'),
(100, 'tepers', 23, 4, 3, 'Scale', '4', '2019-12-04 11:21:14', '2019-12-04 11:21:19'),
(101, 'tepers', 23, 5, 4, 'Choice', '1', '2019-12-04 11:21:19', '2019-12-04 11:21:19'),
(102, 'tepers', 23, 2, 4, 'Question example 1', 'dfdf', '2019-12-04 11:21:19', '2019-12-04 11:21:19'),
(103, 'shuuma', 24, 23, 0, '9', 'dfgdf', '2019-12-04 11:22:56', '2019-12-04 11:23:14'),
(104, 'shuuma', 24, 24, 0, '10', 'fgfgfg', '2019-12-04 11:22:56', '2019-12-04 11:23:14'),
(105, 'shuuma', 24, 21, 1, '7', 'dsfdsf', '2019-12-04 11:22:58', '2019-12-04 11:23:14'),
(106, 'shuuma', 24, 19, 1, '5', 'dsfdsfdsf', '2019-12-04 11:22:58', '2019-12-04 11:23:14'),
(107, 'shuuma', 24, 14, 2, 'Question 6', '10', '2019-12-04 11:23:06', '2019-12-04 11:23:14'),
(108, 'shuuma', 24, 4, 3, 'Scale', '4', '2019-12-04 11:23:10', '2019-12-04 11:23:14'),
(109, 'shuuma', 24, 5, 4, 'Choice', '2', '2019-12-04 11:23:14', '2019-12-04 11:23:14'),
(110, 'shuuma', 24, 2, 4, 'Question example 1', 'ddd', '2019-12-04 11:23:14', '2019-12-04 11:23:14'),
(111, 'shuuma', 25, 41, 0, 'choive test', 'choice b', '2019-12-04 11:35:47', '2019-12-04 11:35:47'),
(112, 'tepers', 27, 1, 0, 'abs', 'abssssssssssss', '2019-12-06 13:02:29', '2019-12-06 13:06:31'),
(113, 'tepers', 27, 2, 1, 'Question example 1', 'c fr', '2019-12-06 13:06:31', '2019-12-06 13:06:31'),
(114, 'faraju', 27, 1, 0, 'abs', 'fddd', '2019-12-06 13:07:30', NULL),
(115, 'tepers', 28, 1, 0, 'abs', 'Asssizer B Cash', '2019-12-09 04:33:05', '2019-12-09 04:33:29'),
(116, 'tepers', 28, 2, 1, 'Question example 1', 'Answer example 1\r\n', '2019-12-09 04:33:29', '2019-12-09 04:33:29'),
(117, 'tepers', 7, 10, 0, 'Question 2', '4', '2019-12-10 12:16:06', '2019-12-10 12:16:13'),
(118, 'tepers', 7, 9, 1, 'FreeText', 'Hi', '2019-12-10 12:16:10', '2019-12-10 12:16:13'),
(119, 'tepers', 7, 5, 2, 'Choice', '3', '2019-12-10 12:16:13', '2019-12-10 12:16:13'),
(120, 'faraju', 7, 10, 0, 'Question 2', '6', '2019-12-10 12:17:10', NULL),
(121, 'tepers', 44, 25, 0, '11', '1.12', '2019-12-17 09:33:10', '2019-12-17 09:33:31'),
(122, 'tepers', 44, 24, 1, '10', '2.11', '2019-12-17 09:33:15', '2019-12-17 09:33:31'),
(123, 'tepers', 44, 23, 2, '9', '3.10', '2019-12-17 09:33:25', '2019-12-17 09:33:31'),
(124, 'tepers', 44, 21, 3, '7', 'sf', '2019-12-17 09:33:31', '2019-12-17 09:33:31'),
(125, 'tepers', 44, 18, 3, '4', 'sdf', '2019-12-17 09:33:31', '2019-12-17 09:33:31'),
(126, 'tepers', 44, 5, 3, 'Choice', '1', '2019-12-17 09:33:31', '2019-12-17 09:33:31'),
(127, 'tepers', 43, 10, 0, 'Question 2', '4', '2019-12-17 09:34:40', '2019-12-17 09:34:46'),
(128, 'tepers', 43, 9, 1, 'FreeText', 'asd', '2019-12-17 09:34:43', '2019-12-17 09:34:46'),
(129, 'tepers', 43, 5, 2, 'Choice', '3', '2019-12-17 09:34:46', '2019-12-17 09:34:46'),
(130, 'shuuma', 35, 10, 0, 'Question 2', '6', '2019-12-17 10:15:06', '2019-12-17 10:15:16'),
(131, 'shuuma', 35, 9, 1, 'FreeText', 'Who\'se Joe?', '2019-12-17 10:15:13', '2019-12-17 10:15:16'),
(132, 'shuuma', 35, 5, 2, 'Choice', '4', '2019-12-17 10:15:16', '2019-12-17 10:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `survey_user`
--

CREATE TABLE `survey_user` (
  `surveyId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullName` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `surveyUrl` varchar(512) NOT NULL,
  `dateSent` date DEFAULT NULL,
  `dateExpired` date DEFAULT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `reminderMail` tinyint(1) NOT NULL DEFAULT '0',
  `hashSurveyId` varchar(256) NOT NULL,
  `hashUsername` varchar(256) NOT NULL,
  `lastModified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `survey_user`
--

INSERT INTO `survey_user` (`surveyId`, `username`, `fullName`, `email`, `surveyUrl`, `dateSent`, `dateExpired`, `sent`, `reminderMail`, `hashSurveyId`, `hashUsername`, `lastModified`) VALUES
(3, 'ajisre', 'Sreeneebus Ajitesh', 'ajitesh.sreeneebus@mcb.mu', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=eccbc87e4b5ce2fe28308fd9f2a7baf3&username=87811e69bbc00ad00aafcb93e3d1134f', '2019-08-09', '2019-08-24', 1, 1, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '87811e69bbc00ad00aafcb93e3d1134f', '2019-12-04 03:00:10'),
(17, 'bheban', 'Bansropun Bhesham', 'bhesham.bansropun@mcb.mu', 'http://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=70efdf2ec9b086079795c442636b55fb&username=6d8e509c2f6de124323d5224c9f56f2f', NULL, NULL, 0, 0, '70efdf2ec9b086079795c442636b55fb', '6d8e509c2f6de124323d5224c9f56f2f', NULL),
(18, 'bheban', 'Bansropun Bhesham', 'bhesham.bansropun@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=6f4922f45568161a8cdf4ad2299f6d23&username=6d8e509c2f6de124323d5224c9f56f2f', '2019-08-28', '2019-08-30', 1, 1, '6f4922f45568161a8cdf4ad2299f6d23', '6d8e509c2f6de124323d5224c9f56f2f', '2019-12-04 03:00:10'),
(16, 'bhodow', 'Dowtal Bhoomeshwur', 'bhoomeshwur.dowtal@mcb.mu', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=c74d97b01eae257e44aa9d5bade97baf&username=25a008800bede0e143a3c8480e03acf9', '2019-09-11', '2019-09-13', 1, 1, 'c74d97b01eae257e44aa9d5bade97baf', '25a008800bede0e143a3c8480e03acf9', '2019-12-04 03:00:10'),
(17, 'bhodow', 'Dowtal Bhoomeshwur', 'bhoomeshwur.dowtal@mcb.mu', 'http://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=70efdf2ec9b086079795c442636b55fb&username=25a008800bede0e143a3c8480e03acf9', '2019-09-11', '2019-09-13', 1, 1, '70efdf2ec9b086079795c442636b55fb', '25a008800bede0e143a3c8480e03acf9', '2019-12-04 03:00:10'),
(18, 'bhodow', 'Dowtal Bhoomeshwur', 'bhoomeshwur.dowtal@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=6f4922f45568161a8cdf4ad2299f6d23&username=25a008800bede0e143a3c8480e03acf9', '2019-08-28', '2019-08-30', 1, 1, '6f4922f45568161a8cdf4ad2299f6d23', '25a008800bede0e143a3c8480e03acf9', '2019-12-04 03:00:10'),
(19, 'darpal', 'Palaten Darini', 'darini.palaten@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=1f0e3dad99908345f7439f8ffabdffc4&username=25830ee81d6a7d8c21beb4aa5e390c42', NULL, NULL, 0, 0, '1f0e3dad99908345f7439f8ffabdffc4', '25830ee81d6a7d8c21beb4aa5e390c42', NULL),
(26, 'darpal', 'Palaten Darini', 'darpal@mcb.local', 'http://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=4e732ced3463d06de0ca9a15b6153677&username=25830ee81d6a7d8c21beb4aa5e390c42', NULL, NULL, 0, 0, '4e732ced3463d06de0ca9a15b6153677', '25830ee81d6a7d8c21beb4aa5e390c42', NULL),
(3, 'dhatem', 'Consultant - Dharati Tembah', 'consultant-dharati.tembah@mcb.mu', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=eccbc87e4b5ce2fe28308fd9f2a7baf3&username=911f2c0ab7ce22d88cab50ccbf906bf5', '2019-08-09', '2019-08-24', 1, 1, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '911f2c0ab7ce22d88cab50ccbf906bf5', '2019-12-04 03:00:10'),
(1, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=c4ca4238a0b923820dcc509a6f75849b&username=a87fc6e8cb881cdd5ef531bfdf096abb', NULL, NULL, 0, 0, 'c4ca4238a0b923820dcc509a6f75849b', 'a87fc6e8cb881cdd5ef531bfdf096abb', NULL),
(2, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=c81e728d9d4c2f636f067f89cc14862c&username=a87fc6e8cb881cdd5ef531bfdf096abb', NULL, NULL, 0, 0, 'c81e728d9d4c2f636f067f89cc14862c', 'a87fc6e8cb881cdd5ef531bfdf096abb', NULL),
(3, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=eccbc87e4b5ce2fe28308fd9f2a7baf3&username=a87fc6e8cb881cdd5ef531bfdf096abb', NULL, NULL, 0, 0, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'a87fc6e8cb881cdd5ef531bfdf096abb', NULL),
(4, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=a87ff679a2f3e71d9181a67b7542122c&username=a87fc6e8cb881cdd5ef531bfdf096abb', '2019-08-09', '2019-08-24', 1, 1, 'a87ff679a2f3e71d9181a67b7542122c', 'a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-04 03:00:10'),
(7, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=8f14e45fceea167a5a36dedd4bea2543&username=a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-10', '2019-12-25', 1, 0, '8f14e45fceea167a5a36dedd4bea2543', 'a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-10 12:15:38'),
(20, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=98f13708210194c475687be6106a3b84&username=a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-04', '2019-12-06', 1, 1, '98f13708210194c475687be6106a3b84', 'a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-05 03:00:08'),
(21, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=3c59dc048e8850243be8079a5c74d079&username=a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-04', '2019-12-06', 1, 1, '3c59dc048e8850243be8079a5c74d079', 'a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-05 03:00:08'),
(26, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'http://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=4e732ced3463d06de0ca9a15b6153677&username=a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-06', '2019-12-21', 1, 0, '4e732ced3463d06de0ca9a15b6153677', 'a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-06 10:50:26'),
(28, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=33e75ff09dd601bbe69f351039152189&username=a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-06', '2019-12-21', 1, 0, '33e75ff09dd601bbe69f351039152189', 'a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-06 11:56:46'),
(29, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=6ea9ab1baa0efb9e19094440c317e21b&username=a87fc6e8cb881cdd5ef531bfdf096abb', '2019-11-06', '2019-12-21', 1, 0, '6ea9ab1baa0efb9e19094440c317e21b', 'a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-06 11:59:05'),
(31, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=c16a5320fa475530d9583c34fd356ef5&username=a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-09', '2019-12-24', 1, 0, 'c16a5320fa475530d9583c34fd356ef5', 'a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-09 07:42:20'),
(32, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=6364d3f0f495b6ab9dcf8d3b5c6e0b01&username=a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-09', '2019-12-08', 1, 1, '6364d3f0f495b6ab9dcf8d3b5c6e0b01', 'a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-09 10:28:11'),
(33, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=182be0c5cdcd5072bb1864cdee4d3d6e&username=a87fc6e8cb881cdd5ef531bfdf096abb', NULL, NULL, 0, 0, '182be0c5cdcd5072bb1864cdee4d3d6e', 'a87fc6e8cb881cdd5ef531bfdf096abb', NULL),
(44, 'faraju', 'Ajubtally Fardeenah', 'fardeenah.ajubtally@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=f7177163c833dff4b38fc8d2872f1ec6&username=a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-17', '2020-01-01', 1, 0, 'f7177163c833dff4b38fc8d2872f1ec6', 'a87fc6e8cb881cdd5ef531bfdf096abb', '2019-12-17 10:37:50'),
(6, 'kautak', 'Takoor Kaushal', 'kautak@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=1679091c5a880faf6fb5e6087eb1b2dc&username=4d77c95ce3e0f36224b697c83daa39b1', NULL, NULL, 0, 0, '1679091c5a880faf6fb5e6087eb1b2dc', '4d77c95ce3e0f36224b697c83daa39b1', NULL),
(6, 'roodal', 'Oodally Rooksar', 'roodal@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=1679091c5a880faf6fb5e6087eb1b2dc&username=798d147cdd1985715a641fa6e9d5f92a', '2019-08-14', '2019-08-29', 1, 1, '1679091c5a880faf6fb5e6087eb1b2dc', '798d147cdd1985715a641fa6e9d5f92a', '2019-12-04 03:00:10'),
(15, 'roodal', 'Oodally Rooksar', 'roodal@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=9bf31c7ff062936a96d3c8bd1f8f2ff3&username=798d147cdd1985715a641fa6e9d5f92a', '2019-08-15', '2019-08-17', 1, 1, '9bf31c7ff062936a96d3c8bd1f8f2ff3', '798d147cdd1985715a641fa6e9d5f92a', '2019-12-04 03:00:10'),
(3, 'selgoi', 'Consultant - Selvina Goinden', 'consultant-selvina.goinden@mcb.mu', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=eccbc87e4b5ce2fe28308fd9f2a7baf3&username=2ef24a75974a23276be6ba2525f6cddb', '2019-08-14', '2019-08-29', 1, 1, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '2ef24a75974a23276be6ba2525f6cddb', '2019-12-04 03:00:10'),
(6, 'selgoi', 'Consultant - Selvina Goinden', 'consultant-selvina.goinden@mcb.mu', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=1679091c5a880faf6fb5e6087eb1b2dc&username=2ef24a75974a23276be6ba2525f6cddb', NULL, NULL, 0, 0, '1679091c5a880faf6fb5e6087eb1b2dc', '2ef24a75974a23276be6ba2525f6cddb', NULL),
(7, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=8f14e45fceea167a5a36dedd4bea2543&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-09', '2019-12-24', 1, 0, '8f14e45fceea167a5a36dedd4bea2543', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-09 05:23:07'),
(12, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'http://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=c20ad4d76fe97759aa27a0c99bff6710&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-04', '2019-12-06', 1, 1, 'c20ad4d76fe97759aa27a0c99bff6710', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-05 03:00:08'),
(13, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'http://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=c51ce410c124a10e0db5e4b97fc2af39&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-04', '2019-12-06', 1, 1, 'c51ce410c124a10e0db5e4b97fc2af39', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-05 03:00:08'),
(20, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=98f13708210194c475687be6106a3b84&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-04', '2019-12-06', 1, 1, '98f13708210194c475687be6106a3b84', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-05 03:00:08'),
(21, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=3c59dc048e8850243be8079a5c74d079&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-04', '2019-12-06', 1, 1, '3c59dc048e8850243be8079a5c74d079', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-05 03:00:08'),
(22, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=b6d767d2f8ed5d21a44b0e5886680cb9&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-04', '2019-12-06', 1, 1, 'b6d767d2f8ed5d21a44b0e5886680cb9', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-05 03:00:08'),
(23, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=37693cfc748049e45d87b8c7d8b9aacd&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-04', '2019-12-06', 1, 1, '37693cfc748049e45d87b8c7d8b9aacd', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-05 03:00:08'),
(24, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=1ff1de774005f8da13f42943881c655f&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-04', '2019-12-02', 1, 1, '1ff1de774005f8da13f42943881c655f', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-05 03:00:08'),
(25, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=8e296a067a37563370ded05f5a3bf3ec&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-04', '2019-12-03', 1, 1, '8e296a067a37563370ded05f5a3bf3ec', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-05 03:00:08'),
(26, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'http://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=4e732ced3463d06de0ca9a15b6153677&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-06', '2019-12-22', 1, 0, '4e732ced3463d06de0ca9a15b6153677', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-06 10:46:27'),
(29, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=6ea9ab1baa0efb9e19094440c317e21b&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-06', '2019-12-21', 1, 0, '6ea9ab1baa0efb9e19094440c317e21b', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-06 11:58:27'),
(30, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=34173cb38f07f89ddbebc2ac9128303f&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-09', '2019-12-24', 1, 0, '34173cb38f07f89ddbebc2ac9128303f', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-09 09:30:00'),
(31, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=c16a5320fa475530d9583c34fd356ef5&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-09', '2019-12-24', 1, 0, 'c16a5320fa475530d9583c34fd356ef5', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-09 07:43:33'),
(33, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=182be0c5cdcd5072bb1864cdee4d3d6e&username=1127856d82a962c4ef7eb43afeaf48c5', NULL, NULL, 0, 0, '182be0c5cdcd5072bb1864cdee4d3d6e', '1127856d82a962c4ef7eb43afeaf48c5', NULL),
(35, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=1c383cd30b7c298ab50293adfecb7b18&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-17', '2020-01-01', 1, 0, '1c383cd30b7c298ab50293adfecb7b18', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-17 10:12:54'),
(37, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=a5bfc9e07964f8dddeb95fc584cd965d&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13', '2019-12-12', 1, 1, 'a5bfc9e07964f8dddeb95fc584cd965d', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13 08:36:53'),
(38, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=a5771bce93e200c36f7cd9dfd0e5deaa&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13', '2019-12-28', 1, 0, 'a5771bce93e200c36f7cd9dfd0e5deaa', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13 10:10:29'),
(39, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=d67d8ab4f4c10bf22aa353e27879133c&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13', '2019-12-12', 1, 1, 'd67d8ab4f4c10bf22aa353e27879133c', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13 10:13:54'),
(40, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=d645920e395fedad7bbbed0eca3fe2e0&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13', '2019-12-28', 1, 0, 'd645920e395fedad7bbbed0eca3fe2e0', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13 10:15:57'),
(41, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=3416a75f4cea9109507cacd8e2f2aefc&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13', '2019-12-14', 1, 1, '3416a75f4cea9109507cacd8e2f2aefc', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13 10:20:10'),
(42, 'shuuma', 'Umarkhan Shujaat', 'shujaat.umarkhan@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=a1d0c6e83f027327d8461063f4ac58a6&username=1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13', '2019-12-28', 1, 0, 'a1d0c6e83f027327d8461063f4ac58a6', '1127856d82a962c4ef7eb43afeaf48c5', '2019-12-13 10:21:26'),
(3, 'swesoo', 'Soondar Sweta', 'swesoo@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=eccbc87e4b5ce2fe28308fd9f2a7baf3&username=f652ec19b51677a30ae79ed1b1da9c87', '2019-08-09', '2019-08-24', 1, 1, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'f652ec19b51677a30ae79ed1b1da9c87', '2019-12-04 03:00:10'),
(5, 'swesoo', 'Soondar Sweta', 'swesoo@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=e4da3b7fbbce2345d7772b0674a318d5&username=f652ec19b51677a30ae79ed1b1da9c87', NULL, NULL, 0, 0, 'e4da3b7fbbce2345d7772b0674a318d5', 'f652ec19b51677a30ae79ed1b1da9c87', NULL),
(6, 'swesoo', 'Soondar Sweta', 'swesoo@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=1679091c5a880faf6fb5e6087eb1b2dc&username=f652ec19b51677a30ae79ed1b1da9c87', '2019-08-14', '2019-08-29', 1, 1, '1679091c5a880faf6fb5e6087eb1b2dc', 'f652ec19b51677a30ae79ed1b1da9c87', '2019-12-04 03:00:10'),
(8, 'swesoo', 'Soondar Sweta', 'swesoo@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=c9f0f895fb98ab9159f51fd0297e236d&username=f652ec19b51677a30ae79ed1b1da9c87', NULL, NULL, 0, 0, 'c9f0f895fb98ab9159f51fd0297e236d', 'f652ec19b51677a30ae79ed1b1da9c87', NULL),
(9, 'swesoo', 'Soondar Sweta', 'swesoo@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=45c48cce2e2d7fbdea1afc51c7c6ad26&username=f652ec19b51677a30ae79ed1b1da9c87', NULL, NULL, 0, 0, '45c48cce2e2d7fbdea1afc51c7c6ad26', 'f652ec19b51677a30ae79ed1b1da9c87', NULL),
(10, 'swesoo', 'Soondar Sweta', 'swesoo@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=d3d9446802a44259755d38e6d163e820&username=f652ec19b51677a30ae79ed1b1da9c87', NULL, NULL, 0, 0, 'd3d9446802a44259755d38e6d163e820', 'f652ec19b51677a30ae79ed1b1da9c87', NULL),
(11, 'swesoo', 'Soondar Sweta', 'swesoo@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=6512bd43d9caa6e02c990b0a82652dca&username=f652ec19b51677a30ae79ed1b1da9c87', NULL, NULL, 0, 0, '6512bd43d9caa6e02c990b0a82652dca', 'f652ec19b51677a30ae79ed1b1da9c87', NULL),
(12, 'swesoo', 'Soondar Sweta', 'swesoo@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=c20ad4d76fe97759aa27a0c99bff6710&username=f652ec19b51677a30ae79ed1b1da9c87', NULL, NULL, 0, 0, 'c20ad4d76fe97759aa27a0c99bff6710', 'f652ec19b51677a30ae79ed1b1da9c87', NULL),
(13, 'swesoo', 'Soondar Sweta', 'swesoo@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=c51ce410c124a10e0db5e4b97fc2af39&username=f652ec19b51677a30ae79ed1b1da9c87', NULL, NULL, 0, 0, 'c51ce410c124a10e0db5e4b97fc2af39', 'f652ec19b51677a30ae79ed1b1da9c87', NULL),
(14, 'swesoo', 'Soondar Sweta', 'swesoo@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=aab3238922bcc25a6f606eb525ffdc56&username=f652ec19b51677a30ae79ed1b1da9c87', '2019-08-21', '2019-08-23', 1, 1, 'aab3238922bcc25a6f606eb525ffdc56', 'f652ec19b51677a30ae79ed1b1da9c87', '2019-12-04 03:00:10'),
(15, 'swesoo', 'Soondar Sweta', 'swesoo@mcb.local', 'http://10.121.1.222:8080/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=9bf31c7ff062936a96d3c8bd1f8f2ff3&username=f652ec19b51677a30ae79ed1b1da9c87', '2019-08-14', '2019-08-16', 1, 1, '9bf31c7ff062936a96d3c8bd1f8f2ff3', 'f652ec19b51677a30ae79ed1b1da9c87', '2019-12-04 03:00:10'),
(7, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=8f14e45fceea167a5a36dedd4bea2543&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-10', '2019-12-25', 1, 0, '8f14e45fceea167a5a36dedd4bea2543', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-10 12:15:38'),
(20, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=98f13708210194c475687be6106a3b84&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-04', '2019-12-06', 1, 1, '98f13708210194c475687be6106a3b84', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-05 03:00:08'),
(25, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'http://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=8e296a067a37563370ded05f5a3bf3ec&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-05', '2019-12-05', 1, 1, '8e296a067a37563370ded05f5a3bf3ec', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-06 03:00:02'),
(26, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=4e732ced3463d06de0ca9a15b6153677&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-10', '2019-12-12', 1, 1, '4e732ced3463d06de0ca9a15b6153677', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-06 10:29:48'),
(27, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=02e74f10e0327ad868d138f2b4fdd6f0&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-06', '2019-12-21', 1, 0, '02e74f10e0327ad868d138f2b4fdd6f0', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-06 11:55:18'),
(28, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=33e75ff09dd601bbe69f351039152189&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-08', '2019-12-23', 1, 0, '33e75ff09dd601bbe69f351039152189', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-08 03:00:03'),
(29, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=6ea9ab1baa0efb9e19094440c317e21b&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-11-10', '2019-12-25', 1, 0, '6ea9ab1baa0efb9e19094440c317e21b', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-09 05:08:43'),
(31, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=c16a5320fa475530d9583c34fd356ef5&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-09', '2019-12-24', 1, 0, 'c16a5320fa475530d9583c34fd356ef5', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-09 07:42:20'),
(32, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=6364d3f0f495b6ab9dcf8d3b5c6e0b01&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-09', '2019-12-08', 1, 1, '6364d3f0f495b6ab9dcf8d3b5c6e0b01', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-09 10:28:11'),
(33, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=182be0c5cdcd5072bb1864cdee4d3d6e&username=744dfe6aeb5e8281aaa22b095f2b34c8', NULL, NULL, 0, 0, '182be0c5cdcd5072bb1864cdee4d3d6e', '744dfe6aeb5e8281aaa22b095f2b34c8', NULL),
(34, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=e369853df766fa44e1ed0ff613f563bd&username=744dfe6aeb5e8281aaa22b095f2b34c8', NULL, NULL, 0, 0, 'e369853df766fa44e1ed0ff613f563bd', '744dfe6aeb5e8281aaa22b095f2b34c8', NULL),
(36, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=19ca14e7ea6328a42e0eb13d585e4c22&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-17', '2020-01-01', 1, 0, '19ca14e7ea6328a42e0eb13d585e4c22', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-17 09:39:33'),
(43, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=17e62166fc8586dfa4d1bc0e1742c08b&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-17', '2020-01-01', 1, 0, '17e62166fc8586dfa4d1bc0e1742c08b', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-17 09:34:24'),
(44, 'tepers', 'Persand Teeshan', 'teeshan.persand@mcb.mu', 'https://devtswebapp/TestingServices/CustomerFeedBack/User/respondSurvey.php?surveyId=f7177163c833dff4b38fc8d2872f1ec6&username=744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-17', '2020-01-01', 1, 0, 'f7177163c833dff4b38fc8d2872f1ec6', '744dfe6aeb5e8281aaa22b095f2b34c8', '2019-12-17 09:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `templateId` int(11) NOT NULL,
  `templateName` varchar(100) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cycleId` int(11) NOT NULL,
  `createdBy` varchar(256) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`templateId`, `templateName`, `dateCreated`, `cycleId`, `createdBy`, `deleted`) VALUES
(1, 's', '2019-08-09 04:43:15', 1, 'faraju', 0),
(2, 'Template example', '2019-08-09 07:16:17', 1, 'tepers', 1),
(3, 'Template 1', '2019-08-13 07:34:28', 1, 'swesoo', 1),
(4, 'SIT template', '2019-08-14 05:30:52', 1, 'swesoo', 0),
(5, 'Issues', '2019-08-14 07:30:41', 2, 'swesoo', 0),
(6, 'Release', '2019-08-14 07:31:35', 1, 'swesoo', 0),
(7, 'SIT', '2019-08-14 07:31:58', 1, 'swesoo', 0),
(8, 'UAT', '2019-08-14 07:32:24', 2, 'swesoo', 0),
(9, 'TEST', '2019-08-14 07:34:43', 2, 'swesoo', 0),
(10, 'TEST2', '2019-08-14 07:34:55', 2, 'swesoo', 0),
(11, 'TEST3', '2019-08-14 07:35:15', 1, 'swesoo', 0),
(12, 'TEST4', '2019-08-14 07:35:33', 1, 'swesoo', 1),
(13, 'TEST5', '2019-08-14 07:35:54', 2, 'swesoo', 1),
(14, 'testing04122019', '2019-12-04 09:43:56', 1, 'shuuma', 0),
(15, 'Default', '2019-12-04 10:14:05', 2, 'shuuma', 0),
(16, 'New template', '2019-12-04 10:33:39', 1, 'shuuma', 0),
(17, 'choice test', '2019-12-04 11:34:42', 1, 'shuuma', 0),
(18, 'template one', '2019-12-16 10:50:32', 3, 'faraju', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`);

--
-- Indexes for table `cycle`
--
ALTER TABLE `cycle`
  ADD PRIMARY KEY (`cycleId`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectId`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`questionId`),
  ADD KEY `questionTypeId` (`questionTypeId`);

--
-- Indexes for table `question_possible_answer`
--
ALTER TABLE `question_possible_answer`
  ADD PRIMARY KEY (`questionId`,`possibleAnswer`);

--
-- Indexes for table `question_template`
--
ALTER TABLE `question_template`
  ADD PRIMARY KEY (`questionId`,`templateId`),
  ADD KEY `templateId` (`templateId`);

--
-- Indexes for table `question_type`
--
ALTER TABLE `question_type`
  ADD PRIMARY KEY (`questionTypeId`);

--
-- Indexes for table `scale_label`
--
ALTER TABLE `scale_label`
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`surveyId`),
  ADD KEY `projectId` (`projectId`),
  ADD KEY `templateId` (`templateId`);

--
-- Indexes for table `survey_answer`
--
ALTER TABLE `survey_answer`
  ADD PRIMARY KEY (`surveyAnswerId`),
  ADD KEY `surveyId` (`surveyId`,`username`);

--
-- Indexes for table `survey_user`
--
ALTER TABLE `survey_user`
  ADD PRIMARY KEY (`username`,`surveyId`),
  ADD KEY `surveyId` (`surveyId`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`templateId`),
  ADD KEY `cycleId` (`cycleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cycle`
--
ALTER TABLE `cycle`
  MODIFY `cycleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `projectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `questionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `question_type`
--
ALTER TABLE `question_type`
  MODIFY `questionTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `surveyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `survey_answer`
--
ALTER TABLE `survey_answer`
  MODIFY `surveyAnswerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `templateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`questionTypeId`) REFERENCES `question_type` (`questionTypeId`) ON UPDATE CASCADE;

--
-- Constraints for table `question_possible_answer`
--
ALTER TABLE `question_possible_answer`
  ADD CONSTRAINT `question_possible_answer_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `question` (`questionId`);

--
-- Constraints for table `question_template`
--
ALTER TABLE `question_template`
  ADD CONSTRAINT `question_template_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `question` (`questionId`),
  ADD CONSTRAINT `question_template_ibfk_2` FOREIGN KEY (`templateId`) REFERENCES `template` (`templateId`);

--
-- Constraints for table `scale_label`
--
ALTER TABLE `scale_label`
  ADD CONSTRAINT `scale_label_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `question` (`questionId`);

--
-- Constraints for table `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`projectId`) REFERENCES `project` (`projectId`),
  ADD CONSTRAINT `survey_ibfk_2` FOREIGN KEY (`templateId`) REFERENCES `template` (`templateId`);

--
-- Constraints for table `survey_answer`
--
ALTER TABLE `survey_answer`
  ADD CONSTRAINT `survey_answer_ibfk_1` FOREIGN KEY (`surveyId`) REFERENCES `survey_user` (`surveyId`);

--
-- Constraints for table `survey_user`
--
ALTER TABLE `survey_user`
  ADD CONSTRAINT `survey_user_ibfk_1` FOREIGN KEY (`surveyId`) REFERENCES `survey` (`surveyId`);

--
-- Constraints for table `template`
--
ALTER TABLE `template`
  ADD CONSTRAINT `template_ibfk_1` FOREIGN KEY (`cycleId`) REFERENCES `cycle` (`cycleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
