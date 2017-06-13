<?php

/**
 * 车源
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

call_user_func($function_name, $GLOBALS['db'], $GLOBALS['ecs']);

/**
 * 车型
 * @param $db
 * @param $ecs
 */
function action_category($db, $ecs)
{
    $cid = helper::post('cat_id', 0, 'intval');
    $access_token = helper::post('access_token');
    $access_data = helper::get_cache($access_token);

    if (empty($access_token) || empty($access_data)) {
        helper::json('false', '登录超时，请重新登录');
    }
    $list = array();
    if (empty($cid)) {
        $brand_list = $db->getAll("SELECT cat_id, cat_name name,cat_logo logo FROM " . $ecs->table('category') . ' WHERE parent_id=1');
        $list = helper::orderBrand($brand_list);
    } else {
        $cat = $db->getRow("SELECT * FROM ". $ecs->table('category') . " WHERE cat_id={$cid}");
        if (!empty($cat)) {
            $list = $db->getAll("SELECT cat_id, cat_name name,cat_logo logo FROM ". $ecs->table('category') . " WHERE parent_id={$cid}");
            foreach ($list as &$row) {
               if (!empty($row['logo'])) {
                   $row['logo'] = 'http://' . $_SERVER['HTTP_HOST'] . '/data/category_img/'. $row['logo'];
               }
           }
        }
    }

    helper::json('true', '', $list);
}

/**
 * 车辆所在地信息
 * @param $db
 * @param $ecs
 */
function action_car_place($db, $ecs)
{
    $list = $db->getAll("SELECT province,short FROM ". $ecs->table('car_area'). ' ORDER BY sort_order DESC');
    helper::json('true', '', $list);
}

/**
 * 发布车源
 * @param $db
 * @param $ecs
 */
function action_add($db, $ecs)
{
    $img = empty($_FILES['img'])?null:$_FILES['img'];
    $cid = helper::post('cat_id', 0);//车型
    $register_time = helper::post('register_time', null, 'strtotime');//上牌时间
    $place = helper::post('place');//所在地
    $miles = helper::post('miles');//表显里程
    $hock_type = helper::post('hock_type');//抵押方式
    $new_car_price = helper::post('new_car_price');//新车指导价
    $price = helper::post('price');//零售价
    $lower_price = helper::post('lower_price');//最低价
    $phone = helper::post('phone');//联系电话
    $access_token = helper::post('access_token');
    $access_data = helper::get_cache($access_token);

    $hock_list = helper::getHockList();

    if (empty($access_token) || empty($access_data)) {
        helper::json('false', '登录超时，请重新登录');
    } elseif (empty($cid)) {
        helper::json('false', '车型不能为空');
    } elseif (empty($register_time)) {
        helper::json('false', '上牌时间不能空');
    } elseif (empty($place)) {
        helper::json('false', '所在地不能空');
    } elseif (empty($miles)) {
        helper::json('false', '表显里程不能空');
    } elseif (empty($hock_type)) {
        helper::json('false', '抵押方式不能空');
    } elseif (empty($new_car_price)) {
        helper::json('false', '新车指导价不能空');
    } elseif (empty($price)) {
        helper::json('false', '零售价不能空');
    } elseif (empty($lower_price)) {
        helper::json('false', '最低价不能空');
    } elseif (empty($phone)) {
        helper::json('false', '联系电话不能空');
    } elseif (empty($img)) {
        helper::json('false', '图片不能空');
    } elseif (count($img['name']) > 8) {
        helper::json('false', '最多只能上传8张图片哦');
    } elseif (!isset($hock_list[$hock_type])) {
        helper::json('false', '非法的抵押方式');
    }

    $car = array(
        'cat_id' => $cid,
        'price' => $price,
        'lower_price' => $lower_price,
        'new_car_price' => $new_car_price,
        'time_created' => time(),
        'sort_order' => 0,
        'phone' => $phone,
        'hock_type' => $hock_type,
        'register_time' => $register_time,
        'miles' => $miles,
        'user_id' => $access_data['uid'],
    );

    $flow = false;
    $db->query('begin');
    //goods表
    if ($db->autoExecute($ecs->table('goods_car'), $car, 'INSERT')) {
        $flow = true;
    }

    $goods_car_id = $db->insert_id();

    if ($flow) {
        $_CFG = $GLOBALS['_CFG'];
        include_once(ROOT_PATH . '/includes/cls_image.php');
        require_once(ROOT_PATH . '/' . ADMIN_PATH . '/includes/lib_goods.php');
        $image = new cls_image($_CFG['bgcolor']);
        foreach ($img['name'] as $key=>$val) {
            $tmp = array(
                'name' => $img['name'][$key],
                'type' => $img['type'][$key],
                'tmp_name' => $img['tmp_name'][$key],
                'error' => $img['error'][$key],
                'size' => $img['size'][$key],
            );
            $car_img = $image->upload_image($tmp);
            $source_img = reformat_image_name('goods', $goods_car_id, $car_img, 'source');
            $goods_thumb = $image->make_thumb(ROOT_PATH . '/' . $source_img, $GLOBALS['_CFG']['thumb_width'],  $GLOBALS['_CFG']['thumb_height']);
            $goods_thumb = reformat_image_name('goods_thumb', $goods_car_id, $goods_thumb, 'thumb');

            $img_data = array(
                'goods_car_id' => $goods_car_id,
                'thumb_url' => $goods_thumb,
                'img_original' => $source_img,
            );
            if ($db->autoExecute($ecs->table('goods_car_img'), $img_data, 'INSERT') === false) {
                $flow = false;
                break;
            }
            unset($tmp, $img_data);
        }
    }

    if (empty($flow)) {
        $db->query('rollback');
    } else {
        $db->query('commit');
        helper::json('true', '发布车源成功');
    }
    helper::json('false', '发布车源失败');
}

/**
 * 管理车源
 * @param $db
 * @param $ecs
 */
function action_list($db, $ecs)
{
    $page = helper::post('page', 1);
    $access_token = helper::post('access_token');
    $access_data = helper::get_cache($access_token);

    if (empty($access_token) || empty($access_data)) {
        helper::json('false', '登录超时，请重新登录');
    }

    $limit = 10;
    $offset = ($page - 1) * $limit;

    $sql = "SELECT id goods_id,cat_id,register_time,miles,price,view_count FROM ". $ecs->table('goods_car') . " WHERE user_id=".$access_data['uid']." limit {$offset},{$limit}";
    $list = $db->getAll($sql);

    foreach ($list as &$row) {
        $row['title'] = '';
        $row['register_time'] = date('Y年m月', $row['register_time']);
    }

    helper::json('true', '', $list);
}

/**
 * 删除车源
 * @param $db
 * @param $ecs
 */
function action_del($db, $ecs)
{
    $goods_id = helper::post('goods_id', 0);
    $access_token = helper::post('access_token');
    $access_data = helper::get_cache($access_token);

    if (empty($access_token) || empty($access_data)) {
        helper::json('false', '登录超时，请重新登录');
    } elseif (empty($goods_id)) {
        helper::json('false', '参数不正确');
    }

    $flow = false;
    $db->query('begin');
    $db->query('DELETE FROM '.$ecs->table('goods_car').' WHERE id = '. $goods_id.' AND user_id='.$access_data['uid']);
    if($db->affected_rows() > 0) {
        $flow = true;
    }

    $img_count = $db->getOne('SELECT COUNT(*) num FROM '. $ecs->table('goods_car_img'). ' WHERE goods_car_id='.$goods_id);
    if ($flow && $img_count > 0) {
        $db->query('DELETE FROM '.$ecs->table('goods_car_img').' WHERE goods_car_id = '. $goods_id);
        if ($db->affected_rows() > 0) {
            $flow = true;
        } else {
            $flow = false;
        }
    }

    if (empty($flow)) {
        $db->query('rollback');
        helper::json('false', '操作失败');
    }

    $db->query('commit');
    helper::json('true', '操作成功');
}

/**
 * 获取城市信息
 * @param $db
 * @param $ecs
 */
function action_region($db, $ecs)
{
    $region_id = helper::post('region_id', 1);
    $access_token = helper::post('access_token');
    $access_data = helper::get_cache($access_token);

    if (empty($access_token) || empty($access_data)) {
        helper::json('false', '登录超时，请重新登录');
    }
    $list = $db->getAll('SELECT region_id id,region_name name FROM '.$ecs->table('region').' WHERE parent_id='.$region_id);
    helper::json('true', '', $list);
}

function action_default()
{
    exit();
}
