


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登入 - layuiAdmin</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/admin/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/admin/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/admin/layuiadmin/style/login.css" media="all">
</head>
<body>

<div class="layadmin-user-login layadmin-user-display-show" >

    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>中后台管理</h2>
        </div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<script src="/static/admin/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/admin/layuiadmin/' //静态资源所在路径
    }).use(['layer'],function () {
        var layer = layui.layer;

        //表单提示信息
        <?php if(count($errors)>0): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                layer.msg("<?php echo e($error); ?>",{icon:5});
                <?php break; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        //正确提示
        <?php if(session('success')): ?>
        layer.msg("<?php echo e(session('success')); ?>",{icon:6});
        <?php endif; ?>

    })
</script>
</body>
</html>