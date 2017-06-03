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
    $brand_list = $db->getAll("SELECT brand_id id,brand_name name,brand_logo logo FROM " . $GLOBALS['ecs']->table('brand'));

    $list = helper::orderBrand($brand_list);
    helper::json('true', '', $list);
}

function action_default()
{
    exit();
}

?>