CREATE TABLE `client_coach` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CID` int(11) NOT NULL DEFAULT 0 ,
  `StaffID` int(11) NOT NULL DEFAULT 0 ,
  `AddUserID`  int(11) NOT NULL DEFAULT 0 ,
  `ItemID`  int(11) NOT NULL DEFAULT 0 ,
  `StartDate` date NOT NULL DEFAULT '0000-00-00',
  `EndDate` date NOT NULL DEFAULT '0000-00-00',
  `StartTime` varchar(8) NOT NULL DEFAULT '',
  `DueHour` int(11) NOT NULL DEFAULT 0,
  `FreqWeek` varchar(32) NOT NULL DEFAULT '',
  `Fee` decimal(9,2) NOT NULL DEFAULT 0.00,
  `AddTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `CID` (`CID`),
  KEY `StaffID` (`StaffID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

alter table client_coach add column Note text;

 alter table client_account modify ACC_TYPE enum('visa', 'legal', 'coach');

CREATE TABLE `coach_item` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL DEFAULT '',
  `ParentID` int(11) NOT NULL DEFAULT 0 ,
  `Fee` decimal(9,2) NOT NULL DEFAULT 0.00,
  `AddTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Title` (`Title`),
  KEY `ParentID` (`ParentID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



insert into coach_item (ID, Title, ParentID) values (1, 'English', 0), (2, 'Mathematics', 0), (3, 'English(Yr1 - Yr6)', 1), (4, 'English(Yr7 - Yr10)', 1), (5, 'English Standard', 1), (6, 'English Advanced', 1), (7, 'English Extension 1', 1), (8, 'English Extension 2', 1), (9, 'EAL/D', 1), (10, 'Mathematics(Yr1 - Yr6)', 2), (11, 'Mathematics(Yr7 - Yr10)', 2), (12, 'Mathematics Standard', 2), (13, 'Mathematics Advanced', 2), (14, 'Mathematics Extension 1', 2), (15, 'Mathematics Extension 2', 2);