-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2014 at 05:29 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `college`
--
CREATE DATABASE IF NOT EXISTS `college` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `college`;

-- --------------------------------------------------------

--
-- Table structure for table `academicyears`
--

CREATE TABLE IF NOT EXISTS `academicyears` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `ayear_id` varchar(20) NOT NULL,
  `ayear_name` varchar(25) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `academicyears`
--

INSERT INTO `academicyears` (`aid`, `ayear_id`, `ayear_name`) VALUES
(1, 'AYID1', '2014-2015'),
(2, 'AYID2', '2015-2016');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `sno` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1002 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`sno`, `user_name`, `password`, `phone`, `message`, `last_login`) VALUES
(1001, 'admin', '21232f297a57a5a743894a0e4a801fc3', '9247977270', 'Rre7pQRY', '2014-12-23 07:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE IF NOT EXISTS `batches` (
  `btno` int(11) NOT NULL AUTO_INCREMENT,
  `btid` varchar(20) NOT NULL,
  `btname` varchar(225) NOT NULL,
  PRIMARY KEY (`btno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`btno`, `btid`, `btname`) VALUES
(1, 'BTID1', '2014-2016'),
(2, 'BTID2', '2014-2018'),
(3, 'BTID3', '2014-2017');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `brno` int(11) NOT NULL AUTO_INCREMENT,
  `brid` varchar(20) NOT NULL,
  `degree` varchar(20) NOT NULL,
  `brname` varchar(255) NOT NULL,
  PRIMARY KEY (`brno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`brno`, `brid`, `degree`, `brname`) VALUES
(1, 'BRID1', 'Intermediate', 'M.P.C'),
(4, 'BRID4', 'Intermediate', 'M.E.C'),
(6, 'BRID6', 'Intermediate', 'C.E.C'),
(7, 'BRID7', 'Intermediate', 'Bi.P.C'),
(8, 'BRID8', 'Degree', 'B.Sc'),
(9, 'BRID9', 'Degree', 'B.Com'),
(10, 'BRID10', 'Degree', 'B.Ed');

-- --------------------------------------------------------

--
-- Table structure for table `concessions`
--

CREATE TABLE IF NOT EXISTS `concessions` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(20) NOT NULL,
  `ed_level` varchar(30) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `year` varchar(20) NOT NULL,
  `ayear` varchar(30) NOT NULL,
  `totalFee` int(11) NOT NULL,
  `cFee` int(11) NOT NULL,
  `nFee` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `posted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `concessions`
--

INSERT INTO `concessions` (`cid`, `sid`, `ed_level`, `branch`, `year`, `ayear`, `totalFee`, `cFee`, `nFee`, `paid`, `due`, `posted_on`, `updated_on`, `date`) VALUES
(1, 'JC1001', 'Intermediate', 'M.P.C', 'I Year', '2014-2015', 12000, 1000, 11000, 11000, 0, '2014-12-13 17:06:38', '2014-12-21 16:08:11', '2014-12-13'),
(2, 'JC1002', 'Degree', 'B.Sc', 'I Year', '2014-2015', 10000, 500, 9500, 7500, 2000, '2014-12-13 17:07:03', '2014-12-22 15:32:55', '2014-12-13'),
(3, 'JC1003', 'Degree', 'B.Com', 'I Year', '2014-2015', 11000, 1000, 10000, 10000, 0, '2014-12-21 15:11:31', '2014-12-23 12:02:17', '2014-12-21'),
(4, 'JC1001', 'Intermediate', 'M.P.C', 'II Year', '2015-2016', 14000, 1000, 13000, 1500, 11500, '2014-12-22 15:30:23', '2014-12-22 15:31:24', '2014-12-22'),
(5, 'JC1003', 'Degree', 'B.Com', 'II Year', '2015-2016', 13000, 1000, 12000, 3000, 9000, '2014-12-23 10:34:34', '2014-12-23 12:04:56', '2014-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `sno` int(5) NOT NULL AUTO_INCREMENT,
  `edlevel` varchar(25) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `fee` int(11) NOT NULL,
  `tfee` int(11) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`sno`, `edlevel`, `branch`, `year`, `fee`, `tfee`) VALUES
(4, 'Intermediate', 'C.E.C', 'II Year', 1000, 7500),
(5, 'Intermediate', 'M.P.C', 'II Year', 1000, 13000),
(6, 'Intermediate', 'M.P.C', 'I Year', 1000, 11000),
(7, 'Intermediate', 'C.E.C', 'I Year', 1000, 6000),
(8, 'Intermediate', 'M.E.C', 'I Year', 1000, 7000),
(9, 'Intermediate', 'M.E.C', 'II Year', 1000, 8500),
(10, 'Intermediate', 'Bi.P.C', 'I Year', 1000, 12500),
(11, 'Intermediate', 'Bi.P.C', 'II Year', 1000, 14500),
(12, 'Degree', 'B.Sc', 'I Year', 1500, 8500),
(13, 'Degree', 'B.Sc', 'II Year', 1500, 10500),
(14, 'Degree', 'B.Sc', 'III Year', 1500, 12500),
(15, 'Degree', 'B.Com', 'I Year', 1500, 9500),
(16, 'Degree', 'B.Com', 'II Year', 1500, 11500),
(17, 'Degree', 'B.Com', 'III Year', 1500, 13500),
(18, 'Degree', 'B.Ed', 'I Year', 1500, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `rid` varchar(20) NOT NULL,
  `sid` varchar(20) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `year` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `pay_date` datetime NOT NULL,
  `edlevel` varchar(30) NOT NULL,
  `ayear` varchar(30) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`sno`, `rid`, `sid`, `branch`, `year`, `amount`, `date`, `pay_date`, `edlevel`, `ayear`) VALUES
(1, 'RCID1', 'JC1001', 'M.P.C', 'I Year', 3500, '2014-12-13', '2014-12-13 17:07:34', 'Intermediate', '2014-2015'),
(2, 'RCID2', 'JC1002', 'B.Sc', 'I Year', 2000, '2014-12-13', '2014-12-13 17:08:09', 'Degree', '2014-2015'),
(3, 'RCID3', 'JC1001', 'M.P.C', 'I Year', 2500, '2014-12-14', '2014-12-14 08:42:21', 'Intermediate', '2014-2015'),
(4, 'RCID4', 'JC1001', 'M.P.C', 'I Year', 5000, '2014-12-21', '2014-12-21 16:08:11', 'Intermediate', '2014-2015'),
(5, 'RCID5', 'JC1002', 'B.Sc', 'I Year', 5000, '2014-12-22', '2014-12-22 15:28:05', 'Degree', '2014-2015'),
(6, 'RCID6', 'JC1001', 'M.P.C', 'II Year', 1500, '2014-12-22', '2014-12-22 15:31:24', 'Intermediate', '2015-2016'),
(7, 'RCID7', 'JC1002', 'B.Sc', 'I Year', 500, '2014-12-22', '2014-12-22 15:32:55', 'Degree', '2014-2015'),
(8, 'RCID8', 'JC1003', 'B.Com', 'I Year', 1500, '2014-12-23', '2014-12-23 10:55:18', 'Degree', '2014-2015'),
(9, 'RCID9', 'JC1003', 'B.Com', 'I Year', 1000, '2014-12-23', '2014-12-23 11:34:33', 'Degree', '2014-2015'),
(10, 'RCID10', 'JC1003', 'B.Com', 'I Year', 1500, '2014-12-23', '2014-12-23 12:01:25', 'Degree', '2014-2015'),
(11, 'RCID11', 'JC1003', 'B.Com', 'I Year', 6000, '2014-12-23', '2014-12-23 12:02:17', 'Degree', '2014-2015'),
(12, 'RCID12', 'JC1003', 'B.Com', 'II Year', 500, '2014-12-23', '2014-12-23 12:03:20', 'Degree', '2015-2016'),
(13, 'RCID13', 'JC1003', 'B.Com', 'II Year', 1000, '2014-12-23', '2014-12-23 12:04:09', 'Degree', '2015-2016'),
(14, 'RCID14', 'JC1003', 'B.Com', 'II Year', 1500, '2014-12-23', '2014-12-23 12:04:56', 'Degree', '2015-2016');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_no` varchar(20) NOT NULL,
  `ad_date` date NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `ed_level` varchar(100) NOT NULL,
  `batch` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `phone1` varchar(20) NOT NULL,
  `phone2` varchar(20) NOT NULL,
  `address` longtext NOT NULL,
  `photo` varchar(255) NOT NULL,
  `insert_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `caste` varchar(255) NOT NULL,
  `subcaste` varchar(255) NOT NULL,
  `adar_no` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1005 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `ad_no`, `ad_date`, `student_name`, `father_name`, `ed_level`, `batch`, `branch`, `phone1`, `phone2`, `address`, `photo`, `insert_on`, `update_on`, `mother_name`, `dob`, `caste`, `subcaste`, `adar_no`) VALUES
(1001, 'JC1001', '2014-12-13', 'prudhvi', 'rama krishna', 'Intermediate', '2014-2016', 'M.P.C', '9247977270', 'Nill', 'Basavataraka Nagar, Vijayawada.', 'students/JC1001Chrysanthemum.jpg', '2014-12-13 17:03:20', '2014-12-21 17:38:19', 'Neeraja', '1989-10-05', 'Vysya', 'Vysya-OC', '1155778844661234'),
(1002, 'JC1002', '2014-12-13', 'pavan', 'Lakshman Rao', 'Degree', '2014-2018', 'B.Sc', '9296559248', '8125549248', 'Moghalrajpuram, Vijayawada.', 'students/JC1002Desert.jpg', '2014-12-13 17:05:07', '2014-12-21 17:39:50', 'Lakshmi', '1991-08-27', 'Naidu', 'Padmasali', '556677889912587963'),
(1003, 'JC1003', '2014-12-21', 'swapna', 'kiran', 'Degree', '2014-2016', 'B.Com', '7799444358', '9296559243', 'Near Bus Station, Boduppal, Hyderabad.', 'students/JC1003Penguins.jpg', '2014-12-21 13:43:30', '2014-12-21 17:41:04', 'Jyothi', '1990-06-14', 'Reddy', 'Reddy BC', '7894561254789632'),
(1004, 'JC1004', '2014-12-21', 'narasimha', 'raghu', 'Degree', '2014-2016', 'B.Sc', '9666699084', '8143549967', 'Sai Mahal Center, Vuyyuru.', 'students/JC1004Koala.jpg', '2014-12-21 17:18:36', '2014-12-21 17:37:06', 'meena', '1990-05-18', 'Naidu', 'Naidu OC', '1547712356987456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
