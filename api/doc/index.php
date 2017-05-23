<?php
/**
 * Short description for index.php
 *
 * @package index
 * @author 吴振宁 EN(daling ng) <13416001387@163.com>
 * @version 0.1
 * @copyright (C) 2016 吴振宁 EN(daling ng) <13416001387@163.com>
 * @license MIT
 */

$host = $_SERVER['HTTP_HOST'];
if (!in_array($host, ['che.dev'])) {
    header('Location: http://diyache.adipower.net:81/api/doc/');
}

$data = require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'data.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width"/>
    <title>接口文档</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
        .api {
            background-color: #f5f5f5;
            margin-bottom: 0.5rem;
        }

        .api pre {
            margin: 0.5rem 0;
            background-color: #fff;
        }

        .api > * {
            display: none;
        }

        .api > .title {
            display: block;
            background-color: rgba(12, 120, 212, 0.78);
            color: #fff;
            box-shadow: 2px 3px 0.1rem rgba(2, 52, 137, 0.68);
        }

        .api.open > * {
            display: block;
        }

        .api .content {
            background-color: #fff;
            min-height: 3rem;
            white-space: pre-wrap;
            font-family: Monospace;
            word-break: break-all;
        }

        .api .red {
            color: #f00;
        }

        .api .sel {
            color: #337ab7;
        }

        .side-nav {
            padding: 2rem 1rem;
            background-color: rgba(238, 238, 238, 0.46);
            position: fixed;
            right: 0;
            overflow-y: scroll;
            height: 100%;
        }
        .side-nav .version-title{
            background-color: #1fcbe2;
            font-size: 1rem;
            cursor: pointer;
            margin-bottom: 0.5rem;
        }

        .small-nav {
            display: none;
        }

    </style>
</head>
<body>
<div class="container-fluid app">
    <div class="row">

        <div class="col-lg-10">
            <!-- 接口说明 -->
            <div class="row api">
                <div class="col-md-12 title">
                    <h3>接口说明</h3>
                </div>
                <div class="col-md-12">
                    <pre>
    <strong>正式环境接口域名：</strong>http://diyache.adipower.net:81
    <strong>测试环境接口域名：</strong>http://diyache.adipower.net
                    </pre>
                </div>
            </div>

            <?php foreach ($data as $key => $item) : ?>
                <div class="row api api-item" id="<?=$item['id']?>">
                    <div class="col-md-12 title">
                        <h3><span>1.<?=$key+1?></span> <?= $item['title']?></h3>
                    </div>
                    <div class="col-md-12">
                    <pre>
    <strong>接口地址：</strong><?=$item['api']?><br>
    <strong>提交方式：</strong><?=$item['method']?><br>
    <strong>请求参数：</strong>
                        <table class="table table-bordered" style="margin-left: 2rem;width: 95%;">
                            <tr>
                                <th>参数</th>
                                <th>类型</th>
                                <th>说明</th>
                                <th></th>
                            </tr>
                            <?php foreach ($item['param'] as $param) :?>
                                <tr>
                                <td><?=$param['attr']?></td>
                                <td><?=$param['type']?></td>
                                <td><?=$param['desc']?></td>
                                    <?php if ($param['required']) :?>
                                        <td><span class="red">必填</span></td>
                                    <?php else :?>
                                        <td>选填</td>
                                    <?php endif;?>
                            </tr>
                            <?php endforeach;?>
                        </table>
    <strong>返回参数：</strong>
                        <?= $item['response']?><br>
    <strong>参数说明：</strong>
                        <?=$item['remark']?><br>
    <strong>请求示例：</strong>
                        <?=$item['demo']?>
                    </pre>
                    </div>
                    <div class="col-md-4">
                        <form action="<?=$item['api']?>" method="<?=$item['method']?>" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-3">params</label>
                                <div class="col-md-9">
                                    <textarea name="params" required="required" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-warning btn-block">测试</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="content"></div>
                    </div>
                </div>
            <?php endforeach;?>

        </div>

        <nav class="col-lg-2 side-nav">
            <div class="form-group">
                <input type="email" class="form-control" id="api-search" v-model="title" placeholder="Search">
            </div>
            <div class="api-nav">
                <div class="api-nav-item" v-for="(api, index) in api_nav" >
                    <a :href="'#'+api.id" v-html="api.title" :class="api.id.substr(0,4)" v-cloak></a>
                </div>
            </div>
        </nav>
    </div>
</div>
<script src="/js/vue.min.js"></script>
<script type="text/javascript" charset="utf-8">
    $(function () {
        new Vue({
            el: '.app',
            data: {
                title: '',
                api_list: <?=json_encode($data)?>
            },
            computed: {
                api_nav: function () {
                    var that = this;
                    return that.api_list.filter(function (api) {
                        return api.title.indexOf(that.title) !== -1;
                    })
                }

            }
        });

        $('.version-title').click(function () {
            var version = $(this).attr('data-version');
            if($('.' + version).hasClass('hide')) {
                $('.' + version).removeClass('hide');
            } else {
                $('.' + version).addClass('hide');
            }
        });

        $("body").on("click", ".api>.title", function (evt) {
            var $el = $(evt.currentTarget);
            var $api = $el.parent();
            if (!$api.hasClass("open")) {
                $(".api").not($api).removeClass("open");
                $api.addClass("open");
            } else {
                $api.removeClass("open");
            }
        });

        $("body").on("click", ".api-nav-item>a", function (evt) {
            console.log($(this).attr('href'));
            var $el = $(""+ $(this).attr('href') +"");
            console.log($el);
            if (!$el.hasClass("open")) {
                $(".api").not($el).removeClass("open");
                $el.addClass("open");
            } else {
                $el.removeClass("open");
            }
        });
        $("body").on("submit", ".api form", function (evt) {
            var $el = $(evt.currentTarget);
            var url = $el.attr("action");
            var method = $el.attr("method") ? $el.attr("method") : "get";

            var formData = $(this).find('textarea[name=params]').val();
            if ($(this).hasClass('upload')) {
                var formData = new FormData(evt.currentTarget);
            }

            if (method == "get") {
                formData = $el.serialize();
            }


            var def = $.ajax({
                url: url,
                type: method,
                data: formData,
                dataType: "json",
                /**
                 * 必须false才会避开jQuery对 formdata 的默认处理
                 * XMLHttpRequest会对 formdata 进行正确的处理
                 */
                processData: false,
                /**
                 *必须false才会自动加上正确的Content-Type
                 */
                contentType: false
            });
            var $content = $el.parentsUntil("body", ".api").find(".content");
            def.then(function (json) {
                $content.html(document.createTextNode(JSON.stringify(json, null, 4)));
            }, function (resp) {
                $content.html(resp.responseText);
            });
            return false;
        });

    });
</script>
</body>
</html>
