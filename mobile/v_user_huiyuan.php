<?php


define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require(dirname(__FILE__) . '/includes/lib_v_user.php');

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}

if($_CFG['is_distrib'] == 0)
{
	show_message('没有开启微信分销服务！','返回首页','index.php'); 
}

if($_SESSION['user_id'] == 0)
{
	ecs_header("Location: ./\n");
    exit;	 
}

$is_distribor = is_distribor($_SESSION['user_id']);
if($is_distribor != 1)
{
	show_message('您还不是分销商！','去首页','index.php');
	exit;
}


if (!$smarty->is_cached('v_user_huiyuan.dwt', $cache_id))
{
    assign_template();

    $position = assign_ur_here();
    $smarty->assign('page_title',      $position['title']);    // 页面标题
    $smarty->assign('ur_here',         $position['ur_here']);  // 当前位置

    /* meta information */
    $smarty->assign('keywords',        htmlspecialchars($_CFG['shop_keywords']));
    $smarty->assign('description',     htmlspecialchars($_CFG['shop_desc']));
	$smarty->assign('user_info',get_user_info_by_user_id($_SESSION['user_id'])); 
	$smarty->assign('one_level_user_count',get_user_count($_SESSION['user_id'],1));  //一级会员数量
	$smarty->assign('two_level_user_count',get_user_count($_SESSION['user_id'],2));  //一级会员数量
	$smarty->assign('three_level_user_count',get_user_count($_SESSION['user_id'],3));  //一级会员数量
	
	$smarty->assign('one_user_list',get_distrib_user_info($_SESSION['user_id'],1)); //一级会员信息
	$smarty->assign('two_user_list',get_distrib_user_info($_SESSION['user_id'],2)); //二级会员信息
	$smarty->assign('three_user_list',get_distrib_user_info($_SESSION['user_id'],3)); //三级会员信息
	$smarty->assign('user_id',$_SESSION['user_id']);
	
    /* 页面中的动态内容 */
    assign_dynamic('v_user_huiyuan');
}

$smarty->display('v_user_huiyuan.dwt', $cache_id);


?>