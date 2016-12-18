<title><?php echo e(trans('global.siteTitle')); ?> | <?php echo App\Providers\AppServiceProvider::pd(($post->title)) ?></title>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php
        if ($post->branch == 'statics')
            {
                $title = $post->say('title');
                $parent = $post->say('category_name');
            }
            else
            {
                $title = $post->say('category_name');
                $parent = $post->branch()->plural_title;
            }
        ?>
        <?php echo $__env->make('site.frame.page_title', [
        'category' => $post->say('header'),
        'parent' => $parent,
        'sub' => $title
        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('site.show_post.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.frame.frame', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>