<?php echo $__env->make('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/devSettings/categories/save'),
	'modal_title' => $model->id? trans('manage.devSettings.categories.edit') : trans('manage.devSettings.categories.new'),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class='modal-body'>

	<?php echo $__env->make('forms.hidden' , [
		'name' => 'id' ,
		'value' => $model->id,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select' , [
		'name' => 'branch_id' ,
		'class' => 'form-required',
		'options' => $branches->get() ,
		'caption_field' => 'plural_title' ,
		'value' => $model->branch_id
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' =>	'title',
	    'value' =>	$model->title,
	    'class' => 'form-required form-default' ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' =>	'slug',
	    'class' =>	'form-required ltr',
		'value' =>	$model->slug ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('manage.settings.downstream-value-photo' , [
		'domain' => json_decode(json_encode(
			[
				'title' => trans('posts.manage.featured_image') ,
				'slug' => 'featured_image' ,
			]
		)) ,
		'value' => $model->featured_image ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php if($posts = $model->posts()->count()): ?>
		<?php echo $__env->make('forms.note' , [
			'shape' => 'warning' ,
			'text' => trans('manage.devSettings.categories.delete_alert_posts' , ['count' => $posts]) ,
			'class' => '-delHandle noDisplay'
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
	<?php echo $__env->make('forms.note' , [
		'shape' => 'danger' ,
		'text' => trans('manage.devSettings.categories.delete_alert') ,
		'class' => '-delHandle noDisplay'
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.button' , [
			'id' => 'btnSave' ,
			'label' => trans('forms.button.save'),
			'shape' => 'success',
			'type' => 'submit' ,
			'value' => 'save' ,
			'class' => '-delHandle'
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php if($model->id): ?>
			<?php echo $__env->make('forms.button' , [
				'id' => 'btnDeleteWarning' ,
				'label' => trans('forms.button.delete'),
				'shape' => 'warning',
				'link' => '$(".-delHandle").toggle()' ,
				'class' => '-delHandle' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('forms.button' , [
				'id' => 'btnDelete' ,
				'label' => trans('forms.button.sure_hard_delete'),
				'shape' => 'danger',
				'value' => 'delete' ,
				'type' => 'submit' ,
				'class' => 'noDisplay -delHandle' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php endif; ?>


		<?php echo $__env->make('forms.button' , [
			'label' => trans('forms.button.cancel'),
			'shape' => 'link',
			'link' => '$(".modal").modal("hide")',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>
<?php echo $__env->make('templates.modal.end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>