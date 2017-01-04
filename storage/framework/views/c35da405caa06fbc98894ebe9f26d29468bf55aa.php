<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.account.tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title"><?php echo e(isset($page[1][1]) ? $page[1][1] : ''); ?></p></div>
	</div>


	<?php /*
	|--------------------------------------------------------------------------
	| Showing the card
	|--------------------------------------------------------------------------
	| Appears only when the user has card already.
	*/ ?>

	<?php if($model->isCard()): ?>
		<div class="w100 mv20 text-center">
			<a class="mv20" href="<?php echo e($url = url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))); ?>" target="_blank">
				<img src="<?php echo e($url); ?>" style="height: 450px">
			</a>
		</div>
	<?php endif; ?>


	<?php /*
	|--------------------------------------------------------------------------
	| Registeration / Edit Button
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div id="divBigButton" class="w100 mv20 text-center">
		<button class="btn btn-primary btn-lg mv20" onclick="$('#divBigButton,#divCardForm').slideToggle()">
			<?php echo e($model->isCard()? trans('people.cards.manage.edit') : trans('site.global.card_register_page')); ?>

		</button>
	</div>


	<?php /*
	|--------------------------------------------------------------------------
	| Registeration Form
	|--------------------------------------------------------------------------
	| Is shown uppon pressing of the big blue registeration or edit button
	*/ ?>
	<div id="divCardForm" class="w100 mv20 noDisplay">
		<?php echo $__env->make('forms.opener' , [
			'url' => 'manage/account/save/card',
			'class' => 'js mv20' ,
			'no_validation' => 1
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.input' , [
				'name' => 'name_first',
				'value' => $model->fullName(),
				'extra' => 'disabled',
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('forms.input' , [
				'name' => 'code_melli',
				'value' => $model->say('code_melli'),
				'extra' => 'disabled',
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.group-start' , [
				'required' => true ,
				'label' => trans('validation.attributes.organs')
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<?php echo $__env->make('manage.cards.editor-organs' , [
					'organs' => $model::$donatable_organs ,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.group-start' , [
				'label' => trans('validation.attributes.newsletter')
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<?php echo $__env->make('forms.check' , [
					'name' => 'newsletter',
					'value' => $model->newsletter,
					'label' => trans('people.cards.manage.newsletter_membership2')
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


			<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<?php echo $__env->make('forms.button' , [
					'label' => $model->isCard()? trans('people.cards.manage.edit') : trans('site.global.card_register_page'),
					'shape' => 'success',
					'type' => 'submit' ,
					'value' => 'save' ,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>