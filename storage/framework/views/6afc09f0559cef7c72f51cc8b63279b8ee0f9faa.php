<?php echo e(csrf_field()); ?>


<div class="layui-form-item">
    <label for="" class="layui-form-label">标题</label>
    <div class="layui-input-block">
        <input type="text" name="title" value="<?php echo e($article->title??old('title')); ?>" lay-verify="required" placeholder="请输入标题" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">关键词</label>
    <div class="layui-input-block">
        <input type="text" name="keywords" value="<?php echo e($article->keywords??old('keywords')); ?>"  placeholder="请输入关键词" class="layui-input" >
    </div>
</div>



<?php echo $__env->make('UEditor::head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
<div class="layui-form-item">
    <label for="" class="layui-form-label">内容</label>
    <div class="layui-input-block">
        <script id="container" name="content" style="min-height:450px;" type="text/plain">
            <?php echo $article->content??old('content'); ?>

        </script>
    </div>
</div>


<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="<?php echo e(route('admin.article')); ?>" >返 回</a>
    </div>
</div>