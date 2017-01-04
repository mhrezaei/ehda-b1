<title><?php echo e(trans('global.siteTitle')); ?> | <?php echo e($volunteer->title); ?></title>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php echo $__env->make('site.frame.page_title', [
        'category' => $volunteer->say('header'),
        'parent' => $volunteer->say('category_name'),
        'sub' => $volunteer->title
        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('site.volunteers.volunteer_register.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.frame.frame', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>