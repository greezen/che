<?php

return array(
    array(
        'id' => 'v1-0_register',
        'title' => '注册',
        'api' => '/api/user.php?act=register',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'phone',
                    'type' => 'string(11)',
                    'desc' => '手机号',
                    'required' => true,
                ),
                array(
                    'attr' => 'password',
                    'type' => 'string(6-20)',
                    'desc' => '密码',
                    'required' => true,
                ),
                array(
                    'attr' => 'code',
                    'type' => 'string',
                    'desc' => '验证码',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '
        {
            "phone" : "15566245598",
            "password" : "111111",
            "code" : "556688"
        }
                    ',
    ),
    array(
        'id' => 'v1-0_code',
        'title' => '发送手机验证码',
        'api' => '/api/user.php?act=code',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'phone',
                    'type' => 'string(11)',
                    'desc' => '手机号',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '
        {
            "phone" : "15566245598"
        }
                    ',
    ),
    array(
        'id' => 'v1-0_check',
        'title' => '手机号可用性检查',
        'api' => '/api/user.php?act=check',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'phone',
                    'type' => 'string(11)',
                    'desc' => '手机号',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '
        {
            "phone" : "15566245598"
        }
                    ',
    ),
    array(
        'id' => 'v1-0_login',
        'title' => '登录',
        'api' => '/api/user.php?act=login',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'phone',
                    'type' => 'string(11)',
                    'desc' => '手机号',
                    'required' => true,
                ),
                array(
                    'attr' => 'password',
                    'type' => 'string',
                    'desc' => '密码',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '
        {
            "phone" : "15566245598",
            "password" : "11111"
        }
                    ',
    ),
    array(
        'id' => 'v1-0_chpwd',
        'title' => '修改密码',
        'api' => '/api/user.php?act=chpwd',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string(32)',
                    'desc' => 'access_token',
                    'required' => true,
                ),
                array(
                    'attr' => 'old_pwd',
                    'type' => 'string',
                    'desc' => '原密码',
                    'required' => true,
                ),
                array(
                    'attr' => 'new_pwd',
                    'type' => 'string(6-20)',
                    'desc' => '新密码',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '
        {
            "access_token" : "b1e087dcd49735071e3392fae6586747",
            "old_pwd" : "11111",
            "new_pwd" : "666666",
        }
                    ',
    ),
    array(
        'id' => 'v1-0_set_profile',
        'title' => '设置个人资料',
        'api' => '/api/user.php?act=set_profile',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string(32)',
                    'desc' => 'access_token',
                    'required' => true,
                ),
                array(
                    'attr' => 'qq',
                    'type' => 'numeric',
                    'desc' => 'qq',
                    'required' => false,
                ),
                array(
                    'attr' => 'user_name',
                    'type' => 'string(1-20)',
                    'desc' => '用户名',
                    'required' => false,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '
        {
            "access_token" : "b1e087dcd49735071e3392fae6586747",
            "qq" : "123456",
            "user_name" : "用户名",
        }
                    ',
    ),
    array(
        'id' => 'v1-0_get_profile',
        'title' => '获取个人资料',
        'api' => '/api/user.php?act=get_profile',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string(32)',
                    'desc' => 'access_token',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '
        {
            "access_token" : "b1e087dcd49735071e3392fae6586747",
        }
                    ',
    ),
    array(
        'id' => 'v1-0_certify',
        'title' => '企业会员认证',
        'api' => '/api/user.php?act=certify',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string(32)',
                    'desc' => 'access_token',
                    'required' => true,
                ),
                array(
                    'attr' => 'zhizhao',
                    'type' => 'file',
                    'desc' => '营业执照(图片)',
                    'required' => true,
                ),
                array(
                    'attr' => 'organization_code',
                    'type' => 'file',
                    'desc' => '组织机构代码证(图片)',
                    'required' => true,
                ),
                array(
                    'attr' => 'idcard_front',
                    'type' => 'file',
                    'desc' => '法人身份证正面(图片)',
                    'required' => true,
                ),
                array(
                    'attr' => 'idcard_reverse',
                    'type' => 'file',
                    'desc' => '法人身份证反面(图片)',
                    'required' => true,
                ),
                array(
                    'attr' => 'business_licence_number',
                    'type' => 'string(1-100)',
                    'desc' => '营业执照号',
                    'required' => true,
                ),
                array(
                    'attr' => 'contacts_phone',
                    'type' => 'string(11)',
                    'desc' => '联系人手机号',
                    'required' => true,
                ),
                array(
                    'attr' => 'contacts_name',
                    'type' => 'string(1-100)',
                    'desc' => '联系人姓名',
                    'required' => true,
                ),
                array(
                    'attr' => 'settlement_bank_account_name',
                    'type' => 'string(1-100)',
                    'desc' => '对公账户名',
                    'required' => true,
                ),
                array(
                    'attr' => 'settlement_bank_account_number',
                    'type' => 'string(1-100)',
                    'desc' => '对公账号',
                    'required' => true,
                ),
                array(
                    'attr' => 'settlement_bank_name',
                    'type' => 'string(1-100)',
                    'desc' => '开户行',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_category',
        'title' => '车型列表信息',
        'api' => '/api/car.php?act=category',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string',
                    'desc' => 'access_token',
                    'required' => true,
                ),
                array(
                    'attr' => 'cat_id',
                    'type' => 'int',
                    'desc' => '车型id,不填则获取第一级的车型列表信息',
                    'required' => false,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":{
                    "A": [ //排序A-Z,只有第一级有排序
                        {
                            "cat_id": "2",//车型id
                            "name": "奥迪",//车型名称
                            "logo": "http://che.dev/data/category_img/1497016763990882049.jpg"//车型logo图片
                        }
                    ]
                }
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_add',
        'title' => '发布车源',
        'api' => '/api/car.php?act=add',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string',
                    'desc' => 'access_token',
                    'required' => true,
                ),
                array(
                    'attr' => 'cat_id',
                    'type' => 'int',
                    'desc' => '车型id',
                    'required' => true,
                ),
                array(
                    'attr' => 'register_time',
                    'type' => 'date',
                    'desc' => '上牌时间(2017-05)',
                    'required' => true,
                ),
                array(
                    'attr' => 'province_id',
                    'type' => 'int',
                    'desc' => '所在地省份id',
                    'required' => true,
                ),
                array(
                    'attr' => 'city_id',
                    'type' => 'ing',
                    'desc' => '所在地市id',
                    'required' => true,
                ),
                array(
                    'attr' => 'miles',
                    'type' => 'float',
                    'desc' => '里程数',
                    'required' => true,
                ),
                array(
                    'attr' => 'hock_type',
                    'type' => 'string',
                    'desc' => '抵押方式(all=>全款，bank=>抵押银行，loan=>低押小贷,personal=>低押个人)',
                    'required' => true,
                ),
                array(
                    'attr' => 'new_car_price',
                    'type' => 'float',
                    'desc' => '新车指导价',
                    'required' => true,
                ),
                array(
                    'attr' => 'price',
                    'type' => 'float',
                    'desc' => '零售价',
                    'required' => true,
                ),
                array(
                    'attr' => 'lower_price',
                    'type' => 'float',
                    'desc' => '最低价',
                    'required' => true,
                ),
                array(
                    'attr' => 'phone',
                    'type' => 'float',
                    'desc' => '联系电话',
                    'required' => true,
                ),
                array(
                    'attr' => 'img[]',
                    'type' => 'file',
                    'desc' => '商品图片',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_car_info',
        'title' => '获取车源信息',
        'api' => '/api/car.php?act=edit',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string',
                    'desc' => 'access_token',
                    'required' => true,
                ),
                array(
                    'attr' => 'goods_id',
                    'type' => 'int',
                    'desc' => '产品id',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_car_del_img',
        'title' => '获取车源信息',
        'api' => '/api/car.php?act=del_img',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string',
                    'desc' => 'access_token',
                    'required' => true,
                ),
                array(
                    'attr' => 'goods_id',
                    'type' => 'int',
                    'desc' => '产品id',
                    'required' => true,
                ),
                array(
                    'attr' => 'img_id',
                    'type' => 'int',
                    'desc' => '图片id',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_car_edit',
        'title' => '编辑车源',
        'api' => '/api/car.php?act=edit',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string',
                    'desc' => 'access_token',
                    'required' => true,
                ),
                array(
                    'attr' => 'cat_id',
                    'type' => 'int',
                    'desc' => '车型id',
                    'required' => true,
                ),
                array(
                    'attr' => 'register_time',
                    'type' => 'date',
                    'desc' => '上牌时间(2017-05)',
                    'required' => true,
                ),
                array(
                    'attr' => 'province_id',
                    'type' => 'int',
                    'desc' => '所在地省份id',
                    'required' => true,
                ),
                array(
                    'attr' => 'city_id',
                    'type' => 'ing',
                    'desc' => '所在地市id',
                    'required' => true,
                ),
                array(
                    'attr' => 'miles',
                    'type' => 'float',
                    'desc' => '里程数',
                    'required' => true,
                ),
                array(
                    'attr' => 'hock_type',
                    'type' => 'string',
                    'desc' => '抵押方式(all=>全款，bank=>抵押银行，loan=>低押小贷,personal=>低押个人)',
                    'required' => true,
                ),
                array(
                    'attr' => 'new_car_price',
                    'type' => 'float',
                    'desc' => '新车指导价',
                    'required' => true,
                ),
                array(
                    'attr' => 'price',
                    'type' => 'float',
                    'desc' => '零售价',
                    'required' => true,
                ),
                array(
                    'attr' => 'lower_price',
                    'type' => 'float',
                    'desc' => '最低价',
                    'required' => true,
                ),
                array(
                    'attr' => 'phone',
                    'type' => 'float',
                    'desc' => '联系电话',
                    'required' => true,
                ),
                array(
                    'attr' => 'img[]',
                    'type' => 'file',
                    'desc' => '商品图片',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_del',
        'title' => '删除车源',
        'api' => '/api/car.php?act=del',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string',
                    'desc' => 'access_token',
                    'required' => true,
                ),
                array(
                    'attr' => 'goods_id',
                    'type' => 'int',
                    'desc' => '车源id',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_region',
        'title' => '获取城市列表信息',
        'api' => '/api/car.php?act=region',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string',
                    'desc' => 'access_token',
                    'required' => true,
                ),
                array(
                    'attr' => 'region_id',
                    'type' => 'int',
                    'desc' => '城市id(不填则获取一级城市的信息，即省份直辖市)',
                    'required' => false,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[
                {
                    "id": "2",//城市id
                    "name": "北京"//城市名称
                },
                {
                    "id": "3",
                    "name": "安徽"
                },
                {
                    "id": "4",
                    "name": "福建"
                },...
            ]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_list',
        'title' => '管理车源',
        'api' => '/api/car.php?act=list',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'access_token',
                    'type' => 'string',
                    'desc' => 'access_token',
                    'required' => true,
                ),
                array(
                    'attr' => 'page',
                    'type' => 'int',
                    'desc' => '页码（默认第一页，每页10条数据）',
                    'required' => false,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[
                        {
                            "goods_id": "6",//产品id
                            "register_time": "2015年06月",//上牌时间
                            "miles": "1",//公里数
                            "price": "8.00",//价格
                            "view_count": "0",//浏览数
                            "city": "深圳",//城市
                            "title": "奥迪 一汽大众奥迪",//标题
                            "img": "http://che.dev/images/201706/thumb_img/6_thumb_G_1497452073311.jpg"//图片
                        },...
                    ]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_car_view',
        'title' => '查看车源详情',
        'api' => '/api/car.php?act=view',
        'method' => 'GET',
        'param' =>
            array(
                array(
                    'attr' => 'goods_id',
                    'type' => 'int',
                    'desc' => '产品id',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[
                        {
                            "goods_id": "6",//产品id
                            "register_time": "2015年06月",//上牌时间
                            "miles": "1",//公里数
                            "price": "8.00",//价格
                            "view_count": "0",//浏览数
                            "city": "深圳",//城市
                            "title": "奥迪 一汽大众奥迪",//标题
                            "img": "http://che.dev/images/201706/thumb_img/6_thumb_G_1497452073311.jpg"//图片
                        },...
                    ]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_article_category',
        'title' => '资讯分类',
        'api' => '/api/article.php?act=category',
        'method' => 'GET',
        'param' =>
            array(
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[
                        {
                            "cat_id": "1", //资讯分类id
                            "name": "系统分类"//资讯分类名称
                        },...
                    ]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_article_list',
        'title' => '资讯列表',
        'api' => '/api/article.php?act=list',
        'method' => 'GET',
        'param' =>
            array(
                array(
                    'attr' => 'cat_id',
                    'type' => 'int',
                    'desc' => '资讯分类id',
                    'required' => true,
                ),
                array(
                    'attr' => 'page',
                    'type' => 'int',
                    'desc' => '页码（默认第一页，每页10条数据）',
                    'required' => false,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[
                        {
                            "article_id": "130", //资讯id
                            "title": "网店一条街和网店连锁店的未来",//资讯标题
                            "description": "",//资讯描述
                            "add_time": "2015-07-19",//资讯发布时间
                            "thumb": "http://che.dev/includes/ueditor/php/../../../images/image//18321437614219.jpg"//资讯
                        },...
                    ]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_article_detail',
        'title' => '资讯详情',
        'api' => '/api/article.php?act=detail',
        'method' => 'GET',
        'param' =>
            array(
                array(
                    'attr' => 'article_id',
                    'type' => 'int',
                    'desc' => '资讯id',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":{
                        "title": "网店一条街和网店连锁店的未来",//资讯标题
                        "content": "我是资讯",//资讯内容
                        "add_time": "2015-07-19 23:18:28",//资讯发布时间
                        "author": "张三",//作者
                        "dig": "10"//点赞数
                    }
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
    array(
        'id' => 'v1-0_article_dig',
        'title' => '资讯点赞',
        'api' => '/api/article.php?act=dig',
        'method' => 'POST',
        'param' =>
            array(
                array(
                    'attr' => 'article_id',
                    'type' => 'int',
                    'desc' => '资讯id',
                    'required' => true,
                ),
            ),
        'response' => '
        {
            "result":"true",//失败返回字符串false,msg中是具体的错误和提示信息
            "msg":"",
            "data":[]
        }

    ',
        'remark' => '',
        'demo' => '',
    ),
);