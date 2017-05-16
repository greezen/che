<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_weixin_sign`;");
E_C("CREATE TABLE `ecs_weixin_sign` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `wxid` int(11) NOT NULL,
  `signtime` int(11) NOT NULL,
  `signymd` date NOT NULL,
  PRIMARY KEY (`sid`),
  UNIQUE KEY `wxid` (`wxid`,`signymd`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_weixin_sign` values('1','22','1458288806','2016-03-18');");
E_D("replace into `ecs_weixin_sign` values('2','129','1458384947','2016-03-19');");

require("../../inc/footer.php");
?>