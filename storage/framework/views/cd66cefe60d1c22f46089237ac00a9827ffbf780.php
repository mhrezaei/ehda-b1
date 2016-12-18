<div class="row post-footer">
    <?php echo $__env->make('site.posts.posts_keywords', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('site.posts.posts_share', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php /*    <?php echo $__env->make('site.posts.posts_comments', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
</div>