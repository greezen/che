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
{}

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

/**
 * 解密函数
 *
 * @param string $txt
 * @param string $key
 * @return string
 */
function passport_decrypt($txt, $key)
{
    $txt = passport_key(base64_decode($txt), $key);
    $tmp = '';
    for ($i = 0;$i < strlen($txt); $i++) {
        $md5 = $txt[$i];
        $tmp .= $txt[++$i] ^ $md5;
    }
    return $tmp;
}

/**
 * 加密函数
 *
 * @param string $txt
 * @param string $key
 * @return string
 */
function passport_encrypt($txt, $key)
{
    srand((double)microtime() * 1000000);
    $encrypt_key = md5(rand(0, 32000));
    $ctr = 0;
    $tmp = '';
    for($i = 0; $i < strlen($txt); $i++ )
    {
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        $tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
    }
    return base64_encode(passport_key($tmp, $key));
}

/**
 * 编码函数
 *
 * @param string $txt
 * @param string $key
 * @return string
 */
function passport_key($txt, $encrypt_key)
{
    $encrypt_key = md5($encrypt_key);
    $ctr = 0;
    $tmp = '';
    for($i = 0; $i < strlen($txt); $i++)
    {
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
    }
    return $tmp;
}
?>