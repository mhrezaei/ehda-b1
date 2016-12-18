<div class="form-group">
    <label for="<?php echo e(isset($field) ? $field : ''); ?>"><?php echo e(trans('validation.attributes.' . $field)); ?>:
    <?php if(isset($required)): ?>
            <span class="text-danger">*</span>
    <?php endif; ?>
    </label>
    <input
            type="<?php echo e(isset($type) ? $type : 'text'); ?>"
            class="form-control <?php echo e(isset($class) ? $class : ''); ?>"
            id="<?php echo e(isset($field) ? $field : ''); ?>"
            name="<?php echo e(isset($field) ? $field : ''); ?>"
            data-toggle="tooltip"
            data-placement="top"
            placeholder="<?php echo e(trans('validation.attributes_placeholder.' . $field)); ?>"
            title="<?php echo e(trans('validation.attributes_example.' . $field)); ?>"
            minlength="<?php echo e(isset($min) ? $min : ''); ?>"
            maxlength="<?php echo e(isset($max) ? $max : ''); ?>"
            value="<?php echo e(isset($value) ? $value : ''); ?>"
            error-value="<?php echo e(trans('validation.javascript_validation.' . $field)); ?>"
            <?php echo e(isset($att) ? $att : ''); ?>

    >
</div>