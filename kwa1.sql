

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

CREATE TABLE IF NOT EXISTS `preferences` (
  `preferencesid` int(11) NOT NULL AUTO_INCREMENT,
  `setting` varchar(25) NOT NULL,
  `category` varchar(10) NOT NULL,
  `value` varchar(100) NOT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
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

CREATE TABLE IF NOT EXISTS `request` (
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
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`requestid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `requestservicecode`
--

CREATE TABLE IF NOT EXISTS `requestservicecode` (
  `requestservicecodeid` int(11) NOT NULL AUTO_INCREMENT,
  `requestid` int(11) DEFAULT NULL,
  `requestcategory` varchar(3) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`requestservicecodeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `statusid` int(11) NOT NULL AUTO_INCREMENT,
  `personid` int(11) DEFAULT NULL,
  `organiationid` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
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

CREATE TABLE IF NOT EXISTS `stdusermenu` (
  `stdusermenuid` int(11) NOT NULL AUTO_INCREMENT,
  `stdname` text NOT NULL,
  `menuname` text NOT NULL,
  `orderfield` int(11) DEFAULT '0',
  `mastermenuid` int(11) NOT NULL DEFAULT '1',
  `title` text,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`stdusermenuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `telephone`
--

CREATE TABLE IF NOT EXISTS `telephone` (
  `telephoneid` int(11) NOT NULL AUTO_INCREMENT,
  `personid` int(11) DEFAULT NULL,
  `organiationid` int(11) DEFAULT NULL,
  `telephonetype` varchar(3) DEFAULT NULL,
  `telephonenumber` varchar(13) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`telephoneid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usermenu`
--

CREATE TABLE IF NOT EXISTS `usermenu` (
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
