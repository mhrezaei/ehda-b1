<?php if($model->branch()->hasFeature('domain')): ?>
	<div class="panel panel-default w100">
		<div class="panel-heading">
			<?php echo e(trans('posts.manage.visibility')); ?>

		</div>

		<div class="text-center m10">
			<?php echo $__env->make('forms.select_self' , [
				'name' => 'domains' ,
				'id' => 'cmbDomain' ,
				'value_field' => 'slug' ,
				'search' => $domains->count()>5 ? true : false ,
				'blank_value' => Auth::user()->can('*','global')? 'global' : 'NO',
				'blank_label' => trans('posts.manage.global'),
				'on_change' => Auth::user()->can('*','global')?  'postEditorFeatures()' : '' ,
				'value' => trim(str_replace('|' , null , str_replace('global' , null , $model->domains))) ,
				'options' => $domains->get() ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>

		<?php if(Auth::user()->can('*','global')): ?>
			<div class="m10">
				<?php echo $__env->make('forms.check' , [
					'name' => 'in_global',
					'label' => trans('posts.manage.also_in_global'),
					'value' => str_contains($model->domains , 'global')? true : false ,
					'id' => 'chkGlobal',
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>