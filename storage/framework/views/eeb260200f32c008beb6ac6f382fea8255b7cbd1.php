<title><?php echo e(trans('global.siteTitle')); ?> | <?php echo e($card_detail->title); ?></title>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php echo $__env->make('site.frame.page_title', [
        'category' => $card_detail->meta('header_title'),
        'parent' => $card_detail->meta('category_title'),
        'sub' => $card_detail->title
        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('site.members.my_card.card_info_content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.frame.frame', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>