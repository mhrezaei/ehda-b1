<div class="container">
    <div class="row">
        <div class="article">
            <div class="col-xs-12" style="text-align: justify;">
                <?php if($post->branch()->slug != 'statics'): ?>
                    <h3 class="post-title"><?php echo App\Providers\AppServiceProvider::pd(($post->title)) ?></h3>
                <?php endif; ?>

                <?php echo $post->text; ?>

                <small><?php echo e(trans('validation.attributes.publish_date')); ?>: <?php echo e($post->say('published_at')); ?></small>
            </div>

            <?php echo $__env->make('site.show_post.post_footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
    </div>
</div>