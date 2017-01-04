<?php if($model->branch()->hasFeature('domain')): ?>
	<?php if(Auth::user()->isGlobal()): ?>
		<div class="panel panel-default w100">
			<div class="panel-heading">
				<?php echo e(trans('posts.manage.visibility')); ?>

			</div>

			<div class="text-center m10">
				<?php echo $__env->make('forms.select_self' , [
					'name' => 'domains' ,
					'id' => 'cmbDomain' ,
					'value_field' => 'slug' ,
					'search' => true ,
					'blank_value' => 'global',
					'blank_label' => trans('posts.manage.global'),
					'on_change' => 'postEditorFeatures()' ,
					'value' => str_replace('*' , null , $model->domains) ,
					'options' => $domains->get() ,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
			
			<div class="m10">
				<?php echo $__env->make('forms.check' , [
					'name' => '_in_global',
					'label' => trans('posts.manage.also_in_global'),
					'value' => str_contains($model->domains , '*')? true : false ,
					'id' => 'chkGlobal',
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>