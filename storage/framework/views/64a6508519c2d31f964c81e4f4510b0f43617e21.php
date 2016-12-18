<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.cards.tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title"><?php echo e(isset($page[1][1]) ? $page[1][1] : ''); ?></p></div>
		<div class="col-md-8 tools">

			<?php if(Auth::user()->can('cards.create')): ?>
				<?php echo $__env->make('manage.frame.widgets.toolbar_button' , [
					'target' => url('manage/cards/create') ,
					'type' => 'success' ,
					'caption' => trans('people.cards.manage.create') ,
					'icon' => 'plus-circle' ,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>

			<?php if(Auth::user()->can('cards.bulk')): ?>
				<?php echo $__env->make('manage.frame.widgets.grid-action' , [
					'id' => '0',
					'button_size' => 'md' ,
					'button_class' => 'primary' ,
					'button_label' => trans('forms.button.bulk_action'),
					'button_extra' => 'disabled' ,
					'actions' => [
						['envelope-o' , trans('people.commands.send_email') , 'modal:manage/cards/-id-/email' , 'cards.send' ] ,
						['mobile' , trans('people.commands.send_sms') , 'modal:manage/cards/-id-/sms' , 'cards.send' ] ,
						['print' , trans('forms.button.card_print') , 'modal:manage/cards/-id-/print' , 'cards.print' ] ,
						['times' , trans('forms.button.hard_delete') , 'modal:manage/cards/-id-/delete' , 'cards.delete' , $page[1][2]!='bin'] ,

					]
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>

			<?php if(Auth::user()->can('cards.search')): ?>
				<?php echo $__env->make('manage.frame.widgets.toolbar_search_inline' , [
					'target' => url('manage/cards/search/') ,
					'label' => trans('people.commands.search') ,
					'value' => isset($keyword)? $keyword : '' ,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>
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
			trans('people.cards.manage.domain'),
			trans('validation.attributes.status'),
			trans('forms.button.action'),
		],
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php foreach($model_data as $model): ?>
		<tr id="tr-<?php echo e($model->id); ?>" class="grid" ondblclick="gridSelector('tr','<?php echo e($model->id); ?>')">
			<?php echo $__env->make('manage.cards.browse-row' , ['model'=>$model], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</tr>
	<?php endforeach; ?>

	<?php echo $__env->make('manage.cards.browse-null', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('manage.frame.widgets.grid-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="paginate">
		<?php echo $model_data->render(); ?>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>