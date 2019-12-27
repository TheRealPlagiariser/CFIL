-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 27, 2019 at 12:43 PM
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
-- Database: `teamvelocity`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `hostname` varchar(256) NOT NULL,
  `mailNotificationInterval` int(11) NOT NULL,
  `adminUser` varchar(256) NOT NULL,
  `groupMail` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `cycle`
--

CREATE TABLE `cycle` (
  `cycleId` int(11) NOT NULL,
  `teamId` int(11) NOT NULL,
  `cycleName` varchar(256) NOT NULL,
  `devStartVelocity` int(11) NOT NULL,
  `devEndVelocity` int(11) NOT NULL,
  `qaStartVelocity` int(11) NOT NULL,
  `qaEndVelocity` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `defect`
--

CREATE TABLE `defect` (
  `defectId` int(11) NOT NULL,
  `cycleId` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('SIT','UAT') NOT NULL,
  `fixed` int(11) NOT NULL,
  `wip` int(11) NOT NULL,
  `new` int(11) NOT NULL,
  `closed` int(11) NOT NULL,
  `critical` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `qualityassurance`
--

CREATE TABLE `qualityassurance` (
  `qualityAssuranceId` int(11) NOT NULL,
  `qaUsername` varchar(256) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `requestId` int(11) NOT NULL,
  `teamId` int(11) NOT NULL,
  `cycleId` int(11) DEFAULT NULL,
  `type` varchar(256) NOT NULL,
  `qaUsername` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `progress` enum('NYS','WIP','CPL') NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `taskId` int(11) NOT NULL,
  `cycleId` int(11) NOT NULL,
  `taskName` varchar(256) NOT NULL,
  `taskCompleted` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `teamId` int(11) NOT NULL,
  `teamName` varchar(256) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`teamId`, `teamName`, `deleted`) VALUES
(8, 'sdsd', 0),
(9, 'team1', 0),
(10, 'oom', 0),
(11, 'dsfdsfdsf', 0),
(12, 'dsfdsfdsfdsf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teamqualityassurance`
--

CREATE TABLE `teamqualityassurance` (
  `teamId` int(11) NOT NULL,
  `QualityAssuranceId` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cycle`
--
ALTER TABLE `cycle`
  ADD PRIMARY KEY (`cycleId`,`teamId`),
  ADD KEY `FK_teamId1` (`teamId`);

--
-- Indexes for table `defect`
--
ALTER TABLE `defect`
  ADD PRIMARY KEY (`defectId`,`cycleId`),
  ADD KEY `FK_cycleId1` (`cycleId`);

--
-- Indexes for table `qualityassurance`
--
ALTER TABLE `qualityassurance`
  ADD PRIMARY KEY (`qualityAssuranceId`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`requestId`,`teamId`),
  ADD KEY `FK_teamId2` (`teamId`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`taskId`,`cycleId`),
  ADD KEY `FK_cycleId` (`cycleId`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`teamId`);

--
-- Indexes for table `teamqualityassurance`
--
ALTER TABLE `teamqualityassurance`
  ADD PRIMARY KEY (`teamId`,`QualityAssuranceId`),
  ADD KEY `FK_qualityAnalystId` (`QualityAssuranceId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cycle`
--
ALTER TABLE `cycle`
  MODIFY `cycleId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `defect`
--
ALTER TABLE `defect`
  MODIFY `defectId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qualityassurance`
--
ALTER TABLE `qualityassurance`
  MODIFY `qualityAssuranceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `teamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cycle`
--
ALTER TABLE `cycle`
  ADD CONSTRAINT `FK_teamId1` FOREIGN KEY (`teamId`) REFERENCES `team` (`teamId`);

--
-- Constraints for table `defect`
--
ALTER TABLE `defect`
  ADD CONSTRAINT `FK_cycleId1` FOREIGN KEY (`cycleId`) REFERENCES `cycle` (`cycleId`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `FK_teamId2` FOREIGN KEY (`teamId`) REFERENCES `team` (`teamId`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_cycleId` FOREIGN KEY (`cycleId`) REFERENCES `cycle` (`cycleId`);

--
-- Constraints for table `teamqualityassurance`
--
ALTER TABLE `teamqualityassurance`
  ADD CONSTRAINT `FK_qualityAnalystId` FOREIGN KEY (`QualityAssuranceId`) REFERENCES `qualityassurance` (`qualityAssuranceId`),
  ADD CONSTRAINT `FK_teamId` FOREIGN KEY (`teamId`) REFERENCES `team` (`teamId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
