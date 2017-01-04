<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.volunteers.tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title"><?php echo e(isset($page[1][1]) ? $page[1][1] : ''); ?></p></div>
		<div class="col-md-8 tools">

			<?php echo $__env->make('manage.frame.widgets.toolbar_button' , [
				'target' => url('manage/volunteers/create') ,
				'type' => 'success' ,
				'caption' => trans('people.volunteers.manage.create') ,
				'icon' => 'plus-circle' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('manage.frame.widgets.grid-action' , [
				'id' => '0',
				'button_size' => 'md' ,
				'button_class' => 'primary' ,
				'button_label' => trans('forms.button.bulk_action'),
				'button_extra' => 'disabled' ,
				'actions' => [
//					['envelope-o' , trans('people.commands.send_email') , 'modal:manage/volunteers/-id-/email' , 'volunteers.send' ] ,
//					['mobile' , trans('people.commands.send_sms') , 'modal:manage/volunteers/-id-/sms' , 'volunteers.send' ] ,
					['check' , trans('people.commands.activate') , 'modal:manage/volunteers/-id-/publish' , 'volunteers.publish' , $page[1][2]!='bin' and $page[1][2]!='active'],
					['ban' , trans('people.commands.block') , 'modal:manage/volunteers/-id-/soft_delete' , 'volunteers.delete' , $page[1][2]!='bin'] ,
					['undo' , trans('people.commands.unblock') , 'modal:manage/volunteers/-id-/undelete' , 'volunteers.bin' , $page[1][2]=='bin'] ,
					['times' , trans('people.commands.hard_delete') , 'modal:manage/volunteers/-id-/hard_delete' , 'volunteers.developer' , $page[1][2]=='bin'] ,

				]
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('manage.frame.widgets.toolbar_search_inline' , [
				'target' => url('manage/volunteers/search/') ,
				'label' => trans('people.commands.search') ,
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
			trans('validation.attributes.name_first') ,
			trans('validation.attributes.home_city'),
			trans('validation.attributes.occupation'),
			trans('people.card'),
			trans('validation.attributes.status'),
			trans('forms.button.action'),
		],
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php foreach($model_data as $model): ?>
		<tr id="tr-<?php echo e($model->id); ?>" class="grid" ondblclick="gridSelector('tr','<?php echo e($model->id); ?>')">
			<?php echo $__env->make('manage.volunteers.browse-row' , ['model'=>$model], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</tr>
	<?php endforeach; ?>

	<?php echo $__env->make('manage.volunteers.browse-null', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('manage.frame.widgets.grid-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="paginate">
		<?php echo $model_data->render(); ?>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>