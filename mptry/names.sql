-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2016 at 10:21 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mp`
--

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE IF NOT EXISTS `names` (
  `COL 1` int(2) DEFAULT NULL,
  `COL 2` varchar(7) DEFAULT NULL,
  `COL 3` varchar(11) DEFAULT NULL,
  `COL 4` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `names`
--

INSERT INTO `names` (`COL 1`, `COL 2`, `COL 3`, `COL 4`) VALUES
(1, 'AK000N2', 'HUVINHEDGI', 'Krishna'),
(2, 'AK000R3', 'GALGALI', 'Krishna'),
(3, 'AK000V1', 'KURUNDWAD', 'Krishna'),
(4, 'AK000V4', 'ARJUNWAD', 'Krishna'),
(5, 'AK000X6', 'KARAD', 'Krishna'),
(6, 'AKP00B6', 'YADGIR', 'Bhima'),
(7, 'AKP00K4', 'TAKLI', 'Bhima'),
(8, 'AKP00Q4', 'NARSINGPUR', 'Bhima'),
(9, 'AKP00V8', 'DHOND', 'Bhima'),
(10, 'AKP40T4', 'BORIOMERGA', 'Borinala'),
(11, 'AKP60C4', 'WADAKBAL', 'Sina'),
(12, 'AKP70C6', 'KOKANGAON', 'Bornala'),
(13, 'AKP80B8', 'SHIRDHON', 'Doddahalla'),
(14, 'AKPA0C2', 'SARATI', 'Nira'),
(15, 'AKPI0M5', 'JEWANGI', 'Kagna'),
(16, 'AKS00H1', 'CHOLACHGUDA', 'Malaprabha'),
(17, 'AKT00C2', 'BAGALKOT', 'Ghataprabha'),
(18, 'AKT00P9', 'GOKAK FALLS', 'Ghataprabha'),
(19, 'AKT00U8', 'DADDI', 'Ghataprabha'),
(20, 'AKT20C3', 'GOTUR', 'Hiranyakeshi'),
(21, 'AKVI0F4', 'BASTEWADE', 'Vedganga'),
(22, 'AKW00A7', 'TERWAD', 'Panchganga'),
(23, 'AKZ00A7', 'WARUNJI', 'Koyna'),
(24, 'AKZ00L3', 'KOYNA NAGAR', 'Koyna');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
