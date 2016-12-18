<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.posts.tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="panel panel-toolbar row w100">
		<div class="col-md-6">
			<p class="title">
				<?php echo e($page[0][1]. ': ' . $page[1][1]); ?>

				<?php if(isset($category_label)): ?>
					<span class="badge mh20 ph20">
						<?php echo e($category_label); ?>

					</span>
				<?php endif; ?>
			</p>
		</div>
		<div class="col-md-6 tools">
			<?php echo $__env->make('manage.posts.browse-category', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.frame.widgets.toolbar_button' , [
				'target' => url('manage/posts/'.$branch->slug.'/create') ,
				'type' => 'success' ,
				'caption' => trans('posts.manage.create' , ['thing'=>$branch->title(1)]) ,
				'icon' => 'plus-circle' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
			($branch->hasFeature('domain') and Auth::user()->isGlobal()) ? trans('posts.manage.visibility') : 'NO',
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