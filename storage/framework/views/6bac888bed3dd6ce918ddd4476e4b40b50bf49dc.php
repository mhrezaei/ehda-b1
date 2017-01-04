<?php $__env->startSection('form'); ?>
	<?php echo $__env->make('manage.login.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('manage.login.frame', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>