<?php if(sizeof($event_slide_show)): ?>
<div class="row">
    <div class="owl-carousel home-slider events-slider" dir="ltr">
        <?php foreach($event_slide_show as $slide): ?>
        <div class="item">
            <img src="<?php echo e($slide->say('featured_image')); ?>">
            <div class="event-box">
                <div class="text">
                    <?php if(strlen($slide->title)): ?>
                        <h2><?php echo e($slide->title); ?></h2>
                    <?php endif; ?>
                    <?php if(strlen($slide->meta('title_two'))): ?>
                        <p><?php echo e($slide->meta('title_two')); ?></p>
                    <?php endif; ?>
                    <?php if(strlen($slide->meta('link'))): ?>
                        <a href="<?php echo e(url('') . $slide->meta('link')); ?>" style="color: white;"><?php echo e(trans('site.global.continue')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>