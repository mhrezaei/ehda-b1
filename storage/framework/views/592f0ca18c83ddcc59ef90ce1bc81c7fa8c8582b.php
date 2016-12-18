<button
		id="<?php echo e(isset($id) ? $id : ''); ?>"
		type="<?php echo e(isset($type) ? $type : 'button'); ?>"
		name="_<?php echo e(isset($type) ? $type : 'button'); ?>"
		value="<?php echo e(isset($value) ? $value : ''); ?>"
		class="btn btn-<?php echo e(isset($shape) ? $shape : 'default'); ?> <?php echo e(isset($class) ? $class : ''); ?> "
		<?php if(isset($link) and (str_contains($link , '(') or str_contains($link , ')'))): ?>
			onclick="<?php echo e($link); ?>"
		<?php elseif(isset($link)): ?>
			onclick="window.location ='<?php echo e(url($link)); ?>'"
		<?php endif; ?>
		<?php echo e(isset($extra) ? $extra : ''); ?>

>
	<?php if(isset($label)): ?>
		<?php echo App\Providers\AppServiceProvider::pd(($label)) ?>
	<?php else: ?>
		''
	<?php endif; ?>
</button>
