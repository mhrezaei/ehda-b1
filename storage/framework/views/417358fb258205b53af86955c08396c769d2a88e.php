<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.posts.tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title"><?php echo e($page[0][1]. ': ' . $page[1][1]); ?></p></div>
		<div class="col-md-8 tools">

			<?php echo $__env->make('manage.frame.widgets.toolbar_button' , [
				'target' => url('manage/posts/'.$branch->slug.'/create') ,
				'type' => 'success' ,
				'caption' => trans('posts.manage.create' , ['thing'=>$branch->title(1)]) ,
				'icon' => 'plus-circle' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php /*<?php echo $__env->make('manage.frame.widgets.grid-action' , [*/ ?>
				<?php /*'id' => '0',*/ ?>
				<?php /*'button_size' => 'md' ,*/ ?>
				<?php /*'button_class' => 'primary' ,*/ ?>
				<?php /*'button_label' => trans('forms.button.bulk_action'),*/ ?>
				<?php /*'button_extra' => 'disabled' ,*/ ?>
				<?php /*'actions' => [*/ ?>
<?php /*//					['check' , trans('people.commands.activate') , 'modal:manage/posts/-id-/publish' , 'volunteers.publish' , $page[1][2]!='bin' and $page[1][2]!='active'],*/ ?>
					<?php /*['trash-o' , trans('people.commands.soft_delete') , 'modal:manage/posts/-id-/soft_delete' , $branch->slug.".delete" , $page[1][2]!='bin'] ,*/ ?>
					<?php /*['undo' , trans('people.commands.undelete') , 'modal:manage/posts/-id-/undelete' , $branch->slug.".bin" , $page[1][2]=='bin'] ,*/ ?>
					<?php /*['times' , trans('people.commands.hard_delete') , 'modal:manage/posts/-id-/hard_delete' , $branch->slug.".bin" , $page[1][2]=='bin'] ,*/ ?>

				<?php /*]*/ ?>
			<?php /*], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>

			<?php echo $__env->make('manage.frame.widgets.toolbar_search_inline' , [
				'target' => url('manage/posts/'.$branch->slug.'/searched/') ,
				'label' => trans('posts.manage.search' , ['thing'=>$branch->title(1)]) ,
				'value' => isset($keyword)? $keyword : '' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>


	<?php /*
	|--------------------------------------------------------------------------
	| Grid
	|--------------------------------------------------------------------------
	|
	*/ ?>

	<?php echo $__env->make('manage.frame.widgets.grid-start' , [
		'selector' => true ,
		'headings' => [
			trans('validation.attributes.title') ,
			trans('posts.manage.properties'),
			$branch->hasFeature('domains') ? trans('posts.manage.visibility') : 'NO',
			trans('forms.button.action'),
		],
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php foreach($model_data as $model): ?>
		<tr id="tr-<?php echo e($model->id); ?>" class="grid" ondblclick="gridSelector('tr','<?php echo e($model->id); ?>')">
			<?php echo $__env->make('manage.posts.browse-row' , ['model'=>$model , 'module'=>$branch->slug], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</tr>
	<?php endforeach; ?>

	<?php echo $__env->make('manage.volunteers.browse-null', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('manage.frame.widgets.grid-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="paginate">
		<?php echo $model_data->render(); ?>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>