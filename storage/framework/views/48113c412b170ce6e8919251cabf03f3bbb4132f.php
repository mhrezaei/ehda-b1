<div class="alert alert-<?php echo e(isset($shape) ? $shape : 'info'); ?> form-note <?php echo e(isset($class) ? $class : ''); ?> " role="alert">
	<i class="fa fa-<?php echo e(isset($icon) ? $icon : 'exclamation-circle'); ?>">
	</i>
	<?php echo App\Providers\AppServiceProvider::pd(($text)) ?>
</div>

