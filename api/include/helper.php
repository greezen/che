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

    public static function set_cache($key, $val, $expire = 0, $flag = null)
    {
        return self::init_cache()->set($key, $val, $flag, $expire);
    }

    public static function get_cache($key, $flag = null)
    {
        return self::init_cache()->get($key, $flag);
    }

    private static function init_cache()
    {
        $cache = new Memcache();
        $cache->connect('127.0.0.1', 11211);
        return $cache;
    }

    public static function gen_access_token($uid, $expire = 0)
    {
        $token = md5(md5(uniqid()) . $uid . time());
        self::set_cache('access_token'.$uid, $token, $expire);

        return $token;
    }
}