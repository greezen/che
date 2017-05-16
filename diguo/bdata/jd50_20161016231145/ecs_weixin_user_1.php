<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_weixin_user`;");
E_C("CREATE TABLE `ecs_weixin_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `ecuid` int(11) NOT NULL COMMENT '绑定用户ID',
  `fake_id` varchar(32) NOT NULL,
  `createtime` int(11) NOT NULL,
  `createymd` date NOT NULL,
  `isfollow` tinyint(1) NOT NULL,
  `nickname` varchar(32) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `headimgurl` varchar(200) NOT NULL,
  `country` varchar(20) NOT NULL,
  `province` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `sign_num` int(11) NOT NULL COMMENT '连续签到次数',
  `access_token` varchar(40) NOT NULL COMMENT 'token',
  `expire_in` int(11) NOT NULL COMMENT 'token到期时间',
  `from_id` int(11) NOT NULL,
  `Latitude` varchar(32) NOT NULL,
  `Longitude` varchar(32) NOT NULL,
  `Precision` varchar(32) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `fake_id` (`fake_id`),
  KEY `ecuid` (`ecuid`),
  KEY `from_id` (`from_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>