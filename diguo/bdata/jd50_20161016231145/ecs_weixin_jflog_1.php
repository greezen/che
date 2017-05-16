<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_weixin_jflog`;");
E_C("CREATE TABLE `ecs_weixin_jflog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fake_id` varchar(32) NOT NULL,
  `jf_type` int(11) NOT NULL COMMENT '1 一次性赠送 2按日计算',
  `key_id` int(11) NOT NULL COMMENT '命令ID',
  `createtime` int(11) NOT NULL,
  `createymd` date NOT NULL,
  `num` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fake_id` (`fake_id`),
  KEY `createymd` (`createymd`),
  KEY `key_id` (`key_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_weixin_jflog` values('1','oWeRDuCrUkgH3FkwhTO45twRnBNQ','1','3','1458286119','2016-03-18','10');");
E_D("replace into `ecs_weixin_jflog` values('2','oWeRDuCrUkgH3FkwhTO45twRnBNQ','0','0','1458288806','2016-03-18','10');");
E_D("replace into `ecs_weixin_jflog` values('3','oWeRDuJdvF3hl_lRD2Gf0EsQ35KU','2','2','1458306534','2016-03-18','10');");
E_D("replace into `ecs_weixin_jflog` values('4','ojeCwvxmevoXgwWje7bnSewbmudI','0','0','1458384947','2016-03-19','10');");

require("../../inc/footer.php");
?>