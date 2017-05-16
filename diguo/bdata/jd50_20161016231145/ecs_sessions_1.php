<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_sessions`;");
E_C("CREATE TABLE `ecs_sessions` (
  `sesskey` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `expiry` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `adminid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `user_name` varchar(60) NOT NULL,
  `user_rank` tinyint(3) NOT NULL,
  `discount` decimal(3,2) NOT NULL,
  `email` varchar(60) NOT NULL,
  `data` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`sesskey`),
  KEY `expiry` (`expiry`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
E_D("replace into `ecs_sessions` values('79cba8f4ef9dfbc3d17de7b4cfc9cd73','1476630317','0','1','127.0.0.1','admin','0','0.00','0','a:4:{s:10:\"admin_name\";s:5:\"admin\";s:11:\"action_list\";s:3:\"all\";s:10:\"last_check\";i:1476630317;s:12:\"suppliers_id\";s:1:\"0\";}');");
E_D("replace into `ecs_sessions` values('c668aac3a0d2aca41f2deff310eb9233','1476630360','0','0','127.0.0.1','0','0','1.00','0','a:4:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;s:13:\"captcha_login\";s:16:\"MWY3MGY0NmRmYQ==\";}');");
E_D("replace into `ecs_sessions` values('85f2dbd5780d3ab075f3b44302f66e3f','1476630380','0','0','127.0.0.1','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('9676fdaaccd0eb16bd5dee964c6d9fde','1476630584','0','1','127.0.0.1','0','0','0.00','0','a:4:{s:10:\"admin_name\";s:5:\"admin\";s:11:\"action_list\";s:3:\"all\";s:10:\"last_check\";i:1476630584;s:12:\"suppliers_id\";s:1:\"0\";}');");
E_D("replace into `ecs_sessions` values('aeecf03df97f16e46c7228c5359cff2c','1476630601','0','0','127.0.0.1','0','0','1.00','0','a:4:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;s:13:\"captcha_login\";s:16:\"OTkxOGFhNDNiMg==\";}');");

require("../../inc/footer.php");
?>