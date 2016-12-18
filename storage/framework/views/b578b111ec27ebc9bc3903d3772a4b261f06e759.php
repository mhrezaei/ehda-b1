<div class="comments col-xs-12">
    <?php echo $__env->make('site.posts.posts_comments_data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="row">
        <div class="comments-list col-xs-12">
            <?php for($i = 0; $i <= 5; $i++): ?>
                <?php echo $__env->make('site.posts.comment_single', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endfor; ?>
            <?php echo $__env->make('site.posts.comments_insert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
</div>