<?php

/**
 * 工具类
 * User: greezen
 * Date: 2017/5/17
 * Time: 14:11
 */
class helper
{
    /**
     * 返回json数据
     * @param string $result
     * @param string $msg
     * @param array $data
     */
    public static function json($result = 'true', $msg = '', $data = array())
    {
        $ret = array('result' => $result, 'msg' => $msg, 'data' => $data);

        exit(json_encode($ret));
    }

    /**
     * 设置缓存
     * @param $key
     * @param $val
     * @param int $expire
     * @param null $flag
     * @return bool
     */
    public static function set_cache($key, $val, $expire = 0, $flag = null)
    {
        return self::init_cache()->set($key, $val, $flag, $expire);
    }

    /**
     * 获取缓存
     * @param $key
     * @param null $flag
     * @return array|bool|string
     */
    public static function get_cache($key, $flag = null)
    {
        if (empty($key)) {
            return false;
        }
        return self::init_cache()->get($key, $flag);
    }

    /**
     * 删除缓存
     * @param $key
     * @return bool
     */
    public static function del_cache($key)
    {
        if (empty($key)) {
            return true;
        }

        return self::init_cache()->delete($key);
    }

    /**
     * 缓存初始化
     * @return Memcache
     */
    private static function init_cache()
    {
        $cache = new Memcache();
        $cache->connect('127.0.0.1', 11211);
        return $cache;
    }

    /**
     * 生成登录token
     * @param $uid
     * @param int $expire
     * @return string
     */
    public static function gen_access_token($uid, $expire = 0)
    {
        $token = md5(md5(uniqid()) . $uid . time());
        $data = array('uid' => $uid);
        self::del_cache(self::get_cache('access_token'.$uid));
        self::del_cache('access_token'.$uid);
        self::set_cache('access_token'.$uid, $token, $expire);
        self::set_cache($token, $data, $expire);

        return $token;
    }

    /**
     * 发送短信
     * @param $phone
     * @param $content
     * @param string $sgin
     * @param string $stime
     * @return bool
     */
    public static function send_sms($phone, $content, $sgin = '允升网络传媒', $stime = '')
    {
        require(ROOT_PATH . 'includes/lib_sms.php');
        $url = 'http://210.5.152.195:1860/asmx/smsservice.aspx';
        $data = array(
            'type' => 'pt',
            'name' => 'cpsyswlcm',
            'pwd' => '9BE5342D1E106A1C355744BB8A4C',
            'content' => $content,
            'mobile' => $phone,
            'sign' => $sgin,
            'stime' => $stime,
        );
        $res = dopost($url, $data);
        $res = explode(',', $res);
        if ($res[0] == 0) {
            return true;
        }

        return false;
    }

    /**
     * 处理get请求数据
     * @param null $key
     * @param null $default
     * @param string $fun
     * @return null
     */
    public static function get($key = null, $default = null, $fun = 'trim')
    {
        if (!empty($key) && isset($_GET[$key])) {
            return $fun($_GET[$key]);
        }

        return $default;
    }

    /**
     * 处理post请求数据
     * @param null $key
     * @param null $default
     * @param string $fun
     * @return null
     */
    public static function post($key = null, $default = null, $fun = 'trim')
    {
        if ($key == 'ALL') {
            foreach ($_POST as &$field) {
                $field = $fun($field);
            }
        }
        if (!empty($key) && isset($_POST[$key])) {
            return $fun($_POST[$key]);
        }

        return $default;
    }

    public static function rand_str($length = 8)
    {
        $source = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($source), 0,$length);
    }
}