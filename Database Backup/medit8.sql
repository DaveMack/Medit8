-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2016 at 11:25 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `medit8`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `Email` varchar(254) NOT NULL,
  `Name` varchar(254) NOT NULL,
  `Address` varchar(254) DEFAULT NULL,
  `Gender` tinyint(1) NOT NULL,
  `Age` int(254) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Email`, `Name`, `Address`, `Gender`, `Age`) VALUES
('69urmom@nomail.com', 'Mr colin Drip', '800 Salimandav Place', 0, 19),
('JF1992@hotmail.com', 'Mr Jimmy Fish', '19 Moon Cr', 0, 22),
('pen1539@onmail.com', 'Mr John Johnson', '1405 Jimmy Street', 0, 45),
('sweetbunz@gmail.com', 'Mrs Stephanie Krazi', '192 Kqoal St', 1, 22),
('xXshadowassasinXx12@BLM.com.nz', 'Mr Kingston Kong', '40 Fack Street', 1, 21);

-- --------------------------------------------------------

--
-- Table structure for table `allocations`
--

CREATE TABLE IF NOT EXISTS `allocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Course` int(11) NOT NULL,
  `Account` varchar(254) NOT NULL,
  `Room` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE IF NOT EXISTS `beds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `capacity` int(11) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(254) NOT NULL,
  `Description` varchar(254) DEFAULT NULL,
  `Capacity` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `Duration` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `Name`, `Description`, `Capacity`, `StartDate`, `Duration`) VALUES
(1, 'Introduction to Meditation', 'An introductory course on meditation and how it can help you find the happiness you are missing in life.', 26, '2016-09-26', 10),
(2, 'Meditation in the workplace', 'How to achieve harmony when surrounded by discord.', 26, '2017-02-28', 30),
(3, 'Zen Garden Maintainence', 'Learning to care for the life web. Focuses on bonsai tree care.', 26, '2017-02-28', 3),
(4, 'Introduction to the Chakra', 'A course in controlling the flow of energies within and around ourselves.', 26, '2017-02-28', 30),
(5, 'Reading Auras, and what they say about you', 'The forgotten art of reading the raw energy sounding us all.', 26, '2017-02-28', 10),
(6, 'Achieving inner peace by turning over your power of attorney ', 'An in depth exploration of how the legal system is flawed.', 26, '2017-02-28', 10),
(7, 'Responses to "They''re just appropriating culture for profit"', 'Learning to answer the questions of the uninitiated.', 26, '2017-02-28', 30);

-- --------------------------------------------------------

--
-- Table structure for table `prerequsites`
--

CREATE TABLE IF NOT EXISTS `prerequsites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Postrequisite` int(11) NOT NULL,
  `Prerequisite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
