<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>在线留言</title>
    <link rel="stylesheet" href="/static/home/layui/css/layui.css" media="all">
    <style type="text/css" media="screen">
        .layui-form-label{padding:9px 0;text-align: left;width:100px;}
    </style>
</head>

<body style="background:#f5f5f5;">
    <section style="padding-top:40px;min-height: 550px;">
        <div class="layui-container">
            <div class="layui-row">
                <div class="layui-col-md6 layui-col-sm12 layui-col-xs12">
                    <form class="layui-form">
                        {{csrf_field()}}
                        <div class="layui-form-item">
                            <label class="layui-form-label">姓名</label>
                            <div class="layui-input-block">
                                <input name="name" class="layui-input" type="text" placeholder="请输入姓名"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">手机号码</label>
                            <div class="layui-input-block">
                                <input name="phone" class="layui-input" type="tel" placeholder="请输入手机"
                                    autocomplete="off" lay-verify="required|phone">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">邮箱地址</label>
                            <div class="layui-input-block">
                                <input name="email" class="layui-input" type="tel" placeholder="请输入邮箱"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">留言</label>
                            <div class="layui-input-block">
                                <textarea class="layui-textarea" name="content" placeholder="请输入内容"></textarea>
                            </div>
                        </div>
                    
                                <button class="layui-btn layui-btn-fluid" type="button" lay-filter="submit"
                                    lay-submit="">立即提交</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <script src="/static/home/layui/layui.js" charset="utf-8"></script>
    <script>
        layui.use(['form', 'layer'], function () {
            var form = layui.form
                , layer = layui.layer
                , $ = layui.jquery;

            form.on('submit(submit)', function (data) {
                // 提交到方法 默认为本身
                var loading = layer.load(1, { shade: [0.1, '#fff'] });
                $.post("{{ route('message') }}", data.field, function (res) {
                    layer.close(loading);
                    if (res.code > 0) {
                        layer.msg(res.msg, {time: 1000, icon: 1}, function () {
                            location.reload();
                        });

                    } else {
                        layer.msg(res.msg, { time: 1800, icon: 2 });
                    }
                });
            });

        });
    </script>

</body>

</html>