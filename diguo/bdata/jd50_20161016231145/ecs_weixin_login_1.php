<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_weixin_login`;");
E_C("CREATE TABLE `ecs_weixin_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createtime` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `token` varchar(200) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `value` (`value`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>