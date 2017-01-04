<div class="container">
    <div class="row archive">
        <?php if(sizeof($archive)): ?>
            <?php foreach($archive as $post): ?>
                <div class="media">
                    <a class="media-right" href="<?php echo e($post->say('link')); ?>">
                        <img class="media-right" src="<?php echo e($post->say('featured_image')); ?>">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="<?php echo e($post->say('link')); ?>"><?php echo App\Providers\AppServiceProvider::pd(($post->title)) ?></a>
                        </h4>
                        <?php if(strlen($post->abstract)): ?>
                            <p style="text-align: justify;">
                                <?php echo e($post->say('abstract')); ?>

                            </p>
                            <small><?php echo e($post->say('published_at')); ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="row" style="text-align: center; font-size: 14px; color: #0A3C6E;"><?php echo e(trans('site.global.no_post')); ?></div>
        <?php endif; ?>
            <div class="row" style="text-align: center; margin: 0 auto;">
                <?php echo $archive->render(); ?>

            </div>
    </div>
</div>