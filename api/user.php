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
        'access_token' => helper::gen_access_token($row['user_id'], 86400 * 7)
    );

    helper::json('true', '登录成功', $data);
}

/**
 * 修改密码
 */
function action_chpwd()
{
    $access_token = helper::post('access_token');
    $old_pwd = helper::post('old_pwd');
    $new_pwd = helper::post('new_pwd');
    $access_data = helper::get_cache($access_token);

    if (empty($access_data)) {
        helper::json('false', '登录超时，请重新登录');
    } elseif (empty($old_pwd)) {
        helper::json('false', '原密码不正确');
    } elseif (empty($new_pwd) || mb_strlen($new_pwd) < 6) {
        helper::json('false', '新密码必须大于6位');
    }

    $uid = $access_data['uid'];
    $db = $GLOBALS['db'];
    $user = $GLOBALS['user'];

    $sql = "SELECT user_id, password, salt, ec_salt " . " FROM " . $GLOBALS['ecs']->table('users') . " WHERE user_id='".$uid."'";
    $row = $db->getRow($sql);
    $pwd = $user->compile_password(array('password' => $old_pwd, 'ec_salt' => $row['ec_salt']));

    if ($pwd != $row['password']) {
        helper::json('false', '原密码不正确');
    }

    $salt = helper::rand_str(8);
    $new_password = $user->compile_password(array('password' => $new_pwd, 'ec_salt' => $salt));

    $sql = "UPDATE " . $GLOBALS['ecs']->table('users') . " SET `password` = '{$new_password}',`ec_salt` = '{$salt}' WHERE user_id = ".$uid;
    if ($db->query($sql)) {
        helper::json('true', '密码修改成功');
    }

    helper::json('false', '密码修改失败');
}

/**
 * 获取个人信息
 */
function action_get_profile()
{
    $access_token = helper::post('access_token');
    $access_data = helper::get_cache($access_token);

    if (empty($access_token) || empty($access_data)) {
        helper::json('false', 'access_token错误');
    }

    $db = $GLOBALS['db'];
    $sql = "SELECT * FROM " . $GLOBALS['ecs']->table('users') . " WHERE user_id=".$access_data['uid'];
    $user_info = $db->getRow($sql);

    if(!empty($user_info)) {
        $data = array(
            'user_name' => $user_info['user_name'],
            'phone' => $user_info['mobile_phone'],
            'wx' => '',
            'qq' => $user_info['qq'],
            'real_name' => '',
        );
        helper::json('true', '', $data);
    }

    helper::json('false', '获取信息失败');
}

/**
 * 设置个人信息
 */
function action_set_profile()
{
    $user_name = helper::post('user_name');
    $qq = helper::post('qq');
    $access_token = helper::post('access_token');
    $access_data = helper::get_cache($access_token);

    if (empty($access_token) || empty($access_data)) {
        helper::json('false', 'access_token错误');
    } elseif (mb_strlen($user_name) > 20) {
        helper::json('false', '用户名不能超过20个字符');
    } elseif (!empty($qq) && !is_numeric($qq)) {
        helper::json('false', 'qq不正确');
    }

    $db = $GLOBALS['db'];
    $sql = "SELECT * FROM " . $GLOBALS['ecs']->table('users') . " WHERE user_id=".$access_data['uid'];
    $user_info = $db->getRow($sql);

    if (empty($user_name)) {
        $user_name = $user_info['username'];
    } elseif (empty($qq)) {
        $qq = $user_info['qq'];
    }
    $sql = "UPDATE ". $GLOBALS['ecs']->table('users') . " SET user_name = '{$user_name}',qq='{$qq}' WHERE user_id=".$access_data['uid'];
    if($db->query($sql)) {
        helper::json('true', '更新信息成功');
    }

    helper::json('false', '更新信息失败');
}

/**
 * 企业会员认证
 */
function action_certify()
{
    $zhizhao = isset($_FILES['zhizhao'])?$_FILES['zhizhao']:null;//营业执照
    $organization_code = isset($_FILES['organization_code'])?$_FILES['organization_code']:null;//组织机构代码证
    $idcard_front = isset($_FILES['idcard_front'])?$_FILES['idcard_front']:null;//法人身份证正面
    $idcard_reverse = isset($_FILES['idcard_reverse'])?$_FILES['idcard_reverse']:null;//法人身份证反面

    $business_licence_number = helper::post('business_licence_number');//营业执照号
    $contacts_phone = helper::post('contacts_phone');//联系人手机号
    $contacts_name = helper::post('contacts_name');//联系人姓名
    $settlement_bank_account_name = helper::post('settlement_bank_account_name');//对公账户名
    $settlement_bank_account_number = helper::post('settlement_bank_account_number');//对公账号
    $settlement_bank_name = helper::post('settlement_bank_name');//开户行

    $access_token = helper::post('access_token');
    $access_data = helper::get_cache($access_token);

    $_CFG = $GLOBALS['_CFG'];
    $db = $GLOBALS['db'];
    $upload_size_limit = $_CFG['upload_size_limit'] == '-1' ? ini_get('upload_max_filesize') : $_CFG['upload_size_limit'];
    if (empty($access_token) || empty($access_data)) {
        helper::json('false', 'access_token错误');
    } elseif (empty($zhizhao)) {
        helper::json('false', '未上传营业执照');
    } elseif (empty($organization_code)) {
        helper::json('false', '未上传组织机构代码证');
    } elseif (empty($idcard_front)) {
        helper::json('false', '未上传法人身份证正面');
    } elseif (empty($idcard_reverse)) {
        helper::json('false', '未上传法人身份证反面');
    } elseif  ($zhizhao['size'] / 1024 > $upload_size_limit) {
        helper::json('false', '营业执照图片尺寸不能超过'.($upload_size_limit/1024).'M');
    } elseif ($organization_code['size'] / 1024 > $upload_size_limit) {
        helper::json('false', '组织机构代码证图片尺寸不能超过'.($upload_size_limit/1024).'M');
    } elseif ($idcard_front['size'] / 1024 > $upload_size_limit) {
        helper::json('false', '法人身份证正面图片尺寸不能超过'.($upload_size_limit/1024).'M');
    } elseif ($idcard_reverse['size'] / 1024 > $upload_size_limit) {
        helper::json('false', '法人身份证反面图片尺寸不能超过'.($upload_size_limit/1024).'M');
    } elseif (empty($business_licence_number)) {
        helper::json('false', '营业执照号不能为空');
    } elseif (empty($contacts_phone)) {
        helper::json('false', '联系人手机号不能为空');
    } elseif (empty(contacts_name)) {
        helper::json('false', '联系人姓名不能为空');
    } elseif (empty($settlement_bank_account_name)) {
        helper::json('false', '对公账户名不能为空');
    } elseif (empty($settlement_bank_account_number)) {
        helper::json('false', '对公账号不能为空');
    } elseif (empty($settlement_bank_name)) {
        helper::json('false', '开户行不能为空');
    } elseif (!is_mobile_phone($contacts_phone)){
        helper::json('false', '手机号不正确');
    }
    $zhizhao_img = upload_file($_FILES['zhizhao'], 'supplier');
    $organization_code_img = upload_file($_FILES['organization_code'], 'supplier');
    $idcard_front_img = upload_file($_FILES['idcard_front'], 'supplier');
    $idcard_reverse_img = upload_file($_FILES['idcard_reverse'], 'supplier');

    if ($zhizhao_img === false) {
        helper::json('false', '营业执照上传失败');
    } elseif ($organization_code_img === false) {
        helper::json('false', '组织机构代码证上传失败');
    } elseif ($idcard_front_img === false) {
        helper::json('false', '法人身份证正面上传失败');
    } elseif ($idcard_reverse_img === false) {
        helper::json('false', '法人身份证反面上传失败');
    }

    $save = array(
        'zhizhao' => $zhizhao_img,
        'organization_code' => $organization_code_img,
        'idcard_front' => $idcard_front_img,
        'idcard_reverse' => $idcard_reverse_img,
        'business_licence_number' => $business_licence_number,
        'contacts_phone' => $contacts_phone,
        'contacts_name' => $contacts_name,
        'settlement_bank_account_name' => $settlement_bank_account_name,
        'settlement_bank_account_number' => $settlement_bank_account_number,
        'settlement_bank_name' => $settlement_bank_name,
        'user_id' => $access_data['uid'],
    );

    if ($db->autoExecute($GLOBALS['ecs']->table('supplier'), $save, 'INSERT') !== false){
       helper::json('true', '认证资料提交成功');
    }

    helper::json('false', '认证资料提交失败');
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
        $content = '您的验证码为 ' . $code . ' 客服不会索取此验证码，请注意保管。';

        if (helper::send_sms($phone, $content)) {
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