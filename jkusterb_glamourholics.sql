-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 10, 2017 at 02:03 PM
-- Server version: 10.0.27-MariaDB-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jkusterb_glamourholics`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `custID` int(11) NOT NULL AUTO_INCREMENT,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` text NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip` int(11) NOT NULL,
  `bday` date NOT NULL,
  KEY `custID` (`custID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `fname`, `lname`, `phone`, `street`, `city`, `state`, `zip`, `bday`) VALUES
(35, 'John', 'Bob', '111-111-1111', '103 Texas Ln', 'Dallas', 'TX', 75003, '1970-12-16'),
(36, 'Fiona', 'Cat', '444-444-4444', '666 Princeton Rd', 'Princeton', 'TX', 75407, '2003-01-01'),
(37, 'Clair', 'Daines', '666-666-6666', '789 Round Circle', 'McKinney', 'TX', 75071, '1987-02-13');

-- --------------------------------------------------------

--
-- Table structure for table `pricelist`
--

CREATE TABLE IF NOT EXISTS `pricelist` (
  `service` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pricelist`
--

INSERT INTO `pricelist` (`service`, `price`) VALUES
('Full highlights, cut, & style', 85),
('Partial highlights, cut, & style', 65),
('Highlights & lowlights, cut & style', 90),
('Cut & style', 25),
('Formal style', 60),
('Up-do', 60),
('Professional makeup', 50),
('Olaplex', 20),
('Vivid colors', 20),
('Travel', 25);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `custID` text NOT NULL,
  `service` text NOT NULL,
  `cost` int(11) NOT NULL,
  `serviceDate` date NOT NULL,
  KEY `custID` (`custID`(12))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`custID`, `service`, `cost`, `serviceDate`) VALUES
('444-444-4444', 'Partial highlights, cut, & style', 65, '2017-04-18'),
('444-444-4444', 'Olaplex', 20, '2017-04-18'),
('444-444-4444', 'Vivid colors', 20, '2017-04-18'),
('444-444-4444', 'Professional makeup', 50, '2017-04-18'),
('444-444-4444', 'Up-do', 60, '2017-04-01'),
('444-444-4444', 'Olaplex', 20, '2017-04-01'),
('444-444-4444', 'Travel', 25, '2017-04-01'),
('444-444-4444', 'Highlights & lowlights, cut & style', 90, '2017-04-05'),
('444-444-4444', 'Olaplex', 20, '2017-04-05'),
('444-444-4444', 'Vivid colors', 20, '2017-04-05'),
('444-444-4444', 'Professional makeup', 50, '2017-04-05'),
('111-111-1111', 'Full highlights, cut, & style', 85, '2017-04-16'),
('111-111-1111', 'Travel', 25, '2017-04-16');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
