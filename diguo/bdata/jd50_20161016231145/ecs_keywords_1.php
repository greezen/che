<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_keywords`;");
E_C("CREATE TABLE `ecs_keywords` (
  `date` date NOT NULL DEFAULT '0000-00-00',
  `searchengine` varchar(20) NOT NULL DEFAULT '',
  `keyword` varchar(90) NOT NULL DEFAULT '',
  `count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`date`,`searchengine`,`keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
E_D("replace into `ecs_keywords` values('2016-03-17','ecshop','雪肌精','1');");
E_D("replace into `ecs_keywords` values('2016-03-18','ecshop','流行元素','1');");
E_D("replace into `ecs_keywords` values('2016-03-18','ecshop','兰芝','1');");
E_D("replace into `ecs_keywords` values('2016-03-18','ecshop','雅漾','1');");
E_D("replace into `ecs_keywords` values('2016-03-18','ecshop','雅诗兰黛','1');");
E_D("replace into `ecs_keywords` values('2016-03-18','ecshop','测试','1');");
E_D("replace into `ecs_keywords` values('2016-03-18','ecshop','酒仙网','1');");
E_D("replace into `ecs_keywords` values('2016-03-18','ecshop','西门子开关','2');");

require("../../inc/footer.php");
?>