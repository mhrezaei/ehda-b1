<?php echo $__env->make('templates.modal.start' , [
	'modal_id' => 'modalDomainEditor' ,
	'modal_size' => 'lg',
	'form_url' => 'manage/devSettings/domains/save',
	'modal_title' => 'this',
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<label class="hidden _1"><?php echo e(trans('manage.devSettings.domains.add')); ?></label>
	<label class="hidden _2"><?php echo e(trans('manage.devSettings.domains.edit')); ?></label>

	<div class='modal-body'>

		<?php echo $__env->make('forms.hidden' , [
			'name' => 'id' ,
			'value' => isset($model)? $model->id : '0',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.input' , [
			'name' =>	'title',
			'value' =>	isset($model)? $model->title : '',
			'class' => 'form-required' ,
			'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.input' , [
			'name' =>	'slug',
			'class' =>	'form-required ltr',
			'value' =>	isset($model)? $model->slug : '',
			'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.button' , [
				'label' => trans('forms.button.save'),
				'shape' => 'success',
				'type' => 'submit' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('forms.button' , [
				'label' => trans('forms.button.cancel'),
				'shape' => 'link',
				'link' => '$(".modal").modal("hide")',
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</div>
<?php echo $__env->make('templates.modal.end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
