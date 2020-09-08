@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group ">
            <button class="layui-btn layui-btn-sm " id="create">添 加</button>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                </div>
            </script>
            <script type="text/html" id="thumb">
                <a href="@{{d.avatar}}" target="_blank" title="点击查看"><img src="@{{d.avatar}}" alt="" width="28" height="28"></a>
            </script>
         
        </div>
    </div>
@endsection

@section('script')
        <script>
            //全局函数child
    	function child(res,index){
    		var eid = res.id;
            layui.use(['layer','table','form'],function () {
                var layer = layui.layer;
                var form = layui.form;
                var table = layui.table;
                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                    ,height: 500
                    ,where:{eid:eid}
                    ,url: "{{ route('admin.resume.data') }}" //数据接口
                    ,page: true //开启分页
                    ,cols: [[ //表头
                        {checkbox: true,fixed: true}
                        ,{field: 'id', title: 'ID', sort: true,width:80}
                        ,{field: 'name', title: '姓名',}
                        ,{field: 'sex', title: '性别',}
                        ,{field: 'title', title: '职位',}
                        ,{field: 'sort', title: '排序',}
                        ,{field: 'created_at', title: '创建时间'}
                        ,{field: 'updated_at', title: '更新时间'}
                        ,{fixed: 'right', width: 220, align:'center', toolbar: '#options'}
                    ]]
                });

           //监听工具条
           table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        ,layEvent = obj.event; //获得 lay-event 对应的值
                    if(layEvent === 'del'){
                        layer.confirm('确认删除吗？', function(index){
                            $.post("{{ route('admin.resume.destroy') }}",{_method:'delete',ids:[data.id]},function (result) {
                                if (result.code==0){
                                    obj.del(); //删除对应行（tr）的DOM结构
                                }
                                layer.close(index);
                                layer.msg(result.msg)
                            });
                        });
                    } 
                });
                //执行添加操作
                $("#create").click(function () {
                	location.href = '/admin/resume/'+ eid +'/create';
                })
            })
        }
        </script>
@endsection