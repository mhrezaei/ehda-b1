<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.settings.tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.opener' , [
		'id' => 'frmEditor',
		'url' => 'manage/settings/save',
		'title' => $page[1][1] ,
		'class' => 'js' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php foreach($model_data as $domain): ?>  <?php /* This $domain serves as an alias instead of $model*/ ?>
			<?php echo $__env->make('manage.settings.downstream-value-'.$domain->data_type , [
				'value' => $domain->value($request_domain)
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endforeach; ?>

		<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.button' , [
				'label' => trans('forms.button.save'),
				'shape' => 'success',
				'type' => 'submit' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.button' , [
				'label' => trans('forms.button.undo_changes'),
				'shape' => 'link',
				'type' => 'button' ,
				'class' => 'text-grey' ,
				'link' => 'location.reload();' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>