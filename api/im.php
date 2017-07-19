<?php

/**
 * 圈子
 *
 */


define('IN_ECS', true);

require_once './init.php';
require_once ROOT_PATH . 'includes/emchat/Easemob.php';

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
    $owner = $access_data['phone'];

    //用户不存在则先创建用户
    if (!has_user($owner, $access_data['uid'], '')) {
        if (!add_user($owner, substr($owner, -8), $access_data['uid'])) {
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

/**
 * 查找用户
 * @param $db
 * @param $ecs
 */
function action_find_user($db, $ecs)
{
    $access_token = helper::post('access_token');
    $username = helper::post('username');
    $access_data = helper::get_cache($access_token);

    if (empty($access_data)) {
        helper::json('false', '登录超时，请重新登录');
    } elseif (empty($username)) {
        helper::json('false', '用户名称不能为空');
    }

    if (!has_user($username, $access_data['uid'], '')) {
        helper::json('false', '用户不存在');
    }

    helper::json('true', '', $username);
}

/**
 * 获取指定用户的群组列表
 * @param $db
 * @param $ecs
 */
function action_group_list($db, $ecs)
{
    $access_token = helper::post('access_token');
    $access_data = helper::get_cache($access_token);

    if (empty($access_data)) {
        helper::json('false', '登录超时，请重新登录');
    }

    $im = Easemob::getInstance();

    $data = $im->getGroupsForUser($access_data['phone']);

    if (!empty($data['error']) && $data['error'] == 'resource_not_found') {
        $list = [];
    } else {
        foreach ($data['data'] as $item) {
            $list[] = array(
                'group_id' => $item['groupid'],
                'group_name' => $item['groupname'],
            );
        }
    }

    helper::json('true', '', $list);
}

/**
 * 添加im用户
 * @param $username
 * @param $password
 * @param $nickname
 * @param $uid
 * @return bool
 */
function add_user($username, $password, $uid, $nickname = '')
{
    $im = Easemob::getInstance();

    $res = $im->createUser($username, $password, $nickname);

    if (!empty($res['error'])) {
        return false;
    }

    $im_user = array(
        'username' => $username,
        'password' => md5($password),
        'nickname' => $nickname,
        'uid' => $uid,
        'time_created' => time(),
        'time_updated' => time(),
    );

    if ($GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('im_user'), $im_user, 'INSERT')) {
        return true;
    }

    return false;
}

/**
 * 检查用户是否存在
 * @param $username
 * @param $uid
 * @param $nickname
 * @return bool
 */
function has_user($username, $uid, $nickname)
{
    $im = Easemob::getInstance();
    $res = $im->getUser($username);

    if (isset($res['error']) && $res['error'] == 'service_resource_not_found') {
        return false;
    }

    $user = $GLOBALS['db']->getOne("SELECT username FROM ".$GLOBALS['ecs']->table('im_user')." WHERE username='{$username}'");
    if (empty($user)) {
        add_user($username, substr($username, -8), $uid, $nickname);
    }

    return true;
}