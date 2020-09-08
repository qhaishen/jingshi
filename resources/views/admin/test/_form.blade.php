{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">公司名称</label>
    <div class="layui-input-block">
        <input type="text" name="name"  lay-verify="required" placeholder="请输入公司名称" class="layui-input" >
    </div>
</div>
<!-- 
<div class="layui-form-item">
    <label for="" class="layui-form-label">职称</label>
    <div class="layui-input-block">
        <input type="text" name="title" value="{{$teams->title??old('title')}}" lay-verify="required" placeholder="请输入职称" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">手机</label>
    <div class="layui-input-block">
        <input type="phone" name="phone" value="{{$teams->phone??old('phone')}}" lay-verify="required" placeholder="请输入手机号" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">邮箱</label>
    <div class="layui-input-block">
        <input type="text" name="email" value="{{$teams->email??old('email')}}" lay-verify="required" placeholder="请输入邮箱" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">微信</label>
    <div class="layui-input-block">
        <input type="text" name="wechat" value="{{$teams->wechat??old('wechat')}}" lay-verify="required" placeholder="请输入微信" class="layui-input" >
    </div>
</div>

@include('UEditor::head');
<div class="layui-form-item">
    <label for="" class="layui-form-label">简介</label>
    <div class="layui-input-block">
        <script id="container" name="brief" style="min-height:300px;" type="text/plain">
            {!! $teams->brief??old('brief') !!}
        </script>
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">排序</label>
    <div class="layui-input-block">
        <input type="number" name="sort" value="{{$teams->sort??0}}" lay-verify="required|numeric"  class="layui-input" >
    </div>
</div> -->


<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.test')}}" >返 回</a>
    </div>
</div>
