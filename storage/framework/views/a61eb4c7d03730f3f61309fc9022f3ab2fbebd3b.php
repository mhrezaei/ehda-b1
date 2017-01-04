<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.account.tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title"><?php echo e(isset($page[1][1]) ? $page[1][1] : ''); ?></p></div>
	</div>

	<?php /*
	|--------------------------------------------------------------------------
	| Form
	|--------------------------------------------------------------------------
	|
	*/ ?>

	<?php echo $__env->make('forms.opener' , [
		'url' => 'manage/account/save/profile',
		'class' => 'js mv20' ,
		'no_validation' => 1
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php /* Notes ...*/ ?>

		<?php if($model->unverified_flag < 0): ?>
			<?php echo $__env->make('forms.note' , [
				'text' => trans('manage.account.profile_reject_note') ,
				'shape' => 'danger' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php if($edit_reject_notice = $model->meta('edit_reject_notice')): ?>
				<?php echo $__env->make('forms.note' , [
					'text' => trans('validation.attributes.reject_reason').": $edit_reject_notice" ,
					'shape' => 'warning' ,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>
		<?php elseif($model->unverified_flag > 0): ?>
			<?php echo $__env->make('forms.note' , [
				'text' => trans('manage.account.profile_pending_note')
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endif; ?>

		<?php echo $__env->make('manage.account.profile-inside' , ['show_unchanged' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.button' , [
			'label' => trans('manage.account.profile_save'),
			'shape' => 'primary',
			'type' => 'submit' ,
			'value' => 'save',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.button' , [
			'label' => trans('manage.account.profile_revert'),
			'shape' => 'danger',
			'type' => 'submit' ,
			'value' => 'revert',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>