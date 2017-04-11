<div class="col-xs-12 col-sm-4">
    <?php if(sizeof($events)): ?>
        <h4><?php echo e(trans('site.global.events')); ?></h4>
        <ul class="events list-unstyled">
            <?php foreach($events as $event): ?>
                <li>
                    <a href="<?php echo e($event->say('link')); ?>"><?php echo App\Providers\AppServiceProvider::pd(($event->say('title_limit'))) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <hr>
        <a href="<?php echo e(url('/archive/event')); ?>" class="left"><?php echo e(trans('site.global.more')); ?></a>
    <?php endif; ?>
</div>