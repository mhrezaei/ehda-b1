<title><?php echo e(trans('global.siteTitle')); ?> | <?php echo e(trans('site.global.card_register_page')); ?></title>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php echo $__env->make('site.frame.page_title', [
        'category' => trans('site.menu.join'),
        'parent' => trans('site.know_menu.organ_donation_card'),
        'sub' => trans('site.global.card_register_page')
        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('site.card_register.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.frame.frame', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>