<div id="<?php echo e(isset($id) ? $id : ''); ?>" class="checkbox <?php echo e(isset($div_class) ? $div_class : ''); ?>">
    <label title="<?php echo e(isset($title) ? $title : ''); ?>">
		<input type="hidden" name="<?php echo e($name); ?>" value="0">
		<?php echo Form::checkbox($name , '1' , $value , [
		    'class' => isset($class)? $class : '' ,
		]); ?>

        <?php echo e(isset($label) ? $label : trans("validation.attributes.$name")); ?>

    </label>
</div>
