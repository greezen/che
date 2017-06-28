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
        self::del_cache(self::get_cache('access_token' . $uid));
        self::del_cache('access_token' . $uid);
        self::set_cache('access_token' . $uid, $token, $expire);
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
        if (!empty($key) && !empty($_POST[$key])) {
            return $fun($_POST[$key]);
        }

        return $default;
    }

    public static function rand_str($length = 8)
    {
        $source = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($source), 0, $length);
    }

    /**
     * 数据验证
     * @param $param
     * @param $rule
     * @return bool|mixed
     */
    public static function validator($param, $rule)
    {
        require_once ROOT_PATH . 'api/include/valitron.php';
        $v = new \Valitron\Validator($param);
        $v->rules($rule);
        if ($v->validate()) {
            return true;
        } else {
            $error = array_shift($v->errors());
            //self::json('false', $error[0]);
            //return array_shift($res);
        }
    }

    public static function getFirstChar($s)
    {
        $s0 = mb_substr($s, 0, 1);                //获取名字的姓
        $s = iconv('UTF-8', 'gb2312', $s0);       //将UTF-8转换成GB2312编码
        if (ord($s0) > 128) {                      //汉字开头，汉字没有以U、V开头的
            $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
            if ($asc >= -20319 and $asc <= -20284) return "A";
            if ($asc >= -20283 and $asc <= -19776) return "B";
            if ($asc >= -19775 and $asc <= -19219) return "C";
            if ($asc >= -19218 and $asc <= -18711) return "D";
            if ($asc >= -18710 and $asc <= -18527) return "E";
            if ($asc >= -18526 and $asc <= -18240) return "F";
            if ($asc >= -18239 and $asc <= -17760) return "G";
            if ($asc >= -17759 and $asc <= -17248) return "H";
            if ($asc >= -17247 and $asc <= -17418) return "I";
            if ($asc >= -17417 and $asc <= -16475) return "J";
            if ($asc >= -16474 and $asc <= -16213) return "K";
            if ($asc >= -16212 and $asc <= -15641) return "L";
            if ($asc >= -15640 and $asc <= -15166) return "M";
            if ($asc >= -15165 and $asc <= -14923) return "N";
            if ($asc >= -14922 and $asc <= -14915) return "O";
            if ($asc >= -14914 and $asc <= -14631) return "P";
            if ($asc >= -14630 and $asc <= -14150) return "Q";
            if ($asc >= -14149 and $asc <= -14091) return "R";
            if ($asc >= -14090 and $asc <= -13319) return "S";
            if ($asc >= -13318 and $asc <= -12839) return "T";
            if ($asc >= -12838 and $asc <= -12557) return "W";
            if ($asc >= -12556 and $asc <= -11848) return "X";
            if ($asc >= -11847 and $asc <= -11056) return "Y";
            if ($asc >= -11055 and $asc <= -10247) return "Z";
        } else if (ord($s) >= 48 and ord($s) <= 57) { //数字开头
            switch (iconv_substr($s, 0, 1, 'utf-8')) {
                case 1:
                    return "Y";
                case 2:
                    return "E";
                case 3:
                    return "S";
                case 4:
                    return "S";
                case 5:
                    return "W";
                case 6:
                    return "L";
                case 7:
                    return "Q";
                case 8:
                    return "B";
                case 9:
                    return "J";
                case 0:
                    return "L";
            }
        } else if (ord($s) >= 65 and ord($s) <= 90) { //大写英文开头
            return substr($s, 0, 1);
        } else if (ord($s) >= 97 and ord($s) <= 122) { //小写英文开头
            return strtoupper(substr($s, 0, 1));
        } else {
            return iconv_substr($s0, 0, 1, 'utf-8');
            //中英混合的词语，不适合上面的各种情况，因此直接提取首个字符即可
        }
    }

    public static function orderByName($list)
    {
        sort($list);
        $charArray = array();
        foreach ($list as $item) {
            $char = self::getFirstChar($item['name']);
            $nameArray = array();//将姓名按照姓的首字母与相对的首字母键进行配对
            if (count($charArray[$char]) != 0) {
                $nameArray = $charArray[$char];
            }
            array_push($nameArray, $item);
            $charArray[$char] = $nameArray;
        }
        ksort($charArray);//根据键值对排序
        return $charArray;
    }

    public static function orderBrand($list)
    {
        $ret = array();
        foreach ($list as &$item) {
            $item['logo'] = 'http://' . $_SERVER['HTTP_HOST'] . '/data/category_img/'. $item['logo'];
            $short = GetPinyin($item['name'], true);
            $ret[strtoupper($short[0])][] = $item;
        }

        ksort($ret);
        return $ret;
    }

    /**
     * 获取抵押方式
     * @param null $index
     * @return array|mixed|string
     */
    public static function getHockList($index = null)
    {
        $hock_list = array(
            'all' => '全款',
            'bank' => '低押银行',
            'loan' => '低押小贷',
            'personal' => '低押个人',
        );
        if ($index === null) {
            return $hock_list;
        } else {
            return isset($hock_list[$index]) ? $hock_list[$index] : '';
        }
    }

    public static function getHost()
    {
        return 'http://'.$_SERVER['HTTP_HOST'].'/';
    }
}