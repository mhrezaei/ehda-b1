<?php $__env->startSection('section'); ?>

	<?php echo $__env->make('forms.opener' , [
		'id' => 'frmEditor',
		'url' => 'manage/cards/save/volunteers',
		'title' => $model->isCard()? trans('people.cards.manage.edit').' '.$model->fullName() : trans('people.cards.manage.create') ,
		'class' => 'js' ,
		'no_validation' => 1 ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.hiddens' , ['fields' => [
			['id' , $model->id],
		]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.input' , [
			'name' => 'code_melli',
			'value' =>  $model->code_melli ,
			'extra' => 'disabled' ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.input' , [
			'name' => 'name_first',
			'value' =>$model->fullName() ,
			'extra' => 'disabled' ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.group-start' , [
			'required' => true ,
			'label' => trans('validation.attributes.organs')
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('manage.cards.editor-organs' , [
				'organs' => $model::$donatable_organs ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.button' , [
				'label' => trans('forms.button.save'),
				'shape' => 'success',
				'type' => 'submit' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.button' , [
				'label' => trans('people.cards.manage.save_and_send_to_print'),
				'value' => 'print' ,
				'shape' => 'primary',
				'type' => 'submit' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>