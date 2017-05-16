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
        $shop_id = isset($data['shop_id'])? intval($data['shop_id']):0;
        $record_number = isset($data['record_number'])? intval($data['record_number']):20;
        $page_number = isset($data['page_number'])? intval($data['page_number']):0;
        $limit = ' LIMIT ' . ($record_number * $page_number) . ', ' . ($record_number+1);
        $sql = "SELECT `goods_id`, `goods_name`, `goods_number`, `shop_price`, `keywords`, `goods_brief`, `goods_thumb`, `goods_img`, `last_update` FROM " . $ecs->table('goods') . " WHERE `is_delete`='0' ORDER BY `goods_id` ASC $limit ";
        $results = array('result' => 'false', 'next' => 'false', 'data' => array());
        $query = $db->query($sql);
        $record_count = 0;
        while ($goods = $db->fetch_array($query))
        {
            $goods['goods_thumb'] = (!empty($goods['goods_thumb']))? 'http://' . $_SERVER['SERVER_NAME'] . '/' . $goods['goods_thumb']:'';
            $goods['goods_img'] = (!empty($goods['goods_img']))? 'http://' . $_SERVER['SERVER_NAME'] . '/' . $goods['goods_img']:'';
            $results['data'][] = $goods;
            $record_count++;
        }
        if ($record_count > 0)
        {
            $results['result'] = 'true';
        }
        if ($record_count > $record_number)
        {
            array_pop($results['data']);
            $results['next'] = 'true';
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

        if (empty($phone) || !$user->check_mobile_phone($phone)){

        } else {

        }

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