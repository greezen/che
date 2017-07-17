<?php

/**
 * 圈子
 *
 */


define('IN_ECS', true);

require('./init.php');
require_once ROOT_PATH . 'includes/emchat/Easemob.class.php';

$act = isset($_GET['act'])? $_GET['act']:'';

$function_name = 'action_' . $act;

if(! function_exists($function_name))
{
    $function_name = "action_default";
}

call_user_func($function_name);


function action_default()
{
    exit();
}

function action_add_group()
{
    $access_token = helper::post('access_token');
    $group_name = helper::post('group_name');
    $desc = helper::post('desc');
    $public = helper::post('public', 0, 'intval');
    $access_data = helper::get_cache($access_token);

    if (empty($access_data)) {
        helper::json('false', '登录超时，请重新登录');
    }

    $im = Easemob::getInstance();
    $options = array(
        'groupname' => $group_name,
        'desc' => $desc,
        'public' => $public,
        'owner' => $access_data['uid'],
    );

    $res = $im->createGroup($options);

    if (!empty($res['error'])) {
        helper::json('false', '创建群组失败');
    }

    helper::json('true', '创建群组成功');
}

function request($action, $param)
{
    $im = Easemob::getInstance();
    $res = $im->$action();
}