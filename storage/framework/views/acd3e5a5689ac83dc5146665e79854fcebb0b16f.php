<?php echo $__env->make('forms.opener' , [
	'id' => 'frmEditor',
	'url' => 'manage/cards/save',
	'title' => $model->id? trans('people.cards.manage.edit').' '.$model->fullName() : trans('people.cards.manage.create') ,
	'class' => 'js' ,
	'no_validation' => 1 ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.hiddens' , ['fields' => [
		['id' , $model->id],
		['code_melli' , $model->code_melli]
	]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' => 'code_melli',
		'value' =>  $model->code_melli ,
		'class' => 'disabled',
		'extra' => Auth::user()->isDeveloper()? '' : 'disabled' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' => 'name_first',
		'value' =>$model->name_first ,
		'class' => 'form-required form-default'
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	'name' => 'name_last',
	'value' =>$model->name_last ,
	'class' => 'form-required'
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
		'name' => 'tel_mobile',
		'value' => $model->tel_mobile ,
		'class' => 'ltr form-required',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


	<?php echo $__env->make('forms.input' , [
		'name' => 'email',
		'value' => $model->email ,
		'class' => 'ltr',
		'type' => 'email'
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*<?php if(!$model->id): ?>*/ ?>
	<?php /*<?php echo $__env->make('forms.input' , [*/ ?>
	<?php /*'name' => 'password',*/ ?>
	<?php /*'value' => rand(10000000 , 99999999),*/ ?>
	<?php /*'class' => 'form-required ltr'*/ ?>
	<?php /*], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
	<?php /*<?php endif; ?>*/ ?>

	<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select-gender' , [
		'value' => $model->id? $model->gender : '0' ,
		'blank_value' => $model->id? 'NO' : ' ',
		'class' => 'form-required',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select-marital' , [
		'blank_value' => ' ',
		'value' => $model->id? $model->marital : '0' ,
		'class' => '',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select' , [
		'name' => 'birth_city' ,
		'class' => 'form-required',
		'value' => $model->id? $model->birth_city : '0' ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'search_placeholder' => trans('forms.button.search') ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.datepicker' , [
		'name' => 'birth_date',
		'class' => 'form-required' ,
		'value' => $model->birth_date ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select-education' , [
		'name' => 'edu_level' ,
		'class' => 'form-required' ,
		'blank_value' => '' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' => 'edu_field',
		'value' => $model->edu_field,
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
		'value' => $model->id? $model->home_city : '0' ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'class' => 'form-required'
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
		'value' => $model->home_postal_code  ,
		'class' => 'ltr',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' => 'job',
		'value' => $model->job  ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-start' , [
		'required' => true ,
		'label' => trans('validation.attributes.organs')
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('manage.cards.editor-organs' , [
			'organs' => $model::$donatable_organs ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-start' , [
		'label' => trans('validation.attributes.newsletter')
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.check' , [
			'name' => 'newsletter',
			'value' => $model->newsletter,
			'label' => trans('people.cards.manage.newsletter_membership')
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-start' , [
		'label' => trans('validation.attributes.password')
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php if($model->id): ?>
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
