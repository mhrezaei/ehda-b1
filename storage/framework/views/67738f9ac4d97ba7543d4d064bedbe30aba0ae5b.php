<div class="col-xs-12 col-sm-6">
    <?php if(sizeof($events)): ?>
        <h3><?php echo e(trans('site.global.events')); ?></h3>
        <ul class="events list-unstyled">
            <?php foreach($events as $event): ?>
                <li>
                    <?php /*<a href="<?php echo e(url('showPost/' . $event->id . '/' . urlencode($event->title))); ?>"><?php echo App\Providers\AppServiceProvider::pd(($event->title)) ?></a>*/ ?>
                    <a href="<?php echo e(url('showPost/' . $event->id . '/' . urlencode($event->title))); ?>"><?php echo e($event->title); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>