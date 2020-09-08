<?php $__env->startSection('content'); ?>
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加候选人</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="<?php echo e(route('admin.resume.store')); ?>" method="post" style="width:50%;">
                <?php echo $__env->make('admin.resume._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>