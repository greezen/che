<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_weixin_corn`;");
E_C("CREATE TABLE `ecs_weixin_corn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `sendtime` int(11) NOT NULL,
  `issend` tinyint(4) NOT NULL COMMENT '0未发送1成功2失败',
  `ecuid` int(11) NOT NULL COMMENT '系统用户ID',
  `sendtype` tinyint(1) NOT NULL COMMENT '0单人1所有',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>