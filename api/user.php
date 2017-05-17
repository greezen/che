<?php

/**
 * 用户
 *
 */


define('IN_ECS', true);

require('./init.php');
require_once(ROOT_PATH . 'includes/cls_json.php');

$json = new JSON;

$hash_code = $db->getOne("SELECT `value` FROM " . $ecs->table('shop_config') . " WHERE `code`='hash_code'", true);

$act = isset($_GET['act'])? $_GET['act']:'';
if (empty($_REQUEST['verify']) || empty($_REQUEST['auth']) || empty($_REQUEST['action']))
{
    $results = array('result'=>'false', 'data'=>'缺少必要的参数');
    //exit($json->encode($results));
}
if ($_REQUEST['verify'] != md5($hash_code.$_REQUEST['action'].$_REQUEST['auth']))
{
    $results = array('result'=>'false', 'data'=>'数据来源不合法，请返回');
    //exit($json->encode($results));
}

parse_str(passport_decrypt($_REQUEST['auth'], $hash_code), $data);

switch ($act)
{
    case 'register':
    {
        require_once (ROOT_PATH . 'includes/lib_validate_record.php');

        $phone = ! empty($_POST['phone']) ? trim($_POST['phone']) : '';
        $code = ! empty($_POST['code']) ? trim($_POST['code']) : '';

        $record = get_validate_record($mobile_phone);

        $session_phone = $_SESSION[VT_MOBILE_REGISTER];

        /* 手机验证码检查 */
        if(empty($code))
        {
            helper::json('false', '验证码不正确');
        }
        // 检查发送短信验证码的手机号码和提交的手机号码是否匹配
        else if($session_mobile_phone != $mobile_phone)
        {
            make_json_error($_LANG['mobile_phone_changed']);
        }
        // 检查验证码是否正确
        else if($record['record_code'] != $mobile_code)
        {
            make_json_error($_LANG['invalid_mobile_phone_code']);
        }
        // 检查过期时间
        else if($record['expired_time'] < time())
        {
            make_json_error($_LANG['invalid_mobile_phone_code']);
        }

        /* 手机注册时，用户名默认为u+手机号 */
        $username = generate_username_by_mobile($mobile_phone);

        /* 手机注册 */
        $result = register_by_mobile($username, $password, $mobile_phone, $other);

        if($result)
        {
            /* 删除注册的验证记录 */
            remove_validate_record($mobile_phone);
        }

        exit($json->encode($results));
        break;
    }
    case 'login':
    {
        $results = array('result' => 'true', 'data' => array());
        $sql = "SELECT `value` FROM " . $ecs->table('shop_config') . " WHERE code='shop_name'";
        $shop_name = $db->getOne($sql);
        $sql = "SELECT `value` FROM " . $ecs->table('shop_config') . " WHERE code='currency_format'";
        $currency_format = $db->getOne($sql);
        $sql = "SELECT r.region_name, sc.value FROM " . $ecs->table('region') . " AS r INNER JOIN " . $ecs->table('shop_config') . " AS sc ON r.`region_id`=sc.`value` WHERE sc.`code`='shop_country' OR sc.`code`='shop_province' OR sc.`code`='shop_city' ORDER BY sc.`id` ASC";

        $shop_region = $db->getAll($sql);
        $results['data'] = array
        (
            'shop_name' => $shop_name,
            'domain' => 'http://' . $_SERVER['SERVER_NAME'] . '/',
            'shop_region' => $shop_region[0]['region_name'] . ' ' . $shop_region[1]['region_name'] . ' ' . $shop_region[2]['region_name'],
            'currency_format' => $currency_format
        );
        exit($json->encode($results));
        break;
    }
    case 'forget':
    {
        $results = array('result' => 'false', 'data' => array());
        $sql = "SELECT `shipping_id`, `shipping_name`, `insure` FROM " . $ecs->table('shipping');
        $result = $db->getAll($sql);
        if (!empty($result))
        {
            $results['result'] = 'true';
            $results['data'] = $result;
        }
        exit($json->encode($results));
        break;
    }
    case 'check':
    {
        $phone = empty($_POST['phone'])?null:$_POST['phone'];

        $results = array('result' => 'false', 'msg' => '', 'data' => array());
        if (empty($phone) || $user->check_mobile_phone($phone)){
            $results['msg'] = '手机号不可以注册';
        } else {
            $results['result'] = 'true';
            $results['msg'] = '手机号可以注册';
        }

        exit($json->encode($results));
        break;
    }
    case 'code':
    {
        $phone = empty($_POST['phone'])?null:$_POST['phone'];

        if (empty($phone)){
            helper::json('false', '手机不能为空');
        } else {
        }

        helper::json('true', '发送成功');
        break;
    }
    default:
    {
        $results = array('result'=>'false', 'data'=>'缺少动作');
        exit(json_encode($results));
        break;
    }
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