<td>
	<input id="gridSelector-<?php echo e($model->id); ?>" data-value="<?php echo e($model->id); ?>" class="gridSelector" type="checkbox" onchange="gridSelector('selector','<?php echo e($model->id); ?>')">
</td>
<td>
	<?php if($model->canEdit()): ?>
		<a href="<?php echo e(url("manage/posts/".$model->branch()->slug."/edit/".$model->id)); ?>">
			<?php echo e($model->say('title_limit')); ?>

		</a>
	<?php else: ?>
		<?php echo e($model->say('title_limit')); ?>

	<?php endif; ?>
</td>


<td>
	<div class="text-<?php echo e($model->status('color')); ?>">
		<?php echo e($model->status('text')); ?>

	</div>
	<div class="mv10 f10 text-grey">
		<?php echo e(trans('posts.manage.created_by' , ['name'=>$model->say('created')])); ?>

	</div>
	<?php if($model->published_by): ?>
		<div class="mv10 f10 text-grey">
			<?php echo e(trans('posts.manage.published_by' , ['name'=>$model->say('published')])); ?>

		</div>
	<?php endif; ?>
	<?php if($model->trashed()): ?>
		<div class="mv10 f10 text-grey">
			<?php echo e(trans('posts.manage.deleted_by' , ['name'=>$model->say('deleted')])); ?>

		</div>
	<?php endif; ?>
</td>

<?php if($branch->hasFeature('domain') and Auth::user()->isGlobal()): ?>
	<td>
		<?php echo e($model->say('domains')); ?>

		<?php if(str_contains($model->domains , '*') ): ?>
			<i class="fa fa-globe mh5 text-success"></i>
		<?php endif; ?>
	</td>
<?php endif; ?>


<td>
	<?php echo $__env->make('manage.frame.widgets.grid-action' , [
		'id' => $model->id ,
		'actions' => [
			['eye' , trans('manage.permits.view') , "urlN:".$model->say('preview')],
			['pencil' , trans('manage.permits.edit') , "url:manage/posts/".$model->branch()->slug."/edit/-id-" , '*' , $model->canEdit()],
			['times' , trans('forms.button.hard_delete') , 'modal:manage/posts/-id-/hard_delete' , "$module.bin" , $model->trashed() and Auth::user()->isDeveloper()] ,


		],
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</td>