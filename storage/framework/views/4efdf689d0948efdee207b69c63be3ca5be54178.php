<?php if($activity): ?>
    <?php foreach($activity as $act): ?>
        <div class="checkbox">
            <label>
                <input name="activity[]" class="volunteer_activity" type="checkbox" value="<?php echo e($act->slug); ?>" style="display: block;"> <?php echo e($act->title); ?>

            </label>
        </div>
    <?php endforeach; ?>
<?php endif; ?>