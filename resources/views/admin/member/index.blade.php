@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group ">
                @can('member.member.destroy')
                    <button class="layui-btn layui-btn-sm layui-btn-danger" id="listDelete">删除</button>
                @endcan
                <button class="layui-btn layui-btn-sm" id="memberSearch">搜索</button>
            </div>
            <div class="layui-form">
                <div class="layui-input-inline">
                    <input type="text" name="name" id="name" placeholder="请输入昵称" class="layui-input">
                </div>
               {{--  <div class="layui-input-inline">
                    <input type="text" name="phone" id="phone" placeholder="请输入手机号" class="layui-input">
                </div> --}}
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('member.member.destroy')
                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                    @endcan
                </div>
            </script>
            <script type="text/html" id="avatar">
                <a href="@{{d.avatar}}" target="_blank" title="点击查看"><img src="@{{d.avatar}}" alt="" width="40" height="40"></a>
            </script>
            <script type="text/html" id="is_lock">
                <input type="checkbox" name="power" value="@{{d.id}}" lay-skin="switch" lay-text="开通|禁用" lay-filter="is_lock" @{{ d.permissions == 1 ? 'checked' : 0 }}>
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('member.member')
        <script>
            layui.use(['layer','table','form'],function () {
                var layer = layui.layer;
                var form = layui.form;
                var table = layui.table;
                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                    ,height: 500
                    ,url: "{{ route('admin.member.data') }}" //数据接口
                    ,where:{model:"member"}
                    ,page: true //开启分页
                    ,cols: [[ //表头
                        {checkbox: true,fixed: true}
                        ,{field: 'id', title: 'ID',width:80,sort:true}
                        ,{field: 'nickname', title: '微信昵称'}
                        ,{field: 'avatar', title: '头像',toolbar:'#avatar',width:100}
                        ,{field:'province',title:'省份'}
                        ,{field:'city',title:'城市'}
                        ,{field:'permissions',align:'center',title:'发布动态权限',toolbar: '#is_lock',width:150}
                        ,{field: 'created_at', title: '注册时间'}
                        ,{field: 'updated_at', title: '上次登录时间'}
                        ,{fixed: 'right', width: 120, align:'center', toolbar: '#options'}
                    ]]
                });

                //监听工具条
                table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        ,layEvent = obj.event; //获得 lay-event 对应的值
                    if(layEvent === 'del'){
                        layer.confirm('确认删除吗？', function(index){
                            $.post("{{ route('admin.member.destroy') }}",{_method:'delete',ids:[data.id]},function (result) {
                                if (result.code==0){
                                    obj.del(); //删除对应行（tr）的DOM结构
                                }
                                layer.close(index);
                                layer.msg(result.msg)
                            });
                        });
                    } 
                });

                 form.on('switch(is_lock)', function(obj){
                    loading =layer.load(1, {shade: [0.1,'#fff']});
                    var id = this.value;
                    var is_lock = obj.elem.checked===true?1:0;
                    $.post("{{ route('admin.member.permissions') }}",{'id':id,'permissions':is_lock},function (res) {
                        layer.close(loading);
                        if (res.code ==0) {
                            tableIn.reload();
                        }else{
                            layer.msg(res.msg,{time:1000,icon:2});
                            return false;
                        }
                    })
                });
                //按钮批量删除
                $("#listDelete").click(function () {
                    var ids = []
                    var hasCheck = table.checkStatus('dataTable')
                    var hasCheckData = hasCheck.data
                    if (hasCheckData.length>0){
                        $.each(hasCheckData,function (index,element) {
                            ids.push(element.id)
                        })
                    }
                    if (ids.length>0){
                        layer.confirm('确认删除吗？', function(index){
                            $.post("{{ route('admin.member.destroy') }}",{_method:'delete',ids:ids},function (result) {
                                if (result.code==0){
                                    dataTable.reload()
                                }
                                layer.close(index);
                                layer.msg(result.msg)
                            });
                        })
                    }else {
                        layer.msg('请选择删除项')
                    }
                })
                //搜索
                $("#memberSearch").click(function () {
                    var userSign = $("#user_sign").val()
                    var name = $("#name").val();
                    var phone = $("#phone").val();
                    dataTable.reload({
                        where:{user_sign:userSign,name:name,phone:phone},
                        page:{curr:1}
                    })
                })
            })
        </script>
    @endcan
@endsection



