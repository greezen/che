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

call_user_func($function_name, $GLOBALS['db'], $GLOBALS['ecs']);


function action_default()
{
    exit();
}

/**
 * 创建群组
 * @param $db
 * @param $ecs
 */
function action_add_group($db, $ecs)
{
    $access_token = helper::post('access_token');
    $group_name = helper::post('group_name');
    $desc = helper::post('desc');
    $private = helper::post('private', 0, 'intval');
    $invite = helper::post('invite', 1, 'intval');
    $access_data = helper::get_cache($access_token);

    if (empty($access_data)) {
        helper::json('false', '登录超时，请重新登录');
    } elseif (empty($group_name)) {
        helper::json('false', '群组名称不能为空');
    } elseif (empty($desc)) {
        helper::json('false', '群组简介不能为空');
    } elseif (mb_strlen($group_name) > 20) {
        helper::json('false', '群组名称不能超过20个字符');
    } elseif (mb_strlen($desc) > 128) {
        helper::json('false', '群组描述不能超过128个字符');
    }

    if ($private == 0) {
        $public = true;
    } else {
        $public = false;
    }

    if ($invite == 0) {
        $invite = false;
    } else {
        $invite = true;
    }

    $im = Easemob::getInstance();
    $owner = helper::getImUser($access_data['uid']);
    $res = $im->getUser(helper::getImUser($access_data['uid']));
    //用户不存在则先创建用户
    if (isset($res['error']) && $res['error'] == 'service_resource_not_found') {
        $user = $im->createUser($owner, '66666666');
        if (isset($user['error'])) {
            helper::json('false', '创建群组失败！');
        }
    }
    $options = array(
        'groupname' => $group_name,
        'desc' => $desc,
        'public' => $public,
        'maxusers' => 300,
        'allowinvites' => $invite,
        'owner' => $owner,
    );

    //创建群组
    $group = $im->createGroup($options);

    $im_group = array(
        'name' => $group_name,
        '`desc`' => $desc,
        'owner' => $owner,
        'public' => $public == true ? 'Y' : 'N',
        'max_users' => $options['maxusers'],
        'allow_invite' => $invite == true ? 'Y' : 'N',
        'members_only' => 'N',
        'group_id' => $group['data']['groupid'],
        'uid' => $access_data['uid'],
        'time_created' => time(),
        'time_updated' => time(),
    );

    //创建成功则数据入库
    if (!isset($group['error']) && $db->autoExecute($ecs->table('im_group'), $im_group, 'INSERT')) {
        helper::json('true', '创建群组成功');
    }

    helper::json('false', '创建群组失败');
}

function action_find_user()
{
    $access_token = helper::post('access_token');
    $group_name = helper::post('group_name');
    $desc = helper::post('desc');
    $private = helper::post('private', 0, 'intval');
    $invite = helper::post('invite', 1, 'intval');
    $access_data = helper::get_cache($access_token);

    if (empty($access_data)) {
        helper::json('false', '登录超时，请重新登录');
    } elseif (empty($group_name)) {
        helper::json('false', '群组名称不能为空');
    } elseif (empty($desc)) {
        helper::json('false', '群组简介不能为空');
    } elseif (mb_strlen($group_name) > 20) {
        helper::json('false', '群组名称不能超过20个字符');
    } elseif (mb_strlen($desc) > 128) {
        helper::json('false', '群组描述不能超过128个字符');
    }
}

function action_group_list()
{

}

function request($action, $param)
{
    $im = Easemob::getInstance();
    $res = $im->$action();
}