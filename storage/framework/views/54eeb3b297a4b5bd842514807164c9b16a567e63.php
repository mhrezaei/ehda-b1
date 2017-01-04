<?php echo $__env->make('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/permits'),
	'modal_title' => trans('manage.permits.permits'),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class='modal-body'>

	<?php echo $__env->make('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' => '',
		'label' => trans('validation.attributes.name_first'),
		'value' => $model->fullName() ,
		'extra' => 'disabled' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Domain
	|--------------------------------------------------------------------------
	|
	*/ ?>

	<?php if(isset($opt['domains'])): ?>
		<?php echo $__env->make('forms.select' , [
			'name' => 'domain' ,
			'value' =>  $model->domain  ,
			'blank_value' => ' ' ,
			'blank_label' => trans('forms.general.none') ,
			'options' => $opt['domains'] ,
			'search' => true ,
			'size' => 7 ,
			'value_field' => 'slug' ,
			'search_placeholder' => trans('forms.button.search') ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>

	<?php if(Auth::user()->isAdmin()): ?>
		<?php echo $__env->make('forms.select' , [
			'name' => 'level' ,
			'value' => $model->can('manage') ,
			'options' => [
				[ 0 , trans('people.volunteers.manage.level_user')] ,
				[ 1 , trans('people.volunteers.manage.level_admin')]
			],
			'value_field' => '0' ,
			'caption_field' => '1' ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>


	<?php /*
	|--------------------------------------------------------------------------
	| Roles
	|--------------------------------------------------------------------------
	|
	*/ ?>

	<?php echo $__env->make('manage.volunteers.permits-role' , [
		'module' => 'cards' ,
		'permits' => 'cards' ,
		'label' => trans('manage.modules.cards')
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('manage.volunteers.permits-role' , [
		'module' => 'volunteers' ,
		'permits' => 'volunteers' ,
		'label' => trans('manage.modules.volunteers')
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php foreach($opt['branches'] as $branch): ?>
		<?php echo $__env->make('manage.volunteers.permits-role' , [
			'module' => $branch->slug ,
			'permits' => 'posts' ,
			'label' => $branch->plural_title ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endforeach; ?>

	<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<a href="javascript:void(0)" onclick="$('.-permits').prop('checked', true)" class="p20"><?php echo e(trans('forms.general.all')); ?></a>
		<a href="javascript:void(0)" onclick="$('.-permits').prop('checked', false)" class=""><?php echo e(trans('forms.general.none')); ?></a>
	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Domains
	|--------------------------------------------------------------------------
	| 
	*/ ?>

	<?php /*<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>

	<?php /*<?php echo $__env->make('forms.group-start' , [*/ ?>
		<?php /*'label' => trans('manage.devSettings.domains.trans'),*/ ?>
		<?php /*'required'=> false ,*/ ?>
	<?php /*], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>

		<?php /*<div class="row w100 m5">*/ ?>
			<?php /*<?php foreach($opt['domains'] as $domain): ?>*/ ?>
				<?php /*<div class="col-md-3">*/ ?>
					<?php /*<div class="checkbox">*/ ?>
						<?php /*<label>*/ ?>
							<?php /*<input type="hidden" name="domain<?php echo e($domain->id); ?>" value="0">*/ ?>
							<?php /*<?php echo Form::checkbox("domain".$domain->id , '1' , $model->can('any',$domain->slug)? '1' : '0' , ['class' => '-domains']); ?>*/ ?>
							<?php /*<?php echo e($domain->title); ?>*/ ?>
						<?php /*</label>*/ ?>
					<?php /*</div>*/ ?>
				<?php /*</div>*/ ?>
			<?php /*<?php endforeach; ?>*/ ?>
		<?php /*</div>*/ ?>

	<?php /*<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>


	<?php /*<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
		<?php /*<a href="javascript:void(0)" onclick="$('.-domains').prop('checked', true)" class="p20"><?php echo e(trans('forms.general.all')); ?></a>*/ ?>
		<?php /*<a href="javascript:void(0)" onclick="$('.-domains').prop('checked', false)" class=""><?php echo e(trans('forms.general.none')); ?></a>*/ ?>
	<?php /*<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>


	<?php /*
	|--------------------------------------------------------------------------
	| Buttons
	|--------------------------------------------------------------------------
	|
	*/ ?>


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