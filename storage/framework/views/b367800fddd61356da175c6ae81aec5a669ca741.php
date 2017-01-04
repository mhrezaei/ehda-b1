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
		</div>
	</div>


	<div class="panel panel-default m20">

		<?php echo $__env->make('forms.opener',[
			'url' => 'manage/cards/search' ,
			'class' => 'js-' ,
			'method' => 'get',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<br>

			<?php echo $__env->make('forms.hiddens' , ['fields' => [
				['searched' , 1],
			]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.input' , [
				'name' => 'keyword',
				'class' => 'form-required form-default'
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<?php echo $__env->make('forms.button' , [
					'label' => trans('forms.button.search'),
					'shape' => 'success',
					'type' => 'submit' ,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>