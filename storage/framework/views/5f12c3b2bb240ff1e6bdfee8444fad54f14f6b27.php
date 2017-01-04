<?php echo $__env->make('forms.opener' , [
	'id' => 'frmEditor',
	'url' => 'manage/volunteers/save/',
	'title' => $page[1][1] ,
	'class' => 'js' ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' => 'code_melli',
		'value' => $model->code_melli ,
		'class' => 'form-required',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' => 'name_first',
		'value' => $model->name_first ,
		'class' => 'form-required form-default'
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	'name' => 'name_last',
	'value' => $model->name_last ,
	'class' => 'form-required ' ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' => 'code_id',
		'value' => $model->code_id ,
		'class' => 'form-required form-number' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('forms.input' , [
		'name' => 'name_father',
		'value' => $model->name_father ,
		'class' => 'form-required' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('forms.input' , [
		'name' => 'email',
		'value' => $model->email ,
		'class' => 'form-required ltr',
		'type' => 'email'
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select-gender' , [
		'value' => $model->gender,
		'blank_value' => $model->gender? 'NO' : ' ',
		'class' => 'form-required',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select-marital' , [
		'value' => $model->marital ,
		'blank_value' => $model->marital? 'NO' : ' ',
		'class' => 'form-required',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select' , [
		'name' => 'birth_city' ,
		'class' => 'form-required',
		'value' => $model->birth_city ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'search_placeholder' => trans('forms.button.search') ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.datepicker' , [
	    'name' => 'birth_date',
	    'value' => $model->birth_date ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' => 'tel_mobile',
	    'value' => $model->tel_mobile ,
	    'class' => 'form-required ltr',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' => 'tel_emergency',
	    'value' => $model->tel_emergency ,
	    'class' => 'form-required ltr',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select-education' , [
		'name' => 'edu_level' ,
	    'value' => $model->edu_level,
		'class' => '' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' => 'edu_field',
	    'value' =>$model->edu_field ,
	    'class' => '' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select' , [
		'name' => 'edu_city' ,
		'value' =>  $model->edu_city  ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'search_placeholder' => trans('forms.button.search') ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select' , [
		'name' => 'home_city' ,
		'value' => $model->home_city ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' => 'home_address',
	    'value' => $model->home_address,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' => 'home_tel',
	    'value' => $model->home_tel ,
	    'class' => 'ltr',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' => 'home_postal_code',
		'value' => $model->home_postal_code ,
		'class' => 'ltr',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' => 'job',
	    'value' => $model->job ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


	<?php echo $__env->make('forms.select' , [
		'name' => 'work_city' ,
		'value' => $model->work_city ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' => 'work_address',
	    'value' => $model->work_address ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' => 'work_tel',
	    'value' => $model->work_tel ,
	    'class' => 'ltr',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' => 'work_postal_code',
	    'value' =>  $model->work_postal_code,
	    'class' => 'ltr',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


	<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select-familization' , [
		'class' => '' ,
		'value' => $model->familization+0 ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' => 'motivation',
	    'value' => $model->motivation ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' => 'alloc_time',
	    'value' => $model->alloc_time ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-start' , [
		'label' => trans('people.volunteers.manage.exam')
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.check' , [
			'name' => '_no_exam',
			'label' => trans('people.volunteers.manage.no_exam'),
			'value' => $model->exam_passed_at? 1 : 0,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


	<?php echo $__env->make('forms.group-start' , [
		'label' => trans('validation.attributes.password')
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php if($model->password): ?>
			<?php echo $__env->make('forms.check' , [
				'name' => '_password_set_to_mobile',
				'value' => false ,
				'label' => trans('people.cards.manage.password_set_to_mobile') ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php else: ?>
			<div class="text-danger disabled mv5">
				<i class="fa fa-check-square"></i>
				<?php echo e(trans('people.cards.manage.preset_password')); ?>

			</div>
		<?php endif; ?>
	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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

	<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>