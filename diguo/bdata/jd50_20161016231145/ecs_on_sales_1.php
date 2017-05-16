<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_on_sales`;");
E_C("CREATE TABLE `ecs_on_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cat_ids` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_on_sales` values('1','56','');");
E_D("replace into `ecs_on_sales` values('2','57','');");
E_D("replace into `ecs_on_sales` values('3','58','1,4');");

require("../../inc/footer.php");
?>