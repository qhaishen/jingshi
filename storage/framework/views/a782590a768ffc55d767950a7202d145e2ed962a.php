<?php $__env->startSection('content'); ?>
    <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
        <form action="<?php echo e(route('admin.login')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                <input type="text" name="username" value="<?php echo e(old('username')); ?>" lay-verify="required" placeholder="用户名" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                <input type="password" name="password"  lay-verify="required" placeholder="密码" class="layui-input">
            </div>
            
         
            <div class="layui-form-item">
                <button type="submit" class="layui-btn layui-btn-fluid" lay-submit lay-filter="">登 入</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.login_register.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>