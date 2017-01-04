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
	| Delete Card
	|--------------------------------------------------------------------------
	| Available only when the volunteer has active card
	*/ ?>

	<?php if($model->isCard()): ?>
		<div class="panel mv20">

			<div class="mv20 text-center">
				<button class="btn btn-lg btn-warning" onclick="$('#divAlertCard').slideToggle();$('#divAlertVolunteer').slideUp()">
					<?php echo e(trans('manage.account.card_delete_button')); ?>

				</button>
			</div>

			<div id="divAlertCard" class="alert alert-warning noDisplay">
				<?php echo $__env->make('templates.widgets.alert' , [
					'shape' => 'danger' ,
					'texts' => [
						trans('people.cards.manage.delete_notice_1') ,
						trans('people.cards.manage.delete_notice_2') ,
					]
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<?php echo $__env->make('forms.opener' , [
					'url' => 'manage/account/save/card_delete',
					'class' => 'js' ,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<div class="row w60 mv10">
						<div class="col-md-6 text-center">
							<button type="submit" class="btn btn-danger">
								<?php echo e(trans('manage.account.card_delete_button')); ?>

							</button>
						</div>
						<div class="col-md-6 text-center">
							<button type="button" class="btn btn-default" onclick="$('#divAlertCard').slideToggle()">
								<?php echo e(trans('forms.button.cancel')); ?>

							</button>
						</div>
					</div>

					<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			</div>

		</div>
	<?php endif; ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Delete Volunteer Account
	|--------------------------------------------------------------------------
	|
	*/ ?>

	<div class="panel mv20">

		<div class="mv20 text-center">
			<button class="btn btn-lg btn-danger" onclick="$('#divAlertVolunteer').slideToggle();$('#divAlertCard').slideUp()">
				<?php echo e(trans('manage.account.volunteer_delete_button')); ?>

			</button>
		</div>

		<div id="divAlertVolunteer" class="alert alert-warning noDisplay">
			<?php echo $__env->make('templates.widgets.alert' , [
				'shape' => 'danger' ,
				'texts' => [
					trans('people.volunteers.manage.delete_notice_1') ,
					$model->isCard()? trans('people.volunteers.manage.delete_notice_2') : trans('people.volunteers.manage.delete_notice_3') ,
					trans('people.volunteers.manage.delete_notice_4') ,
				]
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.opener' , [
				'url' => 'manage/account/save/volunteer_delete',
				'class' => 'js' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<div class="row w60 mv10">
					<div class="col-md-6 text-center">
						<button type="submit" class="btn btn-danger">
							<?php echo e(trans('manage.account.volunteer_delete_button')); ?>

						</button>
					</div>
					<div class="col-md-6 text-center">
						<button type="button" class="btn btn-default" onclick="$('#divAlertVolunteer').slideToggle()">
							<?php echo e(trans('forms.button.cancel')); ?>

						</button>
					</div>
				</div>

				<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		</div>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>