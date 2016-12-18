<div class="col-xs-12 col-sm-6">
    <?php if(sizeof($events)): ?>
        <h3><?php echo e(trans('site.global.events')); ?></h3>
        <ul class="events list-unstyled">
            <?php foreach($events as $event): ?>
                <li>
                    <a href="<?php echo e($event->say('link')); ?>"><?php echo App\Providers\AppServiceProvider::pd(($event->say('title_limit'))) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>