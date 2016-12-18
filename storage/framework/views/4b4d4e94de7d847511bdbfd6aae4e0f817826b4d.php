<?php
if(isset($class) && str_contains($class, 'form-required')) {
    $required = true;
}
?>

<div class="form-group">
    <label
            for="<?php echo e($name); ?>"
            class="col-sm-2 control-label <?php echo e(isset($label_class) ? $label_class : ''); ?>"
    >
        <?php if(isset($label)): ?>
            <?php echo e($label); ?>

        <?php else: ?>
            <?php echo e(Lang::has("validation.attributes.$name") ? trans("validation.attributes.$name") : $name); ?>

        <?php endif; ?>
        <?php if(isset($required) and $required): ?>
            <span class="fa fa-star required-sign " title="<?php echo e(trans('forms.logic.required')); ?>"></span>
        <?php endif; ?>
    </label>

    <div class="col-sm-10">
        <textarea
                id="<?php echo e(isset($id) ? $id : ''); ?>"
                name="<?php echo e($name); ?>" value="<?php echo e(isset($value) ? $value : ''); ?>"
                class="form-control <?php echo e(isset($class) ? $class : ''); ?>"
                placeholder="<?php echo e(isset($placeholder) ? $placeholder : ''); ?>"
				rows="<?php echo e(isset($rows) ? $rows : 5); ?>"
                <?php echo e(isset($extra) ? $extra : ''); ?>

        ><?php echo e(isset($value) ? $value : ''); ?></textarea>
		<span class="help-block">
			<?php echo e(isset($hint) ? $hint : ''); ?>

		</span>
    </div>
</div>
