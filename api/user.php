<?php

/**
 * 用户
 *
 */


define('IN_ECS', true);

require('./init.php');

$act = isset($_GET['act'])? $_GET['act']:'';

$function_name = 'action_' . $act;

if(! function_exists($function_name))
{
    $function_name = "action_default";
}

call_user_func($function_name);

/**
 * 注册
 */
function action_register()
{
    require_once (ROOT_PATH . 'includes/lib_validate_record.php');
    include_once (ROOT_PATH . 'includes/lib_passport.php');

    $phone = ! empty($_POST['phone']) ? trim($_POST['phone']) : '';
    $password = ! empty($_POST['password']) ? trim($_POST['password']) : '';
    $code = ! empty($_POST['code']) ? trim($_POST['code']) : '';

    $record = get_validate_record($phone);

    /* 手机验证码检查 */
    if(empty($code))
    {
        helper::json('false', '验证码不正确');
    }
    // 检查密码
    else if(empty($password) || mb_strlen($password) < 6)
    {
        helper::json('false', '密码必须6位以上');
    }// 检查验证码是否正确
    else if($record['record_code'] != $code)
    {
        helper::json('false', '验证码不正确');
    }
    // 检查过期时间
    else if($record['expired_time'] < time())
    {
        helper::json('false', '验证码已过期');
    }

    /* 手机注册时，用户名默认为u+手机号 */
    $username = generate_username_by_mobile($phone);

    /* 手机注册 */
    $result = register_by_mobile($username, $password, $phone);

    if($result)
    {
        /* 删除注册的验证记录 */
        remove_validate_record($phone);
        helper::json('true', '注册成功');
    }

    helper::json('false', '注册失败');

}

function action_default()
{
    exit();
}

/**
 * 登录
 */
function action_login()
{
    $phone = empty($_POST['phone'])?null:trim($_POST['phone']);
    $password = empty($_POST['password'])?null:trim($_POST['password']);

    if (empty($phone) || empty($password) || !is_mobile_phone($phone)) {
        helper::json('false', '账号或密码不正确');
    }

    $sql = "SELECT user_id, password, salt, ec_salt " . " FROM " . $GLOBALS['ecs']->table('users') . " WHERE mobile_phone='".$phone."'";
    $row = $GLOBALS['db']->getRow($sql);
    $ec_salt = $row['ec_salt'];
    $pwd = $GLOBALS['user']->compile_password(array('password' => $password, 'ec_salt' => $ec_salt));

    if(empty($row) || $row['password'] !== $pwd) {
        helper::json('false', '账号或密码不正确');
    }

    $data = array(
        'access_token' => helper::gen_access_token($row['user_id'], 5)
    );

    helper::json('true', '登录成功', $data);
}

/**
 * 发送验证码
 */
function action_code()
{
    require_once (ROOT_PATH . 'includes/lib_validate_record.php');
    $phone = empty($_POST['phone'])?null:$_POST['phone'];

    if (empty($phone)){
        helper::json('false', '手机不能为空');
    } else {
        $code = mt_rand(100000, 999999);
        //TODO:发短信
        $res = true;
        $content = '您的验证码为 ' . $code . ' 客服不会索取此验证码，请注意保管。';
        helper::send_sms($phone, $content);

        if ($res) {
            save_validate_record($phone, $code, VT_MOBILE_REGISTER, time(), time() + 600);
            helper::json('true', '发送成功');
        }

        helper::json('false', '发送失败');
    }
}

/**
 * 用户名重名检测
 */
function action_check()
{
    $user = $GLOBALS['user'];
    $phone = empty($_POST['phone'])?null:$_POST['phone'];

    $results = array('result' => 'false', 'msg' => '', 'data' => array());
    if (empty($phone) || $user->check_mobile_phone($phone)){
        $results['msg'] = '手机号不可以注册';
    } else {
        $results['result'] = 'true';
        $results['msg'] = '手机号可以注册';
    }
}

/**
 * 忘记密码
 */
function action_forget()
{}

/**
 * 根据手机号生成用户名
 *
 * @param number $length
 * @return number
 */
function generate_username_by_mobile ($mobile)
{

    $username = 'u'.substr($mobile, 0, 3);

    $charts = "ABCDEFGHJKLMNPQRSTUVWXYZ";
    $max = strlen($charts);

    for($i = 0; $i < 4; $i ++)
    {
        $username .= $charts[mt_rand(0, $max)];
    }

    $username .= substr($mobile, -4);

    $sql = "select count(*) from " . $GLOBALS['ecs']->table('users') . " where user_name = '$username'";
    $count = $GLOBALS['db']->getOne($sql);
    if($count > 0)
    {
        return generate_username_by_mobile();
    }

    return $username;
}

?>