{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">父级</label>
    <div class="layui-input-block">
        <select name="parent_id" lay-search>
            <option value="0">顶级权限</option>
            @forelse($permissions as $perm)
            <option value="{{$perm['id']}}" {{ isset($permission->id) && $perm['id'] == $permission->parent_id ? 'selected' : '' }}>{{$perm['name']}}</option>
            @if(isset($perm['_child']))
            @foreach($perm['_child'] as $childs)
            <option value="{{$childs['id']}}" {{ isset($permission->id) && $childs['id'] == $permission->parent_id ? 'selected' : '' }}>&nbsp;&nbsp;┗━━{{$childs['name']}}</option>
            @if(isset($childs['_child']))
            @foreach($childs['_child'] as $lastChilds)
            <option value="{{$lastChilds['id']}}" {{ isset($permission->id) && $lastChilds['id'] == $permission->parent_id ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┗━━{{$lastChilds['name']}}</option>
            @endforeach
            @endif
            @endforeach
            @endif
            @empty
            @endforelse
        </select>
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">姓名</label>
    <div class="layui-input-block">
        <input type="text" name="name" value="" lay-verify="required" placeholder="请输入姓名" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">职称</label>
    <div class="layui-input-block">
        <input type="text" name="title" value="" lay-verify="required" placeholder="请输入职称" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">性别</label>
    <div class="layui-input-block">
        <input type="radio" name="sex" value="男" title="男" checked="">
        <input type="radio" name="sex" value="女" title="女">
    </div>
</div>
<div class="layui-form-item " style="display: none;">
    <label for="" class="layui-form-label">id</label>
    <div class="layui-input-inline">
        <input type="text" name="eid" value="{{ $eid}}" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a class="layui-btn" href="{{route('admin.team')}}">返 回</a>
    </div>
</div>