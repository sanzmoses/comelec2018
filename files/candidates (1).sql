-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2017 at 09:08 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
  `candidate_id` int(24) NOT NULL AUTO_INCREMENT,
  `id_number` varchar(56) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mi` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(50) NOT NULL,
  `partylist` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`candidate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `id_number`, `firstname`, `lastname`, `mi`, `course`, `year`, `partylist`, `position`) VALUES
(1, '14-0121', 'Yvonie', 'Galleto', 'D', 'BA', 3, 'KAAKIBAT', 'President'),
(2, '13-0947', 'Jayvee Angelo', 'Bravo', 'J', 'ENGINEERING', 4, 'KAAKIBAT', 'Vice-president(internal)'),
(3, '14-1244', 'Kymp', 'Amparado', 'Q', 'CHM', 3, 'KAAKIBAT', 'Vice-president(external)'),
(4, '15-0277', 'Ryan Jerome', 'Molejon', 'B', 'ENGINEERING', 2, 'KAAKIBAT', 'Vice-president(finance)'),
(5, '15-0882', 'George', 'Entice', 'G', 'ICT', 2, 'KAAKIBAT', 'Councilor'),
(6, '15-0792', 'Earl John', 'Talledo', 'G', 'ICT', 2, 'KAAKIBAT', 'Councilor'),
(7, '14-0437', 'Meaniza', 'Tambaluwan', 'T', 'EDUC', 3, 'KAAKIBAT', 'Councilor'),
(8, '15-0005', 'Aika', 'Rocha', 'A', 'EDUC', 2, 'KAAKIBAT', 'Councilor'),
(9, '14-0010', 'Jean', 'Salarda', 'A', 'BA', 3, 'KAAKIBAT', 'Councilor'),
(10, '15-1359', 'Jim Brixter', 'Rosales', 'R', 'BA', 2, 'KAAKIBAT', 'Councilor'),
(11, '14-0770', 'Roxsanne', 'Severino', 'O', 'CHM', 3, 'KAAKIBAT', 'Councilor'),
(12, '14-0826', 'Gerald', 'Pauyon', 'S', 'ENGINEERING', 4, 'KAAKIBAT', 'Councilor'),
(13, '15-0178', 'Philip John', 'Sigaton', 'S', 'BA', 2, 'KAAKIBAT', 'Councilor'),
(14, '15-0296', 'Justine Marie', 'Rabuya', 'B', 'CHM', 2, 'KAAKIBAT', 'Councilor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
