<div class="container">
    <div class="row">
        <div class="article">
            <div class="col-xs-12">

                <img class="post-cover" src="<?php echo e(url('')); ?>/assets/site/images/post-image.jpg" alt="">
                <p>
                    <?php echo e($post['text']); ?>

                </p>
            </div>
            <?php echo $__env->make('site.posts.posts_footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
</div>