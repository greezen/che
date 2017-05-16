<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_keyword_area`;");
E_C("CREATE TABLE `ecs_keyword_area` (
  `access_time` int(10) unsigned NOT NULL DEFAULT '0',
  `w_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ip_address` varchar(15) NOT NULL DEFAULT '',
  `area` varchar(30) NOT NULL DEFAULT '',
  KEY `access_time` (`access_time`),
  KEY `w_id` (`w_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
E_D("replace into `ecs_keyword_area` values('1437586690','1','192.168.1.189','LAN');");
E_D("replace into `ecs_keyword_area` values('1437688030','2','192.168.1.162','LAN');");
E_D("replace into `ecs_keyword_area` values('1437688204','2','192.168.1.162','LAN');");
E_D("replace into `ecs_keyword_area` values('1437688209','2','192.168.1.162','LAN');");
E_D("replace into `ecs_keyword_area` values('1438044666','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438045552','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438045555','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438045562','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438045581','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438045584','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438045903','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438046167','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438046177','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438046574','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438046577','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438046595','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438046636','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438047907','3','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438047967','4','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438047975','5','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438047990','6','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048097','7','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048125','8','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048144','9','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048151','5','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048178','10','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048198','11','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048228','12','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048238','13','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048248','14','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048277','15','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048290','12','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048345','16','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048396','12','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048456','13','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048806','3','192.168.1.133','LAN');");
E_D("replace into `ecs_keyword_area` values('1438048850','5','192.168.1.133','LAN');");
E_D("replace into `ecs_keyword_area` values('1441673925','17','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1441673931','18','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1441673977','19','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1444582976','20','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1444582976','21','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1447893411','22','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1453252337','2','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1453271859','2','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1455428093','23','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1455447544','23','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1455592062','5','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1455592180','5','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1455601942','5','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1456276118','24','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1457488865','5','127.0.0.1','LAN');");
E_D("replace into `ecs_keyword_area` values('1458104409','25','122.228.20.130','IANA');");
E_D("replace into `ecs_keyword_area` values('1458107489','25','124.67.10.77','IANA');");
E_D("replace into `ecs_keyword_area` values('1458114592','26','111.193.129.88','IANA');");
E_D("replace into `ecs_keyword_area` values('1458114734','27','111.193.129.88','IANA');");
E_D("replace into `ecs_keyword_area` values('1458115856','13','111.193.129.88','IANA');");
E_D("replace into `ecs_keyword_area` values('1458189671','12','125.107.119.9','IANA');");
E_D("replace into `ecs_keyword_area` values('1458284592','28','116.5.244.118','IANA');");
E_D("replace into `ecs_keyword_area` values('1458296309','28','116.5.244.118','IANA');");
E_D("replace into `ecs_keyword_area` values('1458298156','28','116.5.244.118','IANA');");
E_D("replace into `ecs_keyword_area` values('1458338367','28','121.42.0.35','IANA');");
E_D("replace into `ecs_keyword_area` values('1458377713','29','127.0.0.1','');");

require("../../inc/footer.php");
?>