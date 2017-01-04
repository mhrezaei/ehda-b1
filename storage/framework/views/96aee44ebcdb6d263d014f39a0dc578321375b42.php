<?php echo $__env->make('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/permits'),
	'modal_title' => $model->fullName(),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class='modal-body profile'>

	<table>

		<?php /*
		|--------------------------------------------------------------------------
		| Status
		|--------------------------------------------------------------------------
		|
		*/ ?>
		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.status')); ?>

			</td>
			<td class="body text-<?php echo e($model->volunteerStatus('color')); ?>">
				<?php echo e($model->volunteerStatus()); ?>

			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('people.card')); ?>

			</td>
			<td class="body">
				<?php if($model->isCard()): ?>
					<span class="text-success"><?php echo e(trans('forms.logic.has')); ?></span>
				<?php else: ?>
					<span class="text-grey"><?php echo e(trans('forms.logic.hasnt')); ?></span>
				<?php endif; ?>
			</td>
		</tr>


		<?php /*
		|--------------------------------------------------------------------------
		| Personal Information
		|--------------------------------------------------------------------------
		|
		*/ ?>
		<tr>
			<td colspan="2">
				<hr>
			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.code_melli')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('code_melli')); ?>

			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.code_id')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('code_id')); ?>

			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.name_father')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('name_father')); ?>

			</td>
		</tr>


		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.email')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('email')); ?>

			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.birth_date')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('birth_date')); ?>

				<span>
					<?php echo e($model->say('birth_city')); ?>

				</span>
				<span>
					<?php echo e($model->say('marital')); ?>

				</span>
			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.education')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('education')); ?>

				<span>
					<?php echo e($model->say('edu_field')); ?>

				</span>
				<span>
					<?php echo e($model->edu_city? $model->say('edu_city') : ''); ?>

				</span>
			</td>
		</tr>

		<?php /*
		|--------------------------------------------------------------------------
		| Contact Details
		|--------------------------------------------------------------------------
		|
		*/ ?>

		<tr>
			<td colspan="2">
				<hr>
			</td>
		</tr>


		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.tel_mobile')); ?>

			</td>
			<td class="body">
				<?php echo App\Providers\AppServiceProvider::pd(($model->tel_mobile)) ?>
				<span>
					<?php echo e(trans('validation.attributes.tel_emergency')); ?>:&nbsp;
					<?php echo App\Providers\AppServiceProvider::pd(($model->tel_emergency)) ?>
				</span>
			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.home_address')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('home_city').' . '); ?>

				<?php echo e($model->say('home_address')); ?>

				<span>
					<?php echo e(trans('validation.attributes.postal_code')); ?>:&nbsp;
					<?php echo e($model->say('home_postal_code')); ?>

				</span>
				<span>
					<?php echo e(trans('validation.attributes.tel')); ?>:&nbsp;
					<?php echo App\Providers\AppServiceProvider::pd(($model->say('home_tel'))) ?>
				</span>
			</td>
		</tr>
		
		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.work_address')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('work_city').' . '); ?>

				<?php echo e($model->say('work_address')); ?>

				<span>
					<?php echo e(trans('validation.attributes.postal_code')); ?>:&nbsp;
					<?php echo e($model->say('home_postal_code')); ?>

				</span>
				<span>
					<?php echo e(trans('validation.attributes.tel')); ?>:&nbsp;
					<?php echo App\Providers\AppServiceProvider::pd(($model->say('work_tel'))) ?>
				</span>
			</td>
		</tr>

		<?php /*
		|--------------------------------------------------------------------------
		| Misc Fields
		|--------------------------------------------------------------------------
		|
		*/ ?>


		<tr>
			<td colspan="2">
				<hr>
			</td>
		</tr>
		
		<tr>
			<td class="head">
				<?php echo e(trans('exams.single')); ?>

			</td>
			<td class="body">
				<?php if($model->exam_passed_at): ?>
					<?php echo App\Providers\AppServiceProvider::pd(($model->say('exam_result'))) ?>
					<span>
						(<?php echo e($model->say('exam_passed_at')); ?>)
					</span>
				<?php else: ?>
					<?php echo e(trans('exams.not_passed')); ?>

				<?php endif; ?>
			</td>
		</tr>
		
		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.familization')); ?>

			</td>
			<td class="body">
				<?php echo e(trans("people.familization.".$model->familization)); ?>

			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.motivation')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('motivation')); ?>

			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.alloc_time')); ?>

			</td>
			<td class="body">
				<?php echo App\Providers\AppServiceProvider::pd(($model->say('alloc_time'))) ?>
			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('manage.devSettings.activities.title')); ?>

			</td>
			<td class="body">
				<?php foreach($model->say('activities') as $activity): ?>
					<?php echo e($activity); ?>

					<br />
				<?php endforeach; ?>
			</td>
		</tr>

		<?php /* @TODO: Activitis */ ?>

		<?php /*
		|--------------------------------------------------------------------------
		| Timestamps
		|--------------------------------------------------------------------------
		|
		*/ ?>

		<tr>
			<td colspan="2">
				<hr>
			</td>
		</tr>
		

		<tr>
			<td class="head">
				<?php echo e(trans('forms.general.created_at')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('volunteer_registered_at')); ?>

				<?php if($model->created_by): ?>
					<span>
						<?php echo e(trans('forms.general.by'). ' ' . $model->say('created_by')); ?>

					</span>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('forms.general.updated_at')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('updated_at')); ?>

				<span>
					<?php echo e(trans('forms.general.by').' '.$model->say('updated_by')); ?>

				</span>
			</td>
		</tr>


		<?php if($model->published_at): ?>
			<tr>
				<td class="head">
					<?php echo e(trans('forms.general.published_at')); ?>

				</td>
				<td class="body">
					<?php echo e($model->say('published_at')); ?>

					<span>
						<?php echo e(trans('forms.general.by').' '.$model->say('published_by')); ?>

					</span>
				</td>
			</tr>
		<?php endif; ?>


		<?php if($model->trashed()): ?>
			<tr>
				<td class="head">
					<?php echo e(trans('forms.general.deleted_at')); ?>

				</td>
				<td class="body">
					<?php echo e($model->say('deleted_at')); ?>

					<span>
						<?php echo e(trans('forms.general.by').' '.$model->say('deleted_by')); ?>

					</span>
				</td>
			</tr>
		<?php endif; ?>

	</table>

</div>

<?php echo $__env->make('templates.modal.end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
