<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>团单服务</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/home/layui/css/layui.css" media="all">
    <style type="text/css" media="screen">
        .layui-form-label{padding:9px 0;text-align: left;width:100px;}
    </style>
</head>

<body style="background:#f5f5f5;">
    <section style="padding-bottom:20px;min-height: 550px;">
        <div class="col-md-6 offset-md-3 col-sm-12 col-xs-12" style="margin-bottom: 20px;padding:0;">
                   <img src="/static/home/img/project.png" class="img-fluid"> 
            </div>
        <div class="layui-container">
            <div class="layui-row">
                <div class="col-md-6 offset-md-3 col-sm-12 col-xs-12">
                    <form class="layui-form" >
                        {{csrf_field()}}
                        <div class="layui-form-item">
                            <label class="layui-form-label">联系人姓名</label>
                            <div class="layui-input-block">
                                <input name="name" class="layui-input" type="text" placeholder="请输入联系人姓名"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">联系人电话</label>
                            <div class="layui-input-block">
                                <input name="phone" class="layui-input" type="tel" placeholder="请输入联系人电话"
                                    autocomplete="off" lay-verify="required|phone">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">团单项目</label>
                            <div class="layui-input-block">
                                <input name="project" class="layui-input" type="text" placeholder="请输入团单项目"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">您更关心的事情</label>
                            <div class="layui-input-block">
                                <textarea class="layui-textarea" name="content" placeholder="请输入内容"></textarea>
                            </div>
                        </div>
                       
                                <button class="layui-btn layui-btn-fluid" type="button" lay-filter="submit"
                                    lay-submit="">提交</button>
                         
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