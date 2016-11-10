-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2014 at 05:00 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressid` int(11) NOT NULL AUTO_INCREMENT,
  `personid` int(11) DEFAULT NULL,
  `organizationid` int(11) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `address1` varchar(30) DEFAULT NULL,
  `address2` varchar(30) DEFAULT NULL,
  `city` varchar(15) DEFAULT NULL,
  `prov` varchar(8) DEFAULT NULL,
  `postalcode` varchar(7) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`addressid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `codesid` int(11) NOT NULL AUTO_INCREMENT,
  `tblname` text NOT NULL,
  `fldname` text NOT NULL,
  `seqno` int(11) NOT NULL DEFAULT '1',
  `code` text NOT NULL,
  `title` text NOT NULL,
  `description` text,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`codesid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`codesid`, `tblname`, `fldname`, `seqno`, `code`, `title`, `description`, `creationdate`, `updatedate`, `updateby`) VALUES
(1, 'person', 'gender', 1, 'm', 'Male', 'A male person', '2013-07-31', '2013-07-31', 'admin'),
(3, 'person', 'gender', 2, 'f', 'Female', 'A female person', '2013-07-31', '2013-07-31', 'admin'),
(4, 'status', 'status', 1, 'disabled', 'Disabled', 'A person with a disability', NULL, NULL, NULL),
(5, 'status', 'status', 2, 'relative', 'Relative', 'Related to a person with a disability', NULL, NULL, NULL),
(6, 'status', 'status', 3, 'staff', 'Staff', 'Staff of KWA', NULL, NULL, NULL),
(7, 'status', 'status', 4, 'volunteer', 'Volunteer', 'Volunteer of KWA', NULL, NULL, NULL),
(8, 'status', 'status', 5, 'director', 'Director ', 'Director of KWA', NULL, NULL, NULL),
(9, 'status', 'status', 6, 'funder', 'Funder', 'A funder of KWA', NULL, NULL, NULL),
(10, 'status', 'status', 7, 'agency', 'Agency', 'A community agency', NULL, NULL, NULL),
(11, 'status', 'status', 9, 'genpub', 'General Public', 'The General Public', NULL, NULL, NULL),
(12, 'status', 'status', 8, 'government', 'Government', 'A government service', NULL, NULL, NULL),
(14, 'status', 'status', 10, 'admin', 'Admin', 'For administration purposes ', NULL, NULL, NULL),
(17, 'membership', 'membership', 1, 'm', 'Member', 'New Description', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `emailid` int(11) NOT NULL AUTO_INCREMENT,
  `personid` int(11) DEFAULT NULL,
  `organiationid` int(11) DEFAULT NULL,
  `emailtype` varchar(3) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`emailid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `logid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(40) DEFAULT NULL,
  `class` varchar(30) DEFAULT NULL,
  `function` varchar(30) DEFAULT NULL,
  `line` varchar(6) DEFAULT NULL,
  `type` varchar(6) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `whatdoing` text,
  `response` text,
  `username` varchar(10) DEFAULT NULL,
  `entrydate` date DEFAULT NULL,
  `entrytime` date DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) NOT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=314 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`logid`, `file`, `class`, `function`, `line`, `type`, `message`, `whatdoing`, `response`, `username`, `entrydate`, `entrytime`, `creationdate`, `updatedate`, `updateby`) VALUES
(1, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(2, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(3, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(4, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(5, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(6, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(7, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(8, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(9, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(10, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(11, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(12, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(13, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(14, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(15, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(16, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(17, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(18, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(19, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(20, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(21, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(22, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(23, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(24, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(25, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(26, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(27, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(28, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(29, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(30, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(31, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(32, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(33, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(34, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(35, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(36, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(37, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(38, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(39, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(40, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(41, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(42, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(43, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(44, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(45, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(46, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(47, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(48, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(49, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(50, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(51, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(52, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(53, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(54, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(55, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(56, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(57, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(60, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(61, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(62, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(63, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(64, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(65, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(66, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(67, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(68, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(69, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(70, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(71, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(72, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(73, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(74, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(75, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(76, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(77, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(78, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(79, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(80, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(81, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(82, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(83, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(84, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(85, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(86, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(87, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(88, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(89, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(90, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(91, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(92, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(93, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(94, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(95, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(96, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(97, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(98, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(99, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(100, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(101, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(102, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(103, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(104, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(105, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(106, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(107, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(108, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(109, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(110, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(111, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(112, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(113, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(114, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(115, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(116, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(117, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(118, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(119, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(120, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(121, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(122, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(123, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(124, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(125, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(126, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(127, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(128, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(129, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(130, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(131, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(132, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(133, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(134, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(135, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(136, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(137, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(138, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(139, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(140, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(141, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(142, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(143, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(144, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(145, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(146, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(147, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(148, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(149, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(150, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(151, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(152, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(153, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(154, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(155, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(156, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(157, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(158, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(159, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(160, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(161, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(162, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(163, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(164, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(165, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(166, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(167, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(168, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(169, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(170, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(171, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(172, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(173, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(174, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(175, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(176, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(177, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(178, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(179, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(180, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(181, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(182, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(183, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(184, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(185, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(186, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(187, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(188, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(189, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(190, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(191, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(192, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(193, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(194, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(195, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(196, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(197, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(198, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(199, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(200, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(201, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(202, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(203, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(204, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(205, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(206, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(207, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(208, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(209, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(210, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(211, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(212, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(213, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(214, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(215, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(216, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(217, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(218, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(219, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(220, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(221, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(222, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(223, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(224, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(225, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(226, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(227, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(228, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(229, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(230, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(231, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(232, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(233, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(234, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(235, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(236, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(237, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(238, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(239, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(240, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(241, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(242, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(243, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(244, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(245, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(246, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(247, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(248, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(249, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(250, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(251, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(252, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(253, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(254, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(255, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(256, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(257, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(258, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(259, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(260, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(261, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(262, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(263, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(264, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(265, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(266, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(267, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(268, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(269, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(270, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(271, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(272, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(273, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(274, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(275, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(276, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(277, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(278, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(279, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(280, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(281, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(282, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(283, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(284, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(285, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(286, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(287, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(288, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(289, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(290, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(291, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(292, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(293, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(294, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(295, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(296, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(297, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(298, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(299, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(300, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(301, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(302, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(303, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(304, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(305, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(306, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(307, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(308, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(309, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(310, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(311, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(312, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(313, 'class.login', 'login', 'check_login_request', '445', 'logged', 'INFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `loginid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personid` int(11) NOT NULL,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `usermenuname` text,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) NOT NULL,
  PRIMARY KEY (`loginid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`loginid`, `personid`, `username`, `password`, `usermenuname`, `creationdate`, `updatedate`, `updateby`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'adminmenu', '2013-05-27', '2013-05-27', 'admin'),
(2, 2, 'guest', '084e0343a0486ff05530df6c705c8bb4', 'guestmenu', '2013-05-27', '2013-05-27', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `mastermenu`
--

CREATE TABLE `mastermenu` (
  `mastermenuid` int(11) NOT NULL AUTO_INCREMENT,
  `menuname` text NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT '1',
  `text` text,
  `link` text,
  `title` text,
  `icon` text,
  `target` text,
  `orderfield` int(11) DEFAULT '0',
  `expanded` tinyint(4) DEFAULT '0',
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`mastermenuid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `mastermenu`
--

INSERT INTO `mastermenu` (`mastermenuid`, `menuname`, `parentid`, `text`, `link`, `title`, `icon`, `target`, `orderfield`, `expanded`, `creationdate`, `updatedate`, `updateby`) VALUES
(1, 'kwamastermenu', 0, 'Organization', '', NULL, NULL, NULL, 300000000, 0, '2013-06-19', '2013-06-19', 'admin'),
(5, 'kwamastermenu', 0, 'Program', '', NULL, NULL, NULL, 400000000, 0, '2013-06-26', '2013-06-26', 'admin'),
(6, 'kwamastermenu', 17, 'Person Profile', 'personprofile.php', NULL, NULL, NULL, 202000000, 0, '2013-06-27', '2013-06-27', 'admin'),
(7, 'kwamastermenu', 17, 'Person Input', 'inputperson.php', NULL, NULL, NULL, 201000000, 0, '2013-06-27', '2013-06-27', 'admin'),
(8, 'kwamastermenu', 19, 'Setup Master Menu', 'setupmastermenu.php', NULL, NULL, NULL, 702000000, 0, '2013-06-27', '2013-06-27', 'admin'),
(12, 'kwamastermenu', 1, 'Organization Input', 'inputorganization.php', NULL, NULL, NULL, 301000000, 0, NULL, NULL, NULL),
(13, 'kwamastermenu', 19, 'Setup Messages', 'setupmessages.php', NULL, NULL, NULL, 704000000, 0, NULL, NULL, NULL),
(14, 'kwamastermenu', 0, 'Home', 'home.php', NULL, NULL, NULL, 100000000, 0, NULL, NULL, NULL),
(17, 'kwamastermenu', 0, 'Person', '', NULL, NULL, NULL, 200000000, 0, NULL, NULL, NULL),
(18, 'kwamastermenu\r\n', 0, 'Request', '', '', NULL, NULL, 600000000, 0, NULL, NULL, NULL),
(19, 'kwamastermenu', 0, 'Administration', NULL, NULL, NULL, NULL, 700000000, 0, NULL, NULL, NULL),
(22, 'kwamastermenu', 19, 'Setup Login', 'setuplogin.php', NULL, NULL, NULL, 701000000, 0, NULL, NULL, NULL),
(23, 'kwamastermenu', 19, 'Setup Codes', 'setupcodes.php', NULL, NULL, NULL, 703000000, 0, NULL, NULL, NULL),
(24, 'kwamastermenu\r\n', 1, 'Organization Profile', 'organizationprofile.php', NULL, NULL, NULL, 302000000, 0, NULL, NULL, NULL),
(25, 'kwamastermenu\r\n', 18, 'Request Input', 'inputrequest.php', NULL, NULL, NULL, 601000000, 0, NULL, NULL, NULL),
(26, 'kwamastermenu', 0, 'Session', '', NULL, NULL, NULL, 500000000, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membershipid` int(11) NOT NULL AUTO_INCREMENT,
  `personid` int(11) DEFAULT NULL,
  `organiationid` int(11) DEFAULT NULL,
  `membership` varchar(3) DEFAULT NULL,
  `expirydate` date NOT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`membershipid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membershipid`, `personid`, `organiationid`, `membership`, `expirydate`, `creationdate`, `updatedate`, `updateby`) VALUES
(1, 1, NULL, 'm', '2014-04-07', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageid` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(10) NOT NULL,
  `code` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) NOT NULL,
  PRIMARY KEY (`messageid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageid`, `category`, `code`, `title`, `description`, `creationdate`, `updatedate`, `updateby`) VALUES
(2, 'login', 'notlogin', 'Not Logged In', 'You are not logged in, please log in', '2011-08-25', '2012-04-16', 'admin'),
(8, 'record', 'recdelete', 'Record Deleted', 'A record has been deleted.', '2011-08-25', '2012-04-16', 'admin'),
(11, 'database', 'error in db', 'Error in the Database', 'A problem while trying to output the table. ', '2012-02-22', '2012-04-20', 'admin'),
(27, 'record', 'recedit', 'Record Edited', 'A record has been edited', '2012-04-18', '2012-04-20', 'admin'),
(34, 'record', ' recadd', 'Record Added', 'A record has added', '2012-04-20', '2012-04-20', 'admin'),
(35, 'login', ' blankfirstname', ' Blank First Name', 'Must have a first name , please re-enter', '2012-04-20', '2012-04-20', 'admin'),
(36, 'login', ' blanklastname', ' Blank Last Name', ' Must have a last name , please re-enter', '2012-04-20', '2012-04-20', 'admin'),
(37, 'login', 'blankpassword ', ' Blank Password', ' Must have a password , please re-enter', '2012-04-20', '2012-04-20', 'admin'),
(38, 'login', 'invalidloginrecord ', 'Invalid Login Record ', 'Login Record for firstname,lastname, password not found', '2012-04-20', '2012-04-20', 'admin'),
(39, 'login', 'blankusername ', 'Blank Username ', ' Must have a UserName , please re- enter', '2012-04-20', '2012-04-20', 'admin'),
(40, 'login', 'passwordchange ', 'Password Change ', ' The password has been changed', '2012-04-20', '2012-04-20', 'admin'),
(41, 'login', 'passwordinvalid ', ' Invalid Password', ' The password entered is invalid, Please re-enter', '2012-04-20', '2012-04-20', 'admin'),
(42, 'login', 'passwordreset ', ' Password Reset', ' The password has been reset', '2012-04-20', '2012-04-20', 'admin'),
(43, 'Menu', 'copy from stdusermen', ' Copy From stdusermenu', ' Records were copied from stdusermenu', '2012-04-26', '2012-04-26', 'admin'),
(44, 'Menu', 'copy to stdusermenu ', 'Copy To stdusermenu ', 'Records were copied to stdusermenu', '2012-04-26', '2012-04-26', 'admin'),
(45, 'record', ' recsave', 'Record Saved', ' A record has been saved', '2012-05-26', '2012-05-26', 'admin'),
(46, 'database', 'datadisplayerror', 'Data Dusplay Error', 'Oops!  a problem while trying to output the table. <a href="javascript:;" onclick="tblReset()">Click here</a> to reset the table or <a href="javascript:;" onclick="alert(\\'''' . preg_replace(''[\\''"]'', '''', $this->db->error()) . ''\\'')">here</a> to review the error.</div>''', '2014-02-13', '2014-02-13', 'admin'),
(47, 'database', 'norows', 'No Rows Found', 'There are no rows found in the table meeting the criteria.', '2014-02-15', '2014-02-15', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `mobilityaid`
--

CREATE TABLE `mobilityaid` (
  `mobilityaidid` int(11) NOT NULL AUTO_INCREMENT,
  `personid` int(11) DEFAULT NULL,
  `mobilityaid` varchar(3) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`mobilityaidid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `noteid` int(11) NOT NULL AUTO_INCREMENT,
  `notestype` varchar(10) DEFAULT NULL,
  `authour` varchar(25) DEFAULT NULL,
  `notedate` date DEFAULT NULL,
  `note` text,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`noteid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orginization`
--

CREATE TABLE `orginization` (
  `organizationid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`organizationid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `personid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `fullname` varchar(52) NOT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `mobilityplusid` varchar(5) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`personid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`personid`, `firstname`, `lastname`, `fullname`, `gender`, `birthdate`, `mobilityplusid`, `creationdate`, `updatedate`, `updateby`) VALUES
(1, 'I am', 'Admin', 'I am Admin', 'm', '2013-07-06', '1', '2013-07-20', '2013-07-20', 'admin'),
(2, 'I am', 'Guest', 'I am Guest', 'm', '2013-07-06', '1', '2013-07-20', '2013-07-20', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `preferencesid` int(11) NOT NULL AUTO_INCREMENT,
  `setting` varchar(25) NOT NULL,
  `category` varchar(10) NOT NULL,
  `value` varchar(100) NOT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(100) DEFAULT 'admin',
  PRIMARY KEY (`preferencesid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`preferencesid`, `setting`, `category`, `value`, `creationdate`, `updatedate`, `updateby`) VALUES
(1, 'type', 'database', 'mysql', NULL, NULL, 'admin'),
(2, 'server', 'database', 'localhost', NULL, NULL, 'admin'),
(3, 'dbname', 'database', 'kwa', NULL, NULL, 'admin'),
(4, 'user', 'database', 'root', NULL, NULL, 'admin'),
(5, 'password', 'database', '', NULL, NULL, 'admin'),
(6, 'port', 'database', '', NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `requestid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `requestor` int(11) DEFAULT NULL,
  `requestdate` date DEFAULT NULL,
  `requesttime` date DEFAULT NULL,
  `receivedby` varchar(25) DEFAULT NULL,
  `refiningdate` date DEFAULT NULL,
  `refiningby` varchar(25) DEFAULT NULL,
  `refiningtimespent` date DEFAULT NULL,
  `gatheringdate` date DEFAULT NULL,
  `gatheringby` varchar(25) DEFAULT NULL,
  `gatheringtimespent` date DEFAULT NULL,
  `presentingdate` date DEFAULT NULL,
  `persentiningby` varchar(25) DEFAULT NULL,
  `presentingtimespent` date DEFAULT NULL,
  `followupdate` date DEFAULT NULL,
  `followupby` varchar(25) DEFAULT NULL,
  `followuptimespent` date DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `accuracy` varchar(3) DEFAULT NULL,
  `utility` varchar(3) DEFAULT NULL,
  `compleyedate` date DEFAULT NULL,
  `completeby` varchar(25) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`requestid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `requestservicecode`
--

CREATE TABLE `requestservicecode` (
  `requestservicecodeid` int(11) NOT NULL AUTO_INCREMENT,
  `requestid` int(11) DEFAULT NULL,
  `requestcategory` varchar(3) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`requestservicecodeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `statusid` int(11) NOT NULL AUTO_INCREMENT,
  `personid` int(11) DEFAULT NULL,
  `organiationid` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`statusid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusid`, `personid`, `organiationid`, `status`, `creationdate`, `updatedate`, `updateby`) VALUES
(1, 1, NULL, 'admin', NULL, NULL, NULL),
(2, 2, NULL, 'admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stdusermenu`
--

CREATE TABLE `stdusermenu` (
  `stdusermenuid` int(11) NOT NULL AUTO_INCREMENT,
  `stdname` text NOT NULL,
  `menuname` text NOT NULL,
  `orderfield` int(11) DEFAULT '0',
  `mastermenuid` int(11) NOT NULL DEFAULT '1',
  `title` text,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`stdusermenuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `telephone`
--

CREATE TABLE `telephone` (
  `telephoneid` int(11) NOT NULL AUTO_INCREMENT,
  `personid` int(11) DEFAULT NULL,
  `organiationid` int(11) DEFAULT NULL,
  `telephonetype` varchar(3) DEFAULT NULL,
  `telephonenumber` varchar(13) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `createdby` varchar(10) DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`telephoneid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usermenu`
--

CREATE TABLE `usermenu` (
  `usermenuid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `menuname` text NOT NULL,
  `orderfield` int(11) DEFAULT '0',
  `mastermenuid` int(11) NOT NULL DEFAULT '1',
  `text` text,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`usermenuid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `usermenu`
--

INSERT INTO `usermenu` (`usermenuid`, `userid`, `menuname`, `orderfield`, `mastermenuid`, `text`, `creationdate`, `updatedate`, `updateby`) VALUES
(2, 1, 'adminmenu', 100000000, 14, 'Home', NULL, NULL, NULL),
(3, 1, 'adminmenu', 200000000, 17, 'Person', NULL, NULL, NULL),
(5, 1, 'adminmenu', 202000000, 6, ' Person Profile', NULL, NULL, NULL),
(6, 1, 'adminmenu', 400000000, 5, '', NULL, NULL, NULL),
(7, 1, 'adminmenu', 600000000, 18, 'Request', NULL, NULL, NULL),
(8, 1, 'adminmenu', 700000000, 19, 'Administration', NULL, NULL, NULL),
(10, 1, 'adminmenu', 701000000, 22, 'Setup Login', NULL, NULL, NULL),
(11, 1, 'adminmenu', 703000000, 23, 'Setup Codes', NULL, NULL, NULL),
(12, 1, 'adminmenu', 704000000, 23, ' Setup Messages', NULL, NULL, NULL),
(13, 1, 'adminmenu', 201000000, 7, ' Person Input', NULL, NULL, NULL),
(14, 1, 'adminmenu', 300000000, 1, ' ', NULL, NULL, NULL),
(15, 1, 'adminmenu', 301000000, 12, 'Organization Input', NULL, NULL, NULL),
(16, 1, 'adminmenu', 302000000, 24, 'Organization Profile', NULL, NULL, NULL),
(18, 1, 'adminmenu', 601000000, 25, 'Request Input', NULL, NULL, NULL),
(20, 1, 'adminmenu', 702000000, 8, 'Setup Master Menu', NULL, NULL, NULL),
(21, 1, 'adminmenu', 500000000, 26, 'Session', NULL, NULL, NULL),
(22, 1, 'adminmenu', 999999999, 8, 'new', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
