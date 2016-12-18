<div class="form-group">
    <label for="<?php echo e(isset($field) ? $field : ''); ?>"><?php echo e(trans('validation.attributes.' . $field)); ?>:
        <?php if(isset($required)): ?>
            <span class="text-danger">*</span>
        <?php endif; ?>
    </label>
    <select
            class="form-control  <?php echo e(isset($class) ? $class : ''); ?>"
            id="<?php echo e(isset($field) ? $field : ''); ?>"
            name="<?php echo e(isset($field) ? $field : ''); ?>"
            data-toggle="tooltip"
            data-placement="top"
            title="<?php echo e(trans('validation.attributes_example.' . $field)); ?>"
            value="<?php echo e(isset($value) ? $value : ''); ?>"
            error-value="<?php echo e(trans('validation.javascript_validation.' . $field)); ?>"
            <?php echo e(isset($att) ? $att : ''); ?>>
        <option value="0"><?php echo e(trans('forms.general.select_default')); ?></option>
        <?php foreach(trans('people.education') as $key => $value): ?>
            <?php if($key != 0): ?>
                <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
</div>