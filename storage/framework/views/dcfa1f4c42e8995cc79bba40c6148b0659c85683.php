<title><?php echo e(trans('global.siteTitle')); ?> | <?php echo e(trans('site.global.home_page')); ?></title>
<?php $__env->startSection('meta'); ?>
    <?php echo $__env->make('site.frame.meta',[
        'title' => trans('global.siteTitle'),
        'url' => url(''),
        'image' => url('assets/site/images/header-logo.png'),
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php echo $__env->make('site.home.slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('site.home.paragraph', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('site.home.event', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('site.home.slider_event_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('site.home.stats', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('site.home.fix_background', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('site.home.news_event_title', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.frame.frame', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>