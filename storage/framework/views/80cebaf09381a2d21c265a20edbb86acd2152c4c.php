<?php $__env->startSection('section'); ?>

	<?php if(!$model->id): ?>
		<div id="divInquiry">
			<?php echo $__env->make('manage.volunteers.editor-inquiry', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	<?php endif; ?>
	<div id="divForm" class="<?php echo e($model->id? '' : 'noDisplay'); ?>">
		<?php echo $__env->make('manage.volunteers.editor-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>