<?php $__env->startSection('content'); ?>
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新成员信息</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="<?php echo e(route('admin.team.update',['id'=>$teams->id])); ?>" method="post">
                <?php echo e(method_field('put')); ?>

                <?php echo $__env->make('admin.team._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('admin.team._js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>