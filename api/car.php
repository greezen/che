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
function action_brand()
{
    $db = $GLOBALS['db'];
    var_dump(GetPinyin('1bmw'));
    $brand_list = $db->getAll("SELECT brand_id id,brand_name name,brand_logo logo FROM " . $GLOBALS['ecs']->table('brand'));
    $brand_list = array(
        array(
            'name' => '珀莱雅'
        ),array(
            'name' => '缪诗'
        ),array(
            'name' => '泸州老窖'
        ),
    );
    $s = helper::orderByName($brand_list);
    var_dump($s);
}

function action_default()
{
    exit();
}

?>