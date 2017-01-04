<div class="row post-footer">
    <?php echo $__env->make('site.show_post.post_footer_tag', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('site.show_post.post_footer_share', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php /*<?php echo $__env->make('site.show_post.post_footer_comment', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
</div>