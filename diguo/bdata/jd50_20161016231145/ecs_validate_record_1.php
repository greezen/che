<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_validate_record`;");
E_C("CREATE TABLE `ecs_validate_record` (
  `record_key` varchar(250) NOT NULL COMMENT '标识',
  `record_code` text NOT NULL COMMENT '值',
  `record_type` varchar(60) NOT NULL COMMENT '业务类型,SESSIONID',
  `last_send_time` int(11) DEFAULT NULL COMMENT '上一次发送时间',
  `expired_time` int(11) DEFAULT NULL COMMENT '过期时间',
  `ext_info` text COMMENT '扩展信息',
  `create_time` int(11) DEFAULT NULL COMMENT '记录的创建时间',
  PRIMARY KEY (`record_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
E_D("replace into `ecs_validate_record` values('957073146@qq.com','405474','email_validate','1463455074','1463456874','a:0:{}','1463455074');");

require("../../inc/footer.php");
?>