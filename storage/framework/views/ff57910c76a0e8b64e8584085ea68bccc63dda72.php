<title><?php echo e(trans('global.siteTitle')); ?> | <?php echo e($post->title); ?></title>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php echo $__env->make('site.frame.page_title', [
        'category' => $post->say('header'),
        'parent' => $post->say('category_title'),
        'sub' => $post->title
        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('site.card_info.card_info_content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.frame.frame', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>