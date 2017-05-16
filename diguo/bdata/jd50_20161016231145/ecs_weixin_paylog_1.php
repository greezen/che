<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_weixin_paylog`;");
E_C("CREATE TABLE `ecs_weixin_paylog` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `log` text NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_weixin_paylog` values('1','a:4:{s:2:\"ip\";s:14:\"112.193.133.58\";s:4:\"time\";s:19:\"2016-03-18 02:14:43\";s:3:\"get\";a:0:{}s:5:\"other\";O:10:\"Notify_pub\":2:{s:4:\"data\";b:0;s:16:\"returnParameters\";N;}}','403');");

require("../../inc/footer.php");
?>