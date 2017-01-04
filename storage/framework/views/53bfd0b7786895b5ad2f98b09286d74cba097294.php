<div class="form-feed alert" style="display:none">
    <?php echo e(isset($feed_wait) ? $feed_wait : trans('forms.feed.wait')); ?>

</div>
<div class="hide">
    <span class=" form-feed-wait" style="color: black;">
        <div style="width: 100%; text-align: center;">
            <?php echo e(isset($feed_wait) ? $feed_wait : trans('forms.feed.wait')); ?>

            <br>
            <img src="<?php echo e(url('assets/site/images/64.gif')); ?>">
        </div>
    </span>
    <span class=" form-feed-error"><?php echo e(isset($feed_error) ? $feed_error : trans('forms.feed.error')); ?></span>
    <span class=" form-feed-ok"><?php echo e(isset($feed_ok) ? $feed_ok : trans('forms.feed.done')); ?></span>
</div>

