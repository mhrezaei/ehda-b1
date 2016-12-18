<?php echo $__env->make('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/permits'),
	'modal_title' => trans('people.commands.view_info'),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class='modal-body profile'>

	<div style="position:absolute;top: 10px;left: 10px">
		<a href="<?php echo e(url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))); ?>" target="_blank">
			<img src="<?php echo e(url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))); ?>" style="height: 450px">
		</a>
	</div>

	<h2 class="mv20">
		<?php echo e($model->fullName()); ?>

		<?php if($model->isVolunteer()): ?>
			<a href="<?php echo e(Auth::user()->can('volunteers.search')? url('manage/volunteers/search?keyword='.$model->code_melli.'&searched=1') : 'javascript:void(0)'); ?>" class="badge badge-success mh10 f7" target="_blank">
				<?php echo e(trans('people.volunteer')); ?>

			</a>
		<?php endif; ?>
		<?php if($model->newsletter): ?>
			<div class="badge badge-info f7">
				<?php echo e(trans('people.cards.manage.newsletter_member')); ?>

			</div>
		<?php endif; ?>

	</h2>

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
			<td class="body text-<?php echo e($model->cardStatus('color')); ?>">
				<?php echo e($model->cardStatus()); ?>

			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('validation.attributes.card_no')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('card_no')); ?>

			</td>
		</tr>

		<tr>
			<td class="head">
				<?php echo e(trans('people.commands.print_status')); ?>

			</td>
			<td class="body text-<?php echo e(trans('people.card_print_status_color.'.$model->card_print_status)); ?>">
				<?php echo e(trans('people.card_print_status.'.$model->card_print_status)); ?>

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
				<?php echo e(trans('validation.attributes.organs')); ?>

			</td>
			<td class="body">
				<?php echo e($model->say('organs')); ?>

			</td>
		</tr>

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
				<?php echo e($model->say('card_registered_at')); ?>

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

				<?php /*<span>*/ ?>
					<?php /*<?php echo e(trans('forms.general.by').' '.$model->say('updated_by')); ?>*/ ?>
				<?php /*</span>*/ ?>
			</td>
		</tr>

		<?php if($model->trashed('card')): ?>
			<tr>
				<td class="head">
					<?php echo e(trans('forms.general.deleted_at')); ?>

				</td>
				<?php /*<td class="body">*/ ?>
					<?php /*<?php echo e($model->say('deleted_at')); ?>*/ ?>
					<?php /*<span>*/ ?>
						<?php /*<?php echo e(trans('forms.general.by').' '.$model->say('deleted_by')); ?>*/ ?>
					<?php /*</span>*/ ?>
				<?php /*</td>*/ ?>
			</tr>
		<?php endif; ?>

	</table>

</div>

<?php echo $__env->make('templates.modal.end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
