<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_pintuan_orders`;");
E_C("CREATE TABLE `ecs_pintuan_orders` (
  `id` mediumint(8) unsigned NOT NULL,
  `pt_id` int(10) unsigned NOT NULL DEFAULT '0',
  `act_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `act_user` mediumint(8) NOT NULL,
  `follow_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `follow_user_nickname` varchar(200) NOT NULL,
  `follow_user_head` varchar(200) NOT NULL,
  `order_id` mediumint(8) unsigned NOT NULL,
  `follow_time` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>