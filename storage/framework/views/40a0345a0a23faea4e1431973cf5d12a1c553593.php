<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.settings.dev_tab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make("manage.settings.".$page[1][0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>