<?php if(sizeof($slide_show)): ?>
<div class="row">
    <div class="owl-carousel home-slider" dir="ltr">
        <?php foreach($slide_show as $slide): ?>
            <div class="item" dir="rtl">
                <?php if($slide->meta('link')): ?>
                    <a href="<?php echo e($slide->meta('link')); ?>" target="_blank">
                <?php endif; ?>
                <img src="<?php echo e($slide->say('featured_image')); ?>">
                <div class="slide-text">
                    <?php if(strlen($slide->title)): ?>
                        <h3><?php echo e($slide->title); ?></h3>
                    <?php endif; ?>
                    <?php if(strlen($slide->meta('title_two'))): ?>
                        <span><?php echo e($slide->meta('title_two')); ?></span>
                    <?php endif; ?>
                </div>
                <?php if($slide->meta('link')): ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>