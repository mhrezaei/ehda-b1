<?php $__env->startSection('page_heading' , trans('manage.modules.dashboard')); ?>

<?php $__env->startSection('section'); ?>

	<?php foreach($digests as $digest): ?>
		<?php echo $__env->make('manage.frame.widgets.digest' , $digest, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endforeach; ?>


<?php $__env->stopSection(); ?>

<?php /*<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTest">Small modal</button>*/ ?>

<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>