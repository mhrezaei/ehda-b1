<div class="input-group">
	<span class="input-group-addon">
		<i class="material-icons"><?php echo e(isset($icon) ? $icon : ''); ?></i>
	</span>
	<input type="<?php echo e(isset($type) ? $type : 'text'); ?>" name="<?php echo e(isset($name) ? $name : ''); ?>" class="form-control <?php echo e(isset($class) ? $class : ''); ?>" placeholder="<?php echo e(isset($cap) ? $cap : ''); ?>">
</div>
