<?php

/**
 * ECSHOP 商品分类管理程序
 * ============================================================================
 * 版权所有 2005-2010 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liuhui $
 * $Id: car_area.php 17063 2010-03-25 06:35:46Z liuhui $
 */

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
$exc = new exchange($ecs->table("category"), $db, 'cat_id', 'cat_name');

/* act操作项的初始化 */
if (empty($_REQUEST['act'])) {
    $_REQUEST['act'] = 'list';
} else {
    $_REQUEST['act'] = trim($_REQUEST['act']);
}


/* 代码增加_start  By jdy */
include_once(ROOT_PATH . 'includes/cls_image.php');
$image = new cls_image($_CFG['bgcolor']);


/*------------------------------------------------------ */
//-- 车辆所在地列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list') {
    /* 获取分类列表 */
    $car_area_list = $db->getAll('SELECT * FROM '.$ecs->table('car_area'));
    /* 模板赋值 */
    $smarty->assign('ur_here', $_LANG['05_car_area_list']);
    $smarty->assign('action_link', array('href' => 'car_area.php?act=add', 'text' => $_LANG['add_car_area_list']));
    $smarty->assign('full_page', 1);

    $smarty->assign('car_area_info', $car_area_list);

    /* 列表页面 */
    assign_query_info();
    $smarty->display('car_area_list.htm');
}



/*------------------------------------------------------ */
//-- 排序、分页、查询
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query') {

    $province = empty($_POST['province'])?'':trim($_POST['province']);

    if (empty($province)) {
        $car_area_list = $db->getAll('SELECT * FROM '.$ecs->table('car_area'));
    } else {
        $car_area_list = $db->getAll('SELECT * FROM '.$ecs->table('car_area')." WHERE provice='{$province}'");
    }

    $smarty->assign('car_area_info', $car_area_list);

    make_json_result($smarty->fetch('car_area_list.htm'));
}
/*------------------------------------------------------ */
//-- 添加车辆所在地
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'add') {
    /* 权限检查 */
    admin_priv('cat_manage');


    /* 模板赋值 */
    $smarty->assign('ur_here', $_LANG['add_car_area_list']);
    $smarty->assign('action_link', array('href' => 'car_area.php?act=list', 'text' => $_LANG['05_car_area_list']));


    $smarty->assign('form_act', 'insert');
    $smarty->assign('cat_info', array('is_show' => 1));


    /* 显示页面 */
    assign_query_info();
    $smarty->display('car_area_info.htm');
}

/*------------------------------------------------------ */
//-- 车辆所在地添加时的处理
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'insert') {
    /* 权限检查 */
    admin_priv('cat_manage');

    $car_area['province'] = !empty($_POST['province']) ? trim($_POST['province']) : '';
    $car_area['short'] = !empty($_POST['short']) ? trim($_POST['short']) : '';
    $car_area['sort_order'] = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;

    if (empty($car_area['province'])) {
        sys_msg('省份不能为空');
    } elseif (empty($car_area['short'])) {
        sys_msg('简称不能为空');
    }

    $has = $db->getOne("select id from " . $ecs->table('car_area') . " where province='{$car_area['province']}' ");
    if (!empty($has)) {
        sys_msg($car_area['province'] . ' 已经存在，请不要重复添加！');
    }

    if($db->autoExecute($ecs->table('car_area'), $car_area) === false) {
        sys_msg('添加失败！');
    }

    admin_log($car_area['province'], 'add', 'car_area');   // 记录管理员操作
    clear_cache_files();    // 清除缓存
    /*添加链接*/
    $link[0]['text'] = '继续添加';
    $link[0]['href'] = 'car_area.php?act=add';

    $link[1]['text'] = '返回列表页';
    $link[1]['href'] = 'car_area.php?act=list';

    sys_msg('添加成功', 0, $link);

}


/*------------------------------------------------------ */
//-- 编辑车辆所在地
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'edit') {
    admin_priv('cat_manage');   // 权限检查
    $id = intval($_REQUEST['id']);
    $car_area_info = $db->getRow('select * from '.$ecs->table('car_area').' where id='.$id);

    /* 模板赋值 */
    $smarty->assign('ur_here', '编辑车辆所在地');
    $smarty->assign('action_link', array('text' => '车辆所在地列表', 'href' => 'car_area.php?act=list'));

    $smarty->assign('car_area_info', $car_area_info);
    $smarty->assign('form_act', 'update');

    /* 显示页面 */
    assign_query_info();
    $smarty->display('car_area_info.htm');
}

/*------------------------------------------------------ */
//-- 编辑车辆所在地
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'update') {
    /* 权限检查 */
    admin_priv('cat_manage');

    $car_area['province'] = !empty($_POST['province']) ? trim($_POST['province']) : '';
    $car_area['short'] = !empty($_POST['short']) ? trim($_POST['short']) : '';
    $car_area['sort_order'] = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;
    $id = intval($_POST['id']);

    if (empty($car_area['province'])) {
        sys_msg('省份不能为空');
    } elseif (empty($car_area['short'])) {
        sys_msg('简称不能为空');
    }

    $has = $db->getOne("select id from " . $ecs->table('car_area') . " where province='{$car_area['province']}' and short='{$car_area['short']}'");
    if (!empty($has)) {
        sys_msg('修改成功！');
    }

    if($db->autoExecute($ecs->table('car_area'), $car_area, 'update', 'id='.$id) === false) {
        sys_msg('修改失败！');
    }
    $link[0]['text'] = '返回列表';
    $link[0]['href'] = 'car_area.php?act=list';
    sys_msg('修改成功！', 0, $link);
}

/*------------------------------------------------------ */
//-- 编辑排序序号
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'edit_sort_order') {
    check_authz_json('cat_manage');

    $id = intval($_POST['id']);
    $val = intval($_POST['val']);

    if (cat_update($id, array('sort_order' => $val))) {
        clear_cache_files(); // 清除缓存
        make_json_result($val);
    } else {
        make_json_error($db->error());
    }
}

/*------------------------------------------------------ */
//-- 删除车辆所在地
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'remove') {
    check_authz_json('car_area_manage');

    $car_area_id = intval($_GET['id']);

    if ($car_area_id) {
        $sql = 'DELETE FROM ' . $ecs->table('car_area') . " WHERE id = '$car_area_id'";
        if ($db->query($sql)) {
            admin_log($car_area_id, 'remove', 'care_area');
        }
    } else {
        make_json_error('删除车辆所在地失败!');
    }

    $url = 'car_area.php?act=query&'.str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}
