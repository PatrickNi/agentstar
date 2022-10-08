CREATE TABLE `checklist_meta` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Item` varchar(255) NOT NULL DEFAULT '',
  `ItemDesc` text NOT NULL DEFAULT '',
  `ItemCode` varchar(255) NOT NULL DEFAULT '',
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `idx_code` (`ItemCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC; 


CREATE TABLE `checklist_tpl` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Subject` text NOT NULL DEFAULT '',
  `Status` emun ('Draft', 'Active', 'InActive')
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

CREATE TABLE `checklist_item` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `TplID` int(11) NOT NULL DEFAULT 0,
  `ItemCode` varchar(128) NOT NULL DEFAULT '',
  `ItemRank` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `idx_code` (`ItemCode`),
  KEY `idx_tpl` (`TplID`) 
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


CREATE TABLE `checklist_app` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Type` varchar(32) NOT NULL DEFAULT 0,
  `AppID` int(11) NOT NULL DEFAULT 0,
  `ItemCode` varchar(128) NOT NULL DEFAULT '',
  `Received` date not null default '0000-00-00 00:00:00',
  `ExItem` text NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `idx_at` (`AppID`, `Type`),
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC; 


Configure CheckList 
Subject input -> create button
Subject list -> edit / delete button 

Configure CheckList Detail
Subject 
Item Selector / Add new 
Item , Description, Rank, Save button / Remove Button 




