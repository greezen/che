<?php

/**
 * 圈子
 *
 */


define('IN_ECS', true);

require('./init.php');
require_once ROOT_PATH . 'includes/emchat/Easemob.class.php';

$act = isset($_GET['act'])? $_GET['act']:'';

$function_name = 'action_' . $act;

if(! function_exists($function_name))
{
    $function_name = "action_default";
}

call_user_func($function_name);


function action_default()
{
    exit();
}

function action_add_group()
{
}

?>