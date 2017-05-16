<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_users_activity`;");
E_C("CREATE TABLE `ecs_users_activity` (
  `id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  `user_nickname` varchar(200) NOT NULL,
  `user_head` varchar(200) NOT NULL,
  `act_id` mediumint(8) NOT NULL,
  `act_type` tinyint(3) NOT NULL,
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `new_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `activity_time` int(10) unsigned NOT NULL DEFAULT '0',
  `order_times` int(10) unsigned NOT NULL DEFAULT '0',
  `is_finished` int(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_users_activity` values('1','270','秋海棠','http://wx.qlogo.cn/mmopen/QyxDic6BD5fd5DjaWiaVcckbOicXdE2VaXanCpltBUjgHm121dj5xUibyMh8WuIpFu4Ric62oSVaBcrovlyXPd2ibofPEWrIgcNNT5/0','39','8','45.00','45.00','1461767448','0','0');");
E_D("replace into `ecs_users_activity` values('2','285','Jean_@','http://wx.qlogo.cn/mmopen/Q3auHgzwzM4RLI9W87foKY7ic5danic1v5nFzGEsy8qcpicU6dDib4V7v60PlM4UjZRrjVTI9ruib12GysUib8ccthnQr2UQ6Oe6jdzjAjTrF0icAg/0','39','8','45.00','41.93','1461822956','0','0');");
E_D("replace into `ecs_users_activity` values('3','278','找我吧','http://wx.qlogo.cn/mmopen/fXQriaBn8PEwc5woMJ9Q0MMiaXic6LZA2hlKZw0rziaNV7hElIpUOSbSzbFhXqAHhOK8HhV9yqWOicpiaJ3cECYziadzs7uLlicMoJhy/0','39','8','45.00','41.92','1461825549','0','0');");
E_D("replace into `ecs_users_activity` values('4','290',',','http://wx.qlogo.cn/mmopen/leqgpMdQQJiacZjWiaFWWV5rySlKNvcD2icEfRgqU9ZqXzodNkFvINfdoSh1ou8zMBowKTAHv0mxAhZ8F4wD7Sibw0lLSdiae9xlo/0','39','8','45.00','40.66','1461836836','0','0');");
E_D("replace into `ecs_users_activity` values('5','321','A 李雄成『导航服务 品牌推广』','http://wx.qlogo.cn/mmopen/W2o18sOSFQVpOK6zAjeQ4r6GNgvJdK2hibLn4n39DibeKnrS3AVCa6PgkALbwdeIpmDgqajkaPUHZFA7xJYbUWRT5f0WuVv2kk/0','39','8','45.00','40.69','1462203371','0','0');");
E_D("replace into `ecs_users_activity` values('6','322','@i','http://wx.qlogo.cn/mmopen/VNDQtnw16icLojlrqSIDCib19koa9Piayycx5mAFg6IuGmpt8S72GRYzkpbKjywA11tZAzOVOVlszicXSEXda4IM3A/0','39','8','45.00','40.91','1462204094','1','0');");
E_D("replace into `ecs_users_activity` values('7','329','微光~','http://wx.qlogo.cn/mmopen/W2o18sOSFQVpOK6zAjeQ4mkVzYkicH1q2SLBdS8sicpribuqIZIVwgRia5rMLb9ict5KiaO5azEMrVmicZBb4hwy2YQDSUHlKFC0rEd/0','39','8','45.00','42.31','1462260020','0','0');");
E_D("replace into `ecs_users_activity` values('8','332','东海','http://wx.qlogo.cn/mmopen/VNDQtnw16icKIcmEUbYFB0fyO7uuqKwP49iczwV9rmXy9zTqaQF0s4Ltc52s77JZxOKMgSyYtZiapia7JwWWISw2qicg0cBpzvb5V/0','39','8','45.00','40.27','1462273227','0','0');");
E_D("replace into `ecs_users_activity` values('9','58','zzl_221','','46','8','120.00','115.00','1471065582','0','0');");
E_D("replace into `ecs_users_activity` values('10','58','zzl_221','','47','8','78.00','55.86','1471065876','0','0');");
E_D("replace into `ecs_users_activity` values('11','58','zzl_221','','48','8','39.00','100.00','1471066767','0','1');");
E_D("replace into `ecs_users_activity` values('12','42','Daniel','','49','8','148.00','138.09','1471403878','0','0');");
E_D("replace into `ecs_users_activity` values('13','42','Daniel','','47','8','78.00','56.78','1471406333','0','0');");
E_D("replace into `ecs_users_activity` values('14','42','Daniel','','50','8','168.00','164.95','1471408001','0','0');");
E_D("replace into `ecs_users_activity` values('15','42','Daniel','','46','8','120.00','120.00','1471413188','0','0');");
E_D("replace into `ecs_users_activity` values('16','42','Daniel','','48','8','39.00','100.00','1471414277','0','1');");
E_D("replace into `ecs_users_activity` values('17','42','Daniel','','51','8','0.00','0.00','1471414655','0','1');");

require("../../inc/footer.php");
?>