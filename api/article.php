<?php

/**
 * 资讯
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
 * 文章分类
 * @param $db
 * @param $ecs
 */
function action_category($db, $ecs)
{
    $list = $db->getAll("SELECT cat_id, cat_name name FROM " . $ecs->table('article_cat') . ' WHERE parent_id=0');

    helper::json('true', '', $list);
}

/**
 * 文章列表
 * @param $db
 * @param $ecs
 */
function action_list($db, $ecs)
{
    $cat_id = helper::get('cat_id');
    $page = helper::get('page', 1);

    $limit = 10;
    $offset = ($page - 1) * $limit;

    $list = array();
    if (!empty($cat_id)) {
        $filed = array(
            'article_id',
            'title',
            'description',
            'content',
            'add_time',
            'dig',
        );
        $filed = implode(',', $filed);
        $sql = "SELECT {$filed} FROM ". $ecs->table('article') . " WHERE cat_id=".$cat_id. " ORDER BY add_time DESC limit {$offset},{$limit}";
        $list = $db->getAll($sql);

        if (!empty($list)) {
            foreach ($list as &$row) {
                $row['add_time'] = date('Y-m-d', $row['add_time']);
                preg_match('/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/', $row['content'], $match);
                $row['thumb'] = $match[1];
                unset($row['content']);
            }
        }
    }

    helper::json('true', '', $list);
}

/**
 * 文章详情
 * @param $db
 * @param $ecs
 */
function action_detail($db, $ecs)
{
    $article_id = helper::get('article_id');

    $detail = array();
    if (!empty($article_id)) {
        $filed = array(
            'title',
            'content',
            'add_time',
            'author',
            'dig',
        );
        $filed = implode(',', $filed);
        $sql = "SELECT {$filed} FROM ". $ecs->table('article') . " WHERE article_id=".$article_id;
        $detail = $db->getRow($sql);
        if (!empty($detail)) {
            $detail['add_time'] = date('Y-m-d H:i:s', $detail['add_time']);
        }
    }

    helper::json('true', '', $detail, JSON_UNESCAPED_UNICODE);
}

/**
 * 文章点赞
 * @param $db
 * @param $ecs
 */
function action_dig($db, $ecs)
{
    $article_id = helper::post('article_id');

    if (!empty($article_id)) {

        $sql = "UPDATE ". $ecs->table('article') . " SET dig=dig+1 WHERE article_id=".$article_id;
        $db->query($sql);
        if ($db->affected_rows() > 0) {
            helper::json('true', '点赞成功');
        }
    }

    helper::json('false', '点赞失败');
}


function action_default()
{
    exit();
}