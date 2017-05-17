<?php

/**
 * 工具类
 * User: greezen
 * Date: 2017/5/17
 * Time: 14:11
 */
class helper
{
    public static function json($result = 'true', $msg = '', $data = array())
    {
        $ret = array('result' => $result, 'msg' => $msg, 'data' => $data);

        exit(json_encode($ret));
    }
}