<?php echo e(csrf_field()); ?>

<div class="layui-form-item">
    <label for="" class="layui-form-label">父级</label>
    <div class="layui-input-block">
        <select name="parent_id" lay-search>
            <option value="0">顶级权限</option>
            <?php $__empty_1 = true; $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <option value="<?php echo e($perm['id']); ?>" <?php echo e(isset($permission->id) && $perm['id'] == $permission->parent_id ? 'selected' : ''); ?>><?php echo e($perm['name']); ?></option>
            <?php if(isset($perm['_child'])): ?>
            <?php $__currentLoopData = $perm['_child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($childs['id']); ?>" <?php echo e(isset($permission->id) && $childs['id'] == $permission->parent_id ? 'selected' : ''); ?>>&nbsp;&nbsp;┗━━<?php echo e($childs['name']); ?></option>
            <?php if(isset($childs['_child'])): ?>
            <?php $__currentLoopData = $childs['_child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lastChilds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($lastChilds['id']); ?>" <?php echo e(isset($permission->id) && $lastChilds['id'] == $permission->parent_id ? 'selected' : ''); ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┗━━<?php echo e($lastChilds['name']); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
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
        <input type="text" name="eid" value="<?php echo e($eid); ?>" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a class="layui-btn" href="<?php echo e(route('admin.team')); ?>">返 回</a>
    </div>
</div>