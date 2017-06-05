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

call_user_func($function_name);

/**
 * 车型
 */
function action_category()
{
    $cid = isset($_GET['cid'])?intval($_GET['cid']):0;
    $list = array();
    $db = $GLOBALS['db'];
    if (empty($cid)) {
        $brand_list = $db->getAll("SELECT cat_id cid, cat_name name,cat_logo logo FROM " . $GLOBALS['ecs']->table('category') . ' WHERE parent_id=0');
        $list = helper::orderBrand($brand_list);
    } else {
        $cat = $db->getRow("SELECT * FROM ". $GLOBALS['ecs']->table('category') . " WHERE cat_id={$cid}");
        if (!empty($cat)) {
            if ($cat['parent_id'] == 0) {
                $list = $db->getAll("SELECT cat_id cid, cat_name name FROM ". $GLOBALS['ecs']->table('category') . " WHERE parent_id={$cid}");
                foreach ($list as &$item) {
                    $item['child'] = $db->getAll("SELECT cat_id cid, cat_name name,cat_logo logo FROM ". $GLOBALS['ecs']->table('category') . " WHERE parent_id={$item['cid']}");
                }
            } else {
                $list = $db->getAll("SELECT cat_id cid, cat_name name,cat_logo logo FROM ". $GLOBALS['ecs']->table('category') . " WHERE parent_id={$cid}");
            }
           foreach ($list as &$row) {
               if (isset($row['child'])) {
                   foreach ($row['child'] as &$item) {
                       $item['logo'] = 'http://' . $_SERVER['HTTP_HOST'] . '/data/category_img/'. $row['logo'];
                   }
               } else {
                   $row['logo'] = 'http://' . $_SERVER['HTTP_HOST'] . '/data/category_img/'. $row['logo'];
               }
           }
        }
    }


    helper::json('true', '', $list);
}

function action_default()
{
    exit();
}
