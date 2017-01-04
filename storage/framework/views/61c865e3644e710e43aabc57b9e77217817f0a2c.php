<?php $__env->startSection('section'); ?>

	<?php if(!$model->id): ?>
		<div id="divInquiry">
			<?php echo $__env->make('manage.cards.editor-inquiry', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	<?php endif; ?>
	<div id="divForm" class="<?php echo e($model->id? '' : 'noDisplay'); ?>">
		<?php echo $__env->make('manage.cards.editor-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<div id="divCard" class="noDisplay text-center">
		<?php echo $__env->make('manage.cards.editor-card', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>